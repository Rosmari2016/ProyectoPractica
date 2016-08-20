<?php 
	session_start();
    require("inc/php_conexion.php");
	$db = new Db();
    if (!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
        header('location:error.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Blanco</title>
	
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
            <div class="col s12 m4 l2">		
					<aside>
							<div class="collection">
								<div class="collection-header"><h4 class="collection-header-with">Configuración</h4></div>
								<a href="datos_empresa.php" class="collection-item">Datos de la empresa</a>
								<a href="seccion.php" class="collection-item active">Administrar Secciones de Inventarios</a>
								<a href="caja.php" class="collection-item">Ventas</a>
							</div>	
					</aside>
				</div>
                
            <div class="col s12 m4 l4">
                <table class="responsive-table">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nombre</td>
                            <td>Estado</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $resultado=$db->mysqli->query("SELECT * FROM seccion");
                            while($row=$resultado->fetch_object()){
                                $nombre=$row->nombre;
                                $id=$row->id;
                                if($row->estado=="n"){
                                    $estado='<span class="new badge red" data-badge-caption="">Inactivo</span>';
                                }else{
                                    $estado='<span class="new badge blue" data-badge-caption="">Activo</span>';
                                }
                            
                        ?>
                                <tr>
                                    <td><?php echo $id; ?></td>
                                    <td><a href="seccion.php?codigo=<?php echo $id; ?>"><?php echo $nombre; ?></a></td>
                                    <td><a class="center-align" href="inc/php_estado_seccion.php?id=<?php echo $id;?>"><?php echo $estado;?></a></td>
                                </tr>
                            <?php } ?>
                        

                    </tbody>
                </table>
            </div>
            <div class="col s12 m4 l4">
                
                        <?php
                            if(empty($_GET['codigo'])){
                                $resultado=$db->mysqli->query("SELECT MAX(id) AS numero FROM Seccion");
                                if($row=$resultado->fetch_object()){
                                    $s_codigo=$row->numero+1;
                                    $s_nombre="";
                                    $boton="Guardar Sección";
                                }
                            }
                            else{
                                $s_codigo=$_GET['codigo'];
                                $resultado=$db->mysqli->query("SELECT * FROM seccion WHERE id=$s_codigo");
                                if($row=$resultado->fetch_object()){
                                    $s_nombre=$row->nombre;
                                }
                                $boton="Actualizar Sección";
                            }
                        ?>
                
                <div class="row">
                    <form class="col s12" name="form1" method="POST" action="">
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="s_codigo" id="s_codigo" value="<?php echo $s_codigo;?>" readonly>
                                <label for="codigo">Codigo</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="s_nombre" id="s_nombre" value="<?php echo $s_nombre;?>" required>
                                <label for="nombre">Nombre</label>
                            </div>
                        </div><br/><br/>
                        <div class="row">
                            <div class="col s6">
                                <button tabindex="submit" class="btn waves-effect waves-light green accent-4" type="submit" ><?php echo $boton;?>
                                    <i class="material-icons right">send</i>
                                </button>
                            </div>
                            <div class="col s6">
                                <?php if($boton=='Actualizar Sección'){?> <a href="seccion.php" class="waves-effect waves-light btn green accent-4">Cancelar</a><?php } ?>

                            </div>
                        </div>
                    </form>
                </div>
                <?php require_once("inc/php_seccion_CRUD.php"); ?>
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
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function () {
            $(".dropdown-button").dropdown();
            $(".button-collapse").sideNav();
        });
	</script>
</body>
</html>