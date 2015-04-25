<?php include ('conexion.php');?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
body {
	background-color: #FFF;
}
</style>
</head>

<body>


<h1>Mi Tienda en Internet</h1>
<h4>www.tuturialesenvideo.net</h4>
<form id="form1" name="form1" method="post" action="">
  <table width="841" border="0" align="left">
    <tr>
      <td width="22">&nbsp;</td>
      <td width="92">&nbsp;</td>
      <td width="111">&nbsp;</td>
      <td width="121">&nbsp;</td>
      <td width="56">&nbsp;</td>
      <td width="94" align="right">BUSCAR:</td>
      <td width="144"><label for="buscar"></label>
      <input type="text" name="buscar" id="buscar" /></td>
      <td width="167"><input type="submit" name="Aceptar" id="Aceptar" value="Aceptar" /></form></td>
    </tr>
    <tr>
      <td colspan="8" align="center">LISTADO DE PRODUCTOS</td>
    </tr>
    <tr>
      <td bgcolor="#FF9900">ID</td>
      <td bgcolor="#FF9900">NOMBRE</td>
      <td bgcolor="#FF9900">PRECIO</td>
      <td bgcolor="#FF9900">ENSTOCK</td>
      <td bgcolor="#FF9900">AGREGAR</td>
    </tr>
    <?php 
		$consulta=mysql_query("select * from productos");
	    if (isset($_POST['buscar'])){
			$consulta=mysql_query("select * from productos where nombre like '%".$_POST['buscar']."%'");
		}
	
		while($filas=mysql_fetch_array($consulta)){
			$id=$filas['id_producto'];
			$nombre=$filas['nombre'];
			$precio=$filas['precio_venta'];
			$enStock=$filas['stock'];
			
         ?>
    <tr>
      <td bgcolor="#FFFADD"><?php echo $id ?></td>
      <td><img src=<?php echo $imagen; ?> alt="" width="70" height="70" /><br /></td>
      <td bgcolor="#FFFADD"><?php echo $nombre ?></td>
      <td bgcolor="#FFFADD"><?php echo $precio ?></td>
      <td bgcolor="#FFFADD"><?php echo $enStock ?></td>
      <td bgcolor="#FFFADD">
      <form action="carrito.php" method="post" name="compra">
        <input name="id_txt" type="hidden" value="<?php echo $id ?>" />
        <input name="nombre" type="hidden" value="<?php echo $nombre ?>" />
        <input name="precio" type="hidden" value="<?php echo $precio ?>" />
        <input name="cantidad" type="hidden" value="1" />
        <input name="Comprar" type="submit" value="Comprar" />
      </form>
      </td>
    </tr>
    <p>
      <?php }?>
      </table>
      
    </p>
    <p><a href="carrito.php">Ver Carrito</a></p>
</body>
</html>