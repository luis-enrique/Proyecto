
<?php
    session_start ();
    $_insession = "activo";

    if($_SESSION['session'] == $_insession){

    }else{
        session_destroy ();
        header('Location: index.php');
    }

    include("conexion.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ahuelik | Sistema</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />

    </head>
    <body class="pace-done skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                A h u e l i k
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">

                        <!-- Inicio Notificaciones: Sobre Pedidos -->
                        <?php
                         $v_query = "SELECT * FROM pedidos";
                         $v_registros = mysqli_query($link,$v_query) or die ("Problemas en el select:".mysql_error());
                         $v_total = mysqli_num_rows($v_registros);
                        ?>
                        <!--termina la consulta de cuantos pedidos hay  -->


                        <!--Inicia consulta de pedidos que deben ser entreados hoy  -->
                        <?php
                         $v_query2 = " SELECT * FROM PEDIDOS WHERE fecha_entrega = CURDATE()";
                         $v_registro = mysqli_query($link,$v_query2) or die ("Problemas en el select:".mysql_error());
                         $v_tota = mysqli_num_rows($v_registro);
                        ?>
                          <!--Termina consulta de pedidos que deben ser entreados hoy  -->


                         <!--Inicia consulta de pedidos atrasados -->
                        <?php
                         $v_query3 = " SELECT * FROM PEDIDOS WHERE fecha_entrega < CURDATE()";
                         $v_reg = mysqli_query($link,$v_query3) or die ("Problemas en el select:".mysql_error());
                         $v_to = mysqli_num_rows($v_reg);
                        ?>
                        <!--Termina consulta de pedidosatrasados -->


                        <!--Inicia consulta de pedidos con fecha faltante -->
                        <?php
                         $v_query4 = " SELECT * FROM PEDIDOS WHERE fecha_entrega > CURDATE()";
                         $v_re = mysqli_query($link,$v_query4) or die ("Problemas en el select:".mysql_error());
                         $v_t = mysqli_num_rows($v_re);
                         ?>
                         <!--Termina consulta  -->


                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning"><?php echo "$v_total";?> </span>
                            </a>
                            <ul class="dropdown-menu">


                                <li class="header"><?php
                               if ($v_total< "1") {

                                 echo "Usted tiene $v_total pedido pendiente";

                                 } else {
                                    echo "Usted tiene $v_total pedidos pendientes";

                               }
                                 ?></li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="pedidos_atrasados.php">
                                                <i class="fa fa-warning danger"></i> <?php echo "Pedidos atrasados $v_to";?>                                                            </a>
                                        </li>
                                        <li>
                                            <a href="pedidos_hoy.php">
                                               <i class="ion ion-ios7-cart success"></i><?php echo "Pedidos del dìa $v_tota";?>                                                  </a>
                                        </li>


                                        <li>
                                            <a href="pedidos_proximos.php">
                                                 <i class="ion ion-ios7-people info"></i><?php echo "Pedidos proximos $v_t";?>
                                        </li>

                                    </ul>
                                </li>
                                <li class="footer"><a></a></li>
                            </ul>
                        </li>
                        <!-- Fin Notificaciones: Sobre Pedidos -->

                        <!-- Informaciòn de usuario: Especificaciones -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $_SESSION['usuario']; ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo $_SESSION['foto_perfil']; ?>" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $_SESSION['nombre']; ?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="mi_perfil.php" class="btn btn-default btn-flat">Mi perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="close_session.php" class="btn btn-default btn-flat">Salir</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Fin Informaciòn de usuario: Especificaciones -->

                    </ul>
                </div>
            </nav>
        </header>


        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="<?php echo $_SESSION['foto_perfil']; ?>" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p><?php echo $_SESSION['tipo_usuario']; ?></p>

                            <a><i class="text-success"></i><?php echo $_SESSION['usuario']; ?></a>
                        </div>
                    </div>


                    <!-- Inicio del menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">

                        <li>
                            <a href='ventas.php'>
                                <i class='fa fa-shopping-cart'></i> <span>Realizar Venta</span>
                            </a>
                        </li>
                        <li>
                            <a href='pedidos.php'>
                                <i class='fa fa-truck'></i> <span>Pedidos</span>
                            </a>
                        </li>
                        <li>
                            <a href='clientes.php'>
                                <i class='fa fa-users'></i> <span>Clientes</span>
                            </a>
                        </li>
                    <!-- Apartado solo para el vendedor -->
                    <?php
                       if($_SESSION['privilegios'] == "Solo venta"){
                           echo "
                                <li>

                                    <a href='#'>
                                        <i class='fa fa-archive'></i> <span>Adquisición de productos</span>

                                    <a href='adquisicion_productos.php'>
                                        <i class='fa fa-archive'></i> <span>Adquisición de productos</span>

                                    </a>
                                </li>
                                <li class='treeview'>
                                    <a href='#'>
                                        <i class='fa fa-folder'></i>
                                        <span>Mis consultas</span>
                                        <i class='fa fa-angle-left pull-right'></i>
                                    </a>
                                    <ul class='treeview-menu'>

                                        <li><a href='#'><i class='fa fa-angle-double-right'></i> Ventas del dìa</a></li>
                                        <li><a href='#'><i class='fa fa-angle-double-right'></i> Pedidos</a></li>
                                        <li><a href='#'><i class='fa fa-angle-double-right'></i> Adquisiciones realizadas</a></li>
                                        <li><a href='#'><i class='fa fa-angle-double-right'></i> Asistencia de trabajadores</a></li>

                                        <li><a href='seller_ventas_dia'><i class='fa fa-angle-double-right'></i> Ventas del dìa</a></li>
                                        <li><a href='seller_pedidos_realizados.php'><i class='fa fa-angle-double-right'></i> Pedidos realizados</a></li>
                                        <li><a href='seller_adquisiciones_realizadas'><i class='fa fa-angle-double-right'></i> Adquicisiones realizadas</a></li>
                                        <li><a href='seller_asistenca_trabajadores'><i class='fa fa-angle-double-right'></i> Asistencia de trabajadores</a></li>


                                    </ul>
                                </li>
                               ";
                       }
                    ?>
                        <!-- Fin Apartado solo para el vendedor -->

                        <!-- Apartado solo para el administrador -->
                    <?php
                       if($_SESSION['privilegios'] == "Todos"){
                           echo "
                                <li>
                                    <a href='admin_productos.php'>
                                        <i class='fa fa-list-alt'></i> <span>Productos</span>
                                    </a>
                                </li>
                                <li class='treeview'>
                                    <a href='#'>
                                        <i class='fa fa-archive'></i>
                                        <span>Adquicisiones</span>
                                        <i class='fa fa-angle-left pull-right'></i>
                                    </a>
                                    <ul class='treeview-menu'>
                                        <li><a href='adquisicion_productos.php'><i class='fa fa-angle-double-right'></i> Adquisiciòn de productos</a></li>
                                        <li><a href='admin_proveedores.php'><i class='fa fa-angle-double-right'></i> Proveedores</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href='admin_usuaios.php'>
                                        <i class='fa fa-user'></i> <span>Usuarios</span>
                                    </a>
                                </li>
                                <li>
                                    <a href='admin_trabajadores.php'>
                                        <i class='fa  fa-briefcase'></i> <span>Trabajadores</span>
                                    </a>
                                </li>
                               ";
                       }
                    ?>
                    <!-- Fin Apartado solo para el administrador -->
                    </ul>
                    <!-- Fin del menu: : style can be found in sidebar.less -->
                </section>
            </aside>

            <!-- Caciones para cuando se pulza un boton  -->
                        <?php
                            // se inserta en la base de datos si preciona el boton insertar
                            if(isset($_POST["insertar_producto"])){

                                $v_query = "SELECT * FROM productos WHERE nombre='".$_POST["p_nombre"]."'";
                                $registros = mysqli_query($link,$v_query) or die("Problemas en el select:".mysql_error());

                                if($reg = mysqli_fetch_array($registros, MYSQLI_ASSOC)){
                                    $_mjerror_exist_articulo = "activo";
                                }else{

                                    $v_query = "INSERT INTO productos
                                    VALUES('','".$_POST["p_nombre"]."','".$_POST['p_descripcion']."','','".$_POST['p_presio']."')";

                                    $v_registro = mysqli_query($link,$v_query) or die("Problemas al insertar:".mysql_error());
                                    $_mjfull_ingresed_articulo = "activo";
                                }

                            }

                            // si se presiona un boton con el icono actualizar entra a esta condicion
                            // y ase una consulta y almasena los datos en variables para mostrarlas en las cajas de texto
                            if(isset($_GET['cliente_actualizar'])){
                                $v_query_actualizar_clientes = " SELECT * FROM cliente WHERE id_cliente = ".$_GET['cliente_actualizar'];
                                $v_query_actualizar_mf = mysqli_query($link,$v_query_actualizar_clientes) or die("Problemas:".mysql_error());

                                if($v_registro_mf = mysqli_fetch_array($v_query_actualizar_mf, MYSQLI_ASSOC)){
                                    $_SESSION['p_id_cliente']  =  $v_registro_mf['id_cliente'];
                                    $v_nombre                   =  $v_registro_mf['nombre'];
                                    $v_apellido_p              =  $v_registro_mf['apellido_p'];
                                    $v_apellido_m                    =  $v_registro_mf['apellido_m'];
                                    $v_estado             =  $v_registro_mf['estado'];
                                }
                            }

                            // Si se preciona el boton actualizar del emergente se actualiza el producto
                            if(isset($_POST["actualizar_product_start"])){
                                $v_query_actualizar_productos_start = "UPDATE productos SET
                                nombre='".$_POST['p_nombre']."',
                                descripcion='".$_POST['p_descripcion']."',
                                precio_venta=".$_POST['p_presio']."
                                WHERE id_producto= ".$_SESSION['p_id_producto']."";
                                $v_actualizar_producto_start = mysqli_query($link,$v_query_actualizar_productos_start) or die("Problemas:".mysql_error());
                                $_mjwarning_articulo_actualizado = "activo";
                            }




                            // si se presiona un boton con el icono eliminar entra a esta condicion
                            // y ase una consulta y almasena los datos en variables para tomar el id_productos y mandarla a una variable sesion
                            //para mostrarlos en el emergente
                            if(isset($_GET['producto_eliminar'])){
                                $v_query_eliminar_productos = "DELETE FROM productos WHERE id_producto=".$_GET['producto_eliminar'];
                                $v_query_eliminar_me = mysqli_query($link,$v_query_eliminar_productos) or die("Problemas:".mysql_error());
                                $_mjwarning_articulo_eliminado = "activo";
                            }

                        ?>






            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Bienvenido
                        <small> Sistema Ahuelik</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="sistema.php"><i class="fa fa-dashboard"></i> Inico</a></li>
                        <li class="active">clientes</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="panel panel-success">
                         <div class="panel-heading">control de clientes</div>
                         <div class="panel-body">
                           <div class="row">
                               <div class="col-xs-3">
                                <div class="input-group">
                                     <span class="input-group-addon glyphicon glyphicon-user" id="Fnombre"></span>
                                     <input type="text" class="form-control" placeholder="Nombre" aria-describedby="<basic->   </basic->addon1">
                                </div>
                               </div>
                               <div class="col-xs-3">
                                <div class="input-group">
                                     <span class="input-group-addon glyphicon glyphicon-asterisk" id="FapellidoP"></span>
                                     <input type="text" class="form-control" placeholder="Apellido Paterno" aria-describedby="<basic->   </basic->addon1">
                                </div>
                               </div>
                               <div class="col-xs-3">
                                <div class="input-group">
                                     <span class="input-group-addon glyphicon glyphicon-asterisk" id="FapellidoM"></span>
                                     <input type="text" class="form-control" placeholder="Apellido Materno" aria-describedby="<basic->   </basic->addon1">
                                </div>
                               </div>
                               <div class="col-xs-3">
                                <div class="input-group">
                                     <span class="input-group-addon glyphicon glyphicon-star-empty" id="Festado"></span>
                                     <input type="text" class="form-control" placeholder="Estado" aria-describedby="<basic->   </basic->addon1">
                                </div>
                               </div>
                           </div><br>
                           <div class="row">
                               <div class="col-xs-3">
                                <div class="input-group">
                                     <span class="input-group-addon glyphicon glyphicon-asterisk" id="Fciudad"></span>
                                     <input type="text" class="form-control" placeholder="Ciudad" aria-describedby="<basic->   </basic->addon1">
                                </div>
                               </div>
                               <div class="col-xs-3">
                                <div class="input-group">
                                     <span class="input-group-addon glyphicon glyphicon-asterisk" id="FcodigoP"></span>
                                     <input type="text" class="form-control" placeholder="Codigo Postal" aria-describedby="<basic->   </basic->addon1">
                                </div>
                               </div>
                               <div class="col-xs-3">
                                <div class="input-group">
                                     <span class="input-group-addon glyphicon glyphicon-asterisk" id="Fcolonia"></span>
                                     <input type="text" class="form-control" placeholder="Colonia" aria-describedby="<basic->   </basic->addon1">
                                </div>
                               </div>
                               <div class="col-xs-3">
                                <div class="input-group">
                                     <span class="input-group-addon glyphicon glyphicon-asterisk" id="Fcalle"></span>
                                     <input type="text" class="form-control" placeholder="Calle" aria-describedby="<basic->   </basic->addon1">
                                </div>
                               </div>
                           </div><br>

                           <div class="row">
                               <div class="col-xs-3">
                                <div class="input-group">
                                     <span class="input-group-addon glyphicon glyphicon-home" id="FnCasa"></span>
                                     <input type="text" class="form-control" placeholder="N° De Casa" aria-describedby="<basic->   </basic->addon1">
                                </div>
                               </div>
                               <div class="col-xs-3">
                                <div class="input-group">
                                     <span class="input-group-addon  glyphicon glyphicon-earphone" id="Ftelefono"></span>
                                     <input type="text" class="form-control" placeholder="Telefono" aria-describedby="<basic->   </basic->addon1">
                                </div>
                               </div>
                               <div class="col-xs-3">
                                <div class="input-group">
                                     <span class="input-group-addon glyphicon glyphicon-envelope" id="Femail"></span>
                                     <input type="text" class="form-control" placeholder="Ejem:  Ahelik@gmail.com" aria-describedby="<basic->   </basic->addon1">
                                </div>
                               </div>
                               <div class="col-xs-3">
                                <div class="input-group">
                                     <span class="input-group-addon glyphicon glyphicon-calendar" id="Ffecha"></span>
                                     <input type="text" class="form-control" placeholder="Fecha" aria-describedby="<basic->   </basic->addon1">
                                </div>
                               </div>
                           </div><br>
                        </div>
                    </div>

                    <div class="box">
                        <div class="box-header">
                            </br>
                            <h3 class="box-title">Tabla de Productos</h3>
                        </div>
                        <!-- /.box-header -->

                        <!-- Inicio celda de busqueda de tabla -->
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <!-- aqui puede ir algo como el que tediga cuantos registros mostrar -->
                            </div>
                            <div class="col-sm-6 col-md-6 text-right">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-6"></div>
                                        <div class="col-xs-6">
                                            <div class="input-group input-group-sm">
                                                <input id="searchTerm" type="text" onkeyup="doSearch()" placeholder="Buscar..." class="form-control" />
                                                <span class="input-group-btn">
                                                    <a class="btn btn-info btn-flat">Go!</a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Fin celda de busqueda de tabla -->

                        <div class="box-body table-responsive">
                            <table id="regTable" id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style='text-align:center'>Id</th>
                                        <th>Nombre</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>Estado</th>
                                        <th>Ciudad</th>
                                        <th>Cod. Postal</th>
                                        <th>Colonia</th>
                                        <th>Calle</th>
                                        <th>N° Casa</th>
                                        <th>Telefono</th>
                                        <th>Email</th>
                                        <th>Fecha</th>
                                        <th style="text-align:center"><samp class="fa fa-cogs"></samp> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $time = time();
                                        $v_query = "SELECT * FROM clientes";
                                        $registros = mysqli_query($link,$v_query) or die("Problemas en el select:".mysql_error());

                                        while($reg = mysqli_fetch_array($registros, MYSQLI_ASSOC)){
                                            echo"<tr>";
                                            echo    "<td style='text-align:center'>".$reg['id_cliente']."</td>";
                                            echo    "<td>".$reg['nombre']."</td>";
                                            echo    "<td>".$reg['apellido_p']."</td>";
                                            echo    "<td>".$reg['apellido_m']."</td>";
                                            echo    "<td>".$reg['estado']."</td>";
                                            echo    "<td>".$reg['ciudad']."</td>";
                                            echo    "<td>".$reg['codigo_postal']."</td>";
                                            echo    "<td>".$reg['colonia']."</td>";
                                            echo    "<td>".$reg['calle']."</td>";
                                            echo    "<td>".$reg['no_casa']."</td>";
                                            echo    "<td>".$reg['Telefono']."</td>";
                                            echo    "<td>".$reg['e_mail']."</td>";
                                            echo    "<td>".$reg['fecha']."</td>";
                                            echo    "<td style='text-align:center'>

<!-- Comienza el primer boton para eliminar -->

<a class='btn btn-danger' data-toggle='modal' data-target='#".$reg['id_cliente']."' data-whatever='@mdo'><i class='fa fa-times-circle' data-toggle='tooltip' data-placement='top' title='Eliminar'></i></a>
<div class='modal fade' id='".$reg['id_cliente']."' tabindex='-1' role='dialog' aria-labelledby='".$reg['id_cliente']."Label' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header text-left'>
        <h4 class='modal-title' id='".$reg['id_cliente']."Label'>Eliminación de un cliente</h4>
      </div>
      <div class='modal-body'>
          <div class='row'>
              <div class=' col-xs-5 col-md-5'>
                  <img style='max-width: 250px' src='img_pages/usuario_eliminar.png'alt='Responsive image' class='img-rounded'>
              </div>
              <div class=' col-xs-7 col-md-7'>
                  <ul class='timeline text-left'>
                        <!-- timeline time label -->
                        <li class='time-label'>
                        <li class='time-label'>
                            <span class='bg-red'>
                                ".date('d-m-Y',$time)."
                            </span>
                        </li>
                        <!-- /.timeline-label -->

                        <!-- timeline item -->
                        <li>
                            <!-- timeline icon -->
                            <i class='fa fa-envelope bg-red'></i>
                            <div class='timeline-item'>
                                <span class='time'><i class='fa fa-clock-o'></i></span>

                                <h3 class='timeline-header'><a>Cliente</a></h3>

                                <div class='timeline-body'>
                                Eliminaras el siguiente Cliente: </br>
                                Id Cliente: <code>".$reg['id_cliente']."</code> </br>
                                Nombre: ".$reg['nombre']." </br>
                                Apellidos: ".$reg['apellido_p']." ".$reg['apellido_m']." </br>
                                Telefono: ".$reg['Telefono']."</br>
                                e_mail: ".$reg['e_mail']."
                                </br>

                                </div>

                                <div class='timeline-footer'>
                                </div>
                            </div>
                        </li>
                        <!-- END timeline item -->
                    </ul>
              </div>
          </div>

      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>
        <a href='admin_productos.php?producto_eliminar=".$reg['id_cliente']."'  class='btn btn-danger'>Eliminar</a>
      </div>
    </div>
  </div>
</div>

<!-- Comienza el primer boton para actualizar -->

<a href='admin_productos.php?producto_actualizar=".$reg['id_cliente']."' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Actualizar'><i class='fa fa fa-pencil'></i></a>

                                                    </td>";
                                            echo"</tr>";
                                        }
                                    ?>

                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    <!-- FIN tabla de productos -->

                </section>

                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>