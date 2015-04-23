
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
                    if(isset($_POST['insert_trabajador'])){
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
                        
                        $v_query_insert_trabajador = mysqli_query($link,$v_insert_trabajador) or die ("Problemas al insertar".mysql_errno());
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
                                                <input name="nombre" type="text" class="form-control" placeholder="Ejemplo: Juan" maxlength="20" required/>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Apellido paterno *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-font"></i></span>
                                                <input name="ap_p" type="text" class="form-control" placeholder="Ejemplo: Morales"  maxlength="20" required/>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Apellido materno *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-font"></i></span>    
                                                <input name="ap_m" type="text" class="form-control" placeholder="Emplo: Gracia" maxlength="20" required/>
                                                </div>
                                            </div>
                                        </div>
                                        </br>
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Estado *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-globe"></i></span> 
                                                <input name="estado" type="text" class="form-control" placeholder="Emplo: Guerrero" maxlength="30" required/>
                                            </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Ciudad *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 
                                                <input name="ciudad" type="text" class="form-control" placeholder="Emplo: Cliapa de Àlvarez" maxlength="30" required/>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>CP: </label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-building-o"></i></span> 
                                                <input name="cp" type="text" class="form-control" placeholder="Emplo: 41100" maxlength="5" onkeypress="return numeros(event)" required/>
                                                </div>
                                            </div>
                                        </div>
                                     </br>
                                     <div class="row">
                                            <div class="col-xs-4">
                                                <label>Colonia *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                                                <input name="colonia" type="text" class="form-control" placeholder="Ejemplo: Los Pinos" maxlength="50" required/>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Calle *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>
                                                <input name="calle" type="text" class="form-control" placeholder="Ejemplo: Emiliano Zapata"  maxlength="50" required/>
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Nª casa *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-chevron-right"></i></span>    
                                                <input name="n_casa" type="text" class="form-control" placeholder="Emplo: 231" maxlength="10" onkeypress="return numeros(event)">
                                                </div>
                                            </div>
                                        </div>
                                        </br>
                                        <div class="row">
                                            <div class="col-xs-4">
                                                <label>Email *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                <input name="mail" type="email" class="form-control" placeholder="usuario@outlook.com" maxlength="50">
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <label>Telefono *</label>
                                                <div class="input-group">
                                                <span class="input-group-addon"><i class="fa  fa-phone"></i></span>
                                                <input name="tel" type="text" class="form-control" placeholder="Ejemplo: 7561187854"  maxlength="10" onkeypress="return numeros(event)">
                                                </div>
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="form-group">
                                                    <label>Categoria *</label>
                                                    <select name="categoria" class="form-control" required/>
                                                        <option></option>
                                                        <?php 
                                                            while($reg_combobox = mysqli_fetch_array($v_query_box, MYSQLI_ASSOC)){
                                                                echo "<option value='".$reg_combobox['id_categoria']."'>".$reg_combobox['puesto']."</option> </br>";
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                </br>
                                <div class='box-footer'>
                                    <button name="insert_trabajador" type="submit" class="btn btn-success" value="1">Ingresar Trabajador</button>
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
                                 CONTENIDO
                             <!-- FIN de los mensajes de las alertas para las acciones del usuario -->
                             ------------------------
                             </div>
                         </div>
                    </div>

                    <div class="box box-primary">
                        <div class="box-header">
                            </br>
                            <h3 class="box-title">Tabla de trabajadores</h3>
                        </div>
                        <div class="box-body">
                            <!-- INICIO contenido de la tabla de trabajadpres -->
                            <div class="box-body table-responsive">
                                <table id="example2" class="table table-bordered table-hover">
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
                                                <td style='text-align:center'>Botones</td>
                                            </tr>
                                            ";
                                        }
                                    ?>
                                    
                                    <tbody>
                                        
                                    </tbody>
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
        <!-- jQuery 2.0.2 -->
        <script src="../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../js/AdminLTE/app.js" type="text/javascript"></script>

    </body>
</html>