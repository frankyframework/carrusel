<?php

function _carrusel($txt)
{
    return dgettext("carrusel",$txt);
}


function carrusel_getFotoGaleria($id,$id_carrusel,$foto,$url)
{
    global $MyAccessList;
    global $MyConfigure;
    
    $html = "";
    $html .= "<div class='_cont_img_carrousel img_foto_clientes foto_$id' id='foto_$id'>"
            . "<div class='_img_slider_panel'>".  makeHTMLImg(imageResize($MyConfigure->getUploadDir()."/carruseles/$id_carrusel/$foto",220,220,true), "100%", "", $url)."</div>"
            . "<div class='_controls'><div><a href=\"javascript:void(0);\" onclick=\"carrusel_eliminarFoto($id)\"><i class='icon icon-r-eliminar'></i></a></div>"
            . "<div><a href=\"javascript:void(0);\" onclick=\"carrusel_promptEditarFoto('URL:','Editar foto','$id' )\"><i class='icon icon-icon_link'></i></a></div></div>"
            . "<p class='txt_gal_description label_url_foto_$id'>$url</p>" 
            . "</div>";
    return $html;
}



function getCarrusel($clave)
{
   
    global $MyConfigure;
    global $MyFrankyMonster;
    global $MyMetatag;
    global $MyRequest;

    $plugins = $MyFrankyMonster->MyJQueyfile();
  
    if (is_array($plugins)) {
        if (!in_array('slick',$plugins)) 
        {
            $MyMetatag->setJs("/public/jquery/slick/js/slick.min.js");
            $MyMetatag->setCss("/public/jquery/slick/css/slick-theme.css");
            $MyMetatag->setCss("/public/jquery/slick/css/slick.css");
        }     
    }
    else{
        $MyMetatag->setJs("/public/jquery/slick/js/slick.min.js");
        $MyMetatag->setCss("/public/jquery/slick/css/slick-theme.css");
        $MyMetatag->setCss("/public/jquery/slick/css/slick.css");
    }
      

    $CarruselcarruselesModel = new Carrusel\model\CarruselcarruselesModel();
    $CarruselcarruselesEntity = new Carrusel\entity\CarruselcarruselesEntity();
    $Tokenizer = new \Franky\Haxor\Tokenizer;
    $CarruselcarruselesEntity->status(1);
    $CarruselcarruselesEntity->code($clave);
    $result	 = $CarruselcarruselesModel->getData($CarruselcarruselesEntity->getArrayCopy());
    
    if($result == REGISTRO_SUCCESS){
        
        $carrusel = $CarruselcarruselesModel->getRows();
        
        $CarruselfotosModel = new Carrusel\model\CarruselfotosModel();
        $CarruselfotosEntity = new Carrusel\entity\CarruselfotosEntity();
        $CarruselfotosEntity->id_carrusel($carrusel['id']);
        $CarruselfotosEntity->status(1);
        $CarruselfotosModel->setTampag('100');
        $CarruselfotosModel->setOrdensql('orden ASC');
        $CarruselfotosModel->getData($CarruselfotosEntity->getArrayCopy());

        if($CarruselfotosModel->getTotal() > 0)
        {
            while($registro = $CarruselfotosModel->getRows())
            {
                

                $registro['foto'] = $MyConfigure->getUploadDir()."/carruseles/".$carrusel["id"].'/'.$registro['foto'];


                
                $resultados_pagina[] = $registro;
            }  
            
            return render(PROJECT_DIR.'/modulos/carrusel/diseno/widget.carrusel.phtml',['resultados_pagina' => $resultados_pagina,'carrusel'=>$carrusel]);
        }
      
        
    }
    return  '';
}



?>
