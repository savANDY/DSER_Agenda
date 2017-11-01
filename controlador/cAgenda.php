<?php
    require_once("../modelo/mAgenda.php");
    $agenda = new Contacto();

    if (!empty($_POST["filtro"])) {
      $filtroRecogido = ($_POST["filtro"]);
      Setcookie("filtro", $filtroRecogido);
      echo "<meta http-equiv='refresh' content='0'>";
    }


    if (isset ($_COOKIE["filtro"] ) ) {
      $filtro = $_COOKIE["filtro"];
      $row = $agenda->lista_contactos($filtro);
    } else {
      $row = $agenda->lista_contactos("sinfiltro");
    }
      require_once("../vista/vAgenda.php");

?>
