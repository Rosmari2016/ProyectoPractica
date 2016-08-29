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
            $celular=$row->cel; $correo=$row->correo;   $obs=$row->obs; $boton="Actualizar Proveedor";
        }
    }else{
        $boton="Guardar Proveedor";
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Crear Proveedor</title>
	
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
						<a href="buscar_proveedor.php" class="collection-item">Buscar Proveedor</a>
                        <a href="crear_proveedor.php" class="collection-item active">Crear  Proveedor</a>
					</div>
                </aside>
            </div>

            <div class="col s12 m12 l10">
                <div class="card-panel green accent-3" style="padding:2px;">
                    <h5 class="center-align" style="color:white;">Creación de Proveedores</h5>
                </div>

                

                <div class="row">
                    <form name="form1" class="col s12" method="POST" action="">
                        <div class="row">
                            <div class="input-field col s6">
                                <input type="text" class="validate" name="codigo" id="codigo" value="<?php echo $numero; ?>" readonly/>
                                <label for="codigo">Codigo</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="validate" name="empresa" id="empresa" value="<?php echo $empresa; ?>" required />
                                <label for="empresa">Empresa</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="validate" name="contacto" id="contacto" value="<?php echo $contacto; ?>" required />
                                <label for="contacto">Contacto</label>
                            </div>

                            <div class="input-field col s6">
                                <input type="text" class="validate" name="direccion" id="direccion" value="<?php echo $direccion; ?>" />
                                <label for="direccion">Dirección</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="validate" name="ciudad" id="ciudad" value="<?php echo $ciudad; ?>" required />
                                <label for="Ciudad">Ciudad</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="validate" name="telefono" id="telefono" value="<?php echo $telefono; ?>" />
                                <label for="telefono">Telefono</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="validate" name="celular" id="celular" value="<?php echo $celular; ?>" />
                                <label for="celular">Celular</label>
                            </div>
                            <div class="input-field col s6">
                                <input type="text" class="validate" name="correo" id="correo" value="<?php echo $correo; ?>" />
                                <label for="correo">Correo</label>
                            </div>

                            <div class="input-field col s6">
                                <textarea name="obs"  id="obs" class="materialize-textarea" value="<?php echo $obs; ?>" ></textarea>
                                <label for="obs">Observación</label>
                            </div>
                            
                            <div class="col s6 center-align" >
                                <br><br>
                                <button class="btn-large waves-effect waves-light green accent-4" type="submit" name="action">Guardar Proveedor
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