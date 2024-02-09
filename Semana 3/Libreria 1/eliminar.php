<?php
include("conexion.php");

if (isset($_GET["id_producto"])) { 
    $id_producto = $_GET["id_producto"]; 
    $sql = "DELETE FROM productos WHERE id=$id_producto";
    if ($conexion->query($sql) === TRUE) {
        header("Location: admin.php"); // Redirigir a la página principal después de eliminar el producto
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

$conexion->close();
?>

