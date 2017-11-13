<!DOCTYPE html>
<html lang="en">
<head>
  <title>Agenda - Ejercicio de Repaso</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/estilo.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="js/javascript.js" type="text/javascript"></script>
</head>
<body>

  <div class="container">
    <h2>Agenda</h2>

    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      echo ("Estás logueado, usuario: " . $_SESSION['username'] . ", rol: " . $_SESSION['rol'] . ", <a href='login/logout.php'>salir</a>");
    } else {
      echo ("No estás logueado, <a href='login'>logueate aqui</a>");
    }
    ?>

    <fieldset>
      <legend>Ordenar por:</legend>


      <form method="post" action="index.php">
        <label class="radio-inline">
          <input type="radio" name="orden"
          <?php if (isset($_COOKIE["orden"]) && $_COOKIE["orden"]=="nombre") echo "checked";?>
          value="nombre">Nombre
        </label>
        <label class="radio-inline">
          <input type="radio" name="orden"
          <?php if (isset($_COOKIE["orden"]) && $_COOKIE["orden"]=="apellido") echo "checked";?>
          value="apellido">Apellido
        </label>
        <label class="radio-inline">
          <input type="radio" name="orden"
          <?php if (isset($_COOKIE["orden"]) && $_COOKIE["orden"]=="grupo") echo "checked";?>
          value="grupo">Grupo
        </label>
        <button type="submit" class="btn btn-default">Buscar</button>
        <button type="submit" class="btn btn-default" name="borrarOrden">Borrar Orden</button>
      </form>
    </fieldset>

    <form class="form-horizontal" action="index.php" method="POST">
      <fieldset>
        <legend>Buscar por:</legend>
        <div class="form-group row">
          <label class="control-label col-sm-2" for="email">Nombre:</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="nombre" placeholder="Introduce un nombre" name="nombre" <?php
            if (isset($_COOKIE["nombre"])) {
              $cookieNombre = $_COOKIE["nombre"];
              echo ("value = '$cookieNombre'");
            }
            ?>>

          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Apellidos:</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="apellidos" placeholder="Introduce los apellidos" name="apellidos">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="pwd">Grupo:</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" id="grupo" placeholder="Introduce un grupo" name="grupo">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Buscar</button>
            <button type="submit" class="btn btn-default" name="resetear">Resetear</button>
          </div>
        </fieldset>
      </form>

      <table class="table table-hover">
        <thead>
          <tr>
            <th><?php if (isset($_COOKIE["orden"]) && $_COOKIE["orden"]=="nombre") echo "↓";?>Nombre</th>
            <th><?php if (isset($_COOKIE["orden"]) && $_COOKIE["orden"]=="apellido") echo "↓";?>Apellidos</th>
            <th>Telefono</th>
            <th>Email(s)</th>
            <th><?php if (isset($_COOKIE["orden"]) && $_COOKIE["orden"]=="grupo") echo "↓";?>Grupo(s)</th>
            <?php
            if ($_SESSION['rol'] == "Administrador") {
              echo ('<th class="text-right">Opciones</th>');
            }
            ?>

          </tr>
        </thead>
        <tbody>

          <?php
          for($i=0;$i<count($row);$i++)
          {
            ?>
            <tr>
              <td><?php echo $row[$i]["Nombre"]; ?></td>
              <td><?php echo $row[$i]["Apellidos"]; ?></td>
              <td><?php echo $row[$i]["Telefono"]; ?></td>
              <td><?php echo $row[$i]["Email"]; ?></td>
              <td><?php echo $row[$i]["Grupo"]; ?></td>

              <?php
              if ($_SESSION['rol'] == "Administrador") {
                echo ('<td class="text-right"><a href="index.php?editar=' . $row[$i]["id"] . '"><button type="button" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-pencil"></span> </button></a>

                <a href="index.php?borrar=' . $row[$i]["id"] . '"><button type="button" class="btn btn-default btn-sm">
                <span class="glyphicon glyphicon-remove"></span></button></a>
                </td>');
              }
              ?>

            </tr>
            <?php
          }
          if ($_SESSION['rol'] == "Administrador") {
            ?>
            <form method="post" action="index.php">
              <tr>
                <td>
                  <div class="form-group">
                    <input type="text" class="form-control" name="nombreI" placeholder="Nombre">
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <input type="text" class="form-control" name="apellidosI" placeholder="Apellidos">
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <input type="tel" class="form-control" name="telefonoI" placeholder="Telefono">
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <div class="row" id="emailsNuevos">
                      <div class="col col-sm-8">
                        <input type="email" class="form-control col-xs-4" name="email1I" placeholder="Email">
                      </div>

                      <div class="col col-sm-8" id="segundoEmail" style="display:none">
                        <input type="email" class="form-control col-xs-4" name="email2I" placeholder="Email">
                      </div>


                      <div class="col col-sm-4" id="botonNuevoEmail">
                        <button type="button" class="btn btn-default btn-sm" onclick="aniadirEmail()">
                          <span class="glyphicon glyphicon-plus"></span>
                        </button>
                      </div>

                    </div>
                  </div>
                </td>
                <td>
                  <div class="form-group">
                    <select multiple class="form-control" id="grupo" name="grupoI[]">

                      <?php
                      for($i=0;$i<count($rowGrupos);$i++)
                      {
                        ?>
                          <option value="<?php echo $rowGrupos[$i]["idGrupo"]; ?>"><?php echo $rowGrupos[$i]["Nombre"]; ?></option>
                        <?php } ?>
                    </select>
                  </div>
                </td>
                <td>
                  <button type="submit" class="btn btn-default btn-sm">
                    Añadir</button>
                  </td>
                </tr>
              </form>
              <?php
            }
            ?>


          </tbody>
        </table>
      </div>

    </body>
    </html>
