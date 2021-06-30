<?php
use Carrusel\model\CarruselfotosModel;
use Carrusel\entity\CarruselfotosEntity;
use Carrusel\model\CarruselcarruselesModel;
use Carrusel\entity\CarruselcarruselesEntity;
use Franky\Haxor\Tokenizer;

$Tokenizer = new Tokenizer();
$carrusel	= $Tokenizer->decode($MyRequest->getRequest('id'));
$CarruselcarruselesEntity = new CarruselcarruselesEntity();
$CarruselcarruselesModel = new CarruselcarruselesModel();
$lista_admin_data = array();

$CarruselcarruselesEntity->id($carrusel);
if($CarruselcarruselesModel->getData($CarruselcarruselesEntity->getArrayCopy()) == REGISTRO_SUCCESS)
{

    $registro = $CarruselcarruselesModel->getRows();
    
    $carrusel_nombre = $registro["nombre"];
    
    $CarruselfotosModel = new CarruselfotosModel();
    $CarruselfotosEntity = new CarruselfotosEntity();
    $CarruselfotosEntity->id_carrusel($carrusel);
    $CarruselfotosEntity->status(1);
    $CarruselfotosModel->setPage(1);
    $CarruselfotosModel->setTampag(2000);
    $CarruselfotosModel->setOrdensql("orden ASC");

    $result   = $CarruselfotosModel->getData($CarruselfotosEntity->getArrayCopy());

    if($CarruselfotosModel->getTotal() > 0)
    {
        while($registro = $CarruselfotosModel->getRows())
        {
            
            $lista_admin_data[] = $registro;

        }
    }

    $carrusel=$Tokenizer->token("carrusel", $carrusel);
}
else
{
    $MyRequest->redirect($MyRequest->getReferer());
}
?>