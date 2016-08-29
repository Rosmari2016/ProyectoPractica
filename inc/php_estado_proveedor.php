<?php
    session_start();
    require("php_conexion.php");
    $db = new Db();
    $usu=$_SESSION['username'];
    if(!$_SESSION['tipo_usu']=='a' OR !$_SESSION['tipo_usu']=='ca'){
        header('location:../error.php');
    }else{
        $id=$_GET['id'];
        
        if($_SESSION['username']==""){
        }else{
            if($_SESSION['tipo_usu']=='a'){
                $cans=$db->mysqli->query("SELECT * FROM proveedor WHERE estado='s' AND codigo='$id'");
                if($row=$cans->fetch_object()){
                    $xSQL="UPDATE proveedor SET estado='n' WHERE codigo=$id";
                    $db->mysqli->query($xSQL);
                }else{
                    $xSQL="UPDATE proveedor SET estado='s' WHERE codigo=$id";
                    $db->mysqli->query($xSQL);
                }
            }
        }
    }

    header('location:../buscar_proveedor.php');

?>