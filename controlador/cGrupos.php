<?php
if ($_SERVER["REQUEST_URI"] == "/dserAgenda/agenda/") {
  require_once("../modelo/mAgenda.php");
} else {
  require_once("modelo/mAgenda.php");
}
$agenda = new Contacto();

$rowGrupos = $agenda->lista_grupos();

require_once("vista/vGrupos.php");

?>
