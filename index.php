<?php 
	 session_start();
    require("inc/php_conexion.php");
	$db = new Db();
	require_once("inc/php_funciones.php");
	$act="0";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
    <meta name="author" content="">

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

		body {
		background: #fffde7;
		}

		.input-field input[type=date]:focus + label,
		.input-field input[type=text]:focus + label,
		.input-field input[type=email]:focus + label,
		.input-field input[type=password]:focus + label {
		color: #00c853;
		}

		.input-field input[type=date]:focus,
		.input-field input[type=text]:focus,
		.input-field input[type=email]:focus,
		.input-field input[type=password]:focus {
		border-bottom: 2px solid #00c853;
		box-shadow: none;
		}
		h5{
			color:#00c853;
		}
  </style>
	<link rel="shortcut icon" type="image/x-icon" href="ico/favicon.png">
</head>
<body>
	
	<main>
		<div class="center-align">
		<img class="responsive-img" style="width: 250px;" src="" />
		

		<h5 class="">Por favor, iniciar sesión en su cuenta</h5>
		<div class="section"></div>

		<div class="container">
			<div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

			<form name="form1"class="col s12" method="post" action="">
				<div class='row'>
				<div class='col s12'>
				</div>
				<h3>Bienvenidos</h3>
				</div>
				<?php
					$act="1";
					if(!empty($_POST['usuario']) and !empty($_POST['contra'])){
						$usuario=trim($_POST['usuario']);
						$contra=trim($_POST['contra']);
						$sql = "SELECT * FROM usuarios WHERE (usu='".$usuario."' or ced='".$usuario."') and con='".$contra."'";
						$resultado=$db->mysqli->query($sql);
					
						if ($row=$resultado->fetch_object()){
							
							$_SESSION['cod_user']=$row->ced;
							$_SESSION['username']=$row->usu;
							$_SESSION['tipo_usu']=$row->tipo;
							//inicializa las variables de caja por defecto
							$_SESSION['tventa']="venta";
							$_SESSION['ddes']=0;
							//////////////////////////////////////////////
							if ($_SESSION['tipo_usu']=='a' OR $_SESSION['tipo_usu']=='ca'){
								echo mensajes('Bienvenido<br/>'.$row->nom,'verde').'<br/>';	 
								echo '<div class="center-align">
										<div class="preloader-wrapper big active">
											<div class="spinner-layer spinner-green-only">
											<div class="circle-clipper left">
												<div class="circle"></div>
											</div><div class="gap-patch">
												<div class="circle"></div>
											</div><div class="circle-clipper right">
												<div class="circle"></div>
											</div>
											</div>
										</div>
								
									</div>			
								<br/>';
								echo '<meta http-equiv="refresh" content="2;url=empresa.php">';
							}
						}else{
							if($act=="1"){
								echo mensajes('Usuario y Contraseña Incorrecto<br>','rojo');
								echo '<div class="center-align"><a href="index.php" class="btn green accent-4"><strong>Intentar de Nuevo</strong><a/></div><br/>';
							}else{$act=="0";}
						}
					}else{
						echo '<div class="row">
								<div class="input-field col s12">
									<input class="validate" type="text" name="usuario" />
									<label for="user">Introduce tu usuario</label>
								</div>
							</div>';

						echo '<div class="row">
									<div class="input-field col s12">
										<input class="validate" type="password" name="contra"  />
										<label for="password">Introduce tu contraseña</label>
									</div>
								</div>';
						
						echo '<br />
							<div class="center-align">
								<div class="row">
									<button type="submit" name="btn_login" class="col s12 btn btn-large waves-effect indigo green accent-4">Entrar</button>
								</div>
							</div>';
					}
				
				?>
				
				
			</form>
			</div>
		</div>
		</div>

		<div class="section"></div>
	
	</main>
	 	

	<footer class="page-footer green accent-4">
		<div class="footer-copyright">
			© 2016 Copyright Rosa Marina Lumbí Suárez
				<!--<a class="grey-text text-lighten-4 right" href="#!">More Links</a>-->
		</div>
   	</footer>

	<script type="text/javascript" src="js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>

</body>
</html>