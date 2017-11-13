<?php
if ($_SERVER["REQUEST_URI"] == "/dserAgenda/agenda/") {
    require_once("../modelo/mAgenda.php");
  } else {
    require_once("modelo/mAgenda.php");
  }

if (($_POST) && (isset($_POST["nombreI"]))){

  $nombrePost = filter_input(INPUT_POST, 'nombreI');
  $apellidosPost = filter_input(INPUT_POST, 'apellidosI');
  $telefonoPost = filter_input(INPUT_POST, 'telefonoI');
  $email1Post = filter_input(INPUT_POST, 'email1I');
  $email2Post = filter_input(INPUT_POST, 'email2I');
  $grupoPost = $_POST['grupoI'];


  foreach ($_POST['grupoI'] as $selected_option) {
   echo $selected_option;
  }

  echo "Hola";

  //insertarContacto($nombrePost, $apellidosPost, $telefonoPost, $email1Post, $email2Post, $grupoPost);
}

$agenda = new Contacto();

$rowGrupos = $agenda->lista_grupos();

$nombreRecogido = "";
$apellidosRecogido = "";
$grupoRecogido = "";

if ((!empty($_POST["orden"])) && (empty($_POST["borrarOrden"]))) {
  $ordenRecogido = ($_POST["orden"]);
  Setcookie("orden", $ordenRecogido);
  echo "<meta http-equiv='refresh' content='0'>";
}

    if (isset($_POST["borrarOrden"])) {
      setcookie('orden');
      echo "<meta http-equiv='refresh' content='0'>";
    }

$whereNombre = "";
$whereApellidos = "";
$whereGrupo = "";

if(isset($_POST['resetear'])) {
  setcookie('nombre');
  setcookie('apellidos');
  setcookie('grupo');
  $whereNombre = "";
  $whereApellidos = "";
  $whereGrupo = "";
  echo "<meta http-equiv='refresh' content='0'>";
} else {

  if (!empty($_POST["nombre"])) {
    $nombreRecogido = ($_POST["nombre"]);
    Setcookie("nombre", $nombreRecogido);
    echo "<meta http-equiv='refresh' content='0'>";
  }

  if (!empty($_POST["apellidos"])) {
    $apellidosRecogido = ($_POST["apellidos"]);
    Setcookie("apellidos", $apellidosRecogido);
    echo "<meta http-equiv='refresh' content='0'>";
  }

  if (!empty($_POST["grupo"])) {
    $grupoRecogido = ($_POST["grupo"]);
    Setcookie("grupo", $grupoRecogido);
    echo "<meta http-equiv='refresh' content='0'>";
  }

  if (isset($_COOKIE["nombre"])) {
    $whereNombre = " AND (c.Nombre like '%" . $_COOKIE["nombre"] . "%')";

  }
  if (isset($_COOKIE["apellidos"])) {
    $whereApellidos = " AND (c.Apellidos like '%" . $_COOKIE["apellidos"] . "%')";
  }
  if (isset($_COOKIE["grupo"])) {
    $whereGrupo = " AND (g.Nombre like '%" . $_COOKIE["grupo"] . "%')";
  }
}

if (isset ($_COOKIE["orden"]) ) {
  $orden = $_COOKIE["orden"];
  $row = $agenda->lista_contactos($orden, $whereNombre, $whereApellidos, $whereGrupo);
} else {
  $row = $agenda->lista_contactos("sinorden", $whereNombre, $whereApellidos, $whereGrupo);
}

if ($_SERVER["REQUEST_URI"] == "/dserAgenda/agenda/") {
    require_once("../vista/vAgenda.php");
  } else {
    require_once("vista/vAgenda.php");
  }

?>
