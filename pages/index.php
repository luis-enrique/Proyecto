<?PHP 
    session_start ();

    if(!empty($_SESSION['session'])){
        header('Location: usuario.php');
    }else{
        session_destroy ();
    }
?>

<?php

    // inclulle la conexion a la bd del archivo "conexion.php"
    include("conexion.php");

    // Start Compara si contiene algundato la variable global $_POST["usuario"]
    if(!empty($_POST["usuario"])){
        echo "con susuario"; //  QUITAR ESTO  
        
        // Resibe los datos del formulario y los almacena en varibles
        $usuario = $_POST["usuario"];
        $pass = $_POST["password"];
        
        // Se almasena un query en un avariable
        $v_query = "SELECT * FROM usuarios WHERE usuario='".$usuario."'";

        // Se ejecuta un Query tomando en cuelta la consulta lamasenada en la variable $v_query
        $registro = mysqli_query($link,$v_query) or die("Problemas en el select:".mysql_error());
        
        // Comprueba y asosia la consulta en un Array
        if($reg = mysqli_fetch_array($registro, MYSQLI_ASSOC)){
            // Compara el usuario y la contraseña con la base de datos
            if($reg["password"] == SHA1("$pass")){
               // Almacena los datos del array en variables globales e inicia seson el usuario
                session_start ();
                $_SESSION['session'] = "activo";
                $_SESSION["usuario"] = $reg['usuario']; 
                $_SESSION["Nombre"]  = $reg['nombre']." ".$reg['apellido_p']." ".$reg['apellido_m']; 
                $_SESSION["id_tipo_usuario"]  = $reg['id_tipo_usuario'];
                $_SESSION["correo"]  = $reg['correo'];                
                $_SESSION["foto_perfil"] = $reg['foto_perfil']; 
                // ESTA ES LA PAGINA A DONDE NOS MANDARA SI TODO ES CORRECTO RETORNA EL USUARIO Y EL URL DE SU FOTO DE PERFIL
                header('Location: sistema.php');                     
            }else{
                //  SI LA CONTRASEÑA ES INCORRECTA RETORNA LA URL DE SU FOTO DE PERFIL DEL USUARIO
                $v_imge_perfil = $reg['foto_perfil'];
                $v_error="La contrasena es incorrecta";
                echo "--- Contraseña incorrecta | el usuario: ".$usuario." existe"; //  QUITAR ESTO 
                
            }
                
        }else{
            //$v_errorusuario = $reg['usuario'];
            //ESTA ES LA PAGINA A DONDE NOS MANDARA SI TODO ESTA MAL
            // RETORNA EL USUARIO
            // header('Location: usuario.php'); 
            echo "--- Todo mal | el usuario ".$usuario." no existe"; //  QUITAR ESTO 
            $v_imge_perfil = "imagenes/login.png";
            $v_error="El usuari no existe";                
        }

        
    }else{
        echo "sin usuario"; //  QUITAR ESTO 
        $v_imge_perfil = "imagenes/login.png";
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
                    <div class="form-group">
                        <input type="text" name="usuario" class="form-control" placeholder="Nombre de usuario"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
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