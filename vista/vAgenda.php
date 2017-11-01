<!DOCTYPE html>
<html lang="en">
<head>
  <title>Agenda - Ejercicio de Repaso</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Agenda</h2>
  <p>Ordenar por:</p>

<form method="post" action="index.php">
    <input type="radio" name="filtro"
    <?php if (isset($_COOKIE["filtro"]) && $_COOKIE["filtro"]=="nombre") echo "checked";?>
    value="nombre">Nombre
    <input type="radio" name="filtro"
    <?php if (isset($_COOKIE["filtro"]) && $_COOKIE["filtro"]=="apellido") echo "checked";?>
    value="apellido">Apellido
    <input type="radio" name="filtro"
    <?php if (isset($_COOKIE["filtro"]) && $_COOKIE["filtro"]=="grupo") echo "checked";?>
    value="grupo">Grupo
    <input type="submit" name="submit" value="Filtrar">
    <input type="reset" name="reset" value="Borrar filtro" onclick="
      <?php
        unset($_COOKIE["filtro"])
      ?>
    ">
</form>
  <table class="table table-hover">
    <thead>
      <tr>
        <th><?php if (isset($_COOKIE["filtro"]) && $_COOKIE["filtro"]=="nombre") echo "↓";?>Nombre</th>
        <th><?php if (isset($_COOKIE["filtro"]) && $_COOKIE["filtro"]=="apellido") echo "↓";?>Apellidos</th>
        <th>Telefono</th>
        <th>Email(s)</th>
        <th><?php if (isset($_COOKIE["filtro"]) && $_COOKIE["filtro"]=="grupo") echo "↓";?>Grupo(s)</th>
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
                  </tr>
              <?php
          }
      ?>


    </tbody>
  </table>
</div>

</body>
</html>
