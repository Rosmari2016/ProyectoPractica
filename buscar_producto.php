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
                        <div class="collection-header"><h4 class="collection-header-with">Acciones</h4></div>
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
                    <div class="col s12">
                        <table class="responsive-table">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>&nbsp;</th>
                                    <th>Nombre del producto</th>
                                    <th>Estado</th>
                                    <th>Proveedor</th>
                                    <th>Cod. del proveedor</th>
                                    <th>Valor Venta</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if(empty($_POST['bus'])){
                                        $query=$db->mysqli->query("SELECT producto.cod AS cod, producto.nom as nom, producto.cprov as cprov, proveedor.empresa as empresa, producto.venta as venta, producto.estado as estado
                                                                         FROM producto INNER JOIN proveedor ON proveedor.codigo=producto.prov");
                                    }else{
                                        $buscar=$_POST['bus'];
                                        $query=$db->mysqli->query("SELECT producto.cod AS cod, producto.nom as nom, producto.cprov as cprov, proveedor.empresa as empresa, producto.venta as venta,producto.estado as estado
                                                                                 FROM producto INNER JOIN proveedor ON proveedor.codigo=producto.prov
                                                                                 WHERE producto.nom LIKE '$buscar%' OR producto.cod LIKE '$buscar%' OR producto.cprov LIKE '$buscar%'");
                                    }
                                    while($row=$query->fetch_object()){
                                        $codigo=$row->cod;
                                        if($row->estado=="n"){
                                            $estado='<span class="new badge red" data-badge-caption="">Inactivo</span>';
                                        }else{
                                            $estado='<span class="new badge green accent-4" data-badge-caption="">Activo</span';
                                        }                                
                                ?>
                                        <tr>
                                            <td>
                                                <?php
                                                    if(file_exists("img/articulo".$codigo.".jpg")){
                                                        echo '<img src="img/articulo/'.$codigo.'.jpg" width="50" height="50">';
                                                    }else{
                                                        echo '<img src="img/articulo/producto.png" width="50" height="50">';
                                                    }
                                                ?>
                                            </td>
                                            <td><?php echo $row->cod; ?></td>
                                            <td><a href="crear_producto.php?codigo=<?php echo $row->cod; ?>"><?php echo $row->nom; ?></a></td>
                                            <td><a href="inc/php_estado_producto.php?id=<?php echo $row->cod; ?>"><?php echo $estado; ?></a></td>
                                            <td><?php echo $row->empresa; ?></td>
                                            <td><?php echo $row->cprov;?></td>
                                            <td><?php echo number_format($row->venta,2,",","."); ?></td>
                                        </tr>
                             <?php } ?>
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
        </div>
    </main>
        <div class="fixed-action-btn horizontal " style="bottom: 45px; right: 24px;">
			<a class="btn-floating btn-large green accent-4">
				<i class="material-icons">menu</i> Reporte PDF
			</a>
			<ul>
                <li><a href="crear_producto.php" class="btn-floating green"><i class="material-icons">add</i></a></li>
				<li><a class="btn-floating green"><i class="material-icons">print</i></a></li>
			</ul>
		</div>
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