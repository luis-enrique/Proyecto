
<?php
    session_start ();
    $_insession = "activo";

    if($_SESSION['session'] == $_insession){
        if($_SESSION['privilegios'] == "Todos"){
            // Eres un administrador
        }else{
            header('Location: index.php');
        }
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
                                <li class='active'>
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
                        <li>
                            <a href='lista_asitencia.php'>
                                <i class='fa fa-users'></i> <span>Pase de lista</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Fin del menu: : style can be found in sidebar.less -->
                </section>
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Usuarios
                        <small> Sistema Ahuelik</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="sistema.php"><i class="fa fa-dashboard"></i> Inico</a></li>
                        <li class="active">Usuarios</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    

<?php

    // Si se preciona el boton ingresar usuario se entra en esta condicion para insertar al usuario
    // si las contrañas coinciden lo inserta y si no existe tambin lo inserta
    if(isset($_POST['insert_usuario'])){

        $v_query_comprovacion_usuario = "SELECT * FROM usuarios WHERE id_trabajador ='".$_POST['id_trabajador']."'";

        $_registro_comparacion = mysqli_query($link,$v_query_comprovacion_usuario) 
                                 or die("Problemas comparacion:".mysql_error());

        // Si ya exite un usuario con ese nombre manda un error sino entrea a 
        // comparar si sus contraseñas son correcatas
        if($reg = mysqli_fetch_array($_registro_comparacion, MYSQLI_ASSOC)){
            $_mjerror_exist_usuario = "activo";
        }else{
            // Si las contraseñas son correctas inserta 
            if($_POST['contrasena'] == $_POST['confirmar_contrasena']){

                $rutaEnServidor='imagenes';
                $rutaTemporal = $_FILES['imagen']['tmp_name'];
                $nombreImagen = $_FILES['imagen']['name'];
                $rutaDestino = $rutaEnServidor.'/'.$nombreImagen;
                move_uploaded_file($rutaTemporal, $rutaDestino);

                $v_insert_usuario = "INSERT INTO usuarios VALUES('',".$_POST['id_trabajador'].",'".$_POST['nombre_usuario']."','".$_POST['contrasena']."',".$_POST['tipo_usuario'].",'".$rutaDestino."',CURDATE())"; 

                mysqli_query($link,$v_insert_usuario) or die("Problemas comparacion:".mysql_error());  
                $_mjfull_insert_usuario = "activo";

            }else{
                $_mjerror_pass_error = "activo";
            }
        }

    }

    // // SI se pica el boton actualizar se entra en esta condicion para actualizar el usuario el usuario
    if(isset($_POST['usuario_actualizar_start'])){

        if($_POST['contrasena'] == $_POST['confirmar_contrasena']){

            $rutaEnServidor='imagenes';
            $rutaTemporal = $_FILES['imagen']['tmp_name'];
            $nombreImagen = $_FILES['imagen']['name'];
            $rutaDestino = $rutaEnServidor.'/'.$nombreImagen;
            move_uploaded_file($rutaTemporal, $rutaDestino);

            $v_update_trabajador = "UPDATE usuarios SET id_trabajador = ".$_POST['id_trabajadortext'].",
                                                    usuario = '".$_POST['nombre_usuario']."', 
                                                    contrasena = '".$_POST['contrasena']."', 
                                                    id_tipo_usuario = ".$_POST['tipo_usuario'].", 
                                                    foto_perfil = '".$rutaDestino."'
                                                    WHERE id_usuario =".$_SESSION['id_usuario'];

             mysqli_query($link,$v_update_trabajador) or die("Problemas en la actualizacion:".mysql_error());  
             $_mjwarning_actualizado_usuario = "activo";

        }else{
            $_mjerror_pass_error = "activo";
        }
    }



    // SI se pica el boton eliminar se entra en esta condicion para eliminar el usuario
    if(isset($_GET['usuario_eliminar'])){
        $v_delete_usuario = "DELETE FROM usuarios WHERE id_usuario=".$_GET['id_usuario']; 
        mysqli_query($link,$v_delete_usuario) or die("Problemas eliminar:".mysql_error());
        $_mjwarning_delete_usuario = "activo";
    }


    // Consulta para mostrar en el combo box las categorias
    $v_query_trabajadores_box = mysqli_query($link,"SELECT id_trabajador, CONCAT(nombre,' ',apellido_p,' ',apellido_m) AS nombre FROM trabajadores") or die ("Problemas Consulta_trabajadores".mysql_error());

    // Consulta para obtener los usuarios y los datos del trabajador
    $v_query_usuarios_table =  "SELECT 

                                  u.id_usuario,

                                    t.id_trabajador, 
                                    t.nombre AS 'nombre', t.apellido_p, t.apellido_m,
                                    t.estado, t.ciudad, t.codigo_postal, t.colonia, t.calle, t.no_casa, 
                                    t.telefono, 
                                    t.e_mail, 

                                    u.usuario, u.contrasena, u.foto_perfil,

                                    tu.nombre AS 'tipo_usuario', tu.privilegios

                                FROM usuarios u, trabajadores t, tipo_usuario tu
                                WHERE u.id_trabajador = t.id_trabajador AND u.id_tipo_usuario = tu.id_tipo_usuario ";

     $v_query_usuarios_table2 = mysqli_query($link,$v_query_usuarios_table) or die ("Error en la consulta usuarios".mysql_error); 

?>
                
                    
                    <div class="box box-primary">
                         <!-- Inicia titulo -->
                         <div class="box-header">
                             </br>
                             <h3 class="box-title">Ingresa a usuarios al sistema!</h3>
                         </div>
                         <!-- FIN titulo -->                    
                         <div class="row">
                             <div class="col-sm-8 col-md-8">
                                 <!-- INICIO del formulario para ingresar los usuarios -->
                                 <form action="admin_usuaios.php" method="post" enctype="multipart/form-data">
                                     <div class="box-body">
                                         <div class="row">
                                             <div class="col-xs-8">
                                                 <div class="form-group">                                             
                                                     <label>Elige un trabajador * <?php if(isset($_GET['usuaios_actualizar'])){ echo "<a href='admin_usuaios.php' data-toggle='tooltip' data-placement='top' title='Aqui podras regresar para ingresar un usuario nuevo!'>ingresar nuevo usuario!</a>";}?></label>
                                                     <?php 
if(isset($_GET['usuaios_actualizar'])){
    echo "<input name='id_trabajadortext' type='text' value='".$_GET['id_trabajador']."' hidden='hidden'>";
    
    echo "<select name='id_trabajador' class='form-control' disabled>";
    $_combonombre = $_GET['nombre']." ".$_GET['apel_p']." ".$_GET['apel_m'];
    echo "<option>".$_combonombre."</option>";
}else{
    echo "<select name='id_trabajador' class='form-control' required/>";
    echo "<option></option>";
    while($reg_tra = mysqli_fetch_array($v_query_trabajadores_box, MYSQLI_ASSOC)){
         echo "<option value='".$reg_tra['id_trabajador']."'>"
         .$reg_tra['nombre'].
         "</option> </br>";
    } 
}
                                                        ?>
                                                     </select>
                                                 </div>
                                             </div> 
                                         </div>
                                         
                                         <div class="row">
                                             <div class="col-xs-4">
                                                 <label>Nombre de Usuario *</label>
                                                 <div class="input-group">
                                                 <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                                 <input name="nombre_usuario" type="text" class="form-control" placeholder="Flora_t" maxlength="20" value="<?php if(isset($_GET['usuaios_actualizar'])){ echo $_GET['usuario'];} ?>" required/>
                                                 </div>                                                   
                                             </div>
                                             <div class="col-xs-4">
                                                 <label>Contraseña * <?php if(isset($_GET['usuaios_actualizar'])){ echo "<a>Nueva contraseña!</a>";}?></label>
                                                 <div class="input-group" data-toggle="tooltip" data-placement="left" title="Solo 10 caracteres">
                                                 <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                                 <input name="contrasena" type="password" class="form-control" placeholder="*****" maxlength="10" value="" required/>
                                                 </div>                             
                                             </div>
                                             <div class="col-xs-4">
                                                 <label>Confirmar ontraseña *</label>
                                                 <div class="input-group" data-toggle="tooltip" data-placement="left" title="Solo 10 caracteres">
                                                 <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                                 <input name="confirmar_contrasena" type="password" class="form-control" placeholder="*****" maxlength="10" value="" required/>
                                                 </div>
                                             </div>
                                         </div>
                                         </br>
                                         <div class="row">
                                             <div class="col-xs-4" style="text-align:center">
                                                 <label>Foto de perfil * <?php if(isset($_GET['usuaios_actualizar'])){ echo "<a>Nueva foto!</a>";}?></label> 
                                                 <div id="fileOutput" class="img_usuario"></div>
                                                 <input type="file" name="imagen" size="50" onchange="processFiles(files)" required/>      
                                             </div>
                                             <div class="col-xs-4">
                                                 <label>Pribilegios * <?php if(isset($_GET['usuaios_actualizar'])){ echo "<a data-toggle='tooltip' data-placement='top' title='Estas actualizando, ingesa los privielegio!'>ingresar una opción!</a>";}?></label>
                                                 <select name="tipo_usuario" class="form-control" required/>
                                                    <option></option>
                                                    <option value="1">Todos</option>
                                                    <option value="2">Solo venta</option>
                                                 </select> 
                                             </div>
                                             <div class="col-xs-4">
                                                 
                                             </div>
                                         </div>
                                         </br>
                                     </div>
                                     <div class="box-footer">
                                         <button name="insert_usuario" type="submit" class="btn btn-success" value="1">Ingresar usuario</button>
                                         
<?php
    // Boton se activa si se pulsa el boton actualizar y manda los datos para
    // actualizarse por post el nombre del boton es usuaios_actualizar
    if(isset($_GET['usuaios_actualizar'])){
        $_SESSION['id_usuario'] = $_GET['id_usuario'];
        $time = time();
        echo "
        <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#ActualizarModal' data-whatever='@mdo'>Actualizar</button>

        <div class='modal fade' id='ActualizarModal' tabindex='-1' role='dialog' aria-labelledby='ActualizarModalLabel' aria-hidden='true'>
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h4 class='modal-title' id='ActualizarModalLabel'>Actualizar usuario</h4>
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

                                        <h3 class='timeline-header'><a>Usuario</a></h3>

                                        <div class='timeline-body'>
                                        Actualizar datos de: 
                                        </br>
                                        </br>
                                        <!-- Datos mandados via GET semuestran a qui tambin -->
                                        Actualizaras al siguiente usuario </br>
                                        <code>".$_GET['nombre']." ".$_GET['apel_p']." ".$_GET['apel_m']."</code>
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
                <button name='usuario_actualizar_start' type='submit' class='btn btn-primary'>Actualizar</button>
              </div>
            </div>
          </div>
        </div>
        ";
    }
?>
                                         
                                     </div>
                                 </form>
                                 <!-- Fin del formulario para ingresar los usuarios -->
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
                                    // Mensaje de alerta el usuario ya existe
                                    if(!empty($_mjerror_pass_error)){
                                        echo  " 
                                            <div class='box-body'>
                                                <div class='box-body'>
                                                <div class='alert  alert-danger alert-dismissable'>
                                                    <i class='fa fa-ban'></i>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <b>Las contraseñas que ingresaste no coinciden!</b>
                                                </div>
                                                </div>
                                            </div>
                                        ";
                                    } 

                                    // Mensaje de alerta si se inserta el usuario
                                    if(!empty($_mjfull_insert_usuario)){
                                        echo  "
                                            <div class='box-body'>
                                                <div class='box-body'>
                                                <div class='alert alert-success alert-dismissable'>
                                                    <i class='fa fa-check'></i>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <b>Uusario ingresado!</b>
                                                </div>
                                                </div>
                                            </div>
                                        ";
                                    }

                                    // Mensaje de alerta el usuario ya existe
                                    if(!empty($_mjerror_exist_usuario)){
                                        echo  " 
                                            <div class='box-body'>
                                                <div class='box-body'>
                                                <div class='alert  alert-danger alert-dismissable'>
                                                    <i class='fa fa-ban'></i>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <b>El usuario ya existe!</b>
                                                </div>
                                                </div>
                                            </div>
                                        ";
                                    } 

                                    // Mensaje de alerta si se actualiza el usuario
                                    if(!empty($_mjwarning_actualizado_usuario)){
                                        echo  "
                                            <div class='box-body'>
                                                <div class='box-body'>
                                                <div class='alert alert-success alert-dismissable'>
                                                    <i class='fa fa-check'></i>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <b>El usurio a sido actualizado!</b>
                                                </div>
                                                </div>
                                            </div>
                                        ";
                                    }

                                    // Mensaje de alerta si se a eliminado el usuario
                                    if(!empty($_mjwarning_delete_usuario)){
                                        echo  "
                                            <div class='box-body'>
                                                <div class='box-body'>
                                                <div class='alert alert-success alert-dismissable'>
                                                    <i class='fa fa-check'></i>
                                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                                    <b>Uaurio Eliminado!</b>
                                                </div>
                                                </div>
                                            </div>
                                        ";
                                    }

                                ?>
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
                            <!-- INICIO contenido de la tabla de usuarios -->
                            <div class="box-body table-responsive">
                                <table id="regTable" id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Trabajador</th>
                                            <th>Usuario</th>
                                            <th>Contraseña</th>
                                            <th>Tipo de usuario</th>
                                            <th>Privilegios</th>
                                            <th style="text-align:center">Foto de perfil</th>
                                            <th style="text-align:center"><samp class="fa fa-cogs"></samp> Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$time = time();
while($reg_show_table = mysqli_fetch_array($v_query_usuarios_table2, MYSQLI_ASSOC)){
                                            $time = time();
                                            $v_name_usuario = $reg_show_table['nombre']." ".
                                                                 $reg_show_table['apellido_p']." ".
                                                                 $reg_show_table['apellido_m'];
    
                                            
    
                                            $v_direccion = "Estado: ".$reg_show_table['estado']."</br> Ciudad: ".$reg_show_table['ciudad']."</br> C.P: ".$reg_show_table['codigo_postal']."</br> Colonia: ".$reg_show_table['colonia']."</br> Calle: ".$reg_show_table['calle']."</br> Numero: ".$reg_show_table['no_casa'];
    


    echo "                                       
                                        <tr>
                                            <td> ".$v_name_usuario."</br>
                                                                    
<!-- Inicia el boton ver mas -->


<button type='button' class='btn btn-primary btn-xs' data-toggle='modal' data-target='#".$reg_show_table['id_usuario']."Modal' data-whatever='@mdo'>ver màs..</button>

<div class='modal fade' id='".$reg_show_table['id_usuario']."Modal' tabindex='-1' role='dialog' aria-labelledby='".$reg_show_table['id_usuario']."ModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h4 class='modal-title' id='".$reg_show_table['id_usuario']."ModalLabel'>Usario</h4>
      </div>
      <div class='modal-body'>                   
          <div class='row'>
              <div class=' col-sm-4 col-md-4' style='text-align:center'>
                  <h4>Foto de perfil</h4>
                  <img src='".$reg_show_table['foto_perfil']."'alt='Responsive image' class='img_usuarios_tabla img-rounded'> 
              </div>
              <div class=' col-sm-8 col-md-8'>
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

                                <h3 class='timeline-header'><a>Usuario</a></h3>

                                <div class='timeline-body'>
                                </br>
                                <!-- Datos mandados via GET semuestran a qui tambin -->
                                <code>".$v_name_usuario."</code> </br></br>
                                Tipo de usuario: ".$reg_show_table['tipo_usuario']." </br>
                                Privilegios: ".$reg_show_table['privilegios']."</br>
                                Direcciòn: ".$v_direccion." </br>
                                Telefono: ".$reg_show_table['telefono']."</br>
                                e_mail: ".$reg_show_table['e_mail']."
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
        <button type='button' class='btn btn-default' data-dismiss='modal'>Volver</button>
      </div>
    </div>
  </div>
</div>
<!-- Termina el boton ver mas-->
                                     
                                            </td>
                                            <td>".$reg_show_table['usuario']."</td>
                                            <td>".$reg_show_table['contrasena']."</td>
                                            <td>".$reg_show_table['tipo_usuario']."</td>
                                            <td>".$reg_show_table['privilegios']."</td>
                                            <td style='text-align:center'><img src='".$reg_show_table['foto_perfil']."' alt='Responsive image' class='img_tabla2 img-rounded'></td>
                                            <td style='text-align:center'>
    
                                            
<!-- Comienza el primer boton para eliminar -->

<a class='btn btn-danger' data-toggle='modal' data-target='#".$reg_show_table['id_usuario']."' data-whatever='@mdo'><i class='fa fa-times-circle' data-toggle='tooltip' data-placement='top' title='Eliminar'></i></a> 

<div class='modal fade' id='".$reg_show_table['id_usuario']."' tabindex='-1' role='dialog' aria-labelledby='".$reg_show_table['id_usuario']."Label' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header text-left'>
        <h4 class='modal-title' id='".$reg_show_table['id_usuario']."Label'>Eliminar usuario</h4>
      </div>
      <div class='modal-body'>                   
          <div class='row'>
              <div class=' col-xs-5 col-md-5'>
                  <img style='max-width: 250px' src='img_pages/usuario_eliminar.png' alt='Responsive image' class='img-rounded'>
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

                                <h3 class='timeline-header'><a>Usuario</a></h3>

                                <div class='timeline-body'>
                                </br>
                                <code>".$v_name_usuario."</code> </br></br>
                                Tipo de usuario: ".$reg_show_table['tipo_usuario']." </br>
                                Privilegios: ".$reg_show_table['privilegios']."</br>
                                Direcciòn: ".$v_direccion." </br>
                                Telefono: ".$reg_show_table['telefono']."</br>
                                e_mail: ".$reg_show_table['e_mail']."
                                </br>
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
        <a href='admin_usuaios.php?usuario_eliminar=activo&id_usuario=".$reg_show_table['id_usuario']."' class='btn btn-danger'>Eliminar</a>
      </div>
    </div>
  </div>
</div>

<!-- Comienza el primer boton para actualizar -->

<a href='admin_usuaios.php?
usuaios_actualizar=activo&id_usuario=".$reg_show_table['id_usuario']."&nombre=".$reg_show_table['nombre']." &apel_p=".$reg_show_table['apellido_p']."&apel_m=".$reg_show_table['apellido_m']."&usuario=".$reg_show_table['usuario']."&id_trabajador=".$reg_show_table['id_trabajador']."' class='btn btn-primary' data-toggle='tooltip' data-placement='top' title='Actualizar'><i class='fa fa fa-pencil'></i></a>                                   
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            </td>
                                        </tr>";
                                        
}
  

?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- FIN contenido de la tabla de usuarios -->
                        </div>
                    </div>
                    
                </section>
                <!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        
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
        
        <!-- script para mostrar imagen -->
        <script>
            function processFiles(files) {
                var file = files[0];

                var reader = new FileReader();

                reader.onload = function (e) {  
                    // Cuando éste evento se dispara, los datos están ya disponibles.
                    // Se trata de copiarlos a una área <div> en la página.
                    var output = document.getElementById("fileOutput"); 
                    fileOutput.style.backgroundImage = "url('" + e.target.result + "')";
                };

                reader.readAsDataURL(file);
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