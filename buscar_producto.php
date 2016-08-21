<?php
    session_start();
    require("inc/php_conexion.php");
    $db = new Db();
        if(!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
			header('location:error.php');
		}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Productos</title>
	
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
	<link rel="shortcut icon" type="image/x-icon" href="ico/favicon.png">
</head>
<body>
    <?php
		if ($_SESSION['tipo_usu']=='a'){
			require_once "menu_admin.php";
		}
	?>
    <main>
        <div class="row">
            <div class="col s12 m12 l2">
                <aside>
                    <div class="collection">
                        <div class="collection-header"><h4 class="collection-header-width">Acciones</h4></div>
                        <div class="divider"></div>
						<a href="buscar_producto.php" class="collection-item active">Buscar Producto</a>
						<a href="crear_producto.php" class="collection-item">Crear Producto</a>       
						<a href="#" class="collection-item">Buscar Proveedor</a>
                        <a href="#" class="collection-item">Crear  Proveedor</a>
                    </div>
                </aside>
            </div>
            <div class="col s12 m12 l10">
                <div class="card-panel green accent-3" style="padding:2px;">
                    <h5 class="center-align" style="color:white;">Listado de producto registrados</h5>
                </div>
                <div class="row">
                    <form class="col s6 " method="POST" action="" enctype="multipart/form-data" name="form1" id="form1">
                        <div class="row">
                            <div class="input-field col s6">
                                <input name="bus" type="text" class="validate" list="characters">
                                    <datalist id="characters">
                                        <?php
                                            $buscar=$_POST['bus'];
                                            $sql=$db->mysqli->query("SELECT * FROM producto");
                                            while($row=$sql->fetch_object()){
                                                echo '<option value="'.$row->nom.'">';
                                                echo '<option value="'.$row->cod.'">';
                                                echo '<option value="'.$row->cprov.'">';
                                            }
                                        ?>
                                    </datalist>
                                <label for="buscar">Buscar</label>
                            </div>
                            <div class="col s6">
                                <br>
                                <button class="btn waves-effect waves-light green accent-4" type="submit">Buscar por Nombre!
                                    <i class="material-icons right">send</i>
                                 </button>
                             </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer class="page-footer green accent-4">
			<div class="footer-copyright">
				© 2016 Copyright Rosa Marina Lumbí Suárez
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