<?php
    session_start();
    require("php_conexion.php");
    $usuario=$_SESSION['username'];
    if(!$_SESSION['tipo_usu']=='a' OR !$_SESSION['tipo_usu']=='a'){
        header("location:../error.php");
    }


?>