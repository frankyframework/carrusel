<?php
return array(
     array('title'=> "Widgets",
            'children' =>  array(
            array(
             "permiso" =>   "administrar_carrusel",
             "url" => $MyRequest->url(ADMIN_CARRUSEL_LIST),
             "etiqueta" => "Carruseles"
            )
    ))
);
?>