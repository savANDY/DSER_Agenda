<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Agenda - Ejercicio de Repaso</title>
</head>
<body>
    <h1>Bienvenido</h1>

    <div class="container">

  		<form name="loginForm" action="login.php" method="post">
  			<div class="row">
  				<h2>Login</h2>
  				<div class="input-group input-group-icon">
  					<input type="text" name="nombre" placeholder="Nombre" required
  						maxlength="10" />
  					<div class="input-icon">
  						<i class="fa fa-user"></i>
  					</div>
  				</div>
  				<div class="input-group input-group-icon">
  					<input type="password" name="password" placeholder="Password"
  						required />
  					<div class="input-icon">
  						<i class="fa fa-key"></i>
  					</div>
  				</div>
  			</div>
  			<input class="btn btn-success" type="submit" value="Loguearse">
  		</form>


  		<form name="miForm" action="registro.php"
  			onsubmit="return validarForm()" method="post" enctype="multipart/form-data">
  			<div class="row">
  				<h2>Nueva Cuenta</h2>
  				<div class="input-group input-group-icon">
  					<input type="text" name="username"
  						placeholder="Username (min 4 caracteres, maximo 10)" required
  						minlength="4" maxlength="10" />
  					<div class="input-icon">
  						<i class="fa fa-user"></i>
  					</div>
  				</div>

  				<div class="input-group input-group-icon">
  					<input type="password" name="pass" placeholder="Contraseña"
  						required />
  					<div class="input-icon">
  						<i class="fa fa-key"></i>
  					</div>
  				</div>
  			</div>
  			<input class="btn btn-success" type="submit" value="Registrarse">
  		</form>
  	</div>


</body>
</html>
