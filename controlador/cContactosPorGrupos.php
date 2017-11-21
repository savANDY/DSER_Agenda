<?php
  require_once("modelo/mAgenda.php");

$agenda = new Contacto();
$rowGrupos = $agenda->lista_grupos();

require_once("vista/vContactosPorGrupos.php");

?>
