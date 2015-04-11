<?PHP 
   
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
            <form action="../../index.html" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="userid" class="form-control" placeholder="Nombre de usuario"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña"/>
                    </div>  
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Ingresar</button>                      
                </div>
            </form>

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