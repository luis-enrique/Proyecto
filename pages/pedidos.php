
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

                                        <li><a href='ventas_del_dia.php'><i class='fa fa-angle-double-right'></i> Ventas del dìa</a></li>
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
                        <li class="active">Blank page</li>
                    </ol>
                </section>

                <!-- Main content -->
                
                
                <section class="content">
                    <div class="row">
                        <div class="col-sm-4 col-md-4">
                             <div class="box box-danger">
                                <div class="box-header">
                                   <h1 class="box-title">Datos del cliente</h3>
                                </div>
                                 <div class="box-body table-responsive">
             <label>Fecha de entrega</label>
                <div class="row">
                    <div class="col-xs-3">
                        <div class="input-group">
                            <div class="input-group-addon">Fecha</div>
                            <input name="p_presio" type="date" class="form-control"       placeholder=value="" required/>                                                                        
                        </div>
                    </div>
                </div>
                <br>
                                    
                 <div style="font-size: 150%; "></div>
                 <label>Hora de entrega</label>
                <div class="row">
                    <div class="col-xs-3">
                        <div class="input-group">
                            <div class="input-group-addon">Hora</div>
                            <input name="p_presio" type="time" class="form-control" placeholder="10:51"                                    value="" required/>                                                                     
                        </div>
                    </div>
                </div>
                                     
                <br>
                    
              
               <!-- select -->
                    <div style="font-size: 150%; "></div>
                 <label>Clientes</label>
                     <br>
               
<!-- Cobombo Box consulta datos de la BD  -->
                        
<?php
   $conexion= include("conexion.php");
$query = 'SELECT * FROM clientes';
$result = mysqli_query($link,$query) or die ("Problemas en el select:".mysql_error());
?>
<select>   
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
</select>
  <br>
<br>
                                    
    
  </div>  
  </div>
      </div>                   
                                             
                        <div class="col-sm-8 ol-md-8">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <h1 class="box-title">Productos</h1>
                                </div>
                                <div class="box-body table-responsive">
         <table id="example1" class="table table-bordered table-striped">
                                        
                                        
                                        
               <?php

                         echo "<thead>";
                         echo '<th>Producto</th>';
                         echo '<th>Precio<th>';
                         echo "</thead>";
                         echo "<tbody>";
$v_query6 = "SELECT * FROM productos";
$v_recibe = mysqli_query($link,$v_query6) or die ("Problemas en el   select:".mysql_error());
while ($rowss=mysqli_fetch_array($v_recibe, MYSQLI_ASSOC)) { //Bucle para ver todos los registros
                         echo '<tr>';
                         echo '  <td>'.$rowss['nombre'].'.</td>';
                         echo '  <td>$'.$rowss['precio_venta'].'.00</td>';
                        echo "   <td style='text-align:center'>";
                        echo "        
                        <button type='button' class='btn btn-success' data-toggle='modal' data-target='#".$rowss['id_producto']."' data-whatever='@mdo'>Realizar</button>

                                                    <div class='modal fade' id='".$rowss['id_producto']."' tabindex='-1' role='dialog' aria-labelledby='".$rowss['id_producto']."Label' aria-hidden='true'>
                                                      <div class='modal-dialog'>
                                                        <div class='modal-content'>
                                                          <div class='modal-header'>
                                                            <h4 class='modal-title' id='".$rowss['id_producto']."Label'>Actualización de productos</h4>
                                                          </div>
                                                          
                                                          
                                                          <div class='modal-body'>

                                                              contenido
                              
                              <form method='post' name='fromulario' action''> 
<input type='text' name='nombre'/> 
<input type='submit' value='enviar'/> 
            
                           
                      
                              
                              
                              

                                                          </div>
                                                          <div class='modal-footer'>
                                                            <button type='button' class='btn btn-default' data-dismiss='modal'>Cancelar</button>
                                                            <a type='submit' class='btn btn-success' href='pedidos.php?enviar=activo&id_producto=".$rowss['id_producto']."& producto=".$rowss['nombre']."&precio=".$rowss['precio_venta']."'>Enviar</a>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>   ";
    
    
                        echo "</td>";

                        echo "</tr>";
                           }
                        echo "</body>";
                        echo "</table>";

             ?>
             
             
          
             
            </div><!-- /.box-body -->
                    </div><!-- /.box -->
                 </div>
               </div>
                        

                        
            <div class="box">
            <div class="box-header">
            <h3 class="box-title">Pedidos</h3>                                    
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
            <thead>
                
                
                
                
                
                
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Subtotal</th>
            </tr>
            </thead>
                    <tbody>
                     <tr>
                         <?php

                


                if(isset($_GET['enviar'])){
                       echo" <td>".$_GET['producto'];"</td>";
                       echo" <td>".$_GET['precio'];"</td>";
                             }

                         ?>
                        <td><a href="cancelar.php">cancelar</a> <br>                                                         <a href="actualizar.php">Actualizar</a> </td> 
                      </tr>
                    </tbody>
                  </div>
                </div>
              </div>
            </section>
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