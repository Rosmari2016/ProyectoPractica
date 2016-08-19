<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Administrador/a</title>
	
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
    <ul id="dropdown1" class="dropdown-content">
	  <li><a href="#!"><i class="material-icons left">settings_backup_restore</i>Cambiar Contraseña</a></li>
	  <li class="divider"></li>
	  <li><a href="#!"><i class="material-icons left">power_settings_new</i>Salir</a></li>
	</ul>
	<nav>
	    <div class="nav-wrapper green accent-4">
	      <!--<a href="#!" class="brand-logo">Logo</a>-->
	      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
	      <ul class="left hide-on-med-and-down">
	        <li class="active"><a href="#"><i class="material-icons left">library_books</i>Inventarios</a></li>
	        <li><a href="caja.php"><i class="material-icons left">shopping_cart</i>Ventas</a></li>
	        <li><a href="#"><i class="material-icons left">assignment</i> Reportes</a></li>
	        
	      </ul>
	      <ul class="right hide-on-med-and-down">
	      	<li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons left">perm_identity</i>Hola! Rosmari<i class="material-icons right">arrow_drop_down</i></a></li>
	      </ul>

	      <ul class="side-nav" id="mobile-demo">
	        <li><a href="#">Inventarios</a></li>
	        <li><a href="caja.php">Ventas</a></li>
	        <li><a href="#">Reportes</a></li>
	      </ul>

	    </div>
	  </nav>
	
		<br>
		<main>
			<div class="row">
				<div class="col s12 m4 l2">
					
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
				
				<div class="col s12 m4 l6">
					<div class="row">
                        <form class="col s12" action="">
                             <div class="input-field col s6">
                                 <input type="text" class="validate" placeholder="Código del articulo">
                                 
                             </div>
                             <div class="input-field col s6">
                                <br>
                                <button class="btn waves-effect waves-light green accent-4" type="submit" name="action">Confirmar Código
                                    <i class="material-icons right">send</i>
                                 </button>
                             </div>
                        </form>
                        
                        <form class="col s12" action="">
                            
                            <div class="row">
                                
                                <div class="input-field col s6">
                                    <input type="text" class="validate" disabled>
                                    <label for="icon_prefix">Codigo</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="number" class="validate">
                                    <label for="icon_prefix">Precio Mayoreo</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" class="validate">
                                    <label for="icon_prefix">Nombre</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="number" class="validate">
                                    <label for="icon_prefix">Cantidad Actual</label>
                                </div>
                                <div class="input-field col s6">
                                    <select>
                                        <option value="1">Sinsa</option>
                                        <option value="2">Tecno</option>
                                        <option value="3">Ferromac</option>
                                    </select>
                                    <label>Proveedor</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="number" class="validate">
                                    <label for="icon_prefix">Cantidad Minima</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="text" class="validate">
                                    <label for="icon_prefix">Cod. Articulo del Proveedor</label>
                                </div>
                                <div class="input-field col s6">
                                    <select>
                                        <option value="1">Sinsa</option>
                                        <option value="2">Tecno</option>
                                        <option value="3">Ferromac</option>
                                    </select>
                                    <label>Seleccion del Articulo</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="date" class="datepicker">
                                    <label for="icon_prefix">Fecha</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="number" class="validate">
                                    <label for="icon_prefix">Precio Venta</label>
                                </div>
                                <div class="input-field col s6">
                                    <input type="number" class="validate">
                                    <label for="icon_prefix">Precio Costo</label>
                                </div>
                                <div class="col s6">
                                    <br>
                                    <button class="btn waves-effect waves-light green accent-4" type="submit" name="action">Guardar
                                        <i class="material-icons right">send</i>
                                    </button>
                                </div>
                                <div class="col s6">
                                
                                </div>
                            </div>
                        </form>
                    </div>				
				</div>

                <div class="col s12 m4 l4 center-align"><br><br>
                    <h4 style="font-size:1.5em;">Imagen del Producto</h4>
                    <br><br>
                    
                    <img src="img/articulo/producto.png" width="200" height="200" class="responsive-img">
                    <div class="file-field input-field ">
                        <div class="btn green accent-4">
                            <span>Seleccionar archivo</span>
                            <input type="file" multiple>
                        </div>
                        <div class="file-path-wrapper ">
                            <input class="file-path validate" type="text" placeholder="Ningún archivo seleccionado">
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
            $('select').material_select();

            $('.datepicker').pickadate({
                selectMonths: true, // Creates a dropdown to control month
                selectYears: 15 // Creates a dropdown of 15 years to control year
            });
        });
	</script> 
</body>
</html>