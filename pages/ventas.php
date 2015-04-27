
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
        <!-- My style -->
        <link href="../css/my_style.css" rel="stylesheet" type="text/css" />

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
                        <li class="active">ventas</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
<<<<<<< HEAD
                    
                    <?php              
                        // Sise genera una venta se pone la variable sesion que muestra el totalde la venta en 0
                        if(isset($_POST['insert_venta'])){
                            $_SESSION['show_total'] = 0;
                        }



                        // Si se agregan mas productos, la variable session que muestra el total de la venta, suma el total de los productos
                        // que se agragan al carrito o tabla de productos
                        if(isset($_GET['datos_producto'])){
                            
                            $_id       = $_GET['id'];
                            $_nombre   = $_GET['nombre'];
                            $_precioun = $_GET['presio'];
                            $_cantidad = $_GET['cantidad'];
                            $_subtotal = ($_GET['presio'] * $_GET['cantidad']);
                            
//                            $_SESSION['aray'][$_id ] = $_nombre ;
                            
                            
                            
                            $_array_porductos_venta[$_id] = array("id"=>$_id,"nombre"=>$_nombre, "preciouni"=>$_precioun, "cantidad"=>$_cantidad ,"subtotal"=>$_subtotal);
                            
                            
                            
                            var_dump($_array_porductos_venta );
                          
                           $_SESSION['show_total'] = ($_SESSION['show_total'] + ($_GET['presio'] * $_GET['cantidad']));  
                            
                        }

                        // INICIO consilta para generar el folio
                        $v_query_folio = "SELECT id_venta FROM ventas WHERE id_venta = (SELECT MAX(id_venta) FROM ventas)";
        
                        $registro_folio = mysqli_query($link,$v_query_folio) or die("Error consulta folio".mysql_error());

                        if($reg = mysqli_fetch_array($registro_folio, MYSQLI_ASSOC)){
                            
                            $_folio = $reg['id_venta']+1;
                            
                            if($_folio < 10){ //Si es menor a 10
                                $new_folio = "000000000".$_folio;
                            }else{
                                if($_folio>9 && $_folio<100){ //Si es menor a 100
                                    $new_folio = "00000000".$_folio;
                                }else{
                                    if($_folio>99 && $_folio<1000){ //Si es menor a 1000
                                        $new_folio = "0000000".$_folio;
                                    }else{
                                        if($_folio>999 && $_folio<10000){ //Si es menor a 10000
                                            $new_folio = "000000".$_folio;
                                        }else{
                                            if($_folio>9999 && $_folio<100000){ //Si es menor a 100000
                                                $new_folio = "00000".$_folio;
                                            }else{
                                                if($_folio>99999 && $_folio<1000000){ //Si es menor a 1000000
                                                    $new_folio = "0000".$_folio;
                                                }else{
                                                    if($_folio>999999 && $_folio<10000000){ //Si es menor a 10000000
                                                        $new_folio = "000".$_folio;
                                                    }else{
                                                        if($_folio>9999999 && $_folio<100000000){ //Si es menor a 100000000
                                                            $new_folio = "00".$_folio;
                                                        }else{
                                                            if($_folio>99999999 && $_folio<1000000000){ //Si es menor a 1000000000
                                                                $new_folio = "0".$_folio;
                                                            }else{
                                                                if($_folio>999999999 && $_folio<10000000000){ //Si es menor a 10000000000
                                                                    $new_folio = $_folio;
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        //FIN consilta para generar el folio

                        // INICIO consilta para el los productos
                        $v_query_trabajadores = "SELECT id_trabajador, CONCAT(nombre,' ',apellido_p,' ',apellido_m) AS nombre FROM trabajadores";
                        $v_trabajadores_combo = mysqli_query($link,$v_query_trabajadores) 
                        or die ("Problemas Consulta_trabajadores:".mysql_error());

                        // INICIO consilta para el los productos
                        $v_query_productos = "SELECT * FROM productos";
                        $v_productos_table = mysqli_query($link,$v_query_productos) or die ("Problemas Consulta_productos:".mysql_error());
                        


                    ?>
                    
                    <div class="box box-primary">
                        </br>
                        <!-- Inicia titulo -->
                        <div class="box-header">
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <h3 class="box-title">Realiza una venta!</h3>
=======
                         <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Realizar ventas</h3>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                <div class="box-body">
                                    <div class="input-group">
                                      <span class="glyphicon glyphicon-user input-group-addon"> Vendedor</span>
                                      <input type="text" class="form-control" placeholder="<?php echo $_SESSION['nombre']; ?>"disabled>
                                    </div><br>

                                    <?php
                                       $conexion= include("conexion.php");
                                        $query = 'SELECT * FROM clientes';
                                         $result = mysqli_query($link,$query) or die ("Problemas en el select:".mysql_error());
                                    ?>
                                    <select class="form-control">
                                        <option value=" <?php echo" " ?> " >
                                        <?php
                                        while ( $row = $result->fetch_array() )
                                        {
                                            ?>

                                            <option value=" <?php echo $row['id_cliente'] ?> " >
                                            <?php echo $row['nombre']." ".$row['apellido_p']." ".$row['apellido_m']; ?>
                                            </option>
                                            <?php
                                         }
                                        ?>
                                    </select><br>

>>>>>>> origin/master
                                </div>
                                </div><!-- primeros formularios izqierdos -->
                                <div class="col-xs-6">
                                    <div class="box-body">
<<<<<<< HEAD
                                        <div class="row">
                                            <div class="col-xs-7"></div>
                                            <div class="col-xs-5">
                                            <div class="input-group">
                                                <div class="input-group-addon">Folio: </div>
                                                <input name="c_sueldo" type="text" class="form-control text-center" value="<?php echo $new_folio; ?>" disabled>
                                            </div>
                                            </div>
=======
                                    <div class="input-group">
                                      <span class="glyphicon glyphicon-calendar input-group-addon"> Fecha</span>
                                      <input type="text" class="form-control" placeholder="<?php echo $fecha=strftime( "%Y-%m-%d", time() );?>"disabled>
                                </div><br>

                                <div class="input-group">
                                      <span class="glyphicon glyphicon-heart-empty input-group-addon"> Folio</span>
                                      <input type="text" class="form-control">
                                </div><br>

                                </div><!-- formularios derechos -->
                                </div>

                                <div class="col-xs-3">
                                    <h3>Agregar Productos</h3><br>
                                </div>
                                <script>
                                     var myModal;
                                     function modal()
                                     {
                                        myModal = window.open("ventas.php","ventas");
                                        myModal.focus();
                                     }

                                </script>
                                <div class="col-xs-3">
                                     <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-lg glyphicon glyphicon-remove-sign" data-toggle="modal" data-target="#myModal">

                                        </button><br>


                                        <!-- Modal -->
                                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                          <div class="modal-dialog">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Productos</h4>
                                              </div>
                                              <div class="modal-body">
                                                <!-- INICIO tabla de productos -->

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Tabla de Productos</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Descripciòn</th>
                                        <th>Stock</th>
                                        <th>Precio de venta</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $v_query = "SELECT * FROM productos";
                                        $registros = mysqli_query($link,$v_query) or die("Problemas en el select:".mysql_error());

                                        while($reg = mysqli_fetch_array($registros, MYSQLI_ASSOC)){
                                            echo"<tr>";
                                            echo    "<td>".$reg['id_producto']."</td>";
                                            echo    "<td>".$reg['nombre']."</td>";
                                            echo    "<td>".$reg['descripcion']."</td>";
                                            echo    "<td>".$reg['stock']."</td>";
                                            echo    "<td>"."$ ".$reg['precio_venta'].".00"."</td>";
                                            echo"</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    <!-- FIN tabla de productos -->
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-primary">Enviar</button>
                                              </div>
                                            </div>
                                          </div>
>>>>>>> origin/master
                                        </div>
                               </div>

                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                         <!-- Default panel contents -->
                                         <div class="panel-heading">Tabla de ventas</div>
                                         <div class="panel-body">
                                         </div>
                                         <!-- Table -->
                                         <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre</th>
                                                        <th>Precio</th>
                                                        <th>Cantidad</th>
                                                        <th>Sub Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Mark</td>
                                                        <td>Otto</td>
                                                        <td>@mdo</td>
                                                    </tr>
                                                <tr>
                                                <tr>
                                                </tbody>
                                         </table>
                                        </div><br>
                                </div>
<<<<<<< HEAD
                            </div>
                        </div>
                        <!-- FIN titulo -->
                        <div class="row">
                            <div class="col-sm-7 col-md-7">
                                <!-- Inicio de formulario -->
                                <div class="box-body">
                                    <form class="form-group" action="ventas.php" method="post">
                                        
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Vendedor</div>
                                                    <input name="c_sueldo" type="text" class="form-control" value="<?php echo  $_SESSION['nombre'];?>" disabled>       
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <!-- Tola para la venta-->
                                                <div class="total_venta">
                                                   <?php 
                                                        if(isset($_GET['datos_producto'])){
                                                            echo "$".$_SESSION['show_total'].".°°";
                                                        }else{
                                                            echo"$ 000.00";
                                                        }
                                                    ?>
                                                </div>
                                                <!-- Fin para la venta-->
                                            </div>
                                        </div>
                                        </br>
                                        <div class="form-group">
                                            <label>Seleciona un cliente</label>
                                            </br>
                                            <select name="usuario" class="form-control">
                                                <option></option>
                                                <?php 
                                                while($reg_trabajadores = mysqli_fetch_array($v_trabajadores_combo, MYSQLI_ASSOC)){
                                                    echo "<option value='".$reg_trabajadores['id_trabajador']."'>".$reg_trabajadores['nombre']."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        </br>
                                        <!-- Comienza tabla para el listado de productos -->
                                        <div class="box-body table-responsive">
                                            <table id="example2" class="table table-bordered table-hover" style="">
                                                <thead>
                                                    <tr>
                                                        <th>Nombre de producto</th>
                                                        <th>Precio U</th>
                                                        <th>Cantidad</th>
                                                        <th>Subtotal</th>
                                                        <th style="text-align:center"><samp class="fa fa-cogs"></samp> Opciòn</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>agua</td>
                                                        <td>5</td>
                                                        <td>2</td>
                                                        <td>10</td>
                                                        <td>Eliminar</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Termina tabla para el listado de productos -->
                                        
                                        </br>
                                        <div class='box-footer'>
                                            <button name="insert_venta" class="btn btn-success" type="submit">Realizar venta</button>
                                            <?php 
                                                if(isset($_GET['datos_producto'])){
                                                    echo $_GET['id']."-".$_GET['nombre']."-".$_GET['presio']."-".$_GET['cantidad']."</br>";
                                                    $_SESSION['show_total'] = ($_GET['cantidad'] * $_GET['presio']);
                                                    echo $_SESSION['show_total'];
                                                }
                                            ?>
                                        </div>
            
                                    </form>
                                </div>
                                <!-- Fin de formulario -->
    
                            </div>
                            <div class="col-sm-5 col-md-5">
                                <!-- Inicia boton de busqueda de productos -->
                                <div class="box-body">
                                    <div class="row text-right">
                                        <div class="col-xs-6"></div>
                                        <div class="col-xs-6">
                                        <div class="input-group input-group-sm">
                                            <input id="searchTerm" type="text" onkeyup="doSearch()" placeholder="Buscar producto..." class="form-control" />
                                            <span class="input-group-btn">
                                                <a class="btn btn-info btn-flat">Go!</a>
                                            </span>
                                        </div>
                                        </div>
                                    </div>
=======

                                  <div class="col-md-6 ">
                                    <button type="button" class="btn btn-primary btn-lg btn-block">Realizar Venta</button>
                                    </div><br>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                             <label for="ejemplo_email_3" class="col-lg-2 control-label">Total</label>
                                             <div class="col-lg-10">
                                               <input type="email" class="form-control" id="ejemplo_email_3"
                                                      placeholder="Email">
                                             </div><br>
                                         </div>
                                    </div>

>>>>>>> origin/master
                                </div>
                                <!-- Termina boton de busqueda de productos -->
                                
                                
                                <!-- Comienza tabla de productos -->
                                <div class="col-sm-6">
                                <label style=""><samp class="glyphicon glyphicon-chevron-left"></samp> Agrega productos<samp class="glyphicon glyphicon-chevron-right"></samp></label>
                                </div>
                                <div class="box-body table-responsive">
                                    <table id="regTable" id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Nombre de producto</th>
                                                <th>Precio U</th>
                                                <th>Stock</th>
                                                <th style="text-align:center"><samp class="fa fa-cogs"></samp> Opciòn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($reg_show_table = mysqli_fetch_array($v_productos_table, MYSQLI_ASSOC)){
                                                    echo "<tr>
                                                            <td>".$reg_show_table['nombre']."</td>
                                                            <td>".$reg_show_table['precio_venta']."</td>
                                                            <td>".$reg_show_table['stock']."</td>
                                                            <td style='text-align:center'>
                                                            
<!-- INICIA Button modal agregar productos -->

<a class='btn btn-success btn-sm' data-toggle='modal' data-target='#".$reg_show_table['id_producto']."'>
  <samp class='glyphicon glyphicon-plus'></samp>
</a>

<!-- Modal -->
<div class='modal fade' id='".$reg_show_table['id_producto']."' tabindex='-1' role='dialog' aria-labelledby='".$reg_show_table['id_producto']."Label' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <h4 class='modal-title' id='".$reg_show_table['id_producto']."Label'>Agregar Producto</h4>
      </div>
      <div class='modal-body'>
          
          
          <div class='row'>
              <div class='col-sm-5'>
                  <img src='img_pages/realizar_venta.png' class='img-responsive img-rounded' alt='Responsive image'>
              </div>
              <div class='col-sm-7 text-left'>
                  <form action='ventas.php' method='get'>
                  <input name='id' type='text' value='".$reg_show_table['id_producto']."' hidden='hidden'>
                  <input name='nombre' type='text' value='".$reg_show_table['nombre']."' hidden='hidden'>
                  <input name='presio' type='text' value='".$reg_show_table['precio_venta']."' hidden='hidden'>
                  <a><h3>Producto: ".$reg_show_table['nombre']."</h3></a>
                  </br>
                  <label>Precio unitario: $".$reg_show_table['precio_venta'].".00</label>
                  </br>
                  <label>Cantidad *</label>
                  <div class='input-group'>
                      <span class='input-group-addon'><i class='glyphicon glyphicon-star'></i></span>
                      <input name='cantidad' type='text' class='form-control' onkeypress='return numeros(event)' required>
                  </div>
                  </br>
              </div>
          </div>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>
        <button name='datos_producto' type='submit' class='btn btn-success'>Agregar</button>
                 </form>
      </div>
    </div>
  </div>
</div>

<!-- FIN Button modal agregar productos -->   
                                                            
                                                            </td>
                                                         </tr>";
                                                }
                                            ?>
                                        </tbody>  
                                    </table>
                                </div>
                                 <!-- Termina tabla de productos -->
                                ---------------------------------
                            </div>
                         </div>
                     </div>
                </section>
                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- Escrip que multiplica codigo de html " -->
        <!--
        <form id="multiplicar">
          <input type="text" id="multiplicando" value=0 onKeyUp="multiplicar(this);"> X
          <input type="text" id="multiplicador" value=0 onKeyUp="multiplicar(this);"> =
          <input type="text" id="resultado">
        </form>
        -->
        <script type="text/javascript">
            function multiplicar(){
                m1 = document.getElementById("multiplicando").value;
                m2 = document.getElementById("multiplicador").value;
                r = m1*m2;
                document.getElementById("resultado").value = r;
            }
        </script>


        <!-- Escrip solo deja insertar numeros en un imput de un formulario sele agrega: onkeypress="return numeros(event)" -->
        <script>
            function numeros(e){
                key = e.keyCode || e.which;
                tecla = String.fromCharCode(key).toLowerCase();
                letras = " 0123456789";
                especiales = [8,37,39,46];
                tecla_especial = false
                for(var i in especiales){
                    if(key == especiales[i]){
                        tecla_especial = true;
                        break;
                    } 
                }

                if(letras.indexOf(tecla)==-1 && !tecla_especial){
                    return false;
                }
            }
        </script>


        <!-- script para aser filtro de busqueda-->
        <script language="javascript">
            function doSearch() {
                var tableReg = document.getElementById('regTable');
                var searchText = document.getElementById('searchTerm').value.toLowerCase();
                for (var i = 1; i < tableReg.rows.length; i++) {
                    var cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
                    var found = false;
                    for (var j = 0; j < cellsOfRow.length && !found; j++) {
                        var compareWith = cellsOfRow[j].innerHTML.toLowerCase();
                        if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
                            found = true;
                        }
                    }
                    if (found) {
                        tableReg.rows[i].style.display = '';
                    } else {
                        tableReg.rows[i].style.display = 'none';
                    }
                }
            }
        </script>


        <!-- jQuery 2.0.2 -->
        <script src="../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>