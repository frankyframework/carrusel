<?php
return array(
     array('title'=> "Carrusel",
            'children' =>  array(
            array(
             "permiso" =>   ADMINISTRAR_CARRUSEL,
             "url" => $MyRequest->url(ADMIN_CARRUSEL_LIST),
             "etiqueta" => "Carruseles"
            )
    ))
);
?>