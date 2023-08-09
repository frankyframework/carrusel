<?php
include 'util.php';
__bindtextdomain("carrusel", 'carrusel');


if (function_exists('bind_textdomain_codeset')) 
{
    bind_textdomain_codeset("carrusel", 'UTF-8');
}


$MyMetatag->setJs("/modulos/carrusel/web/js/carrusel.js");
?>