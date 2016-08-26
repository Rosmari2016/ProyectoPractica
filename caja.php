<?php
    session_start();
    require("inc/php_conexion.php");
    $db = new Db();
    if(!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
		header('location:error.php');
	}
    $usuario=$_SESSION['username'];
    $sql=$db->mysqli->query("SELECT * FROM usuarios WHERE usu='$usuario'");
    if($row=$sql->fetch_object()){
        $nombre_usu=$row->nom;
    }
    if(!empty($_POST['tmp_cantidad']) and !empty($_POST['tmp_nombre']) and !empty($_POST['tmp_valor'])){
        $tmp_cantidad=$_POST['tmp_cantidad'];
        $tmp_nombre=$_POST['tmp_nombre'];
        $tmp_valor=$_POST['tmp_valor'];
        $fechay=date("Y-m-d");
        $tmp_importe=$tmp_cantidad*$tmp_valor;
        $cmd="INSERT INTO caja_tmp(cod,nom,venta,cant,importe,existencia,usu)VALUES('0000','$tmp_nombre','$tmp_valor','$tmp_cantidad','$tmp_importe','$tmp_cantidad','$usuario'";
        $db->mysqli->query($cmd);
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
                      <form name="form1" action="" method="POST">
                          <div class="input-field">
                              <input type="text" autofocus class="validate" name="codigo" autocomplete="off" list="lista">
                                <datalist id="lista">
                                    <?php
                                        $can=$db->mysqli->query("SELECT * FROM producto");
                                        while($row=$can->fetch_object()){
                                            echo '<option value="'.$row->nom.'">';
                                        }
                                    
                                    ?>
                                </datalist>

                              <label for="codigo">Codigo de barra o Nombre del producto</label>
                          </div>
                      </form>
                      <?php
                        if(!empty($_POST['codigo'])){
                            $codigo=$_POST['codigo'];
                            $can=$db->mysqli->query("SELECT * FROM caja_tmp WHERE cod='$codigo' OR nom='$codigo'");
                            if($row=$can->fetch_object()){
                                $sql="UPDATE caja_tmp SET importe='$aventa', cant='$acant' WHERE cod='$dcodigo'";
                                $db->mysqli->query($sql);
                            }else{
                               
                                $can=$db->mysqli->query("SELECT * FROM producto WHERE cod='$codigo' OR nom='$codigo'");
                                if($row=$can->fetch_object()){
                                    if($_SESSION['tventa']=="venta"){
                                        
                                        $importe=$row->venta;
                                        $venta=$row->venta;
                                    }else{
                                        
                                        $importe=$row->mayor;
                                        $venta=$row->mayor;
                                    }
                                    $cod=$row->cod;
                                    $nom=$row->nom;
                                    $cant="1";
                                    $exitencia=$row->cantidad;
                                    $usu=$_SESSION['username'];
                                    $sql="INSERT INTO caja_tmp(cod,nom,venta,cant,importe,exitencia,usu)VALUES('$cod','$nom','$venta','$cant','$importe','$exitencia','$usu')";
                                    $db->mysqli->query($sql);
                                  
                                }else{
                                    echo '<div class="alert alert-error" align="center">
                                            <strong>    
                                                Producto no encontrado en la base de datos 
                                                <a href="#modal1" role="button" class="modal-trigger waves-effect waves-light btn green accent-4"><i class="material-icons">add</i></a>
                                            </strong>
                                         </div>';
                                }
                            }
                        }
                      
                      ?>
                  </div>


                  <div class="col s12 m4 l4">
                      <br>
                      <div class="chip center-align" style="width:100%;">
                          <img src="img/rosa.jpg" alt="Contact Person">
                          <b>Nombre del Cajero/a:</b> <?php echo $nombre_usu; ?>
                      </div>
                    
                  </div>
                  <div class="col s12">
                  <?php // $can=$db->mysqli->query("SELECT * FROM caja_tmp WHERE usu='$usuario'"); if($row=$can->fetch_object()){ echo '<div style="overflow:auto;width:100%;top:48px; height:200px">';} ?>
                      <table class="responsive-table">
                          <thead>
                              <tr>
                                  <th>Código</th>
                                  <th>Descripcion del Producto</th>
                                  <th>Valor Unitario</th>
                                  <th>Cant.</th>
                                  <th>Importe</th>
                                  <th>Existencia</th>
                              </tr>
                          </thead>
                          <tbody>
                          <?php $na=0; $can=$db->mysqli->query("SELECT * FROM caja_tmp WHERE usu='$usuario'");
                                while($row=$can->fetch_object()){   
                          ?>
                                <tr>
                                    <td><?php echo $row->cod ?></td>
                                    <td><?php echo $row->nom; ?></td>
                                    <td><a href="caja.php?id=<?php echo $row->cod.'&ddes='.$_SESSION['ddes'];?>">C$ <?php echo number_format($row->venta,2,",","."); ?></a></td>
                                    <td><a href="caja.php?idd=<?php echo $row->cod.'&ddes='.$_SESSION['ddes']; ?>"><?php echo $row->cant; ?></a></td>
                                    <td class="green accent-2"><div align="left">CS <?php echo number_format($row->importe,2,",",".") ?></div></td>
                                    <td>
                                        <?php
                                            if(($row->exitencia-$row->cant)>0){
                                                echo $row->exitencia-$row->cant;
                                            }else{
                                                echo 0;
                                            }
                                        
                                        ?>
                                    </td>
                                    <td><button class="waves-effect waves-light btn red" onClick="window.location='php_eliminar_caja.php?id=<?php echo $row->cod; ?>'"><i class="left material-icons">delete</i>Remover</button></td>
                                </tr>
                                <?php } ?>
                          </tbody>
                      </table>
                      
                  </div>
                  
                  <?php
                        if(!empty($_GET['id'])){
                      ?>
                            <br><br><br>
                            <form class="col s12" name="form2" method="get" action="php_caja_act.php">
                                <div class="row">
                                  <input class="validate" type="hidden" name="xcodigo" value="<?php echo $_GET['id']; ?>">
                                    <div class="input-field col s2">
                                        <input class="validate" type="text" name="xdes" id="xdes"  autocomplete="off">
                                        <label for="">Nuevo Precio o % Descuento</label>
                                    </div>
                                    <div class="col s2">
                                        <br><br>
                                        <input type="radio" name="group1" id="test1" value="p"  checked>
                                        <label for="test1">Descuento %</label>    
                                    </div>
                                    <div class="col s2">
                                        <br><br>
                                        <input type="radio" name="group1" id="test2" value="d">
                                        <label for="test2">Nuevo Precio C$</label>
                                    </div>
                                    <div class="col s2">
                                        <br><br>
                                        <button type="submit" class="waves-effect waves-light btn green accent-4">Procesar</button>
                                    </div>
                                </div>
                            </form>
                      <?php } ?>
                      <?php
                        if(!empty($_GET['idd'])){
                      ?>
                            <form class="col s12" action="">
                                <input type="hidden" name="xcodigo" id="xcodigo" value="<?php echo $_GET['idd']; ?>">
                                <div class="row">
                                    <div class="input-field col s2">
                                        <input autofocus type="text" name="cantidad" id="cantidad" autocomplete="off" class="validate">
                                        <label for="cantidad">Cantidad</label>
                                    </div>
                                    <div class="col s2">
                                        <br><br>
                                        <button type="submit" class="waves-effect waves-light btn green accent-4">Procesar</button>
                                    </div>
                                </div>
                            
                            </form>
                      <?php } ?>
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