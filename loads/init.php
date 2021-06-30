<?php
include 'lca.php';
include 'util.php';
bindtextdomain("carrusel", PROJECT_DIR .'/modulos/carrusel/locale');


if (function_exists('bind_textdomain_codeset')) 
{
    bind_textdomain_codeset("carrusel", 'UTF-8');
}


$MyMetatag->setJs("/public/js/carrusel.js");
?>