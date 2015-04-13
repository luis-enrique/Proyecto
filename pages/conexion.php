<?php 

    $link = mysqli_connect("localhost", "root", "");
    mysqli_select_db($link, "purificadora");

//    comrueba la conexion
//    if ($link->connect_errno) {
//        echo "Falló la conexión con MySQL: (" . $mysqli->connect_errno . ")" . $mysqli->connect_error;
//    }else{ 
//        echo "Conexion exitosa con MySQL";
//    }

?>