<?php
session_start();

if (isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)) {
  require_once("controlador/cContactosPorGrupos.php");
} else {
  require_once("controlador/cLogin.php");
}

 ?>
