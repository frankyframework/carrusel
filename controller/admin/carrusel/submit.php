<?php
use Franky\Filesystem\File;
use Franky\Core\validaciones; 
use Carrusel\model\CarruselcarruselesModel;
use Carrusel\entity\CarruselcarruselesEntity;
use Franky\Haxor\Tokenizer;

$Tokenizer = new Tokenizer();

$CarruselcarruselesModel =  new CarruselcarruselesModel();
$CarruselcarruselesEntity =  new CarruselcarruselesEntity($MyRequest->getRequest());

$id       = $Tokenizer->decode($MyRequest->getRequest('id'));
$callback = $Tokenizer->decode($MyRequest->getRequest('callback'));

$CarruselcarruselesEntity->id($id);

$error = false;
$CarruselcarruselesEntity->code(getFriendly($CarruselcarruselesEntity->code()));

$validaciones =  new validaciones();
$valid = $validaciones->validRules($CarruselcarruselesEntity->setValidation());
if(!$valid)
{
    $MyFlashMessage->setMsg("error",$validaciones->getMsg());
    $error = true;
}

if($CarruselcarruselesModel->existe($CarruselcarruselesEntity->code(),$id) == REGISTRO_SUCCESS)
{
    $MyFlashMessage->setMsg("error",$MyMessageAlert->Message("carrusel_duplicado"));
    $error = true;
}

if(!$MyAccessList->MeDasChancePasar("administrar_carrusel"))
{
    $MyFlashMessage->setMsg("error",$MyMessageAlert->Message("sin_privilegios"));
    $error = true;
}


if($error == false)        
{
    $width = $MyRequest->getRequest('_width',array());
    $visible = $MyRequest->getRequest('_visible',array());
    $scroll = $MyRequest->getRequest('_scroll',array());
    $options = [];
    if(!empty($width))
    {
        foreach($width as $k => $v)
        {
            $options[$k] = ['width' => $width[$k],'visible' => $visible[$k],'scroll' => $scroll[$k]];
        }
    }

    $CarruselcarruselesEntity->responsivo(json_encode($options));
    if(empty($id))
    {

        $CarruselcarruselesEntity->createdAt(date('Y-m-d H:i:s'));
        $CarruselcarruselesEntity->status(1);
    }
    else
    {
        $CarruselcarruselesEntity->updateAt(date('Y-m-d H:i:s'));
    }
    $result = $CarruselcarruselesModel->save($CarruselcarruselesEntity->getArrayCopy());
    if($result == REGISTRO_SUCCESS)
    {
        if(empty($id))
        {
            $MyFlashMessage->setMsg("success",$MyMessageAlert->Message("guardar_generico_success"));
        }
        else
        {
             $MyFlashMessage->setMsg("success",$MyMessageAlert->Message("editar_generico_success"));
        }

        $location = (!empty($callback) ? ($callback) : $MyRequest->url(ADMIN_CARRUSEL_LIST));

    }
    elseif($result == REGISTRO_ERROR)
    {

        if(empty($id))
        {
            $MyFlashMessage->setMsg("error",$MyMessageAlert->Message("guardar_generico_error"));
        }
        else
        {
            $MyFlashMessage->setMsg("error",$MyMessageAlert->Message("editar_generico_error"));
        }
        $location = $MyRequest->getReferer();
    }
    else
    {
        $MyFlashMessage->setMsg("error",$result);
        $location = $MyRequest->getReferer();
    }
}
else
{

    $location = $MyRequest->getReferer();
}

$MyRequest->redirect($location);
?>