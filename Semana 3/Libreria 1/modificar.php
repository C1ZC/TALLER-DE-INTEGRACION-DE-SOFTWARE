<?php
	require 'conexion.php';
	//ingresa los valores por GET, y los ingresa en value 
	$id_producto = $_GET['id_producto'];
	
	$sql = "SELECT * FROM productos WHERE id = '$id_producto'";
	$resultado = $conexion->query($sql);
	$row = $resultado->fetch_array(MYSQLI_ASSOC);

    // Modificar producto
    if(isset($_POST["modificar"])){
        //$id_producto = mysqli_real_escape_string($conexion,$_POST['id_producto']);
        $codigo_barras = mysqli_real_escape_string($conexion,$_POST['codigo_barras']);
        $codigo_qr = mysqli_real_escape_string($conexion,$_POST['codigo_qr']);
        $nombre_producto = mysqli_real_escape_string($conexion,$_POST['nombre_producto']);
        $identificador_lote = mysqli_real_escape_string($conexion,$_POST['identificador_lote']);
        $tipo_producto = mysqli_real_escape_string($conexion,$_POST['tipo_producto']);
        $ciudad = mysqli_real_escape_string($conexion,$_POST['ciudad']);
        $numero_estante = mysqli_real_escape_string($conexion,$_POST['numero_estante']);
        $cantidad_piezas_inventario = mysqli_real_escape_string($conexion,$_POST['cantidad_piezas_inventario']);
        $cantidad_cajas = mysqli_real_escape_string($conexion,$_POST['cantidad_cajas']);
        $piezas_por_caja = mysqli_real_escape_string($conexion,$_POST['piezas_por_caja']);
        $total_piezas_inventariadas = mysqli_real_escape_string($conexion,$_POST['total_piezas_inventariadas']);

        // Actualizar la información del producto
        $sql_producto = "UPDATE productos SET codigo_barras = '$codigo_barras', codigo_qr = '$codigo_qr', nombre_producto = '$nombre_producto', identificador_lote = '$identificador_lote', tipo_producto = '$tipo_producto', ciudad = '$ciudad', numero_estante = '$numero_estante', cantidad_piezas_inventario = '$cantidad_piezas_inventario', cantidad_cajas = '$cantidad_cajas', piezas_por_caja = '$piezas_por_caja', total_piezas_inventariadas = '$total_piezas_inventariadas' WHERE id = '$id_producto'";
        
        $resultado_producto = $conexion->query($sql_producto);
        if($resultado_producto > 0) {
            echo " <script> alert('Modificado correctamente')";
            
            header("Location: admin.php");
      exit; // Asegúrate de que el script se detenga después de la redirección
        }else{
            echo " <script> alert('Error al Modificar');
            window.location = 'modificar.php?id_producto=$id_producto';</script>";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<title>Modificar Librería</title>
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

      <h1>Modificar Producto</h1>
    </header>
    <div class="container pt-60">
      <div class="row">
			<h4>Ingresa la Información del Producto</h4>
        <form class="col s12" action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST">
          <div class="row">
            <div class="input-field col s6">
              <input id="id_producto" type="text" class="validate" name="id_producto" required="true" value="<?php echo $row['id']; ?>" readonly>
              <label for="id_producto">ID del Producto</label>
            </div>
            <div class="input-field col s6">
              <input id="codigo_barras" type="text" class="validate" name="codigo_barras" required="true" value="<?php echo $row['codigo_barras']; ?>">
              <label for="codigo_barras">Código de Barras</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="codigo_qr" type="text" class="validate" name="codigo_qr" required="true" value="<?php echo $row['codigo_qr']; ?>">
              <label for="codigo_qr">Código QR</label>
            </div>
            <div class="input-field col s6">
              <input id="nombre_producto" type="text" class="validate" name="nombre_producto" required="true" value="<?php echo $row['nombre_producto']; ?>">
              <label for="nombre_producto">Nombre del Producto</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="identificador_lote" type="text" class="validate" name="identificador_lote" required="true" value="<?php echo $row['identificador_lote']; ?>">
              <label for="identificador_lote">Identificador de Lote</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="ciudad" type="text" class="validate" name="ciudad" required="true" value="<?php echo $row['ciudad']; ?>">
              <label for="ciudad">Ciudad</label>
            </div>
            <div class="input-field col s6">
              <input id="numero_estante" type="text" class="validate" name="numero_estante" required="true" value="<?php echo $row['numero_estante']; ?>">
              <label for="numero_estante">Número de Estante</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="cantidad_piezas_inventario" type="text" class="validate" name="cantidad_piezas_inventario" required="true" value="<?php echo $row['cantidad_piezas_inventario']; ?>">
              <label for="cantidad_piezas_inventario">Cantidad en Inventario de Piezas</label>
            </div>
            <div class="input-field col s6">
              <input id="cantidad_cajas" type="text" class="validate" name="cantidad_cajas" required="true" value="<?php echo $row['cantidad_cajas']; ?>">
              <label for="cantidad_cajas">Cantidad Inventariada de Cajas/Empaques</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="piezas_por_caja" type="text" class="validate" name="piezas_por_caja" required="true" value="<?php echo $row['piezas_por_caja']; ?>">
              <label for="piezas_por_caja">Cantidad de Piezas en Cajas/Empaques</label>
            </div>
            <div class="input-field col s6">
              <input id="total_piezas_inventariadas" type="text" class="validate" name="total_piezas_inventariadas" required="true" value="<?php echo $row['total_piezas_inventariadas']; ?>">
              <label for="total_piezas_inventariadas">Total de Piezas Inventariadas</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s4">
              <label> Tipo de producto 
                <input type="radio" name="tipo_producto" value="oficina" <?php if($row['tipo_producto'] == 'oficina') echo 'checked'; ?> />
                <span>Oficina</span>
              </label>
            </div>
            <div class="input-field col s4">
              <label>
                <input type="radio" name="tipo_producto" value="escolar" <?php if($row['tipo_producto'] == 'escolar') echo 'checked'; ?> />
                <span>Escolar</span>
              </label>
            </div>
            <div class="input-field col s4">
              <label>
                <input type="radio" name="tipo_producto" value="muebleria" <?php if($row['tipo_producto'] == 'muebleria') echo 'checked'; ?> />
                <span>Mueblería</span>
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col s12 mt-25"> 
              <button class="btn waves-effect waves-light pulse" type="submit" name="modificar">Modificar Producto</button>
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