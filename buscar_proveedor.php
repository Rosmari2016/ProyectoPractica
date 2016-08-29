<?php
    session_start();
    require("inc/php_conexion.php");
    $db = new Db();
        if(!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
			header('location:error.php');
		}
?>
<!DOCTYPE html>
<html lang="es">
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
	<link rel="shortcut icon" type="image/x-icon" href="img/logo.png">
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
                        <div class="collection-header"><h4 class="collection-header-with">Acciones</h4></div>
                        <div class="divider"></div>
						<a href="buscar_producto.php" class="collection-item">Buscar Producto</a>
						<a href="crear_producto.php" class="collection-item">Crear Producto</a>       
						<a href="buscar_proveedor.php" class="collection-item active">Buscar Proveedor</a>
                        <a href="crear_proveedor.php" class="collection-item">Crear  Proveedor</a>
                    </div>
                </aside>
            </div>

            <div class="col s12 m12 l10">
                <div class="card-panel green accent-3" style="padding:2px;">
                    <h5 class="center-align" style="color:white;">Listado de proveedores registrados</h5>
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