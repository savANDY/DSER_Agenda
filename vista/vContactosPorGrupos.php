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
    <h2>Contactos por Grupos</h2>

    <?php
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
      echo ("Estás logueado, usuario: " . $_SESSION['username'] . ", rol: " . $_SESSION['rol'] . ", <a href='login/logout.php'>salir</a>");
    } else {
      echo ("No estás logueado, <a href='login'>logueate aqui</a>");
    }
    ?>

    <p><a href="index.php">Volver a la agenda</a></p>

    <table class="table table-hover" style="width:200px;">
      <thead>
        <tr>
          <th>Grupo</th>
          <th>Contactos</th>
        </tr>
      </thead>
      <tbody>

        <?php
        for($i=0;$i<count($rowGrupos);$i++) {
          ?>
          <tr id="<?php echo $rowGrupos[$i]["idGrupo"]; ?>">
            <td><?php echo $rowGrupos[$i]["Nombre"]; ?></td>
            <td><?php
            $rowCpg = $agenda->contactosPorGrupos($rowGrupos[$i]["idGrupo"]);
            for($j=0;$j<count($rowCpg);$j++) {
              echo $rowCpg[$j]["Nombre"];
              echo " ";
              echo $rowCpg[$j]["Apellidos"];
              echo "<br>";
            }

            ?>
            </td>
          </tr>
          <?php
        }
        ?>

      </tbody>
    </table>
  </div>

</body>
</html>
