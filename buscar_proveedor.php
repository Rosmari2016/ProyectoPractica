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
                <div class="row">
                    <form class="col s6" method="POST" enctype="multipart/form-data" name="form1" id="form1" action="">
                        <div class="row">
                            <div class="input-field col s6">
                                <input name="bus" type="text" class="validate" list="characters">
                                    <datalist id="characters">
                                        <?php
                                            $buscar=$_POST['bus'];
                                            $sql=$db->mysqli->query("SELECT * FROM proveedor");
                                            while($row=$sql->fetch_object()){
                                                echo '<option value="'.$row->nom.'">';
                                                echo '<option value="'.$row->empresa.'">';
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
                    <div class="col s12">
                        <table class="responsive-table">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre Empresa</th>
                                    <th>Contacto</th>
                                    <th>Estado</th>
                                    <th>Telefono</th>
                                    <th>Celular</th>
                                    <th>Correo</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php if(empty($_POST['bus'])){
                                    $can=$db->mysqli->query("SELECT * FROM proveedor");
                                  }else{
                                      $buscar=$_POST['bus'];
                                      $can=$db->mysqli->query("SELECT * FROM proveedor WHERE nom LIKE '$buscar%' OR empresa LIKE '$buscar%'");
                                  }
                                  while($row=$can->fetch_object()){
                                    if($row->estado=="n"){
                                        $estado='<span class="new badge red" data-badge-caption="">Inactivo</span>';
                                    }else{
                                            $estado='<span class="new badge green accent-4" data-badge-caption="">Activo</span';
                                        } 
                            ?>
                                    <tr>
                                        <td><?php echo $row->codigo; ?></td>
                                        <td><a href="crear_proveedor.php?codigo=<?php echo $row->codigo;?>"><?php echo $row->empresa; ?></a></td>
                                        <td><?php echo $row->nom; ?></td>
                                        <td><a href="php_estado_proveedor.php?id=<?php echo $row->codigo; ?>"><?php echo $estado; ?></a></td>
                                        <td><?php echo $row->tel; ?></td>
                                        <td><?php echo $row->cel; ?></td>
                                        <td><?php echo $row->correo; ?></td>
                                    </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    
                    </div>

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