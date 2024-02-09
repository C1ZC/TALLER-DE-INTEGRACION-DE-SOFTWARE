<?php
include("conexion.php");

// Ordenar la lista de la tabla
if(isset($_GET['campo']) && isset($_GET['orden'])){
    $campo = $_GET['campo'];
    $orden = $_GET['orden'];
} else {
    // Por defecto, ordenar por el campo 'nombre_producto' de manera ascendente
    $campo = 'nombre_producto';
    $orden = 'ASC';
}

// Construir la consulta SQL para obtener los productos, ordenados según el campo y la dirección especificados
$sql = "SELECT * FROM productos";

// Buscar en la tabla
$where = "";

if (!empty($_POST)) {
    $valor = $_POST['campo1'];
    if (!empty($valor)) {
        // Filtrar la búsqueda en varios campos
        $where = "WHERE id_producto LIKE '%$valor%' OR codigo_barras LIKE '%$valor%' OR codigo_qr LIKE '%$valor%' OR nombre_producto LIKE '%$valor%' OR identificador_lote LIKE '%$valor%' OR tipo_producto LIKE '%$valor%' OR ciudad LIKE '%$valor%' OR numero_estante LIKE '%$valor%' OR cantidad_piezas_inventario LIKE '%$valor%' OR cantidad_cajas LIKE '%$valor%' OR piezas_por_caja LIKE '%$valor%' OR total_piezas_inventariadas LIKE '%$valor%'";
    }
}

// Combinar la búsqueda con el orden ascendente o descendente
$sql .= " $where ORDER BY $campo $orden";

$resultado = $conexion->query($sql);
?>
<div class="dataTables_scrollBody" style="position: relative; overflow: auto; max-height: 400px; width: 100%;">
    <table cellspacing="0" cellpadding="0">
        <thead>
            <tr class="encabezado">
            <?php
            // Definir dos arrays, uno para los nombres de los campos de la tabla y otro para los nombres a mostrar
            $campos = "id_producto, codigo_barras, codigo_qr, nombre_producto, identificador_lote, tipo_producto, ciudad, numero_estante, cantidad_piezas_inventario, cantidad_cajas, piezas_por_caja, total_piezas_inventariadas";
            $cabecera = "ID Producto, Código de Barras, Código QR, Nombre Producto, Identificador de Lote, Tipo Producto, Ciudad, Número de Estante, Cantidad en Inventario de Piezas, Cantidad Inventariada de Cajas/Empaques, Cantidad de Piezas en Cajas/Empaques, Total de Piezas Inventariadas";

            // Separar los nombres mediante coma
            $cabecera = explode(",", $cabecera);
            $campos = explode(",", $campos);

            // Número de elementos en el primer array
            $nroItemsArray = count($campos);

            // Iniciar la variable $i en 0
            $i = 0;

            // Utilizar un bucle para crear las columnas
            while ($i < $nroItemsArray) {
                // Comparar: si el campo actual es igual al elemento actual del array
                if ($campos[$i] == $campo) {
                    // Cambiar la dirección de orden si se hace clic en el encabezado
                    if ($orden == "DESC") {
                        $orden = "ASC";
                    } else {
                        $orden = "DESC";
                    }

                    // Si el campo coincide con el elemento del array, darle un color diferente al encabezado
                    echo "<td class=\"encabezado_selec\"><a onclick=\"OrdenarPor('" . $campos[$i] . "','" . $orden . "')\">" . $cabecera[$i] . "</a></td>\n";
                } else {
                    // En caso contrario, la columna no tendrá un color especial
                    echo "<td><a onclick=\"OrdenarPor('" . $campos[$i] . "','DESC')\">" . $cabecera[$i] . "</a></td>\n";
                }

                $i++;
            }
            ?>
                <th> <a href="libreria.php"> <button type="button" class="btn btn-info">Agregar</button> </a> </th>
            </tr>
        </thead>

        <tbody>
            <?php
            // Esta función permite comparar el campo actual y el nombre de la columna en la base de datos
            function estiloCampo($_campo, $_columna) {
                if ($_campo == $_columna) {
                    return " class=\"filas_selec\"";
                } else {
                    return "";
                }
            }

            // Mostrar los resultados mediante la consulta anterior
            while ($fila = mysqli_fetch_array($resultado)) {
                echo "<tr>";
                echo "<td" . estiloCampo($campo, 'id_producto') . ">" . $fila['id'] . "</td>";
                echo "<td" . estiloCampo($campo, 'codigo_barras') . ">" . $fila['codigo_barras'] . "</td>";
                echo "<td" . estiloCampo($campo, 'codigo_qr') . ">" . $fila['codigo_qr'] . "</td>";
                echo "<td" . estiloCampo($campo, 'nombre_producto') . ">" . $fila['nombre_producto'] . "</td>";
                echo "<td" . estiloCampo($campo, 'identificador_lote') . ">" . $fila['identificador_lote'] . "</td>";
                echo "<td" . estiloCampo($campo, 'tipo_producto') . ">" . $fila['tipo_producto'] . "</td>";
                echo "<td" . estiloCampo($campo, 'ciudad') . ">" . $fila['ciudad'] . "</td>";
                echo "<td" . estiloCampo($campo, 'numero_estante') . ">" . $fila['numero_estante'] . "</td>";
                echo "<td" . estiloCampo($campo, 'cantidad_piezas_inventario') . ">" . $fila['cantidad_piezas_inventario'] . "</td>";
                echo "<td" . estiloCampo($campo, 'cantidad_cajas') . ">" . $fila['cantidad_cajas'] . "</td>";
                echo "<td" . estiloCampo($campo, 'piezas_por_caja') . ">" . $fila['piezas_por_caja'] . "</td>";
                echo "<td" . estiloCampo($campo, 'total_piezas_inventariadas') . ">" . $fila['total_piezas_inventariadas'] . "</td>";
                echo "<td> <a href='modificar.php?id_producto=" . $fila['id'] . "'><button type='button' class='btn btn-danger'>Modificar</button></a> </td>";
                echo "<td> <a href='eliminar.php?id_producto=" . $fila['id'] . "'><button type='button' class='btn btn-danger'>Eliminar</button></a> </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
