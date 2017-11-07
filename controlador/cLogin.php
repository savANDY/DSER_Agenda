<?php

if ($_SERVER["REQUEST_URI"] == "/dserAgenda/login/login.php") {
    require_once("../modelo/mLogin.php");
  } else {
    require_once("modelo/mLogin.php");
  }
    $comprobar = new comprobarUsuario();

    if ((isset($_POST['username'])) && (isset($_POST['password']))){
      if ($comprobar->comprobarUsuario()) {
        echo "ESTAS LOGUEADO";
      } else {
        echo "NO ESTÁS LOGUEADO";
      }
    }

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      require_once("../vista/vLoggedin.php");
    } else {
      if ($_SERVER["REQUEST_URI"] == "/dserAgenda/login/login.php") {
          require_once("../vista/vLogin.php");
        } else {
          require_once("vista/vLogin.php");
        }
    }



?>
