<?php
    require_once("modelo.php");
    $agenda = new Contacto();
    $pd = $agenda->lista_contactos();
    require_once("vista.php");
?>
