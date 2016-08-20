<?php
    session_start();
    require('php_conexion.php');
    $db = new Db();
    $id=$_GET['id'];

    if($_SESSION['username']=""){   
    }else{
        if($_SESSION['tipo_usu']=='a'){
            $resultado=$db->mysqli->query("SELECT * FROM seccion WHERE estado='s' AND id='$id'");
            if($row=$resultado->fetch_object()){
                $xSQL="UPDATE seccion SET estado='n' WHERE id=$id";
                $db->mysqli->query($xSQL);
                header('location:../seccion.php');
            }else{
                $xSQL="UPDATE seccion SET estado='s' WHERE id=$id";
                $db->mysqli->query($xSQL);
                header('location:../seccion.php');
            }
        }
    }

?>