/*
Navicat MySQL Data Transfer

Source Server         : MySQL
Source Server Version : 50617
Source Host           : 127.0.0.1:3306
Source Database       : purificadora

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-04-24 16:14:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for adquisiciones
-- ----------------------------
DROP TABLE IF EXISTS `adquisiciones`;
CREATE TABLE `adquisiciones` (
  `id_adquisicion` int(11) NOT NULL AUTO_INCREMENT,
  `id_proveedor` int(10) NOT NULL,
  `nombre` char(20) NOT NULL,
  `apellido_p` char(20) NOT NULL,
  `apellido_m` char(20) NOT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `total` varchar(45) DEFAULT NULL,
  `id_usuario` int(10) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_adquisicion`),
  KEY `fk_adquisiciones_proveedores_idx` (`id_proveedor`),
  KEY `fk_adquisiciones_usuarios_idx` (`id_usuario`),
  CONSTRAINT `fk_adquisiciones_proveedores` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_adquisiciones_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of adquisiciones
-- ----------------------------
INSERT INTO `adquisiciones` VALUES ('1', '1', 'Sandra', 'Gutierres', 'Florez', null, '53', '3', '2015-04-15');

-- ----------------------------
-- Table structure for asistencia
-- ----------------------------
DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE `asistencia` (
  `id_trabajador` int(10) NOT NULL,
  `asistencia` char(2) NOT NULL,
  `facha` date NOT NULL,
  UNIQUE KEY `unique_key_asistencia` (`id_trabajador`,`facha`),
  CONSTRAINT `fk_asistencia_trabajadores` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajadores` (`id_trabajador`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of asistencia
-- ----------------------------

-- ----------------------------
-- Table structure for bitacora_pedidos
-- ----------------------------
DROP TABLE IF EXISTS `bitacora_pedidos`;
CREATE TABLE `bitacora_pedidos` (
  `id_venta` int(10) NOT NULL,
  `id_pedido` int(10) NOT NULL,
  `fecha` date NOT NULL,
  KEY `fk_bitacora_pedidos_ventas_idx` (`id_venta`),
  KEY `fk_bitacora_pedidos_pedidos_idx` (`id_pedido`),
  CONSTRAINT `fk_bitacora_pedidos_pedidos` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_bitacora_pedidos_ventas` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bitacora_pedidos
-- ----------------------------

-- ----------------------------
-- Table structure for categorias
-- ----------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id_categoria` int(10) NOT NULL AUTO_INCREMENT,
  `puesto` varchar(50) NOT NULL,
  `sueldo` int(10) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of categorias
-- ----------------------------
INSERT INTO `categorias` VALUES ('1', 'Administrador', '2000');
INSERT INTO `categorias` VALUES ('2', 'Cajero', '1000');
INSERT INTO `categorias` VALUES ('3', 'Embotellador de garrafones', '1000');
INSERT INTO `categorias` VALUES ('4', 'Encargado de limpieza', '800');

-- ----------------------------
-- Table structure for clientes
-- ----------------------------
DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id_cliente` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` char(20) NOT NULL,
  `apellido_p` char(20) NOT NULL,
  `apellido_m` char(20) NOT NULL,
  `estado` char(30) NOT NULL,
  `ciudad` char(30) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  `colonia` char(50) NOT NULL,
  `calle` char(50) NOT NULL,
  `no_casa` varchar(10) DEFAULT NULL,
  `Telefono` varchar(10) DEFAULT NULL,
  `e_mail` varchar(50) DEFAULT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of clientes
-- ----------------------------
INSERT INTO `clientes` VALUES ('1', 'Rosario', 'Meneses', 'Corrales', 'Guerrero', 'Atempa', '41104', 'Barrio el Rosario', '', '', '75612351', 'rosi_791@hotmail.com', '2015-04-13');
INSERT INTO `clientes` VALUES ('2', 'Isabel', 'Myao', 'Salazar', 'Guerrero', 'Chilapa de Àlvarez', '41100', 'Zàpata', 'Esperanza', '42', '75610372', 'isa.moyao_89@gmail.com', '2015-04-14');

-- ----------------------------
-- Table structure for folio_auto
-- ----------------------------
DROP TABLE IF EXISTS `folio_auto`;
CREATE TABLE `folio_auto` (
  `folio_key` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`folio_key`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of folio_auto
-- ----------------------------
INSERT INTO `folio_auto` VALUES ('000001');
INSERT INTO `folio_auto` VALUES ('000002');
INSERT INTO `folio_auto` VALUES ('000003');

-- ----------------------------
-- Table structure for pedidos
-- ----------------------------
DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE `pedidos` (
  `id_pedido` int(10) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(10) DEFAULT NULL,
  `total` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `hora_entrega` time DEFAULT NULL,
  `fecha_pedido` date NOT NULL,
  `estdo` char(30) NOT NULL,
  PRIMARY KEY (`id_pedido`),
  KEY `fk_pedidos_usuarios_idx` (`id_usuario`),
  KEY `fk_pedidos_clientes_idx` (`id_cliente`),
  CONSTRAINT `fk_pedidos_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pedidos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pedidos
-- ----------------------------
INSERT INTO `pedidos` VALUES ('1', '2', '900', '3', '2015-04-14', null, '2015-04-14', 'Pendiente');
INSERT INTO `pedidos` VALUES ('2', '1', '700', '3', '2015-04-20', null, '2015-04-19', 'Pendiente');
INSERT INTO `pedidos` VALUES ('3', null, '300', '3', '2015-04-17', null, '2015-04-15', 'Pendiente');

-- ----------------------------
-- Table structure for productos
-- ----------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `stock` int(10) NOT NULL,
  `precio_venta` int(10) NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES ('1', 'Garrafon vacio', '', '50', '25');
INSERT INTO `productos` VALUES ('2', 'Garrafon con agua', null, '50', '13');
INSERT INTO `productos` VALUES ('3', 'Llenado de garrafon', null, '50', '10');
INSERT INTO `productos` VALUES ('4', 'Hielo 1/4', null, '50', '15');
INSERT INTO `productos` VALUES ('5', 'Hielo 1/2', '', '51', '30');
INSERT INTO `productos` VALUES ('6', 'Hielo entero', null, '50', '60');

-- ----------------------------
-- Table structure for productos_adquisicion
-- ----------------------------
DROP TABLE IF EXISTS `productos_adquisicion`;
CREATE TABLE `productos_adquisicion` (
  `id_adquisicion` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `subtotal` int(10) NOT NULL,
  UNIQUE KEY `unique_key_productos_adquisicion` (`id_adquisicion`,`id_producto`),
  KEY `fk_productos_adquisicion_adquisiciones_idx` (`id_adquisicion`),
  KEY `fk_productos_adquisicion_productos_idx` (`id_producto`),
  CONSTRAINT `fk_productos_adquisicion_adquisiciones` FOREIGN KEY (`id_adquisicion`) REFERENCES `adquisiciones` (`id_adquisicion`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_productos_adquisicion_productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of productos_adquisicion
-- ----------------------------
INSERT INTO `productos_adquisicion` VALUES ('1', '1', '1', '25');
INSERT INTO `productos_adquisicion` VALUES ('1', '2', '1', '13');
INSERT INTO `productos_adquisicion` VALUES ('1', '5', '2', '30');

-- ----------------------------
-- Table structure for productos_pedido
-- ----------------------------
DROP TABLE IF EXISTS `productos_pedido`;
CREATE TABLE `productos_pedido` (
  `id_pedido` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `precio_unitario` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `subtotal` int(10) NOT NULL,
  UNIQUE KEY `unique_key_productos_venta` (`id_pedido`,`id_producto`),
  KEY `fk_productos_pedido_productos1_idx` (`id_producto`),
  CONSTRAINT `fk_productos_pedido_pedidos1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_productos_pedido_productos1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of productos_pedido
-- ----------------------------
INSERT INTO `productos_pedido` VALUES ('1', '2', '25', '4', '100');
INSERT INTO `productos_pedido` VALUES ('1', '3', '10', '20', '200');
INSERT INTO `productos_pedido` VALUES ('1', '6', '60', '10', '600');
INSERT INTO `productos_pedido` VALUES ('2', '2', '25', '4', '100');
INSERT INTO `productos_pedido` VALUES ('2', '6', '60', '10', '600');
INSERT INTO `productos_pedido` VALUES ('3', '2', '25', '4', '100');
INSERT INTO `productos_pedido` VALUES ('3', '3', '10', '20', '200');

-- ----------------------------
-- Table structure for productos_venta
-- ----------------------------
DROP TABLE IF EXISTS `productos_venta`;
CREATE TABLE `productos_venta` (
  `id_venta` int(10) NOT NULL,
  `id_producto` int(10) NOT NULL,
  `precio_unitario` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `subtotal` int(10) NOT NULL,
  UNIQUE KEY `unique_key_productos_venta` (`id_venta`,`id_producto`),
  KEY `fk_productos_venta_ventas_idx` (`id_venta`),
  KEY `fk_productos_venta_productos_idx` (`id_producto`),
  CONSTRAINT `fk_productos_venta_productos` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_productos_venta_ventas` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of productos_venta
-- ----------------------------
INSERT INTO `productos_venta` VALUES ('1', '1', '25', '1', '25');
INSERT INTO `productos_venta` VALUES ('1', '2', '13', '1', '13');
INSERT INTO `productos_venta` VALUES ('1', '5', '15', '1', '15');

-- ----------------------------
-- Table structure for proveedores
-- ----------------------------
DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE `proveedores` (
  `id_proveedor` int(10) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` char(50) NOT NULL,
  `estado` char(30) NOT NULL,
  `ciudad` char(30) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  `colonia` char(50) NOT NULL,
  `calle` char(50) NOT NULL,
  `no_establesimiento` varchar(10) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `fax` varchar(10) DEFAULT NULL,
  `e_mail` varchar(50) DEFAULT NULL,
  `pagina_web` varchar(50) DEFAULT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of proveedores
-- ----------------------------
INSERT INTO `proveedores` VALUES ('1', 'Productos y Reactivos Químicos', 'México', 'México DF', '03660', 'Lázaro Cárdenas', 'Constitución', '110', '58910359', '', 'mexico_pro_110@outlook.com', null, '2015-04-15');

-- ----------------------------
-- Table structure for tipo_usuario
-- ----------------------------
DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` char(15) NOT NULL,
  `privilegios` char(30) NOT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipo_usuario
-- ----------------------------
INSERT INTO `tipo_usuario` VALUES ('1', 'Administrador', 'Todos');
INSERT INTO `tipo_usuario` VALUES ('2', 'Vendedor', 'Solo venta');

-- ----------------------------
-- Table structure for trabajadores
-- ----------------------------
DROP TABLE IF EXISTS `trabajadores`;
CREATE TABLE `trabajadores` (
  `id_trabajador` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` char(20) NOT NULL,
  `apellido_p` char(20) NOT NULL,
  `apellido_m` char(20) NOT NULL,
  `id_categoria` int(10) NOT NULL,
  `estado` char(30) NOT NULL,
  `ciudad` char(30) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  `colonia` char(50) NOT NULL,
  `calle` char(50) NOT NULL,
  `no_casa` varchar(10) DEFAULT NULL,
  `Telefono` varchar(10) DEFAULT NULL,
  `e_mail` varchar(50) DEFAULT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_trabajador`),
  KEY `fk_trabajadores_categorias_idx` (`id_categoria`),
  CONSTRAINT `fk_trabajadores_categorias` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trabajadores
-- ----------------------------
INSERT INTO `trabajadores` VALUES ('1', 'Flora', 'Trinidad', 'Tlatempa', '1', 'Guerrero', 'Zitlala', '41160', 'San Francisco', 'Francisco I Madero', '126', '7561177640', 'trinidadflora@outlook.com', '2015-04-13');
INSERT INTO `trabajadores` VALUES ('2', 'Luis Enrique', 'Morales', 'Tomatzin', '1', 'Guerrero', 'Chilapa de ï¿½lvare', '4', ' Los Pinos', 'Emiliano Zapata', '          ', '7561183234', 'luis.enrique.mt@outlook.com', '2015-04-13');
INSERT INTO `trabajadores` VALUES ('3', 'Hermenegildo', 'Diaz', 'Renteria', '3', 'Guerrero', 'Guerrero', '41100', 'Rubï¿½n Fiegeroa', 'Ribi', '', '7561039507', 'hermengildodiazrenteria@gmail.com', '2015-04-13');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(10) NOT NULL AUTO_INCREMENT,
  `id_trabajador` int(10) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `id_tipo_usuario` int(10) NOT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_usuarios_tipo_usuario_idx` (`id_tipo_usuario`),
  KEY `fk_usuarios_trabajadores_idx` (`id_trabajador`),
  CONSTRAINT `fk_usuarios_tipo_usuario` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_usuarios_trabajadores` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajadores` (`id_trabajador`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', '2', 'luis enrique', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', '1', 'imagenes/luis.png', '2015-04-13');
INSERT INTO `usuarios` VALUES ('3', '3', 'hermenegildo', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', '2', 'imagenes/herme.jpg', '2015-04-13');
INSERT INTO `usuarios` VALUES ('4', '4', 'jorge luis', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', '1', 'imagenes/jorge.png', '2015-04-13');

-- ----------------------------
-- Table structure for ventas
-- ----------------------------
DROP TABLE IF EXISTS `ventas`;
CREATE TABLE `ventas` (
  `id_venta` int(10) NOT NULL AUTO_INCREMENT,
  `folio` varchar(10) NOT NULL,
  `id_cliente` int(10) DEFAULT NULL,
  `total` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `fecha_venta` date NOT NULL,
  PRIMARY KEY (`id_venta`),
  UNIQUE KEY `folio_UNIQUE` (`folio`),
  KEY `fk_ventas_usuarios_idx` (`id_usuario`),
  KEY `fk_ventas_clientes_idx` (`id_cliente`),
  CONSTRAINT `fk_ventas_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_ventas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ventas
-- ----------------------------
INSERT INTO `ventas` VALUES ('1', '0000000001', '1', '53', '3', '2015-04-15');
INSERT INTO `ventas` VALUES ('2', '0000000002', '1', '100', '3', '2015-04-15');
DROP TRIGGER IF EXISTS `ingreso_productos`;
DELIMITER ;;
CREATE TRIGGER `ingreso_productos` AFTER INSERT ON `productos_adquisicion` FOR EACH ROW BEGIN
 UPDATE productos SET stock = (stock + NEW.cantidad) WHERE id_producto = NEW.id_producto;
 END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `resta_productos`;
DELIMITER ;;
CREATE TRIGGER `resta_productos` AFTER INSERT ON `productos_venta` FOR EACH ROW BEGIN
 UPDATE productos SET stock = (stock - NEW.cantidad) WHERE id_producto = NEW.id_producto;
 END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `foilio_auto_insert`;
DELIMITER ;;
CREATE TRIGGER `foilio_auto_insert` BEFORE INSERT ON `ventas` FOR EACH ROW BEGIN
    INSERT INTO folio_auto VALUES ("");
END
;;
DELIMITER ;
