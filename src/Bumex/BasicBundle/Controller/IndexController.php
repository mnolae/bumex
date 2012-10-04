<?php

namespace Bumex\BasicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;

use Bumex\BasicBundle\Form\FicheroType;
use Bumex\BasicBundle\Entity\Fichero;
use Bumex\BasicBundle\Entity\Edicto;
use Bumex\BasicBundle\Entity\Expediente;
use Bumex\BasicBundle\Entity\Href;
use Bumex\BasicBundle\Entity\Historico;

use MakerLabs\PagerBundle\Pager;
use MakerLabs\PagerBundle\Adapter\DoctrineOrmAdapter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class IndexController extends Controller
{
	/**
     * @Route("/index", name="_bumex_index")
     * @Template()
     */
    public function indexAction()
    {
    	$fichero = new Fichero();
		$fichero->setFrmFecha(new \DateTime('yesterday')); // Valor por defecto del campo fecha: ayer
        $form = $this->createForm(new FicheroType(), $fichero);
		
		return $this->render('BumexBasicBundle:Index:index.html.twig', array('form' => $form->createView()));
	}
	
	/**
     * @Route("/expedientes", name="_bumex_expedientes")
     * @Template()
     */
    public function expedientesAction(Request $request)
    {
		if ($request->getMethod() == 'POST') {
    			
    		$fichero = new Fichero();
        	$form = $this->createForm(new FicheroType(), $fichero);
			$form->bindRequest($request);
			
			if($form->isValid()) {
				
				// Copia el fichero al directorio creado app/cache/tmp
				$this->gestionarFichero($form); 
						 
				// Obtiene los edictos y sus expedientes				
				$this->obtenerEdictos($form['frmFecha']->getData());
				
				// Obtiene los datos del xls y busca las coincidencias
				$this->gestionarDatosFichero($form); 
				
				// Borra el fichero y el directorio app/cache/tmp
				$this->gestionarFichero($form, 'borrar');
				
				// Genera los pdf de los edictos, los clientes con multa y los no clientes.
				$this->generarPdf();
				
				// Registra en el histórico los datos conseguidos, pasamos la fecha en formato sajón
				$datos = $this->registrarHistorico($form['frmFecha']->getData());
				
				// Limpiamos las tablas
				$this->limpiarTablas();
			}
			
		} else {
			// si entras en expedientes mediante URL, sin pasar por index
			return $this->redirect($this->generateUrl('index'));
		}
		
		return array('datos' => $datos);
    }
		
	/**
     * @Route("/historial/{page}", defaults={"page"=1}, name="_bumex_historial")
	 * @Template()
	 */
    public function historialAction($page)
    {
    	// Obtenemos el histórico
    	$repo = $this->getDoctrine()->getRepository('BumexBasicBundle:Historico');
    	$query = $repo->createQueryBuilder('h')
					    ->orderBy('h.id', 'DESC');

		$adapter = new DoctrineOrmAdapter($query);
		$pager = new Pager($adapter, array('page' => $page, 'limit' => 10));
		
		
        return array('datos' => $pager);
    }
	
	private function gestionarFichero($fichero, $accion = 'guardar') {
		
		$dir = $_SERVER['DOCUMENT_ROOT'] . '/bumex/app/cache/tmp';
		$nombre = $fichero['file']->getData()->getClientOriginalName();
		
		if($accion == 'guardar') {
			// mkdir($dir, 0700);
			$fichero['file']->getData()->move($dir, $nombre);
		} elseif ($accion == 'borrar') {
			unlink($dir . "/" . $nombre);
			// rmdir($dir);
		}
		
	}
	
	private function gestionarDatosFichero($fichero) {
		$resultados = 0;
		$dir = $_SERVER['DOCUMENT_ROOT'] . '/bumex/app/cache/tmp';
		$nombre = $fichero['file']->getData()->getClientOriginalName();
		
		$exelObj = $this->get('xls.load_xls5')->load($dir . "/" . $nombre);
		$sheetData = $exelObj->getActiveSheet()->toArray(null,true,true,true);
		foreach ($sheetData as $tupla) {
			foreach ($tupla as $dato) {
				if($dato) 
					if($this->actualizarExpediente($dato))
						$resultados += 1;
			}
		}
		
		// print_r($sheetData);
		return $resultados;
	}
	
	private function actualizarExpediente($dato) {
		$return = FALSE;
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $this->getDoctrine()->getRepository('BumexBasicBundle:Expediente');
		$query = $repository->createQueryBuilder('ex')
	    		->where('ex.nif like :dato OR ex.matricula like :dato')
	    		->setParameter('dato', $dato)
	    		->getQuery();

		$expedientes = $query->getResult();
		
		foreach ($expedientes as $exp) {
			$exp->setCoincidencia(TRUE);
			$exp->setTlf(NULL);
			$return = TRUE;
		}
		
		$em->flush();
		
		return $return;
	}
	
	private function obtenerEdictos($fechaBusqueda) {

		// Por cada provincia lanzamos una búsqueda; Del 1 al 54 contempla TESTRA
		for ($provincia=34; $provincia <= 34; $provincia++) {
			$this->obtenerListasProvincia($provincia, $fechaBusqueda);
		}

		// Desde aquí traer los registros de Href
		$listaHref = $this->getDoctrine()->getRepository('BumexBasicBundle:Href')->findAll();
		
		foreach ($listaHref as $href)
			$this->obtenerDatosIframe($href->getHref());
		
		return TRUE;
	}

	private function obtenerListasProvincia($provincia, $fechaBusqueda, $csfv = FALSE, $dir = FALSE, $pag = FALSE)
	{
		$url = 'https://sede.dgt.gob.es/WEB_TTRA_CONSULTA/TablonEdictosPublico.faces';
		
		if(!$pag){
			$dir = $_SERVER['DOCUMENT_ROOT'] . '/bumex/app/cache/tmp/cookies/' . time();
			
			$pagina = $this->peticionCurl($url, FALSE, $dir);
			$csfv = $pagina['csfv'];

			$inputs = array(
						'habilitado' => 'habilitado',
						'habilitado:_id42' => 'Búsqueda Avanzada',
						'com.sun.faces.VIEW' => $csfv
					);
			
			
			$pagina = $this->peticionCurl($url, $inputs, $dir);
			
			$csfv = $pagina['csfv'];

			$inputs = array(
				        'dato:BusInput' => '*',      // $dato
			    	    'dato:cal1' => $fechaBusqueda->format('d-m-Y'),
			        	'dato:cal2' => $fechaBusqueda->format('d-m-Y'),
				        'dato:selector1' => $provincia,
				        'dato' => 'dato',
				        'dato:_id50' => '',
				        'com.sun.faces.VIEW' => $csfv
				    );
		}
		
		if($pag){
			$inputs = array(
							'paginacion' => 'paginacion',
							'paginacion:siguiente' => '',
							'com.sun.faces.VIEW' => $csfv
					);
		}
		
		$pagina = $this->peticionCurl($url, $inputs, $dir);
		
		$data = $pagina['html'];
		$csfv = $pagina['csfv'];
		
		$doc = new \DOMDocument();
		$doc->loadHTML($data);
		$xpath = new \DOMXPath($doc);
		
		$listado = $xpath->query('//ul[@class="capaUL"]');
		
		foreach($listado as $edicto) {
			if($this->comprobarVigencia($edicto, $xpath)) {
				$href = $this->obtenerHref($edicto, $xpath);
				
				$enlace = new Href();
				$enlace->setHref($href);
				$enlace->setProvincia($provincia);
				$enlace->setFecha($fechaBusqueda);
				
				$em = $this->getDoctrine()->getEntityManager();
		    	$em->persist($enlace);
				$em->flush();
			}
		}
		
		$siguiente = $xpath->query('//input[@name="paginacion:siguiente"]');
		
		if($siguiente->length > 0){
			$this->obtenerListasProvincia($provincia, $fechaBusqueda, $csfv, $dir, TRUE);
		}
		
		
		return TRUE;
	}
	
	private function comprobarVigencia($edicto, $xpath) {

		$vigencia = $xpath->query($edicto->getNodePath().'/li/div[@class="floatLeft tamanoEstadoCaracter"]');
		return (strpos($vigencia->item(0)->nodeValue, 'No vigente') === FALSE) ? TRUE : FALSE;
	}
	
	private function obtenerHref($edicto, $xpath) {
		$href = $xpath->query($edicto->getNodePath() . '/li[@class="estiloCabeceraEdicto"]/a');
		return $href->item(0)->getAttribute('href');
	}
	
	private function obtenerDatosIframe($pagina) {
		
		$count = array('edictos' => 0, 'expedientes' => 0);
		
		$url = $this->obtenerSrcIframe($pagina);
		
		$handler = curl_init();  
		
		curl_setopt($handler, CURLOPT_URL, 'https://sede.dgt.gob.es' . $url);
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
		
		$data = curl_exec ($handler);  
		curl_close($handler);
		
		$doc = new \DOMDocument();
		$doc->loadHTML($data);
		$xpath = new \DOMXPath($doc);
		$codEdicto = $this->obtenerTextoEdicto($xpath, $pagina); $count['edictos'] += 1;
		$this->obtenerExpedientesEdicto($xpath, $codEdicto);
		
		return TRUE;
	}
	
	private function obtenerSrcIframe($pagina) {
		$url = "https://sede.dgt.gob.es" . $pagina;
		$dir = $_SERVER['DOCUMENT_ROOT'] . '/bumex/app/cache/tmp/cookies/' . time();
		
		$pagina = $this->peticionCurl($url, FALSE, $dir);
		
		$csfv = $pagina['csfv'];
		
		$inputs = array(
				        'dato:BusInput'		=> '_*', // Muestra todos los resultados
				        'criterioBusqueda' 	=> '1', // Búsqueda por expediente
		        		'dato:js3' 			=> '',
		        		'dato' 				=> 'dato',
		        		'com.sun.faces.VIEW' => $csfv
		    		);
	
		$pagina = $this->peticionCurl($url, $inputs, $dir);
		
		$data = $pagina['html'];
		
		$doc = new \DOMDocument();
		$doc->loadHTML($data);
		$xpath = new \DOMXPath($doc);
		
		$iframe = $xpath->query('//iframe[@id="capaHTML"]');
		
		return $iframe->item(0)->getAttribute('src');
	}
	
	private function obtenerTextoEdicto($xpath, $pagina) {
		$hoja = new Edicto();
		
		$num = $xpath->query('/html/body/table/tr/td[2]/table/tr[7]/td[2]/span');
		$hoja->setNumero($num->item(0)->nodeValue);

		$fecha = $xpath->query('/html/body/table/tr/td[2]/table/tr[7]/td[4]');
		$hoja->setFecha($fecha->item(0)->nodeValue);
		
        $membrete = $xpath->query('/html/body/table/tr/td[2]/table/tr[13]/td[2]');
        $hoja->setMembrete($membrete->item(0)->nodeValue);

        $entrada = $xpath->query('/html/body/table/tr/td[2]/table/tr[18]/td[2]/span');
        $hoja->setEntrada($entrada->item(0)->nodeValue);

        $texto = $xpath->query('/html/body/table/tr/td[2]/table/tr[20]/td[2]');
        $hoja->setTexto($texto->item(0)->nodeValue);
		
		$hoja->setEnlace($pagina);
		
		$em = $this->getDoctrine()->getEntityManager();
    	$em->persist($hoja);
    	$em->flush();
		
		return $hoja->getId();	
	}
		
	private function obtenerExpedientesEdicto($xpath, $idEdicto) {
		$letras = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'P', 'Q', 'R', 'S', 'U', 'V', 'N', 'W');
		
		$exps = $xpath->query('/html/body/table/tr/td[2]/table/tr[24]');
		
		$edicto = $this->getDoctrine()->getRepository('BumexBasicBundle:Edicto')->find($idEdicto);
		
		$col40 = $xpath->query('//td[@colspan="40"]');
		$tope = $col40->item(9)->getNodePath();
		$tr = 25; // El 24 son las cabeceras de la tabla de expedientes. 
		$count = 0;
		
		// Bucle que obtiene la línea
		do {
			$vacio = 0;
			
			$multa = new Expediente();
			$multa->setEdicto($edicto);
			
			// Bucle que obtiene cada dato de la línea
			for ($td=2; $td <= 22; $td+=2) {
				$control = '/html/body/table/tr/td[2]/table/tr[' . $tr . ']/td';
				$cab = $xpath->query('/html/body/table/tr/td[2]/table/tr[' . $tr . ']/td[' . $td . ']');

				switch ($td) {
					case 2: // Expediente
						if(is_object($cab->item(0))) {
							$multa->setExpediente($cab->item(0)->textContent);
							$vacio++;
						} 
						break;
					case 4: // Nombre
						if(is_object($cab->item(0))) {
							$multa->setNombre($cab->item(0)->textContent);
							$vacio++;
						}
						break;
					case 6: // NIF
						if(is_object($cab->item(0))){
							$multa->setNif($cab->item(0)->textContent);							
							if(in_array(substr($cab->item(0)->textContent,0,1), $letras))
								$multa->setTlf($this->buscarTelefono($cab->item(0)->textContent));
						} 
						break;
					case 8: // Localidad
						if(is_object($cab->item(0))) $multa->setLocalidad($cab->item(0)->textContent);
						break;
					case 10: // Fecha
						if(is_object($cab->item(0))) $multa->setFecha($cab->item(0)->textContent);
						break;
					case 12: // Matrícula
						if(is_object($cab->item(0))) $multa->setMatricula($cab->item(0)->textContent);
						break;
					case 14: // Euros
						if(is_object($cab->item(0))) $multa->setEuros($cab->item(0)->textContent);
						break;
					case 16: // Precepto
						if(is_object($cab->item(0))) $multa->setPrecepto($cab->item(0)->textContent);
						break;
					case 18: // Art
						if(is_object($cab->item(0))) $multa->setArt($cab->item(0)->textContent);
						break;
					case 20: // Puntos
						if(is_object($cab->item(0))) $multa->setPuntos($cab->item(0)->textContent);
						break;
					case 22: // Req
						if(is_object($cab->item(0))) $multa->setReq($cab->item(0)->textContent);
						break;
				}
			}
			$tr++;
			
			if ($vacio == 2) {
				$em = $this->getDoctrine()->getEntityManager();
	    		$em->persist($multa);
	    		$em->flush();
				
				$count++;
			}
			
		} while ($control != $tope);
		
		return $count;
	}

	private function generarPdf(){
		
		$edictos = $this->getDoctrine()->getRepository('BumexBasicBundle:Edicto')->findAll();
		
		$edictos = $this->getDoctrine()->getRepository('BumexBasicBundle:Edicto')->findAll();
		
		foreach ($edictos as $edicto) {
			$crea = FALSE;
			$directorio = $_SERVER['DOCUMENT_ROOT'] . '/bumex/app/cache/tmp/';
			
			$query = $this->getDoctrine()->getEntityManager()
			    ->createQuery('SELECT ex FROM BumexBasicBundle:Expediente ex WHERE ex.edicto = :id')
				->setParameter('id', $edicto->getId());
			
			$exps = $query->getResult();
			
			$listaExp = $listaTlf = array();
			foreach ($exps as $exp) {
				if($exp->getCoincidencia() == '1'){
					$listaExp[] = $exp;
					$crea = TRUE;
				}
				elseif($exp->getTlf() != NULL){
					$listaTlf[] = $exp;
					$crea = TRUE;
				}
			}
			
			if($crea){
				$directorio .= $edicto->getNumero() . " [" . date('dmyHis') . "]";
				$this->crearPdfEdicto($edicto, $directorio);
				if(count($listaExp) > 0)
					$this->crearPdfExpedientes($listaExp, $directorio, 'Listado Clientes.pdf');
				if(count($listaTlf) > 0)
					$this->crearPdfExpedientes($listaTlf, $directorio, 'Listado Teléfonos.pdf');
			}
		}
	}

	private function crearPdfEdicto($edicto, $directorio, $nombre = 'Edicto.pdf') {
		
		mkdir($directorio, 0777);
		
		$pdfObj = $this->get("white_october.tcpdf")->create();
		$pdfObj->addPage();
		$pdfObj->Write($h=0, $edicto->getNumero(), $link='', $fill=0, $align='L', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
		$pdfObj->Write($h=0, "Fecha de publicación: " . substr($edicto->getFecha(), 6), $link='', $fill=0, $align='L', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
		$pdfObj->Write($h=0, "Enlace de comprobación: https://sede.dgt.gob.es" . $edicto->getEnlace(), $link='', $fill=0, $align='L', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
		$pdfObj->Write($h=0, $edicto->getMembrete(), $link='', $fill=0, $align='L', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
		$pdfObj->Write($h=0, $edicto->getEntrada(), $link='', $fill=0, $align='L', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
		$pdfObj->Write($h=0, $edicto->getTexto(), $link='', $fill=0, $align='L', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
		$pdfObj->Output($directorio . "/" . $nombre, 'F');
		
		return TRUE; 
	}
 
	private function crearPdfExpedientes($exps, $directorio, $nombre) {
		$pdfObj = $this->get("white_october.tcpdf")->create();
		$pdfObj->addPage('L');
		
		$tbl = $this->obtenerTabla($exps);
		
		$pdfObj->writeHTML($tbl, true, false, false, false, '');		
		$pdfObj->Output($directorio . "/" . $nombre, 'F');
		
		return TRUE; 
	}
	
	private function buscarTelefono($cif){
		$existe = $this->realizarBusquedaAxesor($cif);
		
		if(!$existe) $existe = 000000000;
		
		return $existe;
	}
	
	private function realizarBusquedaAxesor($cif){
		$existe = 999999999;
		$url = 'http://www.axesor.es/buscar/empresas?q=' . $cif;
		
		$handler = curl_init();  
		
		curl_setopt($handler, CURLOPT_URL, $url);
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($handler, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($handler, CURLOPT_MAXREDIRS, 1);
		
		$response = curl_exec ($handler);  
		curl_close($handler);  
	
		$doc = new \DOMDocument();
		@$doc->loadHTML($response);
		$xpath = new \DOMXPath($doc);
		
		$input = $xpath->query('//span[@class="tel"]');
		if(is_object($input->item(0)))
			$existe = $input->item(0)->nodeValue;
		
		return $existe;
	}
	
	private function obtenerTabla($exps){
		// Cabecera de la tabla de expedientes
		$tbl = '<table cellspacing="0" cellpadding="1" border="1">
					<tr>
					        <td>Expediente</td><td>Nombre</td><td>DNI/NIF</td><td>Localidad</td><td>Fecha</td>
					        <td>Matrícula</td><td>Euros</td><td>Precepto</td><td>Art.</td><td>Puntos</td><td>Req.</td>
					        <td>Tlf</td>
					</tr>';
					
		foreach ($exps as $exp){
			$tbl .= '<tr style="background-color: #FAFAFA">';
			$tbl .= '	<td>' . $exp->getExpediente() . '&nbsp;</td>';
			$tbl .= '	<td>' . $exp->getNombre() . '&nbsp;</td>';
			$tbl .= '	<td>' . $exp->getNif() . '&nbsp;</td>';
			$tbl .= '	<td>' . $exp->getLocalidad() . '&nbsp;</td>';
			$tbl .= '	<td>' . $exp->getFecha() . '&nbsp;</td>';
			$tbl .= '	<td>' . $exp->getMatricula() . '&nbsp;</td>';
			$tbl .= '	<td>' . $exp->getEuros() . '&nbsp;</td>';
			$tbl .= '	<td>' . $exp->getPrecepto() . '&nbsp;</td>';
			$tbl .= '	<td>' . $exp->getArt() . '&nbsp;</td>';
			$tbl .= '	<td>' . $exp->getPuntos() . '&nbsp;</td>';
			$tbl .= '	<td>' . $exp->getReq() . '&nbsp;</td>';
			if($exp->getTlf())
				$tbl .= '	<td>' . $exp->getTlf() . '&nbsp;</td>';
			$tbl .= '</tr>';
		}
		
		$tbl .= '</table>';
		
		return $tbl;
	}

	private function peticionCurl($url, $params = FALSE, $dirCookie){
		
		$handler = curl_init();  
		curl_setopt($handler, CURLOPT_URL, $url);
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE); // Para no mostrar la página recibida
		curl_setopt($handler, CURLOPT_COOKIEFILE, $dirCookie); 
		curl_setopt($handler, CURLOPT_COOKIEJAR, $dirCookie);

		if($params){
			$postdata = http_build_query($params);
			curl_setopt($handler, CURLOPT_POST, TRUE);  
			curl_setopt($handler, CURLOPT_POSTFIELDS, $postdata);
		}
		
		$response = curl_exec($handler);  

		curl_close($handler);

		$pagina['csfv'] = $this->obtenerCsfv($response);
		$pagina['html'] = $response;
		
		return $pagina;
	}
	
	private function obtenerCsfv($data){
		
		$doc = new \DOMDocument();
		@$doc->loadHTML($data);
		$xpath = new \DOMXPath($doc);
		$listado = $xpath->query('//input[@name="com.sun.faces.VIEW"]');
		if($listado->length > 0)
			return $listado->item(0)->getAttribute('value');
		
		return FALSE;
	}

	private function limpiarTablas(){
		$em = $this->getDoctrine()->getEntityManager();
		$conn = $em->getConnection();
		$conn->query('SET FOREIGN_KEY_CHECKS=0');
		$conn->query('TRUNCATE Edicto');
		$conn->query('TRUNCATE Expediente');
		$conn->query('TRUNCATE Href');
		$conn->query('SET FOREIGN_KEY_CHECKS=1');
		
		
	}
	
	private function registrarHistorico($fecha){
		$historico = new Historico();
		
		$historico->setFecha($fecha);
		
		// Número de edictos
		$query = $this->getDoctrine()->getEntityManager()
			    ->createQuery('SELECT count(ed.id) as dato FROM BumexBasicBundle:Edicto ed');

		$dato = $query->getResult();
				
		$historico->setNedictos($dato[0]['dato']);
		
		// Número de expedientes
		$query = $this->getDoctrine()->getEntityManager()
			    ->createQuery('SELECT count(ex.id) as dato FROM BumexBasicBundle:Expediente ex');
		
		$dato = $query->getResult();
		
		$historico->setNexpedientes($dato[0]['dato']);
		
		// Número de coincidencias
		$query = $this->getDoctrine()->getEntityManager()
			    ->createQuery('SELECT COUNT(ex.id) as dato FROM BumexBasicBundle:Expediente ex WHERE ex.coincidencia IS NOT NULL');
		
		$dato = $query->getResult();
		
		$historico->setNcoincidencias($dato[0]['dato']);
		
		// Número de teléfonos
		$query = $this->getDoctrine()->getEntityManager()
			    ->createQuery('SELECT count(ex.id) as dato FROM BumexBasicBundle:Expediente ex WHERE ex.tlf IS NOT NULL');
		
		$dato = $query->getResult();
		
		$historico->setNtelefonos($dato[0]['dato']);
		
		// Fecha en que se realiza la búsqueda
		$f = new \DateTime(date('Y-m-d H:i:s'));
		$historico->setFbusqueda($f);
		
		// Registramos
		$em = $this->getDoctrine()->getEntityManager();
    	$em->persist($historico);
		$em->flush();
		
		return $historico;
	}
}
