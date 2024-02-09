<?php
include("conexion.php");
//registrar usuario este metodo evita inyecciones en tus campos de datos.
if(isset($_POST["registrar"])){
	$nombre = mysqli_real_escape_string($conexion,$_POST['nombre']);
	$correo = mysqli_real_escape_string($conexion,$_POST['correo']);
	$usuario = mysqli_real_escape_string($conexion,$_POST['user']);
  $rut = mysqli_real_escape_string($conexion,$_POST['rut']);
	$password = mysqli_real_escape_string($conexion,$_POST['pass']);
  $sexo = mysqli_real_escape_string($conexion,$_POST['sexo']);
	$tel = mysqli_real_escape_string($conexion,$_POST['tel']);
  $direccion = mysqli_real_escape_string($conexion,$_POST['direccion']);
	//enviar encriptar contraceña a base de datos
	$password_encriptada = sha1($password);
	//esto permite que no se agregue 2 usuarios del mismo nombre
	$sqluser = "SELECT idusuarios FROM usuarios WHERE usuario = '$usuario'; ";
	$resultadouser = $conexion->query($sqluser);
	$filas= $resultadouser->num_rows;
      if($filas > 0) {
        echo "<script>alert('El usuario ya existe');
              window.location = 'registrar.php';</script>";
    } else {
        $sqlusuario = "INSERT INTO usuarios(Nombre,Correo,Usuario,Rut,Password,Sexo,Telefono,Direccion) VALUES ('$nombre', '$correo', '$usuario', '$rut' , '$password_encriptada' , '$sexo' , '$tel' , '$direccion')";
        
        $resultadousuario = $conexion->query($sqlusuario);
        if($resultadousuario) {
            echo "<script>alert('Registro Exitoso');
                  window.location = 'index.php';</script>";
        } else {
            echo "<script>alert('Error al Registrarse');
                  window.location = 'registrar.php';</script>";
        }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>Bienvenido a la Libreria</title>
	<!--CSS MATERIALIZE-->
	<link href="css/estilos.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<!-- Compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
<!-- Compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<!--registrar -->
<header>
      <h1>Registrar</h1>
    </header>
    <div class="container pt-60">
      <div class="row">
			<h4>Ingresa tu Información</h4>
        <form class="col s12" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
          <div class="row">
            <div class="input-field col s6">
              <input  type="text" class="validate" name ="user" required="true">
              <label for="first_name">Username</label>
            </div>
            <div class="input-field col s6">
              <input id="last_name" type="text" class="validate" name = "nombre" required="true">
              <label for="last_name">Nombre Completo</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="pass" type="password" class="validate" name = "pass" required="true">
              <label for="pass">Password</label>
            </div>
            <div class="input-field col s6">
              <input id="c_pass" type="password" class="validate" required="true">
              <label for="c_pass">Confirmar Password</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="email" type="email" class="validate" name="correo" required="true">
              <label for="email">Email</label>
            </div>
            <div class="input-field col s6">
              <input id="rut" type="text" class="validate" name="rut" required="true">
              <label for="rut">RUT</label>
            </div>
            </div>
            <div class="row">
            <div class="input-field col s6">
              <input id="sexo" type="text" class="validate" name="sexo" required="true">
              <label for="sexo">Sexo</label>
            </div>
            <div class="input-field col s6">
              <input id="tel" type="tel" class="validate" name="tel" required="true">
              <label for="tel">Telefono</label>
            </div>
            </div>
            <div class="row">
            <div class="input-field col s12">
              <input id="direccion" type="text" class="validate" name="direccion" required="true">
              <label for="sexo">Dirección</label>
            </div>
            </div>
          <div class="row">
            <div class="col s12 mt-25"> 
              <button class="btn waves-effect waves-light pulse" type="submit" name="registrar">Registrar
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
    

	<div class="toolbar center">
				<a href="index.php"  class="waves-effect waves-light btn">
					
						Regresar al Login
				</a>
			</div>

<!--register-->

</body>
</html>