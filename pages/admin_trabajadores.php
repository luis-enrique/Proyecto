
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
                        Trabajadores
                        <small> Sistema Ahuelik</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="sistema.php"><i class="fa fa-dashboard"></i> Inico</a></li>
                        <li class="active">Trabajadores</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    
                    <?php

                    // Si se preciona el boton ingresar trabajador se entra en esta condicion para insertar al trabajador
                    // si no existe lo inserta
                    if(isset($_POST['insert_trabajador'])){
                        
                        $v_query_comprovacio_trabajador = "SELECT * FROM trabajadores WHERE 
                                                           nombre='".$_POST["nombre"]."' AND 
                                                           apellido_p='".$_POST["ap_p"]."' AND 
                                                           apellido_M='".$_POST["ap_m"]."'";
                        
                        $registros_comparacion = mysqli_query($link,$v_query_comprovacio_trabajador) 
                                                 or die("Problemas comparacion:".mysql_error());
                        
                        
                        if($reg = mysqli_fetch_array($registros_comparacion, MYSQLI_ASSOC)){
                            
                            $_mjerror_exist_trabajador = "activo";
                            
                        }else{
                            $v_insert_trabajador = "INSERT INTO trabajadores VALUES (
                                               '',
                                               '".$_POST['nombre']."', '".$_POST['ap_p']."', '".$_POST['ap_m']."', 
                                               '".$_POST['categoria']."', 
                                               '".$_POST['estado']."', 
                                               '".$_POST['ciudad']."', 
                                               '".$_POST['cp']."', 
                                               '".$_POST['colonia']." ', 
                                               '".$_POST['calle']."', 
                                               '".$_POST['n_casa']."', 
                                               '".$_POST['tel']."', 
                                               '".$_POST['mail']."', 
                                               'CURDATE()'
                                               )";
                        
                            $v_query_insert_trabajador = mysqli_query($link,$v_insert_trabajador) 
                                                         or die ("Problemas insertar".mysql_errno());
                            
                            $_mjfull_insert_trabajador = "activo";
                            
                        }
                        
                    }  

                     // Si se preciona el boton actualizar del emergente entrara a esta condicion para actualizar
                     if(isset($_POST['trabajador_actualizar_start'])){
                         $v_update_trabajador = "UPDATE trabajadores SET 
                                                     nombre=            '".$_POST['nombre']."',
                                                     apellido_p=        '".$_POST['ap_p']."',
                                                     apellido_m=        '".$_POST['ap_m']."',
                                                     id_categoria=       ".$_POST['categoria'].",
                                                     estado=            '".$_POST['estado']."',
                                                     ciudad=            '".$_POST['ciudad']."',
                                                     codigo_postal=     '".$_POST['cp']."',
                                                     colonia=           '".$_POST['colonia']."',
                                                     calle=             '".$_POST['calle']."',
                                                     no_casa=           '".$_POST['n_casa']."',
                                                     Telefono=          '".$_POST['tel']."',
                                                     e_mail=            '".$_POST['mail']."'
                                                 WHERE id_trabajador=".$_SESSION['id_trabajador'];
                                                 
                         mysqli_query($link,$v_update_trabajador) or die("Problemas Actualizar:".mysql_error());
                         $_mjwarning_actualizado_trabajador = "activo";
                     }

                    // Si se preciona el boton eliminar del emergente entrara a esta condicion para eliminarlo
                    if(isset($_GET['trabajador_eliminar'])){
                        $v_delete_trabajador = "DELETE FROM trabajadores WHERE id_trabajador=".$_GET['trabajador_eliminar']; 
                        mysqli_query($link,$v_delete_trabajador) or die("Problemas eliminar:".mysql_error());
                        $_mjwarning_delete_trabajador = "activo";
                    }


                    // Consulta para mostrar en el combo box las categorias
                    $v_query_box = mysqli_query($link,"SELECT * FROM categorias") or die ("Problemas Consulta_categorias:".mysql_error());

                    // Consulta para mostrar los tabajadores en la tabla
                    $v_query_tabla_trabajadores = "SELECT tra.id_categoria,
                                                           tra.fecha, 
                                                           tra.id_trabajador, 
                                                           tra.nombre, tra.apellido_p, tra.apellido_m,
                                                           tra.estado, tra.ciudad, tra.codigo_postal, tra.colonia, tra.calle, tra.no_casa, 
                                                           tra.telefono, 
                                                           tra.e_mail,   
                                                           ct.puesto, 
                                                           ct.sueldo 
                                                    FROM trabajadores tra, categorias ct 
                                                    WHERE tra.id_categoria = ct.id_categoria ORDER BY tra.id_trabajador";

                    $v_query_trabajadores_table = mysqli_query($link, $v_query_tabla_trabajadores) or die ("Problemas
                    Consulta_categorias:".mysql_error());

                    ?>
                    
                     <div class="box box-primary">
                         <!-- Inicia titulo -->
                         <div class="box-header">
                             </br>
                             <h3 class="box-title">Ingresa a tus trabajadores!</h3>
                         </div>
                         <!-- FIN titulo -->                    
                         <div class="row">
                             <div class="col-sm-8 col-md-8">
                                <!-- INICIO del formulario para ingresar los trabajadores -->
                                 <form action="admin_trabajadores.php" method="post">
                                     <div class="box-body">
                                         <div class="row">
                                            <div class="col-xs-4">
                                                <label>Nombre del trabajador *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                                <input name="nombre" type="text" class="form-control" placeholder="Ejemplo: Juan" maxlength="20" value="<?php if(isset($_GET['trabajador_actualizar'])){echo $_GET['nombre'];} ?>" required/>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Apellido paterno *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                                <input name="ap_p" type="text" class="form-control" placeholder="Ejemplo: Morales"  maxlength="20" value="<?php if(isset($_GET['trabajador_actualizar'])){echo $_GET['apel_p'];} ?>" required/>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Apellido materno *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-font"></i></span>    
                                                <input name="ap_m" type="text" class="form-control" placeholder="Emplo: Gracia" maxlength="20" value="<?php if(isset($_GET['trabajador_actualizar'])){echo $_GET['apel_m'];} ?>" required/>
                                                </div>
                                            </div>
                                        </div>
                                        </br>
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Estado *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-globe"></i></span> 
                                                <input name="estado" type="text" class="form-control" placeholder="Emplo: Guerrero" maxlength="30" value="<?php if(isset($_GET['trabajador_actualizar'])){echo $_GET['estado'];} ?>" required/>
                                            </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Ciudad *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                                                <input name="ciudad" type="text" class="form-control" placeholder="Emplo: Cliapa de Àlvarez" maxlength="30" value="<?php if(isset($_GET['trabajador_actualizar'])){echo $_GET['ciudad'];} ?>" required/>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>CP: </label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span> 
                                                <input name="cp" type="text" class="form-control" placeholder="Emplo: 41100" maxlength="5" onkeypress="return numeros(event)" value="<?php if(isset($_GET['trabajador_actualizar'])){echo $_GET['cp'];} ?>" required/>
                                                </div>
                                            </div>
                                        </div>
                                     </br>
                                     <div class="row">
                                            <div class="col-xs-4">
                                                <label>Colonia *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                                                <input name="colonia" type="text" class="form-control" placeholder="Ejemplo: Los Pinos" maxlength="50" value="<?php if(isset($_GET['trabajador_actualizar'])){echo $_GET['colonia'];} ?>" required/>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Calle *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                                                <input name="calle" type="text" class="form-control" placeholder="Ejemplo: Emiliano Zapata"  maxlength="50" value="<?php if(isset($_GET['trabajador_actualizar'])){echo $_GET['calle'];} ?>" required/>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Nª casa *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>    
                                                <input name="n_casa" type="text" class="form-control" placeholder="Emplo: 231" maxlength="10" value="<?php if(isset($_GET['trabajador_actualizar'])){echo $_GET['n_casa'];} ?>" onkeypress="return numeros(event)">
                                                </div>
                                            </div>
                                        </div>
                                        </br>
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Email *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <input name="mail" type="email" class="form-control" placeholder="usuario@outlook.com" maxlength="50" value="<?php if(isset($_GET['trabajador_actualizar'])){echo $_GET['e_mail'];} ?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Telefono *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa  fa-phone"></i></span>
                                                <input name="tel" type="text" class="form-control" placeholder="Ejemplo: 7561187854"  maxlength="10" onkeypress="return numeros(event)" value="<?php if(isset($_GET['trabajador_actualizar'])){echo $_GET['telefono'];} ?>">
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <label>Puesto de trabajo * <a href="admin_categorias.php" data-toggle="tooltip" data-placement="top" title="Aqui podras editar los puestos de trabajo!">Editar puestos!</a></label>
                                                    <select name="categoria" class="form-control" required/>
                                                        <?php 
                                                            if(isset($_GET['trabajador_actualizar'])){
                                                                echo "<option value='".$_GET['trabajador_actualizar']."'>".$_GET['puesto']."</option>";
                                                            }else{
                                                                echo "<option></option>";
                                                            } 

                                                            while($reg_combobox = mysqli_fetch_array($v_query_box, MYSQLI_ASSOC)){
                                                                     echo "<option value='".$reg_combobox['id_categoria']."'>"
                                                                     .$reg_combobox['puesto'].
                                                                     "</option> </br>";
                                                            }

                                                        ?>
                                                    
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                </br>
                                <div class='box-footer'>
                                    <button name="insert_trabajador" type="submit" class="btn btn-success" value="1">Ingresar Trabajador</button>
                                    <?php
                                                // Boton se activa si se pulsa el boton actualizar y manda los datos para
                                                // actualizarse por post el nombre del boton es actualizar_product_start
                                                if(isset($_GET['trabajador_actualizar'])){
                                                    $_SESSION['id_trabajador'] = $_GET['trabajador_actualizar'];
                                                    $time = time();
                                                    echo "
                                                    <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#ActualizarModal' data-whatever='@mdo'>Actualizar</button>

                                                    <div class='modal fade' id='ActualizarModal' tabindex='-1' role='dialog' aria-labelledby='ActualizarModalLabel' aria-hidden='true'>
                                                      <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                          <div class='modal-header'>
                                                            <h4 class='modal-title' id='ActualizarModalLabel'>Actualizar trabajador</h4>
                                                          </div>
                                                          <div class='modal-body'>                   
                                                              <div class='row'>
                                                                  <div class=' col-sm-5 col-md-5'>
                                                                      <img style='max-width: 250px' src='img_pages/usuario_actualizar.png'alt='Responsive image' class='img-rounded'>
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

                                                                                    <h3 class='timeline-header'><a>Trabajador</a></h3>

                                                                                    <div class='timeline-body'>
                                                                                    Actualizar datos de: 
                                                                                    </br>
                                                                                    </br>
                                                                                    <!-- Datos mandados via GET semuestran a qui tambin -->
                                                                                    <code>".$_GET['nombre']." ".$_GET['apel_p']." ".$_GET['apel_m']."</code> </br>
                                                                                        Telefono: ".$_GET['telefono']." </br>
                                                                                        Puesto: ".$_GET['puesto']." </br>
                                                                                        Sueldo: $".$_GET['sueldo'].".00
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
                                                            <button name='trabajador_actualizar_start' type='submit' class='btn btn-primary'>Actualizar</button>
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
                                <!-- FIN del formulario para ingresar los trabajadores -->
                             </div>
                             <div class="col-sm-4 col-md-4">
                                 <div class="box-body">
                                    <div class="box-body">
                                    <div class="callout callout-info">
                                        <h4>Información!</h4>
                                        <p>En esta parte podras visualizar tus alertas.</p>
                                    </div>
                                    </div>
                                 </div>
                                 </br> 
                             <!-- INICIO de los mensajes de las alertas para las acciones del usuario -->
                                
                                <?php 
                                    // Mensaje de alerta si se inserta el trabajador
                                    if(!empty($_mjfull_insert_trabajador)){
                                        echo  "
                                            <div class='box-body'>
                                                <div class='box-body'>
                                                <div class='alert alert-success alert-dismissable'>
                                                    <i class='fa fa-check'></i>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <b>Trabajador ingresado!</b>
                                                </div>
                                                </div>
                                            </div>
                                        ";
                                    }

                                    // Mensaje de alerta el trabajador ya existe
                                    if(!empty($_mjerror_exist_trabajador)){
                                        echo  " 
                                            <div class='box-body'>
                                                <div class='box-body'>
                                                <div class='alert  alert-danger alert-dismissable'>
                                                    <i class='fa fa-ban'></i>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <b>El trabajador ya existe!</b>
                                                </div>
                                                </div>
                                            </div>
                                        ";
                                    } 

                                    // Mensaje de alerta si se actualiza el trabajador
                                    if(!empty($_mjwarning_actualizado_trabajador)){
                                        echo  "
                                            <div class='box-body'>
                                                <div class='box-body'>
                                                <div class='alert alert-success alert-dismissable'>
                                                    <i class='fa fa-check'></i>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <b>El rabajador a sido actualizado!</b>
                                                </div>
                                                </div>
                                            </div>
                                        ";
                                    }

                                    // Mensaje de alerta si se a eliminado el trabajador
                                    if(!empty($_mjwarning_delete_trabajador)){
                                        echo  "
                                            <div class='box-body'>
                                                <div class='box-body'>
                                                <div class='alert alert-success alert-dismissable'>
                                                    <i class='fa fa-check'></i>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <b>Trabajador Eliminado!</b>
                                                </div>
                                                </div>
                                            </div>
                                        ";
                                    }

                                ?>
                                
                                
    
                             <!-- FIN de los mensajes de las alertas para las acciones del usuario -->
                             </div>
                         </div>
                    </div>

                    <div class="box box-primary">
                        <div class="box-header">
                            </br>
                            <h3 class="box-title">Tabla de trabajadores</h3>
                        </div>
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
                        <div class="box-body">
                            <!-- INICIO contenido de la tabla de trabajadpres -->
                            <div class="box-body table-responsive">
                                <table id="regTable" id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style='text-align:center'>Id</th>
                                            <th>Nombre</th>
                                            <th>Dirección</th>
                                            <th>Telefono</th>
                                            <th>E-mail</th>
                                            <th>Puesto</th>
                                            <th>Sueldo</th>
                                            <th style="text-align:center"><samp class="fa fa-cogs"></samp> Opciones</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        while($reg_show_table = mysqli_fetch_array($v_query_trabajadores_table, MYSQLI_ASSOC)){
                                            $time = time();
                                            $v_name_trabajador = $reg_show_table['nombre']." ".
                                                                 $reg_show_table['apellido_p']." ".
                                                                 $reg_show_table['apellido_m'];
                                            echo "
                                            <tr>
                                                <td>".$reg_show_table['id_trabajador']."</td>
                                                
                                                <td>".$reg_show_table['nombre']." "
                                                     .$reg_show_table['apellido_p']." "
                                                     .$reg_show_table['apellido_m']
                                                ."</td>
                                                
                                                <td>"."Estado: ".$reg_show_table['estado']." </br> "
                                                     ."Ciudad: ".$reg_show_table['ciudad']." </br> "
                                                     ."CP: ".$reg_show_table['codigo_postal']." </br> "
                                                     ."Col. ".$reg_show_table['colonia']." </br> "
                                                     ."Clle: ".$reg_show_table['calle']." </br>" 
                                                     ."N°: ".$reg_show_table['no_casa']
                                                ."</td>
                                                
                                                <td>".$reg_show_table['telefono']."</td>
                                                <td>".$reg_show_table['e_mail']."</td>
                                                <td>".$reg_show_table['puesto']."</td>
                                                <td> $".$reg_show_table['sueldo'].".00 </td>
                                                <td style='text-align:center'>
<!-- Comienza el primer boton para eliminar -->

<a class='btn btn-danger' data-toggle='modal' data-target='#".$reg_show_table['id_trabajador']."' data-whatever='@mdo'><i class='fa fa-times-circle' data-toggle='tooltip' data-placement='top' title='Eliminar'></i></a> 

<div class='modal fade' id='".$reg_show_table['id_trabajador']."' tabindex='-1' role='dialog' aria-labelledby='".$reg_show_table['id_trabajador']."Label' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header text-left'>
        <h4 class='modal-title' id='".$reg_show_table['id_trabajador']."Label'>Eliminar trabajador</h4>
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

                                <h3 class='timeline-header'><a>Trabajador</a></h3>

                                <div class='timeline-body'>
                                </br>
                                <code>".$v_name_trabajador."</code> </br>
                                Telefono: ".$reg_show_table['telefono']." </br>
                                Puesto: ".$reg_show_table['puesto']." </br>
                                Sueldo: $".$reg_show_table['sueldo'].".00
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
        <a href='admin_trabajadores.php?trabajador_eliminar=".$reg_show_table['id_trabajador']."' class='btn btn-danger'>Eliminar</a>
      </div>
    </div>
  </div>
</div>

<!-- Comienza el primer boton para actualizar -->

<a href='admin_trabajadores.php?trabajador_actualizar=".$reg_show_table['id_trabajador']."&nombre=".$reg_show_table['nombre']."&apel_p=".$reg_show_table['apellido_p']."&apel_m=".$reg_show_table['apellido_m']."&estado=".$reg_show_table['estado']."&ciudad=".$reg_show_table['ciudad']."&cp=".$reg_show_table['codigo_postal']."&colonia=".$reg_show_table['colonia']."&calle=".$reg_show_table['calle']."&n_casa=".$reg_show_table['no_casa']."&telefono=".$reg_show_table['telefono']."&e_mail=".$reg_show_table['e_mail']."&sueldo=".$reg_show_table['sueldo']."&puesto=".$reg_show_table['puesto']."' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Actualizar'><i class='fa fa fa-pencil'></i></a> 
                                                
                                                </td>
                                            </tr>
                                            ";
                                        }
                                    ?>
                                </table>
                            </div>
                            <!-- FIN contenido de la tabla de trabajadpres -->
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