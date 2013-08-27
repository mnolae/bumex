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
// use Bumex\BasicBundle\Entity\Lineaexp;

use MakerLabs\PagerBundle\Pager;
use MakerLabs\PagerBundle\Adapter\DoctrineOrmAdapter;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class IndexController extends Controller
{
	private $directorio;
	private $dirauto;
	private $dircookies;
	private $logactivo;
	private $falloConexion;
	/**
     * @Route("/index", name="_bumex_index")
     * @Template()
     */
    public function indexAction(Request $request)
    {
    	$dirMod = $autoMod = FALSE;
		if ($request->getMethod() == 'POST'){
			$dirMod = $this->cambiarDirectorio($_POST['ruta'], 'CFGDIR');
			$autoMod = $this->cambiarDirectorio($_POST['auto_ruta'], 'CFGAUTO');
		}
		
    	$this->cargarDirectorio('CFGDIR');
		$this->cargarDirectorio('CFGAUTO');
		
		// $dir = $this->getDirectorio() . DIRECTORY_SEPARATOR . $this->getDircookies() . DIRECTORY_SEPARATOR . time();
		// $url = "https://sede.dgt.gob.es/WEB_TTRA_CONSULTA/ServletVisualizacion?params=PkwJwhHF5814qPU8PcIb5lpBjZWNeWvR9PRCRCXHq%2BT2WOjS6tWMjeblD958PVUqySJj8qrLc%2FLR%0D%0A0cAUHE7mZA%3D%3D%0D%0A&formato=HTML";
		// $p = $this->peticionCurl($url, FALSE, $dir);
		// // $p = $this->tratarIMG($p);
// 				
		// // echo $this->tratarHTML($p); exit;
// 		
		// $pdfObj = $this->get("white_october.tcpdf")->create();
		// $pdfObj->addPage();
		// $pdfObj->writeHTML($this->tratarHTML($p), true, false, false, false, '');
		// $pdfObj->Output("bla.pdf", 'I');
// 		
		// exit;
		
		$testraok = $this->estadoTestra();
    	$fichero = new Fichero();
		$fichero->setFrmFecha(new \DateTime('yesterday')); // Valor por defecto del campo fecha: ayer
        $form = $this->createForm(new FicheroType(), $fichero);
		
		return $this->render('BumexBasicBundle:Index:index.html.twig', array('auto' => FALSE, 'testraok' => $testraok,'directorio' => $this->getDirectorio(), 'autoruta' => $this->getDirauto(), 'dirMod' => $dirMod, 'autoMod' => $autoMod, 'form' => $form->createView()));
	}
	
	/**
     * @Route("/expedientes", name="_bumex_expedientes")
     * @Template()
     */
    public function expedientesAction(Request $request)
    {
		if ($request->getMethod() == 'POST') {
			$this->cargarDirectorio('CFGDIR');
			$this->setFalloConexion(FALSE);
    			
    		$fichero = new Fichero();
        	$form = $this->createForm(new FicheroType(), $fichero);
			$form->bindRequest($request);
			
			if($form->isValid()) {
				// Limpia las tablas al principio por si hubo algún error
				$this->limpiarTablas();
				
				// Se indica el directorio de almacén de cookies
				$this->setDircookies(date('dmYHis') . '_cookies');
				
				// Conseguimos el fichero a tratar, manual o auto
				if($form['file']->getData()){ // Manual
					$f = $this->getDirectorio() . DIRECTORY_SEPARATOR . $form['file']->getData()->getClientOriginalName();
					
					// Copia el fichero al directorio creado app/cache/tmp
					$this->gestionarFicheros($form);
					$auto = FALSE;
					$nfichero = "";
				}
				else{ // Auto
					$this->cargarDirectorio('CFGAUTO');
					$nfichero = $this->obtenerFicheroAuto($this->getDirauto());
					$f = $this->getDirauto() . DIRECTORY_SEPARATOR . $nfichero;
					
					// Copia el fichero al directorio creado app/cache/tmp
					$this->gestionarFicheros("", "auto");
					$auto = TRUE;
				}

				// SE BUSCAN NIF Y MATRICULAS EN TESTRA
				$this->buscarOcurrencias($f, $form['frmFecha']->getData());
				$this->obtenerPDFEXP($form['frmFecha']->getData());

 
				// Registra en el histórico los datos conseguidos, pasamos la fecha en formato sajón
				$datos = $this->registrarHistorico($form['frmFecha']->getData());
				// Borra el fichero y el directorio de cookies
				if($auto)
					$this->gestionarFicheros("", "borrarauto");
				else
					$this->gestionarFicheros($form, 'borrar');

				// Limpiamos las tablas
				// $this->limpiarTablas();
			}
			
		} else {
			// si entras en expedientes mediante URL, sin pasar por index
			return $this->redirect($this->generateUrl('index'));
		}
		
		return array('auto' => $auto, 'nombreFichero' => $nfichero, 'datos' => $datos, 'control' => FALSE, 'conexion' => $this->getFalloConexion());
    }

	/**
     * @Route("/auto", name="_bumex_auto")
     * @Template()
     */
    public function autoAction()
    {
		$this->cargarDirectorio('CFGAUTO');
		
    	$fichero = new Fichero();
		$fichero->setFrmFecha(new \DateTime('yesterday')); // Valor por defecto del campo fecha: ayer
        $form = $this->createForm(new FicheroType(), $fichero);
		
		return array('auto' => TRUE, 'testraok' => TRUE,'directorio' => FALSE, 'autoruta' => FALSE, 'dirMod' => FALSE, 'autoMod' => FALSE, 'form' => $form->createView());
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
    
    
	/**
	 * FUNCIONES
	 */
	
	private function buscarOcurrencias($fichero, $fecha) {
		
		$dir = $this->getDirectorio() . DIRECTORY_SEPARATOR . $this->getDircookies() . DIRECTORY_SEPARATOR . time();
			
		// URL DE BÚSQUEDA BÁSICA
		$url = 'https://sede.dgt.gob.es/WEB_TTRA_CONSULTA/Todos.faces';
		
		$pagina = $this->peticionCurl($url, FALSE, $dir);
		$csfv = $this->obtenerCsfv($pagina);		
		
		$inputs = array(
						'habilitado' => 'habilitado',
						// EL SIGUIENTE VALUE LO HAN MODIFICADO DESPUÉS DE QUE BÚMEX ESTUVIERA LISTO
						'habilitado:_id46' => 'Búsqueda Avanzada',
						'com.sun.faces.VIEW' => $csfv
					);
			
			
		$pagina = $this->peticionCurl($url, $inputs, $dir);
		$csfv = $this->obtenerCsfv($pagina);

		// SE OBTIENEN DEL XLS LOS DATOS A BUSCAR
		$datos = $this->obtenerXLS($fichero);
		
		// POR CADA DATO SE REALIZA UNA BÚSQUEDA
		foreach($datos as $dato) {
					
			$this->grabaLog("\tDato de búsqueda: " . $dato);
			
			$inputs = array(
						// EL SIGUIENTE PARÁMETRO SE HA TENIDO QUE MODIFICAR 21-06-2013
				        'dato' => 'dato',
				        'dato:BusInput' => $dato,
			    	    'dato:cal1' => $fecha->format('d-m-Y'),
			        	'dato:cal2' => $fecha->format('d-m-Y'),
						'dato:suggest' => '',
						'dato:selector1' => '',
						'dato:selector3' => '',
						'dato:suggestionbox2_selection' => '',
				        // EL SIGUIENTE VALUE LO HAN MODIFICADO DESPUÉS DE QUE BÚMEX ESTUVIERA LISTO
				        'dato:_id54' => '',
				        'dato:_id88' => '',
				        'com.sun.faces.VIEW' => $csfv
				    );
		
			$pagina = $this->peticionCurl($url, $inputs, $dir);
			
			// SE OBTIENE EL ENLACE AL EDICTO
			$href = $this->obtenerHREF($pagina);
			
			// SE GUARDA EL ENLACE AL EDICTO O DIRECTAMENTE EL EDICTO
			foreach($href as $enlace) 
				$this->registrarHREF($enlace->getAttribute('href'), substr($enlace->nodeValue, 0, strpos($enlace->nodeValue, "|")), $fecha);
		}
		
	}
	
	private function obtenerPDFEXP($fecha) {
		$hrefs = $this->getDoctrine()->getRepository('BumexBasicBundle:Href')->findAll();
		
		foreach($hrefs as $href) {
			$dir = $this->getDirectorio() . DIRECTORY_SEPARATOR . $this->getDircookies() . DIRECTORY_SEPARATOR . time();
			
			$url = "https://sede.dgt.gob.es" . str_replace("VisualizacionEdicto.faces", "ServletVisualizacion", $href->getHref()) . "&formato=HTML";
			
			$pagina = $this->peticionCurl($url, FALSE, $dir);
			
			// $pagina = str_replace("/WEB_TTRA_CONSULTA", "https://sede.dgt.gob.es/WEB_TTRA_CONSULTA", $pagina);
			// $pagina = strip_tags($pagina, '<table><tr><td><span><br>');
			
			$this->crearPDFEXP($pagina, $fecha, $href->getId());
		}
	}
	
	private function crearPDFEXP($pagina, $fecha, $idhref) {
		$this->grabaLog("\tGenerado PDF para edicto: " . $idhref);
		$directorio = $this->getDirectorio(). DIRECTORY_SEPARATOR . "Coincidencias " . $fecha->format('d-m-Y') . ' ' . date('[dmY His]');

		if(!is_dir($directorio))
			mkdir($directorio, 0777);
		
		$pdfObj = $this->get("white_october.tcpdf")->create();
		$pdfObj->addPage();
		$pdfObj->writeHTML($this->tratarHTML($pagina), true, false, false, false, '');
		$pdfObj->Output($directorio . DIRECTORY_SEPARATOR . "Edicto." . $idhref . ".pdf", 'F');
		
	}
	
	private function tratarHTML($pagina) {
		$dom = new \DOMDocument();
		@$dom->loadHTML($pagina);
		$xpath = new \DOMXPath($dom);
		
		// NÚMERO
		$num = $xpath->query('/html/body/table/tr/td[2]/table/tr[7]/td[2]/span');
		if (is_object($num->item(0))) 
			$num = $num->item(0)->nodeValue;
		
		// FECHA
		$fecha = $xpath->query('/html/body/table/tr/td[2]/table/tr[7]/td[4]');
		if (is_object($fecha->item(0))) 
			$fecha = $fecha->item(0)->nodeValue;
		
		// MEMBRETE
		$membrete = $xpath->query('/html/body/table/tr/td[2]/table/tr[13]/td[2]');
        if (is_object($membrete->item(0))) 
        	$membrete = $membrete->item(0)->nodeValue;

		// SUBMEMBRETE		
		$submembrete = $xpath->query('/html/body/table/tr/td[2]/table/tr[15]/td[2]');
		if (is_object($submembrete->item(0))) 
			$submembrete = $submembrete->item(0)->nodeValue;
		
		// ENTRADA
		$ini = strpos($pagina, '<span style="font-family: Verdana; color: #000000; font-size: 12px; font-weight: bold;">');
		$fin = strpos($pagina, '</span>', $ini);
        if ($ini > 0 && $fin > 0) 
        	$entrada = substr($pagina, $ini+88, $fin-($ini+88));

		// TEXTO
		$ini = strpos($pagina, '<span style="font-family: Verdana; color: #000000; font-size: 12px;">');
		$fin = strpos($pagina, '</span>', $ini);
		if ($ini > 0 && $fin > 0) 
			$texto = substr($pagina, $ini+69, $fin-($ini+69));
		
		// TABLA CON LA CABECERA
		$tbl  = '<table cellspacing="1" cellpadding="1" border="0" style="font-size: 10pt;">';
		$tbl .= '	<tr>';
		$tbl .= '		<td>' . $num . '</td>';
		$tbl .= '		<td style="text-align: right">' . $fecha . '</td>';
		$tbl .= '	</tr><tr><td colspan="2"><hr /></td></tr>';
		$tbl .= '	<tr style="font-size: 14pt">';
		$tbl .= '		<td style="text-align: center; font-weight: bold;" colspan="2">' . $membrete . '</td>';
		$tbl .= '	</tr>';
		$tbl .= '	<tr style="font-size: 12pt">';
		$tbl .= '		<td style="text-align: center; font-weight: bold;" colspan="2">' . $submembrete . '</td>';
		$tbl .= '	</tr>';
		$tbl .= '	<tr style="font-size: 12pt">';
		$tbl .= '		<td style="text-align: center;" colspan="2"><br /><br />' . $entrada . '</td>';
		$tbl .= '	</tr>';
		$tbl .= '	<tr style="font-size: 12pt">';
		$tbl .= '		<td style="text-align: left;" colspan="2"><br />' . $texto . '</td>';
		$tbl .= '	</tr>';
		$tbl .= '</table>';
		
		// DATOS DE EXPEDIENTE/S
		$ltope = $xpath->query('//img[@style="width: 801px; height: 13px;"]');
		(is_object($ltope->item(0))) ? $tope = $ltope->item(0)->getNodePath() : $control = TRUE;
		
		// Si no tiene $tope caerá en bucle sin fin
		if(!isset($tope)) return FALSE;
		
		$tr = 25; // El 24 son las cabeceras de la tabla de expedientes. 
		$almacen = array();
				
		// Bucle que obtiene la línea
		do {
			// Bucle que obtiene cada dato de la línea
			for ($td=2; $td <= 22; $td+=2) {
				$controlfin = '/html/body/table/tr/td[2]/table/tr[' . $tr . ']/td/img';
				$cab = $xpath->query('/html/body/table/tr/td[2]/table/tr[' . $tr . ']/td[' . $td . ']');

				switch ($td) {
					case 2: // Expediente
						if(is_object($cab->item(0))) $almacen[$tr]['exp'] = "" . $cab->item(0)->textContent;
						break;

					case 4: // Nombre
						if(is_object($cab->item(0))) $almacen[$tr]['nom'] = "" . $cab->item(0)->textContent;
						break;

					case 6: // NIF
						if (is_object($cab->item(0))) $almacen[$tr]['nif'] = "" . $cab->item(0)->textContent; 
						break;

					case 8: // Localidad
						if(is_object($cab->item(0))) $almacen[$tr]['loc'] = "" . $cab->item(0)->textContent;
						break;
						
					case 10: // Fecha
						if(is_object($cab->item(0))) $almacen[$tr]['fec'] = "" . $cab->item(0)->textContent;
						break;
					
					case 12: // Matrícula
						if (is_object($cab->item(0))) $almacen[$tr]['mat'] = "" . $cab->item(0)->textContent;
						break;

					case 14: // Euros
						if(is_object($cab->item(0))) $almacen[$tr]['euro'] = "" . $cab->item(0)->textContent;
						break;
					
					case 16: // Precepto
						if(is_object($cab->item(0))) $almacen[$tr]['pre'] = "" . $cab->item(0)->textContent;
						break;
						
					case 18: // Art
						if(is_object($cab->item(0))) $almacen[$tr]['art'] = "" . $cab->item(0)->textContent;
						break;
						
					case 20: // Puntos
						if(is_object($cab->item(0))) $almacen[$tr]['pto'] = "" . $cab->item(0)->textContent;
						break;
						
					case 22: // Req
						if(is_object($cab->item(0))) $almacen[$tr]['req'] = "" . $cab->item(0)->textContent;
						break;
				}
			}

			$tr++;
			
		} while ($controlfin != $tope);
		
		// TABLA DE EXPEDIENTES
		// Cabecera de la tabla de expedientes
		$tbl .= '<br /><hr /><br />';
		$tbl .= '<table cellspacing="1" cellpadding="1" border="0" style="font-size: 8pt;">';
		$tbl .= '	<tr style="text-align: center; background-color: #F1F7E2; font-weight: bold;">
					        <td width="13%">Expediente</td><td width="20%">Nombre</td><td>DNI/NIF</td><td width="16%">Localidad</td><td>Fecha</td>
					        <td>Matrícula</td><td width="6%">&euro;</td><td width="6%">Prec.</td><td width="4%">Art</td><td width="4%">Pts</td><td width="4%">Req</td>
					</tr>';
		$aux = 1;
		foreach ($almacen as $linea){
			($aux == 1) ? $color = "#FFFFFF" : $color = "#F3F7FA";
			
			$tbl .= '<tr style="background-color: '. $color .';">';
			$tbl .= '	<td style="text-align: left">&nbsp;' . $linea['exp'] . '</td>';
			$tbl .= '	<td style="text-align: left">&nbsp;' . $linea['nom'] . '</td>';
			$tbl .= '	<td style="text-align: center">&nbsp;' . $linea['nif'] . '</td>';
			$tbl .= '	<td style="text-align: left">&nbsp;' . $linea['loc'] . '</td>';
			$tbl .= '	<td style="text-align: center">&nbsp;' . $linea['fec'] . '</td>';
			$tbl .= '	<td style="text-align: center">&nbsp;' . $linea['mat'] . '</td>';
			$tbl .= '	<td style="text-align: right">&nbsp;' . $linea['euro'] . '</td>';
			$tbl .= '	<td style="text-align: left">&nbsp;' . $linea['pre'] . '</td>';
			$tbl .= '	<td style="text-align: right">&nbsp;' . $linea['art'] . '</td>';
			$tbl .= '	<td style="text-align: right">&nbsp;' . $linea['pto'] . '</td>';
			$tbl .= '	<td style="text-align: left">&nbsp;' . $linea['req'] . '</td>';
			$tbl .= '</tr>';
			$aux = $aux * (-1);
		}
		
		$tbl .= '</table><br /><hr /><br />';
		
		return $tbl;
	}
	
	private function tratarIMG($pagina) {
		$dom = new \DOMDocument();
		@$dom->loadHTML($pagina);
		
		$domElemsToRemove = array();
		$imgs = $dom->getElementsByTagName('img');
		
		foreach($imgs as $imgnode)
			$domElemsToRemove[] = $imgnode;
		
		foreach($domElemsToRemove as $domElement)
			$domElement->parentNode->removeChild($domElement);
		
		return $dom->saveHTML();
	}
	
	private function obtenerXLS($fichero){
		$resultados = array();

		$exelObj = $this->get('xls.load_xls5')->load($fichero);
		$sheetData = $exelObj->getActiveSheet()->toArray(null,true,true,true);
		foreach ($sheetData as $tupla)
			foreach ($tupla as $dato)
				if($dato) 
					array_push($resultados, $dato);

		return $resultados;
	}
	
	private function obtenerHREF($pagina) {
		
		$doc = new \DOMDocument();
		@$doc->loadHTML($pagina);
		$xpath = new \DOMXPath($doc);
		
		$href = $xpath->query('//ul[@class="capaUL"]/li[@class="estiloCabeceraEdicto"]/a');
		
		return $href;
	}
	
	private function registrarHREF($href, $exp, $fecha) {
		$em = $this->getDoctrine()->getEntityManager();
		
		$enlace = new Href();
		$enlace->setExp($exp);
		$enlace->setHref($href);
		$enlace->setFecha($fecha);
				
    	$em->persist($enlace);
		$em->flush();
		$em->clear();
		
		$this->grabaLog("\tEnlace a edicto registrado");
	}
	
	/**
	 * VIEJO
	 */
	
	private function gestionarFicheros($fichero, $accion = 'guardar') {
		
		if($accion == 'guardar') {
			$nombre = $fichero['file']->getData()->getClientOriginalName();
			mkdir($this->getDirectorio() . DIRECTORY_SEPARATOR . $this->getDircookies(), 0700);
			$fichero['file']->getData()->move($this->getDirectorio(), $nombre);
		} elseif ($accion == 'borrar') {
			$nombre = $fichero['file']->getData()->getClientOriginalName();
			unlink($this->getDirectorio() . DIRECTORY_SEPARATOR . $nombre);
			
			$dir = $this->getDirectorio() . DIRECTORY_SEPARATOR . $this->getDircookies();
			$handle = opendir($dir); 

			while ($file = readdir($handle)){
				if (is_file($dir . DIRECTORY_SEPARATOR .$file)) 
					unlink($dir . DIRECTORY_SEPARATOR .$file);
			}
			closedir($handle);
			rmdir($dir);
			
		} elseif($accion == 'auto'){
			
			mkdir($this->getDirectorio() . DIRECTORY_SEPARATOR . $this->getDircookies(), 0700);
			
		} elseif($accion == 'borrarauto'){
			
			$dir = $this->getDirectorio() . DIRECTORY_SEPARATOR . $this->getDircookies();
			$handle = opendir($dir); 

			while ($file = readdir($handle)){
				if (is_file($dir . DIRECTORY_SEPARATOR .$file)) 
					unlink($dir . DIRECTORY_SEPARATOR .$file);
			}
			closedir($handle);
			rmdir($dir);
		}
		
	}
	
	private function gestionarDatosFichero($fichero) {
		$resultados = 0;

		$exelObj = $this->get('xls.load_xls5')->load($fichero);
		$sheetData = $exelObj->getActiveSheet()->toArray(null,true,true,true);
		foreach ($sheetData as $tupla) {
			foreach ($tupla as $dato) {
				if($dato) 
					if($this->actualizarExpediente($dato))
						$resultados += 1;
			}
		}
		
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
		
		$this->grabaLog("\tMirando en excell: " . $dato);
		foreach ($expedientes as $exp) {
			$exp->setCoincidencia(TRUE);
			$return = TRUE;
		}
		
		$em->flush();
		$em->clear();
		
		return $return;
	}
	
	private function obtenerEdictos($fichero, $fechaBusqueda, $control = FALSE) {
		$em = $this->getDoctrine()->getEntityManager();

		if($control == FALSE){
			$this->grabaLog("\tINICIO DE LA BÚSQUEDA DE ENLACES");
			$this->obtenerListas($fechaBusqueda);
			$this->grabaLog("\tFIN DE LA BÚSQUEDA DE ENLACES");
		
			// Desde aquí traer los registros de Href, con distinct por si se ha duplicado algún href
			$query = $em->createQuery('SELECT h FROM BumexBasicBundle:Href h GROUP BY h.href');
		
		} else {
			$this->grabaLog("\tINICIO DE LA BÚSQUEDA DE ENLACES CON CONTROL == NULL");
			$query = $em->createQuery('SELECT h FROM BumexBasicBundle:Href h WHERE control IS TRUE GROUP BY h.href');
			$this->grabaLog("\tFIN DE LA BÚSQUEDA DE ENLACES CON CONTROL == NULL");
		}

		$listaHref = $query->getResult();
		
		// SACAMOS LOS DATOS DEL XLS
		$nifmat = $this->obtenerXLS($fichero);
		
		foreach ($listaHref as $href){
			// Actualizamos el control de enlace a null
			$em->getRepository('BumexBasicBundle:Href')->find($href->getId())->setControl(NULL);
			$em->flush();
			$em->clear();
			
			$codEdicto = $this->obtenerDatosIframe($href);
			if($codEdicto){
				$this->obtenerPDF($nifmat, $href, $codEdicto);
			}
		}
		
		return count($listaHref);
	}

	private function obtenerListas($fechaBusqueda, $csfv = FALSE, $dir = FALSE, $pag = FALSE)
	{
		$url = 'https://sede.dgt.gob.es/WEB_TTRA_CONSULTA/TablonEdictosPublico.faces';
		
		if(!$pag){
			$dir = $this->getDirectorio() . DIRECTORY_SEPARATOR . $this->getDircookies() . DIRECTORY_SEPARATOR . time();
			
			// SE AÑADE LA SIGUIENTE URL PARA SEGUIR EL ORDEN EXACTO DE TESTRA
			$url1 = 'https://sede.dgt.gob.es/WEB_TTRA_CONSULTA/Todos.faces';
			
			$pagina = $this->peticionCurl($url1, FALSE, $dir);
			$csfv = $this->obtenerCsfv($pagina);
			
			$inputs = array(
						'habilitado' => 'habilitado',
						// EL SIGUIENTE VALUE LO HAN MODIFICADO DESPUÉS DE QUE BÚMEX ESTUVIERA LISTO
						'habilitado:_id46' => 'Búsqueda Avanzada',
						'com.sun.faces.VIEW' => $csfv
					);
			
			
			$pagina = $this->peticionCurl($url, $inputs, $dir);
			$csfv = $this->obtenerCsfv($pagina);

			$inputs = array(
						// EL SIGUIENTE PARÁMETRO SE HA TENIDO QUE MODIFICAR 21-06-2013
				        'dato' => 'dato',
				        'dato:BusInput' => '',      // $dato
			    	    'dato:cal1' => $fechaBusqueda->format('d-m-Y'),
			        	'dato:cal2' => $fechaBusqueda->format('d-m-Y'),
						'dato:suggest' => '',
						'dato:selector1' => '',
						'dato:selector3' => '',
						'dato:suggestionbox2_selection' => '',
				        // EL SIGUIENTE VALUE LO HAN MODIFICADO DESPUÉS DE QUE BÚMEX ESTUVIERA LISTO
				        'dato:_id54' => '',
				        'dato:_id88' => '',
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
		@$doc->loadHTML($pagina);
		$xpath = new \DOMXPath($doc);
		
		$listado = $xpath->query('//ul[@class="capaUL"]');
		
		$em = $this->getDoctrine()->getEntityManager();
		foreach($listado as $edicto) {
			$this->grabaLog("\t Obteniendo edicto");

			if($this->comprobarVigencia($edicto, $xpath)) {
				$href = $this->obtenerHref($edicto, $xpath);
				
				$enlace = new Href();
				$enlace->setHref($href);
				$enlace->setFecha($fechaBusqueda);
				
		    	$em->persist($enlace);
			}
		}
		$em->flush();
		$em->clear();
		
		$siguiente = $xpath->query('//input[@name="paginacion:siguiente"]');
		
		if($siguiente->length > 0){
			$this->obtenerListas($fechaBusqueda, $csfv, $dir, TRUE);
		}
		
		return TRUE;
	}
	
	private function comprobarVigencia($edicto, $xpath) {
		return TRUE; // Para que salgan siempre, aunque estén en estado "No vigente"
		$vigencia = $xpath->query($edicto->getNodePath().'/li/div[@class="floatLeft tamanoEstadoCaracter"]');
		return (strpos($vigencia->item(0)->nodeValue, 'No vigente') === FALSE) ? TRUE : FALSE;
	}
	
	private function obtenerPDF($nifmat, $enlace, $edicto) {
		$this->grabaLog("\tFunción: obteniendo el PDF ");
		$dir = $this->getDirectorio() . DIRECTORY_SEPARATOR . $this->getDircookies() . DIRECTORY_SEPARATOR . time();
		$url = $this->obtenerSrcPDF($enlace->getHref());
		$control = FALSE;

		if($url){
			$pdf = $this->peticionCurl('https://sede.dgt.gob.es' . $url, FALSE, $dir);
			$res = $this->PDF2TXT($pdf, $this->getDirectorio(), $edicto);
			$aux = 0;
			
			if($res) $control = $this->compararExpLinea($nifmat, $this->getDirectorio());
			else $control = TRUE;
			
		} else $control = TRUE;
		
		if ($control) {
			// Si no se llega por algún motivo al edicto, se activa el dato de control de Href
			$em = $this->getDoctrine()->getEntityManager(); 
			$em->getRepository('BumexBasicBundle:Href')->find($enlace->getId())->setControl(TRUE);
			$em->flush();
			$em->clear();
			
			$this->grabaLog("\tActivado control al obtener el edicto");
		}

		return TRUE;
		
	}

	/*private function compararExpLinea($nifmat, $dir) {
		$this->grabaLog("\tFunción: compararExpLinea ");
		 
		$return = FALSE;
		$repository = $this->getDoctrine()->getRepository('BumexBasicBundle:Lineaexp');
		
		
		// select substring(linea,1, locate('   ', linea)) from Lineaexp;
		// select id, locate('49078507A', linea) from Lineaexp
		// select id from Lineaexp where id in (select if(locate('39172196E', linea), id, '') as id from Lineaexp)
		
		foreach($nifmat as $dato) {
			$query = $this->getDoctrine()->getEntityManager()
			    ->createQuery("select lex.id, lex.linea from BumexBasicBundle:Lineaexp lex where locate(:dato, lex.linea) != 0")
				->setParameter('dato', $dato);
				
			$lins = $query->getResult();
			 
			print_r($lins); echo "<br />";
			
			$this->grabaLog("\tMirando en excell: " . $dato);
			exit;
		}
		
		exit;
		
		$em->flush();
		$em->clear();
		
		return $return;
		
	}*/
	
	private function PDF2TXT($pdf, $dir, $edicto) {
		if(file_exists($dir . DIRECTORY_SEPARATOR . "edicto.xml")) unlink($dir . DIRECTORY_SEPARATOR . "edicto.xml");
		$f = fopen($dir . DIRECTORY_SEPARATOR . "edicto.pdf", "w");
		fwrite($f, $pdf); fclose($f);
		exec("pdftotext -layout " . $dir . DIRECTORY_SEPARATOR . "edicto.pdf" . " " . $dir . DIRECTORY_SEPARATOR . "edicto.txt");

		return $this->TXT2BDD($dir, $edicto);
	}
	
	/*private function TXT2BDD($dir, $idEdicto) {
		$edicto = $this->getDoctrine()->getRepository('BumexBasicBundle:Edicto')->find($idEdicto);		
		$em = $this->getDoctrine()->getEntityManager();
		$graba = FALSE;
		$cadaux = "";
		
		$this->grabaLog("\tGrabando líneas.");
	
		$lineas = file($dir . DIRECTORY_SEPARATOR . "edicto.txt");
		
		foreach($lineas as $linea) {
			if(strstr($linea, "https://sede.dgt.gob.es")) $graba = FALSE;			

			if($graba && !strstr($linea, "CSV:") && $linea != "\n") {
				// SE REGISTRA EN BDD CADA LINEA
				$lineaexp = new Lineaexp();

				$lineaexp->setLinea($linea);
				$lineaexp->setEdicto($edicto);
				
		    	$em->persist($lineaexp);
			}

			if(strstr($linea, "EUROS")) $graba = TRUE;

		}

    	$em->flush();
		$em->clear();
		
		return TRUE;
	}*/
	
	private function obtenerDatosIframe($enlace) {
		$this->grabaLog("\tFunción: obtenerDatosIframe ");
		$dir = $this->getDirectorio() . DIRECTORY_SEPARATOR . $this->getDircookies() . DIRECTORY_SEPARATOR . time();
		$em = $this->getDoctrine()->getEntityManager();
		$url = $this->obtenerSrcIframe($enlace->getHref());
		$codEdicto = FALSE;
				
		//$this->grabaLog("\tURL de búsqueda de expedientes: " . $url);
		if($url){
			$this->grabaLog("\tHay URL y entra");
			$pagina = $this->peticionCurl('https://sede.dgt.gob.es' . $url, FALSE, $dir);
			$aux = 0;
			
			$doc = new \DOMDocument();
			@$doc->loadHTML($pagina);
			$xpath = new \DOMXPath($doc);
			$codEdicto = $this->obtenerTextoEdicto($xpath, $pagina, $enlace->getHref());
			
			// Repetir 3 veces o hasta que control == true
			/* 
			do{
				if($codEdicto) $control = $this->obtenerExpedientesEdicto($xpath, $codEdicto);
			} while($control == FALSE && $aux++ < 3);
				
			if($control == FALSE) $this->controlEdicto($codEdicto, 2); 
			*/
				
		} else {
			// Si no se llega por algún motivo al edicto, se activa el dato de control de Href 
			$em->getRepository('BumexBasicBundle:Href')->find($enlace->getId())->setControl(TRUE);
			$em->flush();
			$em->clear();
			
			$this->grabaLog("\tActivado control al obtener el edicto");
		}

		return $codEdicto;
	}

	private function obtenerSrcPDF($enlace) {
		$url = "https://sede.dgt.gob.es" . $enlace;
		$dir = $this->getDirectorio() . DIRECTORY_SEPARATOR . $this->getDircookies() . DIRECTORY_SEPARATOR . time();
		$result = FALSE;
		
		$pagina = $this->peticionCurl($url, FALSE, $dir);
		$csfv = $this->obtenerCsfv($pagina);
		
		$pagina = $this->peticionCurl($url, FALSE, $dir);
		
		$doc = new \DOMDocument();
		@$doc->loadHTML($pagina);
		$xpath = new \DOMXPath($doc);

		$result = "";		
		$enlaces = $xpath->query('//a[@target="_blank"]');
		foreach ($enlaces as $href) {
			(substr($href->getAttribute('href'),-3) == "PDF") ? $result = $href->getAttribute('href') : FALSE;
			
		}
		
		return $result;		
	}
	
	private function obtenerSrcIframe($enlace) {
		$url = "https://sede.dgt.gob.es" . $enlace;
		$dir = $this->getDirectorio() . DIRECTORY_SEPARATOR . $this->getDircookies() . DIRECTORY_SEPARATOR . time();
		$result = FALSE;
		
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
		@$doc->loadHTML($pagina);
		$xpath = new \DOMXPath($doc);
		
		$iframe = $xpath->query('//iframe[@id="capaHTML"]');
		if(is_object($iframe->item(0)))
			$result = $iframe->item(0)->getAttribute('src');
		
		return $result;
	}
	
	private function obtenerTextoEdicto($xpath, $data, $pagina) {
		$this->grabaLog("\tObteniendo cabecera de edicto");
		$control = FALSE;
		$hoja = new Edicto();
		
		$num = $xpath->query('/html/body/table/tr/td[2]/table/tr[7]/td[2]/span');
		if (is_object($num->item(0))) 
			$hoja->setNumero($num->item(0)->nodeValue); 
		else {
			$control = TRUE;
			$hoja->setNumero("Comprobar");
		}

		$fecha = $xpath->query('/html/body/table/tr/td[2]/table/tr[7]/td[4]');
		if (is_object($fecha->item(0))) 
			$hoja->setFecha($fecha->item(0)->nodeValue);
		else {
			$control = TRUE;
			$hoja->setFecha("Comprobar");
		}
		
        $membrete = $xpath->query('/html/body/table/tr/td[2]/table/tr[13]/td[2]');
        if (is_object($membrete->item(0))) 
        	$hoja->setMembrete($membrete->item(0)->nodeValue);
		else {
			$control = TRUE;
			$hoja->setMembrete("Comprobar");
		}
		
		$submembrete = $xpath->query('/html/body/table/tr/td[2]/table/tr[15]/td[2]');
		if (is_object($submembrete->item(0))) 
			$hoja->setSubmembrete($submembrete->item(0)->nodeValue);		
		
		$ini = strpos($data, '<span style="font-family: Verdana; color: #000000; font-size: 12px; font-weight: bold;">');
		$fin = strpos($data, '</span>', $ini);
        if ($ini > 0 && $fin > 0) 
        	$hoja->setEntrada(substr($data, $ini+88, $fin-($ini+88)));
		else {
			$control = TRUE;
			$hoja->setEntrada("Comprobar");
		} 

		$ini = strpos($data, '<span style="font-family: Verdana; color: #000000; font-size: 12px;">');
		$fin = strpos($data, '</span>', $ini);
		if ($ini > 0 && $fin > 0) 
			$hoja->setTexto(substr($data, $ini+69, $fin-($ini+69)));
		else {
			$control = TRUE;
			$hoja->setTexto("Comprobar");
		} 
		
		$hoja->setEnlace($pagina);

        // $texto = $xpath->query('/html/body/table/tr/td[2]/table/tr[20]/td[2]');
        // $hoja->setTexto($texto->item(0)->nodeValue);
		if($control){
			$hoja->setControl(1);
			$this->grabaLog("\tActivado control al obtener el texto del edicto");
		}
		
		$em = $this->getDoctrine()->getEntityManager();
    	$em->persist($hoja);
    	$em->flush();
		$em->clear();
		
		$this->grabaLog("\tRegistrada cabecera de edicto: " . $hoja->getId());
		
		return $hoja->getId();	
	}
		
	private function obtenerExpedientesEdicto($xpath, $idEdicto) {
		$this->grabaLog("\tObteniendo expedientes de edicto: " . $idEdicto);
		
		$edicto = $this->getDoctrine()->getRepository('BumexBasicBundle:Edicto')->find($idEdicto);
		
		$ltope = $xpath->query('//img[@style="width: 801px; height: 13px;"]');
		(is_object($ltope->item(0))) ? $tope = $ltope->item(0)->getNodePath() : $control = TRUE;
		
		$em = $this->getDoctrine()->getEntityManager();
		
		// Si no tiene $tope caerá en bucle sin fin
		if(!isset($tope)) return FALSE;
		
		$tr = 25; // El 24 son las cabeceras de la tabla de expedientes. 
		$count = 0;
		
		
		// Bucle que obtiene la línea
		do {
			$vacio = 0;
			$control = FALSE;
			
			$multa = new Expediente();
			$multa->setEdicto($edicto);
			
			// Bucle que obtiene cada dato de la línea
			for ($td=2; $td <= 22; $td+=2) {
				$controlfin = '/html/body/table/tr/td[2]/table/tr[' . $tr . ']/td/img';
				$cab = $xpath->query('/html/body/table/tr/td[2]/table/tr[' . $tr . ']/td[' . $td . ']');

				switch ($td) {
					case 2: // Expediente
						if(is_object($cab->item(0))) {
							$multa->setExpediente($cab->item(0)->textContent);
							$vacio++;
						}
						else {
							$control = TRUE;
							$multa->setExpediente(FALSE);
						} 
						break;
					case 4: // Nombre
						if(is_object($cab->item(0))) {
							$multa->setNombre($cab->item(0)->textContent);
							$vacio++;
						}
						else {
							$control = TRUE;
							$multa->setNombre(FALSE);							
						} 
						break;
					case 6: // NIF
						if (is_object($cab->item(0))) 
							$multa->setNif($cab->item(0)->textContent); 
						else {
							$control = TRUE;
							$multa->setNif(FALSE);							
						} 
							
						break;
					case 8: // Localidad
						if(is_object($cab->item(0))) $multa->setLocalidad($cab->item(0)->textContent);
						break;
					case 10: // Fecha
						(is_object($cab->item(0))) ? $multa->setFecha($cab->item(0)->textContent) : $control = TRUE;
						break;
					case 12: // Matrícula
						if (is_object($cab->item(0))) 
							$multa->setMatricula($cab->item(0)->textContent);
						else {
							$control = TRUE;
							$multa->setMatricula(FALSE);							
						} 
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
				$this->grabaLog("\t (" . $count . ") Persistiendo: " . $multa->getExpediente());
				
				if($control){
					$multa->setControl(TRUE);
					$this->grabaLog("\tActivado control al obtener el expediente");
				} 
					

				$em->persist($multa);
				$count++;
			}
			
		} while ($controlfin != $tope);
		
		$em->flush();
		$em->clear();
				
		$this->grabaLog("\tFin obteniendo expedientes de edicto: " . $idEdicto);
				
		return TRUE;
	}

	private function generarPdf($fecha){
		$directorio = $this->getDirectorio(). DIRECTORY_SEPARATOR . $fecha->format('d-m-Y') . ' ' . date('[dmY His]');
		mkdir($directorio, 0777);
		
		$edictos = $this->getDoctrine()->getRepository('BumexBasicBundle:Edicto')->findAll();
		
		foreach ($edictos as $edicto) {
			$crea = FALSE;
			$control = $cli = "";
			
			$query = $this->getDoctrine()->getEntityManager()
			    ->createQuery('SELECT ex FROM BumexBasicBundle:Expediente ex WHERE ex.edicto = :id')
				->setParameter('id', $edicto->getId());
			$exps = $query->getResult();

			$listaExp = $listaTlf = array();
			foreach ($exps as $exp) {
				if($exp->getCoincidencia() == '1'){
					$listaExp[] = $exp;
					$crea = TRUE;
					$cli = "(C) ";
					
					($exp->getControl() != NULL || $control != "") ? $control = "!!- " : $control = "";
				}
				elseif($exp->getTlf() != NULL){
					$listaTlf[] = $exp;
					$crea = TRUE;
					
					($exp->getControl() != NULL || $control != "") ? $control = "!!- " : $control = "";
				}
			}
			
			if($crea){
				$this->grabaLog("\t Generando Pdf de " . $edicto->getNumero());
				
				$dir = $directorio . DIRECTORY_SEPARATOR . $cli . "N. " . substr($edicto->getNumero(), 6);
				$this->crearPdfEdicto($edicto, $dir);
				if(count($listaExp) > 0)
					$this->crearPdfExpedientes($listaExp, $dir, $edicto->getNumero(), $edicto->getFecha(), $control . 'Listado Clientes.pdf');
				if(count($listaTlf) > 0)
					$this->crearPdfExpedientes($listaTlf, $dir, $edicto->getNumero(), $edicto->getFecha(), $control . 'Listado Tlfs.pdf');
			}
		}

		$this->crearInfoRev($directorio, $fecha->format('d-m-Y'));
	}

	private function crearInfoRev($directorio, $fecha, $nombre = "Informe.pdf"){
		
		// Comprobamos HREF
		$query = $this->getDoctrine()->getEntityManager()
				->createQuery("SELECT h FROM BumexBasicBundle:Href h WHERE h.control IS NOT NULL");
		$dato1 = $query->getResult();

		// Comprobamos EDICTO
		$query = $this->getDoctrine()->getEntityManager()
				->createQuery("SELECT ed FROM BumexBasicBundle:Edicto ed WHERE ed.control IS NOT NULL");
		$dato2 = $query->getResult();
		
		// Comprobamos EXPEDIENTE
		$query = $this->getDoctrine()->getEntityManager()
				->createQuery("SELECT ex FROM BumexBasicBundle:Expediente ex WHERE ex.control IS NOT NULL");
		$dato3 = $query->getResult();		
		
		if(count($dato1) > 0 || count($dato2) > 0 || count($dato3) > 0){
			
			$tbl = '<table width="99%" style="font-size: 9pt;">';
			$tbl .= '	<tr><td align="center" style="border-bottom: 1px solid black;"><strong>Datos a revisar (' . $fecha . ')</strong></td></tr>';
			
			// Si hay enlaces con control activado
			if(count($dato1) > 0){
				
			$tbl .= '	<tr><td><br /><strong>Enlaces a edictos</strong></td></tr>';
				
				foreach ($dato1 as $href) {
					
			$tbl .= '	<tr>';
			$tbl .= '		<td>&nbsp;https://sede.dgt.gob.es' . $href->getHref() . '</td>';
			$tbl .= '	</tr>';
					
				}
				
			}
			
			// Si hay edictos con control activado
			if(count($dato2) > 0){
				
			$tbl .= '	<tr><td><br /><strong>Texto de edictos</strong></td></tr>';
				
				foreach ($dato2 as $edicto) {
					
			$tbl .= '	<tr>';
			$tbl .= '		<td>&nbsp;https://sede.dgt.gob.es' . $edicto->getEnlace() . '</td>';
			$tbl .= '	</tr>';
					
				}
				

			}
			
			// Si hay expedientes con control activado
			if(count($dato3) > 0){
				
			$tbl .= '	<tr><td><br /><strong>Datos de expedientes</strong></td></tr>';
			$tbl .= '	<tr><td>Total de expedientes con datos no encontrados: ' . count($dato3) . '</td></tr>';
			}
			
			$tbl .= '</table>';
			
			$pdfObj = $this->get("white_october.tcpdf")->create();
			$pdfObj->addPage();
			$pdfObj->writeHTML($tbl, true, false, false, false, '');
			$pdfObj->Output($directorio . DIRECTORY_SEPARATOR . $nombre, 'F');
		}
		
		return TRUE;
	}

	private function crearPdfEdicto($edicto, $directorio, $nombre = 'Edicto.pdf') {
		
		mkdir($directorio, 0777);
		
		$tbl  = '<table cellspacing="1" cellpadding="1" border="0" style="font-size: 10pt;">';
		$tbl .= '	<tr>';
		$tbl .= '		<td>' . $edicto->getNumero() . '</td>';
		$tbl .= '		<td style="text-align: right">' . $edicto->getFecha() . '</td>';
		$tbl .= '	</tr><tr><td colspan="2"><hr /></td></tr>';
		$tbl .= '	<tr style="font-size: 14pt">';
		$tbl .= '		<td style="text-align: center; font-weight: bold;" colspan="2">' . $edicto->getMembrete() . '</td>';
		$tbl .= '	</tr>';
		$tbl .= '	<tr style="font-size: 12pt">';
		$tbl .= '		<td style="text-align: center; font-weight: bold;" colspan="2">' . $edicto->getSubmembrete() . '</td>';
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
		
		if($edicto->getControl()) $nombre = "!!- " . $nombre;
		
		$pdfObj = $this->get("white_october.tcpdf")->create();
		$pdfObj->addPage();
		$pdfObj->writeHTML($tbl, true, false, false, false, '');
		$pdfObj->Output($directorio . DIRECTORY_SEPARATOR . $nombre, 'F');
		
		return TRUE; 
	}
 
	private function crearPdfExpedientes($exps, $directorio, $numero, $fecha, $nombre) {
		$pdfObj = $this->get("white_october.tcpdf")->create();
		$pdfObj->addPage('L');
		
		$tbl = $this->obtenerTabla($exps, $numero, $fecha);
		
		$pdfObj->writeHTML($tbl, true, false, false, false, '');		
		$pdfObj->Output($directorio . DIRECTORY_SEPARATOR . $nombre, 'F');
		
		return TRUE; 
	}
	
	private function buscarTelefono(){	
		
		$existe = NULL;
		$letras = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'P', 'Q', 'R', 'S', 'U', 'V', 'N', 'W');
		
		$em = $this->getDoctrine()->getEntityManager();

		// Distinct de todos los nif
		$query = $this->getDoctrine()->getEntityManager()
			    ->createQuery("SELECT distinct(ex.nif) as nif, ex.nombre as nombre FROM BumexBasicBundle:Expediente ex where ex.nif not like 'NO CONSTA' and ex.coincidencia IS NULL");

		$nifs = $query->getResult();
		
		foreach ($nifs as $nif) {
			
			$this->grabaLog("\t AJARENAWEEEEEEEER!!!!!!");
			
			$existe = NULL;

			if(in_array(substr($nif['nif'],0,1), $letras)){
				$existe = $this->realizarBusquedaAxesor($nif['nif']);
				
				if(!$existe)
					$existe = $this->realizarBusquedaInforma($nif['nombre']);
				
				if(!$existe)
					$existe = $this->realizarBusquedaAxesor($nif['nif']);
				
				if(!$existe) $existe = "999999999";
	   			$em->getRepository('BumexBasicBundle:Expediente')->findByNif($nif['nif']);
				
				$em = $this->getDoctrine()->getEntityManager();
				$query = $em->createQuery(
				    'SELECT ex.id FROM BumexBasicBundle:Expediente ex WHERE ex.nif like :nif'
				)->setParameter('nif', $nif['nif']);
				$exps = $query->getResult();
				
				foreach ($exps as $exp) {
					$em->getRepository('BumexBasicBundle:Expediente')->find($exp['id'])->setTlf($existe);
				}
					
				if($existe != "999999999" && $existe != NULL)
					$this->grabaLog("\t NIF: " . $nif['nif'] . " TLF: " . $existe);
					
			}	
		}
		$em->flush();
		$em->clear();
		
		return $existe;
	}
	
	private function realizarBusquedaAxesor($cif){
		$existe = NULL;
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
		
		$input = $xpath->query('//span[@itemprop="telephone"]');
		if(is_object($input->item(0)))
			$existe = $input->item(0)->nodeValue;
		
		// $this->grabaLog("\t Búsqueda en axesor: " . $existe);		
		return $existe;
	}
	
	private function realizarBusquedaInforma($nombre){
		$enlace = FALSE;	
		$existe = NULL;
		$url = 'http://empresas.informa.es/Listado_empresas_' . str_replace(" ", "-", $nombre) . '.html';
		
		$handler = curl_init();  
		
		curl_setopt($handler, CURLOPT_URL, $url);
		curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
		
		$response = curl_exec ($handler);  
		curl_close($handler);  
	
		$doc = new \DOMDocument();
		@$doc->loadHTML($response);
		$xpath = new \DOMXPath($doc);
		
		$empresas = $xpath->query('//div[@class="texto_cuadro2"]/table/tr/td/a');

		foreach ($empresas as $key => $empresa)
			if($key%2 == 0 && $nombre == $empresa->nodeValue)
				$enlace = $empresa->getAttribute('href');
			
		if($enlace){
			$url = 'http://empresas.informa.es' . $enlace;
			
			$handler = curl_init();
			
			curl_setopt($handler, CURLOPT_URL, $url);
			curl_setopt($handler, CURLOPT_RETURNTRANSFER, TRUE);
			
			$response = curl_exec ($handler);  
			curl_close($handler);
			
			$doc = new \DOMDocument();
			@$doc->loadHTML($response);
			$xpath = new \DOMXPath($doc);
			
			$datos = $xpath->query('//li');
			
			foreach ($datos as $dato)
				if(substr($dato->nodeValue, 0, 10) == 'TELÉFONO:')
					$existe = substr($dato->nodeValue,10);
		}
			
		// $this->grabaLog("\t Búsqueda en informa: " . $existe);		
		return $existe;
	}
	
	private function obtenerTabla($exps, $numero, $fecha){
		// Cabecera de la tabla de expedientes
		$tbl = '<table cellspacing="1" cellpadding="1" border="0" style="font-size: 9pt;">';
		$tbl .= '	<tr>';
		$tbl .= '		<td colspan="6">' . $numero . '</td>';
		$tbl .= '		<td colspan="6" style="text-align: right">' . $fecha . '</td>';
		$tbl .= '	</tr><tr><td colspan="12"><hr /></td></tr>';
		$tbl .= '	<tr style="text-align: center; background-color: #F1F7E2; font-weight: bold;">
					        <td width="9%">Expediente</td><td width="18%">Nombre</td><td>DNI/NIF</td><td width="16%">Localidad</td><td>Fecha</td>
					        <td>Matrícula</td><td width="6%">&euro;</td><td width="6%">Prec.</td><td width="4%">Art.</td><td width="4%">Ptos.</td><td width="4%">Req.</td>
					        <td>Tlf</td>
					</tr>';
		$aux = 1;
		foreach ($exps as $exp){
			($aux == 1) ? $color = "#FFFFFF" : $color = "#F3F7FA";
			if ($exp->getControl() != NULL) $color = "#fdb4a1";
			
			$tbl .= '<tr style="background-color: '. $color .';">';
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
		$this->grabaLog("\tRealizando petición cURL");	
		$handler = curl_init();
		  
		curl_setopt($handler, CURLOPT_URL, $url);
		curl_setopt($handler, CURLOPT_FAILONERROR, TRUE);
		curl_setopt($handler, CURLOPT_SSLVERSION, 3);
		curl_setopt($handler, CURLOPT_SSL_VERIFYPEER, false);
		// curl_setopt($handler, CURLOPT_CAINFO, getcwd() . "\certs\ca-bundle.crt");
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
		if($listado->length > 0){
			$this->grabaLog("\t Tamaño CSVF: " . strlen($listado->item(0)->getAttribute('value')));
			return $listado->item(0)->getAttribute('value');
		}
		$this->setFalloConexion(TRUE);
		return FALSE;
	}

	private function limpiarTablas(){
		$em = $this->getDoctrine()->getEntityManager();
		$conn = $em->getConnection();
		$conn->query('SET FOREIGN_KEY_CHECKS=0');
		$conn->query('TRUNCATE Edicto');
		$conn->query('TRUNCATE Expediente');
		$conn->query('TRUNCATE Href');
		// $conn->query('TRUNCATE Lineaexp');		
		$conn->query('SET FOREIGN_KEY_CHECKS=1');
	}
	
	private function registrarHistorico($fecha){
		$this->grabaLog("\tRegistrando en el historial.");
		
		$historico = new Historico();
		
		$historico->setFecha($fecha);
		
				
		$historico->setNedictos('0');
		$historico->setNexpedientes('0');
		$historico->setNtelefonos('0');
		
		// Número de coincidencias
		$query = $this->getDoctrine()->getEntityManager()
			    ->createQuery('SELECT COUNT(ex.id) as dato FROM BumexBasicBundle:Href ex');
		
		$dato = $query->getResult();
		
		$historico->setNcoincidencias($dato[0]['dato']);
		
		// Fecha en que se realiza la búsqueda
		$f = new \DateTime(date('Y-m-d H:i:s'));
		$historico->setFbusqueda($f);
		
		// Registramos
		$em = $this->getDoctrine()->getEntityManager();
    	$em->persist($historico);
		$em->flush();
		$em->clear();
		
		return $historico;
	}

	private function comprobarControl($entidad){
		$control = FALSE;

		// Control de enlaces
		$query = $this->getDoctrine()->getEntityManager()
			    ->createQuery('SELECT count(ed.id) as dato FROM BumexBasicBundle:' . $entidad . ' ed WHERE ed.control IS NOT NULL');
		
		$dato = $query->getResult();
		if($dato[0]['dato'] > 0) $control = TRUE;
		return $control;
	}

	private function cargarDirectorio($clave){
			
		if($clave == 'CFGDIR' && $this->getDirectorio() != "")
			return TRUE;
		elseif ($clave == 'CFGAUTO' && $this->getDirauto() != "")
			return TRUE;
		
		$query = $this->getDoctrine()->getEntityManager()
				 ->createQuery('SELECT c.valor FROM BumexBasicBundle:Config c WHERE c.clave = :clave')
				 ->setParameter('clave', $clave);
		$dir = $query->getResult();
		
		if(count($dir) == 0){
			$datoconfig = new Config();
			$datoconfig->setClave($clave);
			$datoconfig->setValor($_SERVER['DOCUMENT_ROOT'] . '/bumex/app/cache');
			
			// Registramos
			$em = $this->getDoctrine()->getEntityManager();
	    	$em->persist($datoconfig);
			$em->flush();
			$em->clear();
				
			if($clave == 'CFGDIR')
				$this->setDirectorio($datoconfig->getValor());
			elseif($clave == 'CFGAUTO')
				$this->setDirauto($datoconfig->getValor());
		} else {
			if($clave == 'CFGDIR')
				$this->setDirectorio($dir['0']['valor']);
			elseif($clave == 'CFGAUTO')
				$this->setDirauto($dir['0']['valor']);
		}
		
		return TRUE;
	}

	private function cambiarDirectorio($nuevaRuta, $clave){
		$stat = @stat($nuevaRuta);
		if('777' == substr(sprintf('%o', $stat['mode']), -3) ||
			'775' == substr(sprintf('%o', $stat['mode']), -3)){
		
			$em = $this->getDoctrine()->getEntityManager();
			if($clave == 'CFGDIR')
		    	$ruta = $em->getRepository('BumexBasicBundle:Config')->find('1');
			elseif($clave == 'CFGAUTO')
				$ruta = $em->getRepository('BumexBasicBundle:Config')->find('2');
	
	    	$ruta->setValor($nuevaRuta);
	    	$em->flush();
			$em->clear();
			
			return FALSE;
		}

		return TRUE;
	}
	
	private function obtenerFicheroAuto($ruta){
		$handle = opendir($ruta); 

		while ($file = readdir($handle))
			if (is_file($ruta . DIRECTORY_SEPARATOR .$file) && substr($file, -4, 4) == ".xls") 
				$fichero = $file;
			
		closedir($handle);
		
		return $fichero;
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
	
	/**
     * Set dirauto
     *
     * @param string $dirauto
     */
    public function setDirauto($dirauto)
    {
        $this->dirauto = $dirauto;
    }

    /**
     * Get dirauto
     *
     * @return string 
     */
    public function getDirauto()
    {
        return $this->dirauto;
    }
	
	/**
     * Set dircookies
     *
     * @param string $dircookies
     */
    public function setDircookies($dircookies)
    {
        $this->dircookies = $dircookies;
    }

    /**
     * Get dircookies
     *
     * @return string 
     */
    public function getDircookies()
    {
        return $this->dircookies;
    }
	
	/**
     * Set logactivo
     *
     * @param string $logactivo
     */
    public function setLogactivo($logactivo)
    {
        $this->logactivo = $logactivo;
    }

    /**
     * Get logactivo
     *
     * @return string 
     */
    public function getLogactivo()
    {
        return $this->logactivo;
    }
	
	/**
     * Set falloConexion
     *
     * @param string $falloConexion
     */
    public function setFalloConexion($falloConexion)
    {
        $this->falloConexion = $falloConexion;
    }

    /**
     * Get falloConexion
     *
     * @return string 
     */
    public function getFalloConexion()
    {
        return $this->falloConexion;
    }
	
	public function estadoTestra(){
		
		$ch = curl_init('https://sede.dgt.gob.es/WEB_TTRA_CONSULTA/TablonEdictosPublico.faces');

		// Ejecutar
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Para no mostrar la página recibida
		curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
		curl_setopt($ch, CURLOPT_SSLVERSION, 3);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_CAINFO, getcwd() . "\certs\ca-bundle.crt");
		// curl_setopt($ch, CURLOPT_CAPATH, getcwd() . "\certs");
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
	
	public function controlEdicto($id, $valor){
		
		$edicto = $this->getDoctrine()->getRepository('BumexBasicBundle:Edicto')->find($id);
		$em = $this->getDoctrine()->getEntityManager(); 
		
		$edicto->setControl($valor);
		$em->persist($edicto);
		$em->flush();
		$em->clear();
		$this->grabaLog("\tActivado control = " . $valor . " en edicto: " . $id);
	}
	
	public function grabaLog($texto){
		if(!$this->getLogactivo()){
			$query = $this->getDoctrine()->getEntityManager()
					 ->createQuery('SELECT c.valor FROM BumexBasicBundle:Config c WHERE c.clave = :clave')
					 ->setParameter('clave', 'CFGLOG');
			$valor = $query->getResult();
			$this->setLogactivo($valor['0']['valor']);
		}
		
		if($this->getLogactivo() == "TRUE")
			$logger = $this->get('logger')->err($texto);
	}
}
