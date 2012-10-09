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
use Bumex\BasicBundle\Entity\Config;

use MakerLabs\PagerBundle\Pager;
use MakerLabs\PagerBundle\Adapter\DoctrineOrmAdapter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class IndexController extends Controller
{
	private $directorio;
	
	/**
     * @Route("/index", name="_bumex_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
    	$dirMod = FALSE;
		if ($request->getMethod() == 'POST')
			$dirMod = $this->cambiarDirectorio($_POST['ruta']);
		
    	$this->cargarDirectorio();
		$testraok = $this->estadoTestra();
    	$fichero = new Fichero();
		$fichero->setFrmFecha(new \DateTime('yesterday')); // Valor por defecto del campo fecha: ayer
        $form = $this->createForm(new FicheroType(), $fichero);
		
		return $this->render('BumexBasicBundle:Index:index.html.twig', array('testraok' => $testraok,'directorio' => $this->getDirectorio(), 'dirMod' => $dirMod, 'form' => $form->createView()));
	}
	
	/**
     * @Route("/expedientes", name="_bumex_expedientes")
     * @Template()
     */
    public function expedientesAction(Request $request)
    {
		if ($request->getMethod() == 'POST') {
			$this->cargarDirectorio();
    			
    		$fichero = new Fichero();
        	$form = $this->createForm(new FicheroType(), $fichero);
			$form->bindRequest($request);
			
			if($form->isValid()) {
				
				// Copia el fichero al directorio creado app/cache/tmp
				$this->gestionarFicheros($form); 
						 
				// Obtiene los edictos y sus expedientes				
				$this->obtenerEdictos($form['frmFecha']->getData());
				
				// Obtiene los datos del xls y busca las coincidencias
				$this->gestionarDatosFichero($form); 
				
				
				// Genera los pdf de los edictos, los clientes con multa y los no clientes.
				$this->generarPdf();
				
				// Registra en el histórico los datos conseguidos, pasamos la fecha en formato sajón
				$datos = $this->registrarHistorico($form['frmFecha']->getData());
				
				// Borra el fichero y el directorio app/cache/tmp
				$this->gestionarFicheros($form, 'borrar');

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
	
	private function gestionarFicheros($fichero, $accion = 'guardar') {
		
		$nombre = $fichero['file']->getData()->getClientOriginalName();
		
		if($accion == 'guardar') {
			mkdir($this->getDirectorio() . DIRECTORY_SEPARATOR . "cookies", 0700);
			$fichero['file']->getData()->move($this->getDirectorio(), $nombre);
		} elseif ($accion == 'borrar') {
			unlink($this->getDirectorio() . DIRECTORY_SEPARATOR . $nombre);
			
			$dir = $this->getDirectorio() . DIRECTORY_SEPARATOR . "cookies";
			$handle = opendir($dir); 

			while ($file = readdir($handle)){
				if (is_file($dir . "/" .$file)) 
					unlink($dir . "/" .$file);
			}
			closedir($handle);
			rmdir($dir);
		}
		
	}
	
	private function gestionarDatosFichero($fichero) {
		$resultados = 0;
		
		$nombre = $fichero['file']->getData()->getClientOriginalName();
		
		$exelObj = $this->get('xls.load_xls5')->load($this->getDirectorio() . DIRECTORY_SEPARATOR . $nombre);
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
		for ($provincia=12; $provincia <= 12; $provincia++) {
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
			$dir = $this->getDirectorio() . DIRECTORY_SEPARATOR . "cookies" . DIRECTORY_SEPARATOR . time();
			
			$pagina = $this->peticionCurl($url, FALSE, $dir);
			$csfv = $this->obtenerCsfv($pagina);

			$inputs = array(
						'habilitado' => 'habilitado',
						'habilitado:_id42' => 'Búsqueda Avanzada',
						'com.sun.faces.VIEW' => $csfv
					);
			
			
			$pagina = $this->peticionCurl($url, $inputs, $dir);
			$csfv = $this->obtenerCsfv($pagina);

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
		$csfv = $this->obtenerCsfv($pagina);
		
		$doc = new \DOMDocument();
		$doc->loadHTML($pagina);
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
		$codEdicto = $this->obtenerTextoEdicto($xpath, $data, $pagina); $count['edictos'] += 1;
		$this->obtenerExpedientesEdicto($xpath, $codEdicto);
		
		return TRUE;
	}
	
	private function obtenerSrcIframe($pagina) {
		$url = "https://sede.dgt.gob.es" . $pagina;
		$dir = $this->getDirectorio() . DIRECTORY_SEPARATOR . 'cookies' . DIRECTORY_SEPARATOR . time();
		
		$pagina = $this->peticionCurl($url, FALSE, $dir);
		$csfv = $this->obtenerCsfv($pagina);
		
		$inputs = array(
				        'dato:BusInput'		=> '_*', // Muestra todos los resultados
				        'criterioBusqueda' 	=> '1', // Búsqueda por expediente
		        		'dato:js3' 			=> '',
		        		'dato' 				=> 'dato',
		        		'com.sun.faces.VIEW' => $csfv
		    		);
	
		$pagina = $this->peticionCurl($url, $inputs, $dir);
		
		$doc = new \DOMDocument();
		$doc->loadHTML($pagina);
		$xpath = new \DOMXPath($doc);
		
		$iframe = $xpath->query('//iframe[@id="capaHTML"]');
		
		return $iframe->item(0)->getAttribute('src');
	}
	
	private function obtenerTextoEdicto($xpath, $data, $pagina) {
		$hoja = new Edicto();
		
		$num = $xpath->query('/html/body/table/tr/td[2]/table/tr[7]/td[2]/span');
		$hoja->setNumero($num->item(0)->nodeValue);

		$fecha = $xpath->query('/html/body/table/tr/td[2]/table/tr[7]/td[4]');
		$hoja->setFecha($fecha->item(0)->nodeValue);
		
        $membrete = $xpath->query('/html/body/table/tr/td[2]/table/tr[13]/td[2]');
        $hoja->setMembrete($membrete->item(0)->nodeValue);
		
		$ini = strpos($data, '<span style="font-family: Verdana; color: #000000; font-size: 12px; font-weight: bold;">');
		$fin = strpos($data, '</span>', $ini);
        $hoja->setEntrada(substr($data, $ini+88, $fin-($ini+88)));

		$ini = strpos($data, '<span style="font-family: Verdana; color: #000000; font-size: 12px;">');
		$fin = strpos($data, '</span>', $ini);
		$hoja->setTexto(substr($data, $ini+69, $fin-($ini+69)));

        // $texto = $xpath->query('/html/body/table/tr/td[2]/table/tr[20]/td[2]');
        // $hoja->setTexto($texto->item(0)->nodeValue);
		
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
		
		foreach ($edictos as $edicto) {
			$crea = FALSE;
			$directorio = $this->getDirectorio();
			
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
				$directorio .= DIRECTORY_SEPARATOR . $edicto->getNumero() . " [" . date('dmyHis') . "]";
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
		
		$url = "https://sede.dgt.gob.es" . $edicto->getEnlace();
		
		$pagina = $this->peticionCurl($url, FALSE, $this->getDirectorio(). DIRECTORY_SEPARATOR . 'cookies' . DIRECTORY_SEPARATOR . time());
		
		$tbl  = '<table cellspacing="1" cellpadding="1" border="0" style="font-size: 10pt;">';
		$tbl .= '	<tr>';
		$tbl .= '		<td>' . $edicto->getNumero() . '</td>';
		$tbl .= '		<td style="text-align: right">' . $edicto->getFecha() . '</td>';
		$tbl .= '	</tr><tr><td colspan="2"><hr /></td></tr>';
		$tbl .= '	<tr style="font-size: 14pt">';
		$tbl .= '		<td style="text-align: center; font-weight: bold;" colspan="2">' . $edicto->getMembrete() . '</td>';
		$tbl .= '	</tr>';
		$tbl .= '	<tr style="font-size: 12pt">';
		$tbl .= '		<td style="text-align: center;" colspan="2"><br /><br />' . $edicto->getEntrada() . '</td>';
		$tbl .= '	</tr>';
		$tbl .= '	<tr style="font-size: 12pt">';
		$tbl .= '		<td style="text-align: left;" colspan="2"><br />' . $edicto->getTexto() . '</td>';
		$tbl .= '	</tr>';
		$tbl .= '	<tr style="font-size: 8pt">';
		$tbl .= '		<td style="text-align: left;" colspan="2"><br /><hr />https://sede.dgt.gob.es' . $edicto->getEnlace() . '</td>';
		$tbl .= '	</tr>';
		$tbl .= '</table>';
		
		$pdfObj = $this->get("white_october.tcpdf")->create();
		$pdfObj->addPage();
		$pdfObj->writeHTML($tbl, true, false, false, false, '');
		$pdfObj->Output($directorio . DIRECTORY_SEPARATOR . $nombre, 'F');
		
		return TRUE; 
	}
 
	private function crearPdfExpedientes($exps, $directorio, $nombre) {
		$pdfObj = $this->get("white_october.tcpdf")->create();
		$pdfObj->addPage('L');
		
		$tbl = $this->obtenerTabla($exps);
		
		$pdfObj->writeHTML($tbl, true, false, false, false, '');		
		$pdfObj->Output($directorio . DIRECTORY_SEPARATOR . $nombre, 'F');
		
		return TRUE; 
	}
	
	private function buscarTelefono($cif){
		$existe = $this->realizarBusquedaAxesor($cif);
		
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
		$tbl = '<table cellspacing="1" cellpadding="1" border="0" style="font-size: 9pt;">
					<tr style="text-align: center; background-color: #F1F7E2; font-weight: bold;">
					        <td width="9%">Expediente</td><td width="19%">Nombre</td><td>DNI/NIF</td><td width="16%">Localidad</td><td>Fecha</td>
					        <td>Matrícula</td><td width="5%">&euro;</td><td width="8%">Prec.</td><td width="4%">Art.</td><td width="4%">Ptos.</td><td width="4%">Req.</td>
					        <td>Tlf</td>
					</tr>';
		$aux = 1;
		foreach ($exps as $exp){
			($aux == 1) ? $color = "#FFFFFF" : $color = "#F3F7FA";
			$tbl .= '<tr style="background-color: '. $color .'">';
			$tbl .= '	<td style="text-align: left">&nbsp;' . $exp->getExpediente() . '</td>';
			$tbl .= '	<td style="text-align: left">&nbsp;' . $exp->getNombre() . '</td>';
			$tbl .= '	<td style="text-align: center">&nbsp;' . $exp->getNif() . '</td>';
			$tbl .= '	<td style="text-align: left">&nbsp;' . $exp->getLocalidad() . '</td>';
			$tbl .= '	<td style="text-align: center">&nbsp;' . $exp->getFecha() . '</td>';
			$tbl .= '	<td style="text-align: center">&nbsp;' . $exp->getMatricula() . '</td>';
			$tbl .= '	<td style="text-align: right">&nbsp;' . $exp->getEuros() . '</td>';
			$tbl .= '	<td style="text-align: left">&nbsp;' . $exp->getPrecepto() . '</td>';
			$tbl .= '	<td style="text-align: right">&nbsp;' . $exp->getArt() . '</td>';
			$tbl .= '	<td style="text-align: right">&nbsp;' . $exp->getPuntos() . '</td>';
			$tbl .= '	<td style="text-align: left">&nbsp;' . $exp->getReq() . '</td>';
			$tbl .= '	<td style="text-align: center">&nbsp;' . $exp->getTlf() . '&nbsp;</td>';
			$tbl .= '</tr>';
			$aux = $aux * (-1);
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

		return $response;
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

	private function cargarDirectorio(){
			
		if($this->getDirectorio() != "")
			return TRUE;
		
		$query = $this->getDoctrine()->getEntityManager()
				 ->createQuery('SELECT c.valor FROM BumexBasicBundle:Config c WHERE c.clave = :clave')
				 ->setParameter('clave', 'CFGDIR');
		$dir = $query->getResult();
		
		if(count($dir) == 0){
			$datoconfig = new Config();
			$datoconfig->setClave('CFGDIR');
			$datoconfig->setValor($_SERVER['DOCUMENT_ROOT'] . '/bumex/app/cache');
			
			// Registramos
			$em = $this->getDoctrine()->getEntityManager();
	    	$em->persist($datoconfig);
			$em->flush();	
			$this->setDirectorio($datoconfig->getValor());
		} else {
			$this->setDirectorio($dir['0']['valor']);
		}
		
		return TRUE;
	}

	private function cambiarDirectorio($nuevaRuta){
		$stat = @stat($nuevaRuta);
		if('777' == substr(sprintf('%o', $stat['mode']), -3) ||
			'775' == substr(sprintf('%o', $stat['mode']), -3)){
		
			$em = $this->getDoctrine()->getEntityManager();
		    $ruta = $em->getRepository('BumexBasicBundle:Config')->find('1');
	
	    	$ruta->setValor($nuevaRuta);
	    	$em->flush();
			
			return FALSE;
		}

		return TRUE;
	}
	
	/**
     * Set directorio
     *
     * @param string $directorio
     */
    public function setDirectorio($directorio)
    {
        $this->directorio = $directorio;
    }

    /**
     * Get directorio
     *
     * @return string 
     */
    public function getDirectorio()
    {
        return $this->directorio;
    }
	
	public function estadoTestra(){
		
		$ch = curl_init('https://sede.dgt.gob.es/WEB_TTRA_CONSULTA/TablonEdictosPublico.faces');

		// Ejecutar
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Para no mostrar la página recibida
		curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
		if(curl_exec($ch) === FALSE)
		{
			// echo curl_error($ch);
		    $return = FALSE;
		}
		else
		{
		    $return = TRUE;
		}
		
		// Cerrar recurso
		curl_close($ch);
		
		return $return;
		
	}
}
