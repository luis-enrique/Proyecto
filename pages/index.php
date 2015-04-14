
<?php

    // inclulle la conexion a la bd del archivo "conexion.php"
    include("conexion.php");

    // Start Compara si contiene algundato la variable global $_POST["usuario"]
    if(!empty($_POST["usuario"])){  
        
        $v_user =  $_POST['usuario'];
        $v_pass = $_POST['password'];
        
        $v_query = "SELECT u.id_usuario, u.usuario, u.contrasena, 
                           t.nombre AS 't_nombre', t.apellido_p, t.apellido_m, t.e_mail, 
                           tu.nombre AS 'tu_nombre', tu.privilegios, u.foto_perfil
                    FROM usuarios u, trabajadores t, tipo_usuario tu
                    WHERE u.id_trabajador = t.id_trabajador AND u.id_tipo_usuario = tu.id_tipo_usuario AND u.usuario ='".$v_user."'";
        
        $registro = mysqli_query($link,$v_query) or die("Problemas en el select:".mysql_error());
        
        if($reg = mysqli_fetch_array($registro, MYSQLI_ASSOC)){
            
            if($reg['contrasena'] == SHA1("$v_pass")){
                // deve de ir un star cesion
                $reg['id_usuario'];
                $reg['usuario'];
                $reg['contrasena'];
                $reg['t_nombre']." ".$reg['apellido_p']." ".$reg['apellido_m'];
                $reg['e_mail'];            
                $reg['tu_nombre'];
                $reg['privilegios'];
                $reg['foto_perfil'];
                
                header('Location: sistema.php');                   
            }else{
                echo " Contraseña incorrecta ";
                $v_mensaje = "Activo";
            }
        }else{
            $v_noexiste = "Activo";
        }
        
    }else{
        echo "sin usuario"; //  QUITAR ESTO 
    }
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
                    <?php if(!empty($v_noexiste)){ echo "<strong><p style='color:#EB440C'><samp class='fa fa-times-circle-o'></samp> Eror el usuario ".$v_user." no existe</p></strong>";} ?>
                    <div class="form-group">
                        <input type="text" name="usuario" class="form-control" placeholder="Nombre de usuario" value="<?php if(!empty($v_mensaje)){echo $v_user;}?>"/>
                    </div>                    
                    
                    <div class='form-group  has-error'>
                        <?php
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