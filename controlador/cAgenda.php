<?php
    require_once("../modelo/mAgenda.php");
    $agenda = new Contacto();
    $row = $agenda->lista_contactos();
    require_once("../vista/vAgenda.php");
?>
