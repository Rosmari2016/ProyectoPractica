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

    if(!empty($_GET['mensaje'])){
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
             @media print{
                #ocultar{
                    display: none;
                }
            }
	</style>
	<link rel="shortcut icon" type="image/x-icon" href="ico/favicon.png">
    <script language="javascript">
        function imprimir(){
            this.print();
        }
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
    <div id="ocultar">
        <?php
            if ($_SESSION['tipo_usu']=='a'){
                require_once "menu_admin.php";
            }
        ?>
    </div>
    
     <?php
        if($error=='si'){
    ?>
        <div class="alert alert-error" align="center">
            <strong>El dinero recibido es menor al valor a pagar</strong><br>
            <strong><a href="caja.php?ddes=<?php echo $_SESSION['ddes'];?>">Regresar a la caja</a></strong>
        </div>
    <?php } 
        if($error=='num'){
            echo '<div class="alert alert-error" align="center">
                    <strong>Solo debe de ingresar numeros en este campo</strong><br>
                    <strong><a href="caja.php?ddes='.$_SESSION['ddes'].'">Regresar a la caja</a></strong>
                </div>';
        }

    ?>

    <main>
        <?php if($error=='no'){ ?>
        <div id="ocultar">
            <div class="center-align">
                <a href="caja.php?ddes=0" class="waves-effect waves-light btn green accent-4"><i class="material-icons left">fast_rewind</i> Regresar Ventas</a>
                <a class="waves-effect waves-light btn green accent-4" onclick="imprimir();"><i class="material-icons left">print</i> Imprimir Factura</a>
            </div>
        <div/>
            <br>
            <div id="impresion">
                <div class="row">
                    <div class="col s12 m12 l6">
                        <div class="row">
                            <div class="chip col s12 m12 l12 center-align green-text" style="font-size:24px;padding-bottom:40px;padding-top:20px;"><strong>Total a Pagar</strong></div>
                            <div class="chip col s12 m12 l12 center-align black-text" style="font-size:24px;padding-bottom:40px;padding-top:20px;"><strong>C$ <?php echo number_format($tpagar,2,",","."); ?></strong></div>
                            <div class="chip col s12 m12 l12 center-align green-text" style="font-size:24px;padding-bottom:40px;padding-top:20px;"><strong>Dinero Recibido</strong></div>
                            <div class="chip col s12 m12 l12 center-align black-text" style="font-size:24px;padding-bottom:40px;padding-top:20px;"><strong>C$ <?php echo number_format($ccpago,2,",","."); ?></strong></div>
                            <div class="chip col s12 m12 l12 center-align green-text" style="font-size:24px;padding-bottom:40px;padding-top:20px;"><strong>Cambio</strong></div>
                            <div class="chip col s12 m12 l12 center-align black-text" style="font-size:24px;padding-bottom:40px;padding-top:20px;"><strong>C$ <?php echo number_format($cambio,2,",","."); ?></strong></div>
                            
                            <div id="ocultar" class="alert-success col s12 m12 l12 center-align green-text" style="font-size:1.3em;margin-top:30px;margin-bottom:25px;">
                                <strong>Pago Realizado con exito</strong><br><a href="caja.php?ddes=0">Regresar a la caja</a>
                                
                            </div>
                            
                            <center><a class="waves-effect waves-light btn-large green accent-4" onclick="imprimir();"><i class="material-icons left">print</i> Imprimir Factura</a></center>
                       
                            
                        </div>
                    </div>
                    <div class="col s12 m12 l6">
                        <!-- codigo imprimir -->
                        <?php
                            $can=$db->mysqli->query("SELECT * FROM empresa WHERE id=1");
                            if($row=$can->fetch_object()){
                                $empresa=$row->empresa; $direccion=$row->direccion;
                                $telefono=$row->tel1;   $nit=$row->nit;
                                $fecha=date("Y-m-d H:i:s"); $pagina=$row->web;
                                $tama=$row->tamano;
                            }
                            $can=$db->mysqli->query("SELECT usuarios.nom AS cajera FROM factura INNER JOIN usuarios ON usuarios.usu=factura.cajera WHERE factura='$factura'");
                            if($row=$can->fetch_object()){
                                $cajera=$row->cajera;
                            }
                           
                        ?>
                        <div id="Imprime" style="font-size:<?php echo $tama.'px;'; ?>">
                            <table width="100%">
                                <tr>
                                    <td>
                                        <strong><?php echo $empresa; ?></strong><br/>
                                        <?php echo $direccion;?><br/>
                                        <?php echo $telefono;?><br/>
                                        <?php echo $nit; ?><br/>
                                    </td>
                                    <td class="right-align"><?php echo $fecha;?></td>
                                </tr>
                                <tr>
                                    <td>Cajero/a: <?php echo $cajera;?></td>
                                </tr>
                            </table>
                            <br>
                            <table width="100%" class="responsive-table">
                                <thead>
                                    <tr>
                                        <th>CANT</th>
                                        <th>DESCRIPCIÓN</th>
                                        <th class="right-align">IMPORTE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $numero=0;$valor=0;
                                    $query=$db->mysqli->query("SELECT * FROM detalle WHERE factura='$factura'");
                                    while($row=$query->fetch_object()){
                                        $numero+=1;
                                        $valor+=$row->valor;
                                        $tipo=$row->tipo;
                                ?>
                                        <tr>
                                            <td><?php echo $row->cantidad; ?></td>
                                            <td><?php echo $row->nombre; ?></td>
                                            <td class="right-align">C$ <?php echo number_format($row->valor,2,",","."); ?></td>
                                        </tr>
                                <?php } ?>
                                </tbody>      
                            </table>
                            <div class="center-align">
                                NO. DE ARTICULOS: <?php echo $numero; ?><br>
                                <strong>* VENTA A <?php echo $tipo; ?>*</strong><br>
                                <strong>TOTAL: C$ <?php echo number_format($valor,2,",",".");?></strong>
                                <p>FIRMA DEL CLIENTE</p>
                                <p>__________________________</p>
                                 GRACIAS POR SU COMPRA<br>
                                <?php echo $pagina; ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        <?php } ?>
    </main>  

   


    <footer class="page-footer green accent-4">
		<div class="footer-copyright">
        
			© 2016 Copyright Rosa Lumbí, Yuritza Solis, Freddy Sirias
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