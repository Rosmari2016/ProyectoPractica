<?php

class Db{

    public $mysqli;

    function __construct(){

          if(!empty($_SESSION['username']) and !empty($_SESSION['tipo_usu'])){
                $usu=$_SESSION['username'];
                $tip=$_SESSION['tipo_usu'];
            }

        $this->mysqli= new mysqli('localhost','root','root','datos');
        
        if(mysqli_connect_error()){
            die('Error en la conexion ('.mysqli_connect_errno().')'.mysqli_connect_error());
        }
    }
}



?>