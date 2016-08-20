<?php
    session_start();
    require("inc/php_conexion.php");
	$db = new Db();
    if (!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
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
            
			<div class="row">
				<div class="col s12 m4 l2">
					
					<aside>
							<div class="collection">
								<div class="collection-header"><h4 class="collection-header-with">Configuración</h4></div>
								<a href="datos_empresa.php" class="collection-item">Datos de la empresa</a>
								<a href="seccion.php" class="collection-item">Administrar Secciones de Inventarios</a>
								<a href="caja.php" class="collection-item">Ventas</a>
							</div>	
					</aside>
				</div>
				
				<div class="col s12 m4 l10">
					<div class="fixed-action-btn horizontal " style="bottom: 45px; right: 24px;">
						<a class="btn-floating btn-large green accent-4">
							<i class="material-icons">menu</i> Reporte PDF
						</a>
						<ul>
							<li><a class="btn-floating green"><i class="material-icons">print</i></a></li>
						</ul>
					</div>
					<table class="responsive-table">
						<thead>
							<tr colspan="6"><center><b>Productos de Baja Existencia</b></center></tr>
							<tr>
								<th>Código</th>
								<th>Descripción del Productos</th>
								<th>Costo</th>
								<th>Venta a por Mayor</th>
								<th>Valor Venta</th>
								<th>Existencia</th>
							</tr>
						</thead>
						<tbody>
                             <?php
                                $mensaje='no';
                                $resultado=$db->mysqli->query("SELECT * FROM producto");
                                while($row=$resultado->fetch_assoc()){
                                    $cant=$row['cantidad'];
                                    $minima=$row['minimo'];
                                    if($cant<=$minima){
                                        $mensaje='si';
                                    
                            ?>
							<tr>
								<td><?php echo $row['cod']; ?></td>
								<td><a href="crear_producto.php?codigo=<?php echo $row['cod']; ?>"><?php echo $row['nom']; ?></a></td>
								<td>C$ <?php echo number_format($row['costo'],2,",","."); ?></td>
								<td>C$ <?php echo number_format($row['mayor'],2,",","."); ?></td>
								<td>C$ <?php echo number_format($row['venta'],2,",","."); ?></td>
								<td><span class="new badge red" data-badge-caption=""><?php echo $cant; ?></span></td>
							</tr>
                            <?php   } 
                                }
                            ?>
						</tbody>
					</table>
					<br><br>
                    <?php if ($mensaje=='no'){
                        echo '<div class="alert alert-success center-align"><strong>No existen articulos bajos de stock!</strong></div>';
                    } ?>
					<table class="responsive-table ">
						<thead>
							<tr colspan="6"><center><b>Listado y Totales de Productos</b></center></tr>
							<tr>
								<th>Código</th>
								<th>Descripción del Productos</th>
								<th>Costo</th>
								<th>Venta a por Mayor</th>
								<th>Valor Venta</th>
								<th>Existencia</th>
							</tr>
						</thead>
						<tbody>
							<?php 
                                $mensaje='no';$costo=0;$mayor=0;$venta=0;$art=0;
                                $can=$db->mysqli->query("SELECT * FROM producto");
                                while($row=$can->fetch_assoc()){
                                    $cant=$row['cantidad'];
                                    $minima=$row['minimo'];
                                    $mensaje2='si';
                                    $art+=$cant;
                                    $costo+=($row['costo']*$row['cantidad']);
                                    $mayor+=($row['mayor']*$row['cantidad']);
                                    $venta+=($row['venta']*$row['cantidad']);
                                    if($cant<=$minima){
                                        $cantidad='<span class="new badge red" data-badge-caption="">'.$cant.'</span>';
                                    }else{
                                        $cantidad='<span class="new badge green accent-4" data-badge-caption="">'.$cant.'</span';
                                    }   
                                
                            
                            ?>
							<tr>
								<td><?php echo $row['cod'];?></td>
								<td><a href="crear_producto.php?codigo=<?php echo $row['cod']; ?>"><?php echo $row['nom']; ?></a></td>
								<td>C$ <?php echo number_format($row['costo'],2,",",".")?></td>
								<td>C$ <?php echo number_format($row['mayor'],2,",",".")?></td>
								<td>C$ <?php echo number_format($row['venta'],2,",",".")?></td>
								<td><?php echo $cantidad; ?></td>
							</tr>
                            <?php } 
                                if ($mensaje2=='2'){                       
                            ?>
                                    <tr>
                                        <td><div class="alert alert-error"><strong>No hay articulos registrados actualmente</strong></div></td>
                                    </tr>
                            <?php } ?>
							
							
							<tr>
								<td>&nbsp</td>
								<td><div align="right"><strong>Totales:</strong></div></td>
								<td><div align=""><strong>C$ <?php echo number_format($costo,2,",","."); ?></strong></div></td>
								<td><div align=""><strong>C$ <?php echo number_format($mayor,2,",","."); ?></strong></div></td>
								<td><div align=""><strong>C$ <?php echo number_format($venta,2,",","."); ?></strong></div></td>
								<td><span class="new badge blue" data-badge-caption=""><?php echo $art; ?></span></td>
							</tr>
						</tbody>
					</table>
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