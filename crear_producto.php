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
	<title>Inventario</title>
	
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
								<div class="collection-header"><h4 class="collection-header-with">Acciones</h4></div>
                                <div class="divider"></div>
								<a href="#!" class="collection-item">Buscar Producto</a>
								<a href="crear_producto.php" class="collection-item active">Crear Producto</a>
                               
								<a href="#" class="collection-item">Buscar Proveedor</a>
                                <a href="#" class="collection-item">Crear  Proveedor</a>
							</div>	
					</aside>
				</div>
				
				<div class="col s12 m12 l10">
                     <div class="card-panel green accent-3" style="padding:2px;">
                        <h5 class="center-align" style="color:white;">Creación de Productos</h5>
                    </div>
					<div class="row">
                        <form class="col s6" method="POST" action="">
                             <div class="input-field col s6">
                                 <input type="text" class="validate" id="ccodigo" name="ccodigo" placeholder="Código del articulo">
                                 
                             </div>
                             <div class="input-field col s6">
                                <br>
                                <button class="btn waves-effect waves-light green accent-4" type="submit">Confirmar Código
                                    <i class="material-icons right">send</i>
                                 </button>
                             </div>
                        </form>
                        
                        <form class="col s12" enctype="multipart/form-data" action="">
                            <?php
                                if(!empty($_POST['ccodigo']) or !empty($_GET['codigo'])){
                                    $prov='';$nom='';$costo='0';$mayor='0';$cantidad='0';$minimo='0';$seccion='';$codigo='';$venta='0';$cprov='';
                                    $fechax=date("d").'/'.date("m").'/'.date("Y");
                                    $fechay=date("Y-m-d");
                                    if(!empty($_GET['codigo'])){
                                        $codigo=$_GET['codigo'];
                                    }
                                    if (!empty($_POST['ccodigo'])){
                                        $codigo=$_POST['ccodigo'];  
                                    }
                                    $can = $db->mysqli->query("SELECT * FROM producto WHERE cod='$codigo'");
                                    if ($row=$can->fetch_object()){
                                        $prov=$row->prov;
                                        $cprov=$row->cprov;
                                        $nom=$row->nom;
                                        $costo=$row->costo;
                                        $mayor=$row->mayor;
                                        $venta=$row->venta;
                                        $cantidad=$row->cantidad;
                                        $minimo=$row->minimo;
                                        $seccion=$row->seccion;
                                        $fechay=$row->fecha;
                                        $boton="Actualizar producto";
                                        $icon="mode_edit";
                                        echo '<div class="alert alert-success"><strong>Producto / Articulo '.$nom.'</strong> con el codigo '.$codigo.' ya existe</div>';   
                                    }else{
                                        $boton="Guardar Producto";
                                        $icon="send";
                                    }
                                

                        ?>
                         <div class="col s8">
                            <div class="row">
                                
                                <div class="input-field col s6">
                                    <input type="text" class="validate" name="codigo" id="codigo" value="<?php echo $codigo; ?>" readonly>
                                    <label for="icon_prefix">Codigo</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="number" class="validate" name="mayor" id="mayor" value="<?php echo $mayor; ?>" required>
                                    <label for="icon_prefix">Precio Mayoreo</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" class="validate" name="nom" id="nom" value="<?php echo $nom; ?>" required>
                                    <label for="icon_prefix">Nombre</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="number" class="validate" name="cantidad" id="cantidad" value="<?php echo $cantidad; ?>" required>
                                    <label for="icon_prefix">Cantidad Actual</label>
                                </div>
                                <div class="input-field col s6">
                                    <select name="prov" id="prov">
                                         <?php 
                                            $can=$db->mysqli->query("SELECT * FROM proveedor WHERE estado='s'");
                                            while($row=$can->fetch_object())
                                            {
                                         ?>
                                                <option value="<?php echo $row->codigo; ?>" <?php if($prov==$row->codigo){ echo 'selected';} ?>><?php echo $row->empresa; ?></option>
                                       <?php } ?>
                                    </select>   
                                    <label>Proveedor</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="number" class="validate" name="minimo" id="minimo" value="<?php echo $minimo; ?>" required>
                                    <label for="icon_prefix">Cantidad Minima</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" class="validate" name="cprov" id="cprov" value="<?php echo $cprov; ?>" required>
                                    <label for="icon_prefix">Cod. Articulo del Proveedor</label>
                                </div>
                                <div class="input-field col s6">
                                    <select name="seccion" id="seccion">
                                        <?php 
                                            $can=$db->mysqli->query("SELECT * FROM seccion WHERE estado='s'");
                                            while($row=$can->fetch_object())
                                            {
                                        ?>
                                               <option value="<?php echo $row->id; ?>" <?php if ($seccion==$row->id){ echo 'selected';} ?>><?php echo $row->nombre; ?></option>
                                       <?php } ?>
                                    </select>
                                    <label>Seleccion del Articulo</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="date" class="datepicker" name="fecha" id="fecha" value="<?php echo $fechay; ?>" required>
                                    <label for="icon_prefix">Fecha</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="number" class="validate" name="venta" id="venta" value="<?php echo $venta;?>" required>
                                    <label for="icon_prefix">Precio Venta</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="number" class="validate" name="costo" id="costo" value="<?php echo $costo; ?>" required>
                                    <label for="icon_prefix">Precio Costo</label>
                                </div>
                                <div class="col s6">
                                    <br>
                                    <button class="btn waves-effect waves-light green accent-4" type="submit" name="action"><?php echo $boton; ?>
                                        <i class="material-icons right"><?php echo $icon; ?></i>
                                    </button>
                                </div>
                                <div class="col s6">
                                
                                </div>
                            </div>
                            
                           </div>
                            <div class="col s4 center-align"><br><br>
                                <h4 style="font-size:1.5em;">Imagen del Producto</h4>
                                <br><br>
                                
                                <img src="img/articulo/producto.png" width="200" height="200" class="responsive-img">
                                <div class="file-field input-field ">
                                    <div class="btn green accent-4">
                                        <i class="material-icons">picture_in_picture</i>
                                        <input type="file" multiple>
                                    </div>
                                    <div class="file-path-wrapper ">
                                        <input class="file-path validate" type="text" placeholder="Ningún archivo seleccionado">
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
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
            $('select').material_select();

            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15 // Creates a dropdown of 15 years to control year
            });
        });
	</script> 
</body>
</html>