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
    <?php
		if ($_SESSION['tipo_usu']=='a'){
			require_once "menu_admin.php";
		}
	?>

      <main>
          <section>
              <div class="row">
                  <div class="col s12 m4 l4">
                      <br>
                      <a class="modal-trigger waves-effect waves-light btn green accent-4" href="#modal1"><i class="material-icons left">done</i>Agregar producto rápido</a>
                  </div>
                  <div class="col s12 m4 l4">
                      <form name="form1" action="">
                          <div class="input-field">
                              <input type="text" class="validate">
                              <label for="codigo">Codigo de barra o Nombre del producto</label>
                          </div>
                      </form>
                  </div>
                  <div class="col s12 m4 l4">
                      <br>
                      <div class="chip center-align" style="width:100%;">
                          <img src="img/rosa.jpg" alt="Contact Person">
                          <b>Nombre del Cajero/a:</b>  Rosa Lumbí
                      </div>
                    
                  </div>
                  <div class="col s12">
                      <table class="responsive-table">
                          <thead>
                              <tr>
                                  <th>Código</th>
                                  <th>Descrpcion del Producto</th>
                                  <th>Valor Unitario</th>
                                  <th>Cant.</th>
                                  <th>Importe</th>
                                  <th>Existencia</th>
                              </tr>
                          </thead>
                        
                      </table>
                  </div>
              </div>
              <br>
              <div class="row">
                  <div class="col s12 m4 l4">
                      <div class="chip center-align" style="width:100%;height:70px;">
                          <h4>0 Articulos en venta</h4>
                      </div>
                  </div>
                  <div class="col s12 m4 l4">
                      <form name="form3" action="">
                          <div class="row">
                              <div class="input-field col s6">
                                  <input type="number" class="validate" placeholder="0">
                                  <label for="Descuento">Descuento al Neto</label>
                              </div>
                              <div class="col s4">
                                  <br>
                                  <button class="btn waves-effect waves-light green accent-4" type="submit" name="action">Aplicar
                                        <i class="material-icons right">send</i>
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
                  <div class="col s12 m4 l4">
                      <div class="chip right-align" style="width:100%;height:70px;">
                          <h4>Neto: C$ 0,00</h4>
                      </div>
                  </div>
              </div>
          </section>

          <div id="modal1" class="modal modal-fixed-footer">
              <form name="form1" class="col s12" action="">
                <div class="modal-content">
                    <h4>Agregar producto rápido</h4>
                    <br>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" class="validate">
                                <label for="descripcion">Descripción</label>
                            </div>
                            <div class="input-field col s12">
                                <input type="number" class="validate">
                                <label for="cantidad">Cantidad</label>
                            </div>
                            <div class="input-field col s12">
                                <input type="number" class="validate">
                                <label for="valor">Valor</label>
                            </div>
                        </div>
                
                </div>
                <div class="modal-footer">
                    
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
                    <button class="btn waves-effect waves-light green accent-4" type="submit" name="action">Guardar
                        <i class="material-icons left">send</i>
                    </button>
                </div>
             </form>
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
            $('.modal-trigger').leanModal()
        });
	</script>
</body>
</html>