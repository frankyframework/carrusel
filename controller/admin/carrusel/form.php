<?php
use Carrusel\Form\CarruselForm;
use Carrusel\model\CarruselcarruselesModel;
use Carrusel\entity\CarruselcarruselesEntity;
use Franky\Haxor\Tokenizer;

$Tokenizer = new Tokenizer();

$id		= $Tokenizer->decode($MyRequest->getRequest('id'));
$callback      = $MyRequest->getRequest('callback');
$data          = $MyFlashMessage->getResponse();

if(!empty($id))
{
    $CarruselcarruselesModel =  new CarruselcarruselesModel();
    $CarruselcarruselesEntity =  new CarruselcarruselesEntity();
    $CarruselcarruselesEntity->id($id);
    $result = $CarruselcarruselesModel->getData($CarruselcarruselesEntity->getArrayCopy());
    $data   = $CarruselcarruselesModel->getRows();
    $data['responsivo'] = json_decode($data['responsivo'],true);
    $data['id'] = $Tokenizer->token('carrusel', $data['id']);
}



$adminForm = new CarruselForm("frmcarrusel");
$adminForm->setData($data);
$adminForm->setAtributoInput("callback","value", urldecode($callback));
$title_form = "Carrusel";
