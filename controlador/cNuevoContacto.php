<?php
require_once("../modelo/mAgenda.php");
$agenda = new Contacto();




if (isset ($_COOKIE["orden"]) ) {
  $orden = $_COOKIE["orden"];
  $row = $agenda->lista_contactos($orden, $whereNombre, $whereApellidos, $whereGrupo);
} else {
  $row = $agenda->lista_contactos("sinorden", $whereNombre, $whereApellidos, $whereGrupo);
}
require_once("../vista/vAgenda.php");

?>
