<?php
    session_start();
    require("inc/php_conexion.php");
    $db = new Db();
    if(!$_SESSION['tipo_usu']=='a'){
        header('location:error.php');
    }

    if(!empty($_GET['tpagar']) and !empty($_GET['ccpago']) and !empty($_GET['factura'])){
        $tpagar=$_GET['tpagar'];
        $ccpago=$_GET['ccpago'];
        $factura=$_GET['factura'];
        $cambio=$ccpago-$tpagar;
    }

    if(!empty($_GET['mensjae'])){
        $error='si';
    }else{
        $error='no';
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contado</title>
    <style type="text/css" media="print">
        #Imprime{
            height:auto;
            width:310;
            margin:0px;
            padding:0px;
            float:left;
            font-family:Arial,Helvetica,sans-serif;
            color:#000;

        }
        @page{
            margin:0;
        }
    </style>
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
    <script language="javascript">
        function imprSelect(nombre){
            var ficha = document.getElementById(nombre);
            var ventimp = window.open(' ','popimpr');
            ventimp.document.write( ficha.innerHTML);
            ventimp.document.close();
            ventimp.print();
            ventimp.close();
        }
    </script>

</head>
<body>
    <?php
		if ($_SESSION['tipo_usu']=='a'){
			require_once "menu_admin.php";
		}
	?>

    <main>
        <?php if($error='no'){ ?>
        <div id="ocultar">
            <div class="center-align">
                <a href="caja.php?ddes=0" class="waves-effect waves-light btn green accent-4"><i class="material-icons left">fast_rewind</i> Regresar Ventas</a>
                <a class="waves-effect waves-light btn green accent-4" onclick="imprimir();"><i class="material-icons left">print</i> Imprimir Factura</a>
            </div>
            <div id="impresion">
                <div class="row">
                    <div class="col s6">
                        <div class="row">
                            <div class="chips col s12" style="font-size:24px"><strong></strong></div>
                            <div class="chips col s12" style="font-size:24px"><strong></strong></div>
                            <div class="chips col s12" style="font-size:24px"><strong></strong></div>
                            <div class="chips col s12" style="font-size:24px"><strong></strong></div>
                            <div class="chips col s12" style="font-size:24px"><strong></strong></div>
                            <div class="chips col s12" style="font-size:24px"><strong></strong></div>
                        </div>
                    </div>
                    <div class="col s6">
                    
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
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