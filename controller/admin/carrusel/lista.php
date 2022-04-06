<?php
use Base\Form\filtrosForm;
use Carrusel\model\CarruselcarruselesModel;
use Carrusel\entity\CarruselcarruselesEntity;
use Franky\Core\paginacion;
use Franky\Haxor\Tokenizer;

$MyPaginacion = new paginacion();
$Tokenizer = new Tokenizer();


$MyPaginacion->setPage($MyRequest->getRequest('page',1));
$MyPaginacion->setCampoOrden($MyRequest->getRequest('por',"createdAt"));
$MyPaginacion->setOrden($MyRequest->getRequest('order',"ASC"));
$MyPaginacion->setTampageDefault($MyRequest->getRequest('tampag',25));		
$busca_b	= $MyRequest->getRequest('busca_b');	


$CarruselcarruselesModel =  new CarruselcarruselesModel();
$CarruselcarruselesEntity =  new CarruselcarruselesEntity();
$CarruselcarruselesModel->setPage($MyPaginacion->getPage());
$CarruselcarruselesModel->setTampag($MyPaginacion->getTampageDefault());
$CarruselcarruselesModel->setOrdensql($MyPaginacion->getCampoOrden()." ".$MyPaginacion->getOrden());


$result	 = $CarruselcarruselesModel->getData([]);
$MyPaginacion->setTotal($CarruselcarruselesModel->getTotal());

$lista_admin_data = array();
if($CarruselcarruselesModel->getTotal() > 0)
{
	$iRow = 0;	

	while($registro = $CarruselcarruselesModel->getRows())
	{
		$thisClass  = ((($iRow % 2) == 0) ? "formFieldDk" : "formFieldLt");
                

		$lista_admin_data[] = array_merge($registro,array(
                "id" => $Tokenizer->token("carrusel", $registro["id"]),
                "callback" => $Tokenizer->token("carrusel", $MyRequest->getURI()),    
                "createdAt" 	=> getFechaUI($registro["createdAt"]),
                "thisClass"     => $thisClass,
                "nuevo_estado"  => ($registro["status"] == 1 ?"desactivar" : "activar"),
                ));
                $iRow++;
        }
}



//$MyFrankyMonster->setPHPFile(getVista("admin/template/grid.phtml"));
$title_grid = _carrusel("Carruseles");
$class_grid = "cont_sliders";
$error_grid = _carrusel("No hay carruseles registrados");
$deleteFunction = "carrusel_DeleteCarrusel";
$frm_constante_link = ADMIN_CARRUSEL_FORM;
$titulo_columnas_grid = array("createdAt" => _carrusel("Fecha"),"nombre" => _carrusel("Nombre"),"code" => _carrusel("Code"));
$value_columnas_grid = array("createdAt", "nombre","code" );

$css_columnas_grid = array("createdAt" => "w-xxxx-3" ,"nombre" => "w-xxxx-3" ,"code" => "w-xxxx-3" );

$permisos_grid = ADMINISTRAR_CARRUSEL;
$MyFiltrosForm = new filtrosForm('paginar');
$MyFiltrosForm->setMobile($Mobile_detect->isMobile());
?>
