<?php
    session_start();
    require("inc/php_conexion.php");
    $db = new Db();
    $mensaje="0";
    if(!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
			header('location:error.php');
	}

    require_once("inc/php_datos_empresa_CRUD.php");
    
    $resultado=$db->mysqli->query("SELECT * FROM empresa WHERE id=1");
    if($row=$resultado->fetch_object()){
        $empresa=$row->empresa;
        $nit=$row->nit;
        $direccion=$row->direccion;
        $ciudad=$row->ciudad;
        $tel1=$row->tel1;
        $tel2=$row->tel2;
        $web=$row->web;
        $correo=$row->correo;
        $tamano=$row->tamano;
        if(empty($row->iva)){
            $iva="0";
        }else{
            $iva=$row->iva;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Empresa</title>
	
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
						<a href="datos_empresa.php" class="collection-item active">Datos de la empresa</a>
						<a href="seccion.php" class="collection-item">Administrar Secciones de Inventarios</a>
						<a href="caja.php" class="collection-item">Ventas</a>							
					</div>
                </aside>
            </div>

            <div class="col s12 m4 l10">
                <div class="card-panel green accent-3" style="padding:2px;">
                    <h5 class="center-align" style="color:white;">Actualizar Datos de la empresa</h5>
                </div>
                <div class="row">    
                    <form  name="form1" method="POST" enctype="multipart/form-data" action="">
                      <div class="col s8">
                            <div class="row">
                                <div class="input-field col s6">
                                    <input type="text" class="validate" name="empresa" id="empresa" value="<?php echo $empresa;?>" required>
                                    <label for="empresa">Nombre Empresa</label>
                                </div>
                        
                                <div class="input-field col s6">
                                    <input type="text" class="validate" name="nit" id="nit" value="<?php echo $nit; ?>" required>
                                    <label for="nit">NIT</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" class="validate" name="direccion" id="direccion" value="<?php echo $direccion; ?>">
                                    <label for="direccion">Dirección</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" class="validate" name="ciudad" id="ciudad" value="<?php echo $ciudad; ?>">
                                    <label for="ciudad">Ciudad</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" class="validate" name="celular" id="celular" value="<?php echo $tel2; ?>">
                                    <label for="celular">Celular</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" class="validate" name="telefono" id="telefono" value="<?php echo $tel1;?>">
                                    <label for="telefono">Telefono</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="email" class="validate" name="correo" id="correo" value="<?php echo $correo; ?>">
                                    <label for="correo">Correo</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" class="validate" name="web" id="web" value="<?php echo $web;?>">
                                    <label for="pagina">Pagina Web</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="number" class="validate" min="0" max="100" name="iva" id="iva" value="<?php echo $iva; ?>">
                                    <label for="iva">IVA</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="number" class="validate" min="0" max="100" name="tamano" id="tamano" value="<?php echo $tamano;?>">
                                    <label for="ticket">Tamaño de impresion del Ticket</label>
                                </div>
                                <div class="col s12">
                                    <button class="btn btn-large waves-effect waves-light green accent-4" type="submit">Actualizar Datos
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                            </div>
                      </div> 
                       <div class="col s4 center-align">
                            <strong>Subir Logo Empresarial</strong><br/><br/>
                            <img src="img/logo.png" width="200" height="200" class="z-depth-2 responsive-img">
                            <div class="file-field input-field">
                                <div class="btn green accent-4">
                                    <i class="material-icons">picture_in_picture</i>
                                    <input type="file" name="imagen" id="imagen" multiple>
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" placeholder="Ningún archivo seleccionado">
                                </div>
                            </div>
                            <?php
                                if($mensaje=="1"){
                                    echo '<div class="alert alert-success">
                                            <strong>Datos de la Empresa!</strong> Actualizado con Exito
                                          </div>';
                                }
                            ?>
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
</body>
</html>