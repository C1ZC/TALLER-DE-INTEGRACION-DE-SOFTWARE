<?php
include("conexion.php");

if(isset($_POST["registrar_producto"])){
    $id_producto = mysqli_real_escape_string($conexion, $_POST['id_producto']);
    $codigo_barras = mysqli_real_escape_string($conexion, $_POST['codigo_barras']);
    $codigo_qr = mysqli_real_escape_string($conexion, $_POST['codigo_qr']);
    $nombre_producto = mysqli_real_escape_string($conexion, $_POST['nombre_producto']);
    $identificador_lote = mysqli_real_escape_string($conexion, $_POST['identificador_lote']);
    $tipo_producto = mysqli_real_escape_string($conexion, $_POST['tipo_producto']);
    $ciudad = mysqli_real_escape_string($conexion, $_POST['ciudad']);
    $numero_estante = mysqli_real_escape_string($conexion, $_POST['numero_estante']);
    $cantidad_piezas_inventario = mysqli_real_escape_string($conexion, $_POST['cantidad_piezas_inventario']);
    $cantidad_cajas = mysqli_real_escape_string($conexion, $_POST['cantidad_cajas']);
    $piezas_por_caja = mysqli_real_escape_string($conexion, $_POST['piezas_por_caja']);
    $total_piezas_inventariadas = mysqli_real_escape_string($conexion, $_POST['total_piezas_inventariadas']);

    // Verificar si el producto ya existe
    $sql_producto_existente = "SELECT id FROM productos WHERE id = '$id_producto';";
    $resultado_producto_existente = $conexion->query($sql_producto_existente);
    $filas_producto = $resultado_producto_existente->num_rows;

    if($filas_producto > 0){
        echo "<script>alert('El producto ya existe');</script>";
    } else {
        // Insertar información del producto en la base de datos
        $sql_insertar_producto = "INSERT INTO productos (id, codigo_barras, codigo_qr, nombre_producto, identificador_lote, tipo_producto, ciudad, numero_estante, cantidad_piezas_inventario, cantidad_cajas, piezas_por_caja, total_piezas_inventariadas)
                                  VALUES ('$id_producto', '$codigo_barras', '$codigo_qr', '$nombre_producto', '$identificador_lote', '$tipo_producto', '$ciudad', '$numero_estante', '$cantidad_piezas_inventario', '$cantidad_cajas', '$piezas_por_caja', '$total_piezas_inventariadas')";

        if ($conexion->query($sql_insertar_producto) === TRUE) {
            echo "<script>alert('Registro Exitoso');</script>";
        } else {
            echo "<script>alert('Error al Registrar');</script>";
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
<!--register -->
<header>

<nav>
    <div class="nav-wrapper">
      <a href="#!" class="brand-logo">Logo</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="admin.php">Home</a></li>
        <li><a href="libreria.php">Libreria</a></li>
		<li><a href="salir.php" class="waves-effect waves-light btn">Salir</a></li>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <li><a href="admin.php">Home</a></li>
    <li><a href="libreria.php">Libreria</a></li>
    <li><a href="salir.php" class="waves-effect waves-light btn">Salir</a></li>
  </ul>

      <h1>Registrar Automotora</h1>
    </header>
    <div class="container pt-60">
      <div class="row">
			<h4>Ingresa la Información del Producto</h4>
        <form class="col s12" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
        <div class="row">
                    <div class="input-field col s6">
                        <input id="id_producto" type="text" class="validate" name="id_producto" required="true">
                        <label for="id_producto">ID del Producto</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="codigo_barras" type="text" class="validate" name="codigo_barras" required="true">
                        <label for="codigo_barras">Código de Barras</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="codigo_qr" type="text" class="validate" name="codigo_qr" required="true">
                        <label for="codigo_qr">Código QR</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="nombre_producto" type="text" class="validate" name="nombre_producto" required="true">
                        <label for="nombre_producto">Nombre del Producto</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="identificador_lote" type="text" class="validate" name="identificador_lote" required="true">
                        <label for="identificador_lote">Identificador de Lote</label>
                    </div>
                  
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="ciudad" type="text" class="validate" name="ciudad" required="true">
                        <label for="ciudad">Ciudad</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="numero_estante" type="text" class="validate" name="numero_estante" required="true">
                        <label for="numero_estante">Número de Estante</label>
                    </div>
                </div>
                <div class="row">
                  <div class="input-field col s6">
                      <input id="cantidad_piezas_inventario" type="text" class="validate" name="cantidad_piezas_inventario" required="true">
                      <label for="cantidad_piezas_inventario">Cantidad en Inventario de Piezas</label>
                  </div>
                  <div class="input-field col s6">
                      <input id="cantidad_cajas" type="text" class="validate" name="cantidad_cajas" required="true">
                      <label for="cantidad_cajas">Cantidad Inventariada de Cajas/Empaques</label>
                  </div>
              </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="piezas_por_caja" type="text" class="validate" name="piezas_por_caja" required="true">
                        <label for="piezas_por_caja">Cantidad de Piezas en Cajas/Empaques</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="total_piezas_inventariadas" type="text" class="validate" name="total_piezas_inventariadas" required="true">
                        <label for="total_piezas_inventariadas">Total de Piezas Inventariadas</label>
                    </div>
                </div>
                <div class="row">
                  <div class="input-field col s4">
                    <label> Tipo de producto 
                        <input type="radio" name="tipo_producto" value="oficina" />
                        <span>Oficina</span>
                    </label>
                </div>
                <div class="input-field col s4">
                    <label>
                        <input type="radio" name="tipo_producto" value="escolar" />
                        <span>Escolar</span>
                    </label>
                </div>
                <div class="input-field col s4">
                    <label>
                        <input type="radio" name="tipo_producto" value="muebleria" />
                        <span>Mueblería</span>
                    </label>
                </div>

                </div>




                <div class="row">
                    <div class="col s12 mt-25">
                        <button class="btn waves-effect waves-light pulse" type="submit" name="registrar_producto">Registrar Producto</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    

    <div class="col s12 mt-25"> </div>

<!--register-->
  <div>
  	<?php require_once("piedepagina.php"); ?>
   </div>

</body>
</html>