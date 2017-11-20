<?php
if ($_SERVER["REQUEST_URI"] == "/dserAgenda/agenda/") {
    require_once("../modelo/mAgenda.php");
  } else {
    require_once("modelo/mAgenda.php");
  }
$agenda = new Contacto();

if (isset($_GET['borrar'])) {
  $idAborrar = $_GET['borrar'];
  if ($agenda->borrarContacto($idAborrar)){
  ?>
  <div class="alert alert-success">
  <strong>Borrado!</strong> Has borrado a una persona de la lista de contactos.
  </div>
  <?php
} else {
  ?>
  <div class="alert alert-warning">
  <strong>Atencion!</strong> No existe ese contacto en la agenda.
</div>
<?php
}
}



if (($_POST) && (isset($_POST["nombreI"]))){

  $idContactoBorrar = "";
  $email2Post = "";
  $grupo1Post = "";
  $grupo2Post = "";
  $grupo3Post = "";

  $nombrePost = filter_input(INPUT_POST, 'nombreI');
  $apellidosPost = filter_input(INPUT_POST, 'apellidosI');
  $telefonoPost = filter_input(INPUT_POST, 'telefonoI');
  $email1Post = filter_input(INPUT_POST, 'email1I');
  $email2Post = filter_input(INPUT_POST, 'email2I');
  $grupoPost = $_POST['grupoI'];

  if (isset($_POST["idAeditar"])) {
    $idContactoBorrar = filter_input(INPUT_POST, 'idAeditar');
  }

  $vueltas = 1;
  foreach ($_POST['grupoI'] as $selected_option) {
   if ($vueltas == 1) {
     $grupo1Post = $selected_option;
   }
   if ($vueltas == 2) {
     $grupo2Post = $selected_option;
   }
   if ($vueltas == 3) {
     $grupo3Post = $selected_option;
   }
   $vueltas++;
  }

  $agenda->insertarContacto($nombrePost, $apellidosPost, $telefonoPost, $email1Post, $email2Post, $grupo1Post, $grupo2Post, $grupo3Post, $idContactoBorrar);
}


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



if (isset($_GET['editar'])) {
  $email2Aeditar = "";
  $grupo1Aeditar= "";
  $grupo2Aeditar = "";
  $grupo3Aeditar = "";
  $rowEditar = $agenda->datosPorId($_GET['editar']);
  $emailsBBDD = $rowEditar['Email'];
  $emails = explode("<br>", $emailsBBDD);
  $gruposBBDD = $rowEditar['Grupo'];
  $gruposAeditar = explode("<br>", $gruposBBDD);
  $email1Aeditar = $emails[0];

  if(isset($emails[1])) {
    $email2Aeditar = $emails[1];
  }

  $grupo1Aeditar = $gruposAeditar[0];

  if (isset($gruposAeditar[1])){
    $grupo2Aeditar = $gruposAeditar[1];
  }

  if (isset($gruposAeditar[2])){
    $grupo3Aeditar = $gruposAeditar[2];
  }

}



if ($_SERVER["REQUEST_URI"] == "/dserAgenda/agenda/") {
    require_once("../vista/vAgenda.php");
  } else {
    require_once("vista/vAgenda.php");
  }

?>
