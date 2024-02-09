-- Base de datos: `Libreria`
--C1ZC--
--https://github.com/C1ZC
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
-- Estructura de tabla para la tabla `profesore`
--
CREATE DATABASE libreria;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(70) NOT NULL,
  `Correo` varchar(30) NOT NULL,
  `Usuario` varchar(20) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `Sexo` varchar(60) NOT NULL,
  `Telefono` varchar(60) NOT NULL,
  `Direccion` varchar(60) NOT NULL,
  `Rut` varchar(60) NOT NULL,
  PRIMARY KEY (`idusuarios`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_barras VARCHAR(255) NOT NULL,
    codigo_qr VARCHAR(255),
    nombre_producto VARCHAR(255) NOT NULL,
    imagen_producto VARCHAR(255),
    identificador_lote INT UNIQUE NOT NULL,
    tipo_producto ENUM('oficina', 'escolar', 'muebleria') NOT NULL,
    ciudad ENUM('Santiago', 'Valparaiso') NOT NULL,
    numero_estante INT NOT NULL,
    cantidad_piezas_inventario INT NOT NULL,
    cantidad_cajas INT NOT NULL,
    piezas_por_caja INT NOT NULL,
    total_piezas_inventariadas INT NOT NULL
);