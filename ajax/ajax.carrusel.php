<?php
function carrusel_DeleteCarrusel($id,$status)
{
    $CarruselcarruselesModel =  new \Carrusel\model\CarruselcarruselesModel();
    $CarruselcarruselesEntity =  new \Carrusel\entity\CarruselcarruselesEntity();
    $Tokenizer = new \Franky\Haxor\Tokenizer;
    global $MyAccessList;
    global $MyMessageAlert;

    $respuesta = null;

    if($MyAccessList->MeDasChancePasar(ADMINISTRAR_CARRUSEL))
    {
        $CarruselcarruselesEntity->id(addslashes($Tokenizer->decode($id)));
        $CarruselcarruselesEntity->status($status);

        if($CarruselcarruselesModel->save($CarruselcarruselesEntity->getArrayCopy()) == REGISTRO_SUCCESS)
        {

        }
        else
        {
              $respuesta["message"] = $MyMessageAlert->Message("eliminar_generico_error");
              $respuesta["error"] = true;
        }
    }
    else
    {
         $respuesta["message"] = $MyMessageAlert->Message("sin_privilegios");
         $respuesta["error"] = true;
    }

    return $respuesta;
}


function carrusel_eliminarFoto($id,$status=0)
{
	
    $CarruselfotosModel = new Carrusel\model\CarruselfotosModel();
    $CarruselfotosEntity = new Carrusel\entity\CarruselfotosEntity();
    global $MyAccessList;
    global $MyMessageAlert;
    $respuesta =null;
    if($MyAccessList->MeDasChancePasar(ADMINISTRAR_CARRUSEL))
    {
        $CarruselfotosEntity->id(addslashes($id));
        $CarruselfotosEntity->status($status);


        if($CarruselfotosModel->save($CarruselfotosEntity->getArrayCopy()) == REGISTRO_SUCCESS)
        {
    
            $respuesta[] = array("message" => "success");
        }
        else
        {
    $respuesta[] = array("message" => $MyMessageAlert->Message("eliminar_generico_error"));
        }
    }
    else
    {
            $respuesta[] = array("message" => $MyMessageAlert->Message("sin_privilegios"));
    }
	
	return $respuesta;
}


function carrusel_editarFoto($id,$url)
{
	
    
    $CarruselfotosModel = new Carrusel\model\CarruselfotosModel();
    $CarruselfotosEntity = new Carrusel\entity\CarruselfotosEntity();
        global $MyAccessList;
        global $MyMessageAlert;
        $respuesta =null;
        if($MyAccessList->MeDasChancePasar(ADMINISTRAR_CARRUSEL))
        {
            $CarruselfotosEntity->id(addslashes($id));
            $CarruselfotosEntity->url($url);

        if($CarruselfotosModel->save($CarruselfotosEntity->getArrayCopy()) == REGISTRO_SUCCESS)
            {
		
               $respuesta[] = array("message" => "success", "url" => ($url));
            }
            else
            {
		$respuesta[] = array("message" => $MyMessageAlert->Message("editar_generico_error"));
            }
        }
        else
        {
             $respuesta[] = array("message" => $MyMessageAlert->Message("sin_privilegios"));
        }
	
	return $respuesta;
}



function carrusel_ShowFotos($carrusel)
{
    $Tokenizer = new \Franky\Haxor\Tokenizer;
	$CarruselfotosModel = new Carrusel\model\CarruselfotosModel();
        $CarruselfotosEntity = new Carrusel\entity\CarruselfotosEntity();
        global $MyAccessList;
        $respuesta =null;
        if($MyAccessList->MeDasChancePasar(ADMINISTRAR_CARRUSEL))
        {
            $carrusel = $Tokenizer->decode($carrusel);
            
            $CarruselfotosModel->setOrdensql("orden ASC");
            $CarruselfotosModel->setTampag(2000);
            $CarruselfotosEntity->id_carrusel($carrusel);
            $CarruselfotosEntity->status(1);
            if($CarruselfotosModel->getData($CarruselfotosEntity->getArrayCopy()) == REGISTRO_SUCCESS)
            {
                $i = 0;
                $html = "";
                while($registro = $CarruselfotosModel->getRows())
                {
                    
                    $html .= carrusel_getFotoGaleria($registro["id"],$carrusel,$registro["foto"],$registro["url"]);
                    $i++;
                }
                $respuesta["html"] =  $html;
                
               
            }
        }
       
	
	return $respuesta;
}




function carrusel_setOrdenFoto($orden)
{
	$Tokenizer = new \Franky\Haxor\Tokenizer;
        $CarruselfotosModel = new Carrusel\model\CarruselfotosModel();
        $CarruselfotosEntity = new Carrusel\entity\CarruselfotosEntity();
        global $MyAccessList;
        global $MyMessageAlert;
        $respuesta =null;
        if($MyAccessList->MeDasChancePasar(ADMINISTRAR_CARRUSEL))
        {
           
        
            $orden = explode(",",str_replace("foto_","",$orden));

            


           
            $v = "";
            foreach($orden as $key => $val)
            {
                $v .= ($key)." -> $val,";
                $CarruselfotosEntity->id($val);
                $CarruselfotosEntity->orden($key);
                $CarruselfotosModel->save($CarruselfotosEntity->getArrayCopy());
            }
          //  echo $v;
        }
        else
        {
             $respuesta[] = array("message" => $MyMessageAlert->Message("sin_privilegios"));
        }
	
	return $respuesta;
}


/******************************** EJECUTA *************************/


$MyAjax->register("carrusel_DeleteCarrusel");
$MyAjax->register("carrusel_eliminarFoto");
$MyAjax->register("carrusel_editarFoto");
$MyAjax->register("carrusel_ShowFotos");
$MyAjax->register("carrusel_setOrdenFoto");
?>