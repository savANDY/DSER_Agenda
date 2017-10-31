<?php
    require_once("../modelo/mRegistro.php");
    $comprobacion = new comprobarSiExiste();
    if ($comprobacion.comprobar()) {
      echo ("Existe");
    } else {
      echo ("No existe");
    }
    require_once("../vista/vRegistro.php");
?>
