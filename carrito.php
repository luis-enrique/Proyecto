<?php 
session_start();
include ('conexion.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<p>Carrito de compras </p>
<p>Sus compras hasta el momento son:</p>
<?php 
if (isset($_POST['id_txt'])){
	$id=$_POST['id_txt'];
	$nombre=$_POST['nombre'];
	$precio=$_POST['precio'];
	$cantidad=$_POST['cantidad'];
	$mi_carrito[]=array('id_producto'=>$id,'nombre'=>$nombre,'precio_venta'=>$precio,'stock'=>$cantidad);
	//print_r($mi_carrito);
}



if (isset($_SESSION['carrito'])){
	    $mi_carrito=$_SESSION['carrito'];
			if (isset($_POST['id_txt'])){
				$id=$_POST['id_txt'];
				$nombre=$_POST['nombre'];
				$precio=$_POST['precio_venta'];
				$cantidad=$_POST['stock'];
				$pos=-1;
				for($i=0;$i<count($mi_carrito);$i++){
					if($id==$mi_carrito[$i]['id_producto']){
						$pos=$i;
					}
				}
				if($pos<>-1){
					$cuanto=$mi_carrito[$pos]['stock']+$cantidad;
					$mi_carrito[$pos]=array('id_producto'=>$id,'nombre'=>$nombre,'precio_venta'=>$precio,'stock'=>$cuanto);
				}else{
					$mi_carrito[]=array('id_producto'=>$id,'nombre'=>$nombre,'precio_venta'=>$precio,'stock'=>$cantidad);
					}
	}
}
if (isset($mi_carrito)) $_SESSION['carrito']=$mi_carrito;


?>

<table width="283" border="0">
  <tr>
    <td colspan="4" align="center"> LISTADO DE SUS COMPRAS</td>
  </tr>
  <tr>
    <td width="43" bgcolor="#FF9900">PRODUCTO</td>
    <td width="43" bgcolor="#FF9900">PRECIO</td>
    <td width="43" bgcolor="#FF9900">CANTIDAD</td>
    <td width="126" bgcolor="#FF9900">SUBTOTAL</td>
  </tr>
  <?php
      if (isset($mi_carrito)){
	    $total=0;
		for ($i=0;$i<count($mi_carrito);$i++){
   ?>
  <tr>
    <td bgcolor="#FFFADD"><?php echo $mi_carrito[$i]['nombre'] ?></td>
    <td bgcolor="#FFFADD"><?php echo $mi_carrito[$i]['precio_venta']  ?></td>
    <td bgcolor="#FFFADD"><?php echo $mi_carrito[$i]['stock']  ?></td>
    <?php 
		$subtotal=$mi_carrito[$i]['precio_venta']*$mi_carrito[$i]['stock'];
	    $total=$total+$subtotal;
	?>
    <td bgcolor="#FFFADD"><?php echo $subtotal ?></td>
  </tr>
  <?php 
	  }
  }
  ?>
  <tr>
    <td bgcolor="#FFFADD">&nbsp;</td>
    <td bgcolor="#FFFADD">&nbsp;</td>
    <td bgcolor="#FFFADD">TOTAL</td>
    <td bgcolor="#FFFADD"><?php if (isset($total)) echo $total ?></td>
  </tr>
</table>
<p><a href="principal.php">Volver</a></p>
</body>
</html>