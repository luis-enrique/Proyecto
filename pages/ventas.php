
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

                        <li class="active">
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
                        <li>
                            <a href='lista_asitencia.php'>
                                <i class='fa fa-users'></i> <span>Pase de lista</span>
                            </a>
                        </li>
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
                    
                    
                    
                    <?php         

                        // Sise genera una venta se pone la variable sesion que muestra el totalde la venta en 0
                        if(isset($_POST['insert_venta'])){ 
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
                            }else{
                                $new_folio = "0000000001";
                            }
                            
                            echo $new_folio."</br>";
                            echo $_POST['id_cliente']."</br>";
                            echo $_SESSION['show_total']."</br>";
                            echo $_SESSION['id_usuario']."</br>";
                            
                            //inserta los datos en la tabla ventas
                            $v_query_venta_new = "INSERT INTO ventas VALUES ('',
                                                                            '".$new_folio."',		
                                                                            ".$_POST['id_cliente'].",
                                                                            ".$_SESSION['show_total'].",
                                                                            ".$_SESSION['id_usuario'].",
                                                                            'CURDATE()'
                                                                            )";
                            
                            mysqli_query($link,$v_query_venta_new) or die("Error insert new ven".mysql_error());
                            
                            //------------------------------------------------------------------------------
                            
                            //consulta el id relacionado a la venta
                            $v_query_id = "SELECT id_venta FROM ventas WHERE id_venta = (SELECT MAX(id_venta) FROM ventas)";        
                            $registro_id= mysqli_query($link,$v_query_id) or die("Error !!".mysql_error());

                            if($reg_id = mysqli_fetch_array($registro_id, MYSQLI_ASSOC)){
                                $id_por_venta = $reg_id['id_venta'];
                            }
                            
                            //------------------------------------------------------------------------------
                            $v_query_productos_temp = mysqli_query($link,"SELECT * FROM productos_venta_temp ORDER BY id_producto") or die("Error !!".mysql_error());
                            while($reg_insert_pro = mysqli_fetch_array($v_query_productos_temp, MYSQLI_ASSOC)){
                                
                                $v_query_pro_table_migra = "INSERT INTO productos_venta VALUES(
                                ".$id_por_venta.",
                                ".$reg_insert_pro['id_producto'].",
                                ".$reg_insert_pro['precio_unitario'].",
                                ".$reg_insert_pro['cantidad'].",
                                ".$reg_insert_pro['subtotal']."
                                )";        
                                
                                mysqli_query($link,$v_query_pro_table_migra) or die("Error !!".mysql_error());
                            }
                            
                            //----------------------------------------------------------------------------
                            // ELIMINA TODOS LOS DATO DE LA TABLA TEMPORAL PARA LISTA DE PRODUCTOS
                            mysqli_query($link,"DELETE FROM productos_venta_temp") or die("Error".mysql_error());
                                                        
                            
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
                        }else{
                            $new_folio = "0000000001";
                        }
                        //FIN consilta para generar el folio



                        // Si se agregan mas productos, la variable session que muestra el total de la venta,
                        // suma el total de los productos que se agragan al carrito o tabla de productos
                        if(isset($_GET['datos_producto'])){
                            
                            $comparacion_carrito = mysqli_query($link,"SELECT * FROM productos_venta_temp WHERE id_producto=".$_GET['id']) or die("Error consulta carrito") or die("Error consulta carrito".mysql_error());
                            
                            if($reg_comp = mysqli_fetch_array($comparacion_carrito, MYSQLI_ASSOC)){
                                // echo "el producto ya existe";
                                // variable para el mensaje de que ya existe el producto
                                $v_error_exist_producto = "Activo";
                            }else{
                                // echo "el producto no existe";   
                                $_id       = $_GET['id'];
                                $_nombre   = $_GET['nombre'];
                                $_precioun = $_GET['presio'];
                                $_cantidad = $_GET['cantidad'];
                                $_subtotal = ($_GET['presio'] * $_GET['cantidad']);  

                                $insert_carrito = "INSERT INTO productos_venta_temp VALUES
                                (".$_id.",'".$_nombre."',".$_precioun.",".$_cantidad.",".$_subtotal.")";


                                mysqli_query($link,$insert_carrito) or die("Error insert carrito".mysql_error());
                            }
                            
                            
                              
                        }


                        // Si se pica en el icono de actulizar se entra en esta condicion para que se acutalize la 
                        // cantidad del producto y actulize el subtotal

                        if(isset($_POST['btn_actualizar_producto'])){
                             $upsate_producto = "UPDATE productos_venta_temp SET 
                                                     cantidad =".$_POST['cantidad'].", 
                                                     subtotal=(precio_unitario * ".$_POST['cantidad'].") 
                                                 WHERE id_producto=".$_POST['id_producto'];
                            
                            mysqli_query($link,$upsate_producto) or die("Error actulizar carrito".mysql_error());      
                        }


                        //sise presiona le boton eliminar de los prodctos d ela lisat se entra qui a elimnarlo
                        if(isset($_POST['btn_eliminar'])){
                            $v_delete_p = "DELETE FROM productos_venta_temp WHERE id_producto=".$_POST['id_elimnar']; 
                            mysqli_query($link,$v_delete_p) or die("Problemas eliminar:".mysql_error());
                        }
                        

                        //consulta para mostrar los productos del carrito
                        $registro_carrito = mysqli_query($link,"SELECT * FROM productos_venta_temp ORDER BY id_producto") or die("Error consulta carrito".mysql_error());



                        //consulta pasa obtener el presio total de la venta
                        $total_venta =  mysqli_query($link,"SELECT SUM(subtotal) AS total FROM productos_venta_temp") or die("Error consulta total".mysql_error());
                        while($reg_total = mysqli_fetch_array($total_venta, MYSQLI_ASSOC)){
                            $_SESSION['show_total'] = $reg_total['total'];
                        }


                        // INICIO consilta para los clientes
                        $v_query_clientes = "SELECT id_cliente, CONCAT(nombre,' ',apellido_p,' ',apellido_m) AS nombre FROM clientes";
                        $v_clientes_combo = mysqli_query($link,$v_query_clientes) 
                        or die ("Problemas Consulta_trabajadores:".mysql_error());


                        // INICIO consilta para el los productos
                        $v_query_productos = "SELECT * FROM productos";
                        $v_productos_table = mysqli_query($link,$v_query_productos) or die ("Problemas Consulta_productos:".mysql_error());
                        


                    ?>
                    <?php
                    // Mensaje de alerta el producto ya se agrego ya existe
                                    if(!empty($v_error_exist_producto)){
                                        echo  " 
                                            <div class='box-body'>
                                                <div class='box-body'>
                                                <div class='alert  alert-danger alert-dismissable'>
                                                    <i class='fa fa-ban'></i>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <b>El producto ya esta garegado! actualiza la cantidad del producto</b>
                                                </div>
                                                </div>
                                            </div>
                                        ";
                                    }
                    ?>
                    
                    <div class="box box-primary">
                        </br>
                        <!-- Inicia titulo -->
                        <div class="box-header">
                            <div class="row">
                                <div class="col-sm-6 col-md-6">
                                    <h3 class="box-title">Realiza una venta!</h3>
                                </div>
                                <div class="col-xs-6">
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-xs-7"></div>
                                            <div class="col-xs-5">
                                            <div class="input-group">
                                                <div class="input-group-addon">Folio: </div>
                                                <input name="c_sueldo" type="text" class="form-control text-center" value="<?php echo $new_folio; ?>" disabled>
                                            </div>
                                            </div>
                                        </div>
                                   </div>
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
                                                    <input type="text" class="form-control" value="<?php echo  $_SESSION['nombre'];?>" disabled>       
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <!-- Tola para la venta-->
                                                <div class="total_venta">
                                                   <?php 
                                                        if($_SESSION['show_total']){
                                                            echo "$ ".$_SESSION['show_total'].".°°";
                                                        }else{
                                                            echo "$ 00.°°";
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
                                            <select name="id_cliente" class="form-control">
                                                <option value='0'></option>
                                                <?php 
                                                while($reg_trabajadores = mysqli_fetch_array($v_clientes_combo, MYSQLI_ASSOC)){
                                                    echo "<option  value='".$reg_trabajadores['id_cliente']."'>
                                                            ".$reg_trabajadores['nombre']."
                                                         </option>";
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
                                                    <?php
                                                    while($reg_carrito_table = mysqli_fetch_array($registro_carrito, MYSQLI_ASSOC)){
                                                    echo "
                                                    <tr>
                                                        <td>".$reg_carrito_table['nombre']."</td>
                                                        <td>".$reg_carrito_table['precio_unitario']."</td>
                                                        <td contenteditable='true'>".$reg_carrito_table['cantidad']."</td>
                                                        <td>".$reg_carrito_table['subtotal']."</td>
                                                        <td style='text-align:center'>
                                                        
<!-- Button trigger modal para el boton eliminar producto de la lista -->                                                       
<button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#elimina".$reg_carrito_table['id_producto']."'>
    <i class='glyphicon glyphicon-remove'></i>
</button>

<!-- Inicio Modal -->
<div class='modal fade' id='elimina".$reg_carrito_table['id_producto']."' tabindex='-1' role='dialog' aria-labelledby='elimina".$reg_carrito_table['id_producto']."Label' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <h4 class='modal-title' id='elimina".$reg_carrito_table['id_producto']."Label'>Eliminar</h4>
      </div>
      <form action='ventas.php' method='post'>
      <div class='modal-body'>
          <h4>Eliminaras el siguiente producto de la lista:</h4></br>
          <h4><code>".$reg_carrito_table['nombre']."</code></h4></br>
          <input name='id_elimnar' value='".$reg_carrito_table['id_producto']."' hidden='hidden'>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>
        <button name='btn_eliminar' type='submit' class='btn btn-danger'>Eliminar</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->

<!-- Button trigger modal para el boton actualizar producto de la lista -->                                                       
<button type='button' class='btn btn-primary btn-sm' data-toggle='modal' data-target='#actualiza".$reg_carrito_table['id_producto']."'>
    <i class='fa fa-pencil'></i>
</button>

<!-- Inicio Modal -->
<div class='modal fade' id='actualiza".$reg_carrito_table['id_producto']."' tabindex='-1' role='dialog' aria-labelledby='actualiza".$reg_carrito_table['id_producto']."Label' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <h4 class='modal-title' id='actualiza".$reg_carrito_table['id_producto']."Label'>Cambiar la cantidad del producto</h4>
      </div>
      <form action='ventas.php' method='post'>
      <div class='modal-body'>
          <h4>Cambiaras la cantidad del siguiente producto de la lista: </h4></br>
          <h4><code>".$reg_carrito_table['nombre']."</code></h4></br>
          <input name='id_producto' value='".$reg_carrito_table['id_producto']."' hidden='hidden'>
          <input name='cantidad'    value='".$reg_carrito_table['cantidad']."'>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>
        <button name='btn_actualizar_producto' type='submit' class='btn btn-primary'>Aceptar</button>
      </form>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->
                                                        </td>
                                                    </tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Termina tabla para el listado de productos -->
                                        
                                        </br>
                                        <div class='box-footer'>
                                            <button name="insert_venta" class="btn btn-success" type="submit">Realizar venta</button>
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
                                                <th>Precio unitario</th>
                                                <th style="text-align:center"><samp class="fa fa-cogs"></samp> Opciòn</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                while($reg_show_table = mysqli_fetch_array($v_productos_table, MYSQLI_ASSOC)){
                                                    echo "<tr>
                                                            <td>".$reg_show_table['nombre']."</td>
                                                            <td>".$reg_show_table['precio_venta']."</td>
                                                            <td style='text-align:center'>
                                                            
<!-- INICIA Button modal agregar productos -->

<a class='btn btn-success btn-sm' data-toggle='modal' data-target='#".$reg_show_table['id_producto']."'><samp class='glyphicon glyphicon-plus'></samp></a>

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