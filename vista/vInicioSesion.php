<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Agenda - Ejercicio de Repaso</title>
</head>
<body>
    <h1>Bienvenido</h1>

    <div class="container">
      Bienvenido! <?php $_SESSION['username'];?>
      <br><br><a href="../index.php">Portal</a> | <a href="../miperfil.php">Tu perfil</a>
  	</div>


</body>
</html>
