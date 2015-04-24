
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

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Categorias
                        <small> Sistema Ahuelik</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="sistema.php"><i class="fa fa-dashboard"></i> Inico</a></li>
                        <li class="active">Categorias</li>
                    </ol>
                </section>

                <!-- Main content -->
                <?php
                    // Si se preciona el boton ingresar puesto se entra en esta condicion para insertar el puesto
                    // si no existe lo inserta
                    if(isset($_POST['insert_categoria'])){
                        
                        $v_query_comprovacion_categoria = "SELECT * FROM categorias WHERE puesto='".$_POST['c_puesto']."'";
                        $registros_comparacion = mysqli_query($link,$v_query_comprovacion_categoria) or die("Problemas insertar".mysql_error);
                        
                        if($reg = mysqli_fetch_array($registros_comparacion, MYSQLI_ASSOC)){
                            
                            $_mjerror_exist_categoria = "activo";
                            
                        }else{
                            mysqli_query($link,"INSERT INTO categorias VALUES('','".$_POST['c_puesto']."',".$_POST['c_sueldo'].")")
                            or die("Problemas insertar".mysql_error);
                            $_mjfull_insert_categoria = "activo";
                        }     
                    }


                     // Si se preciona el boton actualizar del emergente entrara a esta condicion para actualizar
                     if(isset($_POST['actualizar_categoria_start'])){
                         $v_update_categoria = "UPDATE categorias SET 
                                                                  puesto='".$_POST['c_puesto']."', 
                                                                  sueldo='".$_POST['c_sueldo']."'
                                                 WHERE id_categoria = ".$_SESSION['id_categoria'];
                                                 
                         mysqli_query($link,$v_update_categoria) or die("Problemas Actualizar:".mysql_error());
                         
                         $_mjwarning_actualizado_categoria = "activo";
                             
                     }


                    //Si se preiona el boton el eliminar del formulario emergente se entra en esta condicion para eliminar la categoria
                    if(isset($_GET['eliminar_categoria'])){
                        $v_delete_categoria = "DELETE FROM categorias WHERE id_categoria=".$_GET['id_categoria'];
                        mysqli_query($link,$v_delete_categoria)or die("Error Eliminar".mysql_error);
                        $_mjwarning_delete_puesto = "activo";
                    }


                    // Consulta para la tabla de categorias
                    $v_query_table_categorias = mysqli_query($link,"SELECT * FROM categorias") or die("Error Consulta categorias".mysql_error());

                ?>
                
                <section class="content">
                    <div class="box box-primary">
                        </br>
                        <!-- Inicia titulo -->
                        <div class="box-header">
                            <h3 class="box-title">Ingresa tus puestos de trabajo y sueldos!</h3>
                        </div>
                        <!-- FIN titulo -->
                        
                            <div class="row">
                                <div class="col-sm-7 col-md-7">
                                    <!-- Inicio de formulario -->
                                    <div class="box-body">
                                    <form class="form-inline" action="admin_categorias.php" method="post">
                                        <div class="row">
                                            <div class="col-xs-6 col-sm-6">
                                                <label>Puesto de trabajador *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                                <input name="c_puesto" type="text" class="form-control" placeholder="Ejemplo: Administrador" value="<?php if(isset($_GET['actualizar_categoria'])){echo $_GET['puesto'];}?>" maxlength="50" required/>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-6">
                                                <label>Sueldo quincenal *</label>
                                                <div class="input-group">
                                                    <div class="input-group-addon">$</div>
                                                    <input name="c_sueldo" type="text" class="form-control" maxlength="10" placeholder="Ejemplo: 20" value="<?php if(isset($_GET['actualizar_categoria'])){echo $_GET['sueldo'];}?>" onkeypress="return numeros(event)" required/>
                                                    <div class="input-group-addon">.00</div>
                                                </div>
                                            </div>
                                        </div>
                                        </br>
                                        <div class='box-footer'>
                                            <button name="insert_categoria" type="submit" class="btn btn-success" value="1">Ingresar puesto</button>
                                            <?php
                                                // Boton se activa si se pulsa el boton actualizar y manda los datos para
                                                // actualizarse por post el nombre del boton es actualizar_categoria_start
                                                if(isset($_GET['actualizar_categoria'])){
                                                    $_SESSION['id_categoria'] = $_GET['id_categoria'];
                                                    $time = time();
                                                    echo "
                                                    <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#ActualizarModal' data-whatever='@mdo'>Actualizar</button>

                                                    <div class='modal fade' id='ActualizarModal' tabindex='-1' role='dialog' aria-labelledby='ActualizarModalLabel' aria-hidden='true'>
                                                      <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                          <div class='modal-header'>
                                                            <h4 class='modal-title' id='ActualizarModalLabel'>Actualizar puesto</h4>
                                                          </div>
                                                          <div class='modal-body'>                   
                                                              <div class='row'>
                                                                  <div class=' col-sm-5 col-md-5'>
                                                                      <img style='max-width: 250px' src='img_pages/puesto_actualizar.png'alt='Responsive image' class='img-rounded'>
                                                                  </div>
                                                                  <div class=' col-sm-7 col-md-7'>
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

                                                                                    <h3 class='timeline-header'><a>Puesto</a></h3>

                                                                                    <div class='timeline-body'>
                                                                                    </br>
                                                                                    <!-- Datos mandados via GET semuestran a qui tambin -->
                                                                                    <code>".$_GET['puesto']."</code> </br>
                                                                                    Sueldo: $".$_GET['sueldo'].".00 </br>
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
                                                            <button name='actualizar_categoria_start' type='submit' class='btn btn-primary'>Actualizar</button>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    ";
                                                }
                                            ?>
                                        </div>
                                    </form>
                                    </div>
                                    <!-- Fim de formulario -->
                                    
                                    <!-- Inicio de tabla de categorias o puestos -->
                                    <div class="box-header">
                                        <h3 class="box-title">Tabla de categorias</h3>
                                    </div>
                                    <!-- Inicio celda de busqueda de tabla -->
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <!-- aqui puede ir algo como el que tediga cuantos registros mostrar -->
                                        </div>
                                        <div class="col-sm-6 col-md-6 text-right">
                                            <div class="box-body">
                                                <div class="row">
                                                    <div class="col-xs-3"></div>
                                                    <div class="col-xs-9">
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
                                                    <th>Puesto de tabjador</th>
                                                    <th>Sueldo quincenal</th>
                                                    <th style="text-align:center"><samp class="fa fa-cogs"></samp> Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    $time = time();
                                                    while($v_show_categorias = mysqli_fetch_array($v_query_table_categorias,MYSQL_ASSOC)){
                                                        echo" 
                                                            <tr>
                                                                <th style='text-align:center'>".$v_show_categorias['id_categoria']."</th>
                                                                <th>".$v_show_categorias['puesto']."</th>
                                                                <th>$".$v_show_categorias['sueldo'].".00</th>
                                                                <th style='text-align:center'>
                                                                
<!-- Comienza el primer boton para eliminar -->

<a class='btn btn-danger' data-toggle='modal' data-target='#".$v_show_categorias['id_categoria']."' data-whatever='@mdo'><i class='fa fa-times-circle' data-toggle='tooltip' data-placement='top' title='Eliminar'></i></a> 

<div class='modal fade' id='".$v_show_categorias['id_categoria']."' tabindex='-1' role='dialog' aria-labelledby='".$v_show_categorias['id_categoria']."Label' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header text-left'>
        <h4 class='modal-title' id='".$v_show_categorias['id_categoria']."Label'>Eliminar puesto</h4>
      </div>
      <div class='modal-body'>                   
          <div class='row'>
              <div class=' col-xs-5 col-md-5'>
                  <img style='max-width: 250px' src='img_pages/puesto_eliminar.png'alt='Responsive image' class='img-rounded'>
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

                                <h3 class='timeline-header'><a>Puesto</a></h3>

                                <div class='timeline-body'>
                                </br>
                                <code>".$v_show_categorias['puesto']."</code> </br>
                                Sueldo: $".$v_show_categorias['sueldo'].".00 </br>
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
        <a href='admin_categorias.php?eliminar_categoria=activo&id_categoria=".$v_show_categorias['id_categoria']."' class='btn btn-danger'>Eliminar</a>
      </div>
    </div>
  </div>
</div>

<!-- Comienza el primer boton para actualizar -->

<a href='admin_categorias.php?actualizar_categoria=activo&id_categoria=".$v_show_categorias['id_categoria']."&puesto=".$v_show_categorias['puesto']."&sueldo=".$v_show_categorias['sueldo']."' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Actualizar'><i class='fa fa fa-pencil'></i></a>
                                                                
                                                                
                                                                </th>
                                                            </tr>";
                                                    }
                                                ?> 
                                            </tbody>
                                        </table>
                                        </br>
                                        </br>
                                    </div>
                                    <!-- Inicio de tabla de categorias o puestos -->
                                
                                </div>
                                <div class="col-sm-5 col-md-5">
                                    <div class="box-body">
                                    <!--Inicio de los mensajes de alerta -->
                                    <a href="admin_trabajadores.php" data-toggle="tooltip" data-placement="top" title="Volver al apartado de trabajadores!"><samp class="fa fa-mail-reply"></samp> Volver</a>
                                    <!--Inicio de los mensajes de alerta -->
                                    <div class="box-body">
                                        <div class="callout callout-info">
                                            <h4>Información!</h4>
                                            <p>En esta parte podras visualizar tus alertas.</p>
                                        </div>
                                        
                                        <?php 
                                            // Mensaje de alerta si se inserta el trabajador
                                            if(!empty($_mjfull_insert_categoria)){
                                                echo  "
                                                    <div class='box-body'>
                                                        <div class='box-body'>
                                                        <div class='alert alert-success alert-dismissable'>
                                                            <i class='fa fa-check'></i>
                                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                            <b>Puesto ingresado!</b>
                                                        </div>
                                                        </div>
                                                    </div>
                                                ";
                                            }

                                            // Mensaje de alerta el puesto ya existe
                                            if(!empty($_mjerror_exist_categoria)){
                                                echo  " 
                                                    <div class='box-body'>
                                                        <div class='box-body'>
                                                        <div class='alert  alert-danger alert-dismissable'>
                                                            <i class='fa fa-ban'></i>
                                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                            <b>El puesto ya existe!</b>
                                                        </div>
                                                        </div>
                                                    </div>
                                                ";
                                            } 

                                            // Mensaje de alerta si se actualiza la categoria
                                            if(!empty($_mjwarning_actualizado_categoria)){
                                                echo  "
                                                    <div class='box-body'>
                                                        <div class='box-body'>
                                                        <div class='alert alert-success alert-dismissable'>
                                                            <i class='fa fa-check'></i>
                                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                            <b>Categoria actualizada!</b>
                                                        </div>
                                                        </div>
                                                    </div>
                                                ";
                                            }


                                            // Mensaje de alerta si se a eliminado la categoria o el puesto
                                            if(!empty($_mjwarning_delete_puesto)){
                                                echo  "
                                                    <div class='box-body'>
                                                        <div class='box-body'>
                                                        <div class='alert alert-success alert-dismissable'>
                                                            <i class='fa fa-check'></i>
                                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                            <b>Puesto Eliminado!</b>
                                                        </div>
                                                        </div>
                                                    </div>
                                                ";
                                            }

                                        ?>

                                        
                                    </div>
                                    <!-- Fin de los mensajes de alerta  -->
                                    </div>
                                </div>
                            </div>
                            
                        
                    
                    </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
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
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>