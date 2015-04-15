<?php
    // verifica si ya se a iniciado una sesion 
   // origin/master
    session_start ();

    if(!empty($_SESSION['session'])){
        header('Location: sistema.php');
    }else{
        session_destroy ();
    }
?>


<?php

    // inclulle la conexion a la bd del archivo "conexion.php"
    include("conexion.php");

    // Start Compara si contiene algundato la variable global $_POST["usuario"] mandada del formulario
    if(!empty($_POST["usuario"])){  
        
        // Almacena los datos del formulario en variables $_POST[]
        $v_user =  $_POST['usuario'];
        $v_pass = $_POST['password'];
        
        // Almacena una consulta en la variable $v_query
        $v_query = "SELECT u.id_usuario, u.usuario, u.contrasena, 
                           t.nombre AS 't_nombre', t.apellido_p, t.apellido_m, t.e_mail, 
                           tu.nombre AS 'tu_nombre', tu.privilegios, u.foto_perfil
                    FROM usuarios u, trabajadores t, tipo_usuario tu
                    WHERE u.id_trabajador = t.id_trabajador AND u.id_tipo_usuario = tu.id_tipo_usuario AND u.usuario ='".$v_user."'";
        
        // Almacena los datos de la consulta en un array
        $registro = mysqli_query($link,$v_query) or die("Problemas en el select:".mysql_error());
        
        // Verifica si la contraseña es correcta o no y se ejuta una toma de desisiones
        if($reg = mysqli_fetch_array($registro, MYSQLI_ASSOC)){
            
            if($reg['contrasena'] == SHA1("$v_pass")){
                session_start();
                $_SESSION['session']       = "activo";
                $_SESSION['id_usuario']    = $reg['id_usuario'];
                $_SESSION['usuario']       = $reg['usuario'];
                $_SESSION['contrasena']    = $reg['contrasena'];
                $_SESSION['nombre']        = $reg['t_nombre']." ".$reg['apellido_p']." ".$reg['apellido_m'];
                $_SESSION['e_mail']        = $reg['e_mail'];            
                $_SESSION['tipo_usuario']  = $reg['tu_nombre'];
                $_SESSION['privilegios']   = $reg['privilegios'];
                $_SESSION['foto_perfil']   = $reg['foto_perfil'];
                header('Location: sistema.php');                   
            }else{
                $v_mensaje = "Activo";
            }
        }else{
            $v_noexiste = "Activo";
        }
        
    }
    // End Compara si contiene algundato la variable global $_POST["usuario"]
?>   


<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Ahuelik | LogIn</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />

    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Iniciar Sesiòn</div>
            
            <!-- INICIO DE FORMULARIO -->
            <form action="index.php" method="post">
                <div class="body bg-gray">
                    
                    <?php
                        // Mensaje de error si el usuario no existe
                        if(!empty($v_noexiste)){ echo "<strong><p style='color:#EB440C'><samp class='fa fa-times-circle-o'></samp> Eror el usuario ".$v_user." no existe</p></strong>";}
                    ?>
                    
                    <div class="form-group">
                        <input type="text" name="usuario" class="form-control" placeholder="Nombre de usuario" value="<?php if(!empty($v_mensaje)){echo $v_user;}?>"/>
                    </div>                    
                    
                    <div class='form-group  has-error'>
                        
                        <?php
                            // Mensaje de error si la contraseña no existe
                            if(!empty($v_mensaje)){
                                echo "<label class='control-label' for='inputError'><i class='fa fa-times-circle-o'></i> Error contraseña incorrecta</label>";
                            }                        
                        ?>
                        
                        <input type='password' name='password' class='form-control' placeholder='Password'/>
                    </div>  
                    
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Ingresar</button>                      
                </div>
            </form>
            <!-- INICIO DE FORMULARIO -->
            

            <div class="margin text-center">
                <span></span>
                <p id="footer-text"><small>Copyright &copy; 2015 <a href="#">Creation a-time</a></small></p>
            </div>
        </div>


        <!-- jQuery 2.0.2 -->
        <script src="../js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>        

    </body>
</html>