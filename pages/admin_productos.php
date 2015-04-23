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
        <!-- DATA TABLES -->
        <link href="../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
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
                                <li class='active'>
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
                        Productos
                        <small> Sistema Ahuelik</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="sistema.php"><i class="fa fa-dashboard"></i> Inico</a></li>
                        <li class="active">Productos</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                                
                    <!-- Inicia el contenido de la pagina para productos -->  
                
                    <!-- INICIAR Div Blanco ingresa productos -->
                    <div class="box box-primary">
                        <!-- Inicia titulo -->
                        <div class="box-header">
                            </br>
                            <h3 class="box-title">Ingresa tus productos!</h3>
                        </div>
                        <!-- FIN titulo -->
                    
                    
                    
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
                            if(isset($_GET['producto_actualizar'])){
                                $v_query_actualizar_productos = " SELECT * FROM productos WHERE id_producto = ".$_GET['producto_actualizar']; 
                                $v_query_actualizar_mf = mysqli_query($link,$v_query_actualizar_productos) or die("Problemas:".mysql_error());
                                                                
                                if($v_registro_mf = mysqli_fetch_array($v_query_actualizar_mf, MYSQLI_ASSOC)){
                                    $_SESSION['p_id_producto']  =  $v_registro_mf['id_producto'];
                                    $v_nombre                   =  $v_registro_mf['nombre'];
                                    $v_descripcion              =  $v_registro_mf['descripcion'];
                                    $v_stock                    =  $v_registro_mf['stock'];
                                    $v_precio_venta             =  $v_registro_mf['precio_venta'];
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
                        
                        
                        <!-- Inicia de celdas -->
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <!-- form start -->
                                <form action="admin_productos.php" method="post">
                                    <div class="box-body">
                                        
                                        <label>Nombre del producto *</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                            <input name="p_nombre" type="text" class="form-control" placeholder="Ejemplo: Grarrafon" value='<?php if(isset($_GET['producto_actualizar'])){ echo $v_nombre;}?>' required/>
                                        </div>
                                        <br/>

                                        <div class="form-group">
                                            <label>Descripciòn del producto</label>
                                            <textarea name="p_descripcion" class="form-control" rows="3" placeholder="Ingresa la descipción" maxlength="50"><?php if(isset($_GET['producto_actualizar'])){ echo $v_descripcion;}?></textarea>
                                        </div>

                                        <label>Stock</label>
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-star"></i></span>
                                                    <input name="p_stock" type="text" class="form-control" id="disabledTextInput" placeholder="0" value="<?php if(isset($_GET['producto_actualizar'])){ echo $v_stock;}?>" disabled/>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>

                                        <label>Precio de venta *</label>
                                        <div class="row">
                                            <div class="col-xs-5">
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input name="p_presio" type="text" class="form-control" maxlength="10" placeholder="Ejemplo: 20" value="<?php if(isset($_GET['producto_actualizar'])){ echo $v_precio_venta;}?>" onkeypress="return numeros(event)" required/>
                                                    <div class="input-group-addon">.00</div>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>

                                        <div class="box-footer">
                                            <button type="submit" name="insertar_producto" class="btn btn-success" value="1">Ingresar producto</button>
                                            <?php
                                                // Boton se activa si se pulsa el boton actualizar y manda los datos para
                                                // actualizarse por post el nombre del boton es actualizar_product_start
                                                if(isset($_GET['producto_actualizar'])){
                                                    $time = time();
                                                    echo "
                                                    <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#ActualizarModal' data-whatever='@mdo'>Actualizar</button>

                                                    <div class='modal fade' id='ActualizarModal' tabindex='-1' role='dialog' aria-labelledby='ActualizarModalLabel' aria-hidden='true'>
                                                      <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                          <div class='modal-header'>
                                                            <h4 class='modal-title' id='ActualizarModalLabel'>Actualización de productos</h4>
                                                          </div>
                                                          <div class='modal-body'>                   
                                                              <div class='row'>
                                                                  <div class=' col-xs-5 col-md-5'>
                                                                      <img style='max-width: 250px' src='img_pages/producto_actualizar.png'alt='Responsive image' class='img-rounded'>
                                                                  </div>
                                                                  <div class=' col-xs-7 col-md-7'>
                                                                      <ul class='timeline'>
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
                                                                                <i class='fa fa-envelope bg-blue'></i>
                                                                                <div class='timeline-item'>
                                                                                    <span class='time'><i class='fa fa-clock-o'></i></span>

                                                                                    <h3 class='timeline-header'><a>Producto</a></h3>

                                                                                    <div class='timeline-body'>
                                                                                    Actualizaras el siguiente producto: 
                                                                                    </br>
                                                                                    </br>
                                                                                        <code>".$v_nombre."</code>
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
                                                            <button name='actualizar_product_start' type='submit' class='btn btn-primary'>Actualizar</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    ";
                                                }
                                            ?>
         
                                            
                                        </div>

                                     </div>
                                </form>
                                <!-- form End -->
                            </div> 
                            
                            <div class="col-sm-6 col-md-6">
                                <div class="box-body">
                                    <div class="box-body">
                                    <div class="callout callout-info">
                                        <h4>Información!</h4>
                                        <p>En esta parte podras visualizar tus alertas.</p>
                                    </div>
                                    </div>
                                </div>
                                
                                </br> 
                                <?php 
                                    // Mensaje de alerta si se ingresa el producto correctamente
                                    if(!empty( $_mjfull_ingresed_articulo)){
                                        echo  "
                                            <div class='box-body'>
                                                <div class='box-body'>
                                                <div class='alert alert-success alert-dismissable'>
                                                    <i class='fa fa-check'></i>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <b>Correcto!</b> El producto se agregrego correctamente.
                                                </div>
                                                </div>
                                            </div>
                                        ";
                                    }

                                    // Mensaje de alerta el articulo ya existe
                                    if(!empty( $_mjerror_exist_articulo)){
                                        echo  " 
                                            <div class='box-body'>
                                                <div class='box-body'>
                                                <div class='alert  alert-danger alert-dismissable'>
                                                    <i class='fa fa-ban'></i>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <b>Alerta!</b> El producto ya existe, Porfavor ingrese un producto nuevo.
                                                </div>
                                                </div>
                                            </div>
                                        ";
                                    } 


                                    // Mensaje de alerta si se actualiza el producto correctamente
                                    if(!empty($_mjwarning_articulo_actualizado)){
                                        echo  "
                                            <div class='box-body'>
                                                <div class='box-body'>
                                                <div class='alert alert-success alert-dismissable'>
                                                    <i class='fa fa-check'></i>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <b>Correcto!</b> El producto a sido actualizado correctamente.
                                                </div>
                                                </div>
                                            </div>
                                        ";
                                    }

                                    // Mensaje de alerta si se a eliminado el producto correctamente
                                    if(!empty($_mjwarning_articulo_eliminado)){
                                        echo  "
                                            <div class='box-body'>
                                                <div class='box-body'>
                                                <div class='alert alert-success alert-dismissable'>
                                                    <i class='fa fa-check'></i>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <b>Correcto!</b> El producto a sido eliminado correctamente.
                                                </div>
                                                </div>
                                            </div>
                                        ";
                                    }
                                ?>
                          
                            
                            
                            </div>
                        </div>
                        <!-- Fin de celdas -->        
                    </div>
                    <!-- FIN Div Blanco ingresa productos -->
                    
                    
                
                
                
                
                    <!-- INICIO tabla de productos -->
                    <div class="box">
                        <div class="box-header">
                            </br>
                            <h3 class="box-title">Tabla de Productos</h3>                                    
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style='text-align:center'>Id</th>
                                        <th>Nombre</th>
                                        <th>Descripciòn</th>
                                        <th>Stock de producto</th>
                                        <th>Precio de venta</th>
                                        <th style="text-align:center"><samp class="fa fa-cogs"></samp> Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $time = time();
                                        $v_query = "SELECT * FROM productos";
                                        $registros = mysqli_query($link,$v_query) or die("Problemas en el select:".mysql_error());

                                        while($reg = mysqli_fetch_array($registros, MYSQLI_ASSOC)){
                                            echo"<tr>";
                                            echo    "<td style='text-align:center'>".$reg['id_producto']."</td>";
                                            echo    "<td>".$reg['nombre']."</td>";
                                            echo    "<td>".$reg['descripcion']."</td>";
                                            echo    "<td>".$reg['stock']."</td>";
                                            echo    "<td>"."$ ".$reg['precio_venta'].".00"."</td>";
                                            echo    "<td style='text-align:center'>
                                                        
<!-- Comienza el primer boton para eliminar -->

<a class='btn btn-danger' data-toggle='modal' data-target='#".$reg['id_producto']."' data-whatever='@mdo'><i class='fa fa-times-circle' data-toggle='tooltip' data-placement='top' title='Eliminar'></i></a>                           
<div class='modal fade' id='".$reg['id_producto']."' tabindex='-1' role='dialog' aria-labelledby='".$reg['id_producto']."Label' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header text-left'>
        <h4 class='modal-title' id='".$reg['id_producto']."Label'>Eliminación de producto</h4>
      </div>
      <div class='modal-body'>                   
          <div class='row'>
              <div class=' col-xs-5 col-md-5'>
                  <img style='max-width: 250px' src='img_pages/producto_eliminar.png'alt='Responsive image' class='img-rounded'>
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

                                <h3 class='timeline-header'><a>Producto</a></h3>

                                <div class='timeline-body'>
                                Eliminaras el siguiente producto: </br>
                                <code>".$reg['nombre']."</code> </br>
                                Stock: ".$reg['stock']." </br>
                                Precio de venta: $".$reg['precio_venta'].".00
                                </br>
                                </br>
                                    <!-- <code>producto</code> -->
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
        <a href='admin_productos.php?producto_eliminar=".$reg['id_producto']."'  class='btn btn-danger'>Eliminar</a>
      </div>
    </div>
  </div>
</div>

<!-- Comienza el primer boton para actualizar -->

<a href='admin_productos.php?producto_actualizar=".$reg['id_producto']."' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Actualizar'><i class='fa fa fa-pencil'></i></a>
                                                        
                                                    </td>";
                                            echo"</tr>";
                                        }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    <!-- FIN tabla de productos -->
            
            
            
                    
                                
                    
                    
                    
                    <!-- Fin el contenido de la pagina para productos -->
                    
                </section>
                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->        



        
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

        
         <!-- jQuery 2.0.2 -->
        <script src="../js/jquery.min.js"></script>
        <script src="../js/jquery.js"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>