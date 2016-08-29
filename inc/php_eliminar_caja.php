<?php
    session_start();
    require("php_conexion.php");
    $db = new Db();
    $usuario=$_SESSION['username'];
    if(!$_SESSION['tipo_usu']=='a' OR !$_SESSION['tipo_usu']=='a'){
        header("location:../error.php");
    }

    if(!empty($_GET['id'])){
         $idcaja=$_GET['id'];

         $cmd = "DELETE FROM caja_tmp WHERE id=$idcaja";
         $db->mysqli->query($cmd);
         header('location:../caja.php?ddes=<?php echo $_SESSION["ddes"];?>');
    }
?>