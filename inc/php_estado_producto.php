<?php
    session_start();
    require("php_conexion.php");
    $db=new Db();
    $usu=$_SESSION['username'];
    if(!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
        header('location:../buscar_producto.php');
    }else{
        $id=$_GET['id'];
        if($_SESSION['username']==""){
        }else{
            if($_SESSION['tipo_usu']=='a'){
                $query=$db->mysqli->query("SELECT * FROM producto WHERE estado='s' AND cod='$id'");
                if($query->num_rows>0){
                    $xSQL="UPDATE producto SET estado='n' WHERE cod=$id";
                    $db->mysqli->query($xSQL);
                }else{
                    $xSQL="UPDATE producto SET estado='s' WHERE cod=$id";
                    $db->mysqli->query($xSQL);
                }           
            }
        }
    }
    header("Location:../buscar_producto.php");

?>