<?php
    session_start();
    require("inc/php_conexion.php");
    $db = new Db();
    $usu=$_SESSION['username'];
    if(!$_SESSION['tipo_usu']=='a' OR !$_SESSION['tipo_usu']=='ca'){
        header('location:error.php');
    }
    $query=$db->mysqli->query("SELECT MAX(codigo) AS numero FROM proveedor");
    if($row=$query->fetch_object()){
        $numero=$row->numero+1;
    }

    $codigo='';$contacto='';$empresa='';$ciudad='';$correo='';$direccion='';$telefono='';$celular='';$obs='';
    if(!empty($_GET['codigo'])){
        $numero=$_GET['codigo'];
        $query=$db->mysqli->query("SELECT * FROM proveedor WHERE codigo=$numero");
        if($row=$query->fetch_object()){
            $empresa=$row->empresa; $contacto=$row->nom;    $direccion=$row->dir;  $ciudad=$row->ciudad;    $telefono=$row->tel;
            $celular=$row->cel; $correo=$row->correo;   $obs=$row->obs; $boton="Actualizar Proveedor" 
        }
    }else{
        $boton="Guardar Proveedor";
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    
</body>
</html>