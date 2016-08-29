<?php
    session_start();
    require("inc/php_conexion.php");
    $db = new Db();
    if(!$_SESSION['tipo_usu']=='a'){
        header("location:error.php");
    }
    $usuario=$_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Cambiar Contraseña</title>
	
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="css/materialize.css">

	<style>	
		  body {
				display: flex;
				min-height: 100vh;
				flex-direction: column;
			}

			main {
				flex: 1 0 auto;
			}
	</style>
	<link rel="shortcut icon" type="image/x-icon" href="img/logo.png">
</head>
<body>
    <?php
		if ($_SESSION['tipo_usu']=='a'){
			require_once "menu_admin.php";
		}
	?>

    <main class="center-align">
        <div class="container">
            <div class="card-panel green accent-3" style="padding:2px;">
                 <h5 class="center-align" style="color:white;">Cambiar Contraseña</h5>
            </div>

            <div class="container">
                 <form name="form1" method="POST" action="">
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="password" name="contra" id="contra" class="validate"/>
                            <label for="contAntigua">Contraseña Antigua</label>
                        </div>

                        <div class="input-field col s12">
                            <input type="password" name="c1" id="c1" class="validate"/>
                            <label for="contNueva">Nueva Contraseña</label>
                        </div>

                        <div class="input-field col s12">
                            <input type="password" name="c2" id="c2" class="validate"/>
                            <label for="contConfirmar">Confirmar Contraseña</label>
                        </div> 
                    </div>
                     <button class="btn-large waves-effect waves-light green accent-4" type="submit" name="action">Cambiar Contraseña
                        <i class="material-icons right">send</i>
                    </button>
                    
                </form>
                <br>
                <?php 
                    if(!empty($_POST['c1']) AND !empty($_POST['c2']) AND !empty($_POST['contra'])){
                        if($_POST['c1']==$_POST['c2']){
                            $contra=$_POST['contra'];
                            $query=$db->mysqli->query("SELECT * FROM usuarios WHERE usu='".$usuario."' AND con='".$contra."'");
                            if($row=$query->fetch_object()){
                                $cnueva=$_POST['c2'];
                                $sql="UPDATE usuarios SET con='$cnueva' WHERE usu='$usuario'";
                                $db->mysqli->query($sql);
                                echo '<div class="alert alert-success">
                                        <strong>Contraseña!</strong> Actualizada con exito
                                      </div>';
                            }else{
                                echo '<div class="alert alert-success">
                                        <strong>Contraseña!</strong> Digitada no corresponde a la antigua
                                      </div>';
                            }
                        }else{
                                echo '<div class="alert alert-success">
                                         <strong>Las dos Contraseña!</strong> Digitada no soy iguales
                                      </div>';
                        }
                    }
                
                ?>
            </div>         
        </div>  
    </main>


    <footer class="page-footer green accent-4">
		<div class="footer-copyright">
			© 2016 Copyright Rosa Lumbí, Yuritza Solis, Freddy Sirias
				<!--<a class="grey-text text-lighten-4 right" href="#!">More Links</a>-->
		</div>
   	</footer>

    <script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
    <script type="text/javascript" src="js/materialize.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
            $(".dropdown-button").dropdown();
            $(".button-collapse").sideNav();       
        });
	</script> 
</body>
</html>