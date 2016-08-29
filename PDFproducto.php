<?php
    session_start();
    require_once("dompdf/dompdf_config.inc.php");
    require("inc/php_conexion.php");
	$db = new Db();
    if (!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
        header('location:error.php');
    }
    $query=$db->mysqli->query("SELECT * FROM empresa WHERE id=1");
    if($row=$query->fetch_object()){
        $empresa=$row->empresa;
        $nit=$row->nit;
        $direccion=$row->direccion;
        $ciudad=$row->ciudad;
        $tel1=$row->tel1;
        $tel2=$row->tel2;
        $web=$row->web;
        $correo=$row->correo;
    }
    $dias = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

    $hoy=$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]." del ".date('Y');
    $fech=date('d')."".$meses[date('n')-1]."".date('Y');

$codigoHTML=' 
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte</title>

<style type="text/css">
.text {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
}
</style>
</head>

<body>
<div align="center">
<table width="100%" border="0">
<caption class="text">
<strong>Informe de Productos</strong>
</caption>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="17"><center><img src="img/logo.png" width="100" height="75" alt="" /></center></td>
    <td width="83%" colspan="2">
      <div align="center">
        <span class="text">facturacion</span> <span class="text">Nit. 1234567899</span><br />
        <span class="text">Ciudad: Juigalpa Direccion: Chino. </span><br />
        <span class="text">TEL: 6679159 CEL: 3167658276</span><br />
        <span class="text">Reporte Impreso el '.$hoy.' por '.$_SESSION['username'].'</span>
      </div>
    </td>
  </tr>
</table><br />
<table width="100%">
  <tr>

    <td class="success"><strong class="text">Codigo</strong></td>
    <td  class="warning"><strong class="text">Nombre del Producto</strong></td>
    <td class="danger"><strong class="text">Proveedor</strong></td>
    <td  class="info"><strong class="text">Cod. del Proveedor</strong></td>
    <td class="active"><strong class="text">Precio Costo</strong></td>
    <td  class="success"><strong class="text">Precio Mayoreo</strong></td>
    <td  class="warning"><strong class="text">Precio Venta</strong></td>
    <td class="danger"><strong class="text">Cant. Actual</strong></td>
    <td class="info"><strong class="text">Cant. Minima</strong></td>
    <td class="active"><strong class="text">Seccion</strong></td>
    </tr>'; 
  	$num=0;
	$can=$db->mysqli->query("SELECT * FROM producto");	
	while($dato=$can->fetch_assoc()){	
		$num=$num+1;
		$resto = $num%2; 
  		if ((!$resto==0)) { 
        	$color="#CCCCCC"; 
   		}else{ 
        	$color="#FFFFFF";
   		}
		$codigo=$dato['cod']; 
		$cprov=$dato['prov']; 
		$cann=$db->mysqli->query("SELECT * FROM proveedor where codigo=$cprov");	
		if($datos=$cann->fetch_assoc()){	$n_prov=$datos['empresa'];	}

		$seccion=$dato['seccion']; 
		$cann=$db->mysqli->query("SELECT * FROM seccion where id=$seccion");	
		if($datos=$cann->fetch_assoc()){	$n_seccion=$datos['nombre'];	}
		
$codigoHTML.='
  <tr>

    <td bgcolor="'.$color.'"><center><span class="text">'.$dato['cod'].'</span></center></td>
    <td bgcolor="'.$color.'"><span class="text">'.$dato['nom'].'</span></td>
    <td bgcolor="'.$color.'"><span class="text">'.$n_prov.'</span></td>
    <td bgcolor="'.$color.'"><span class="text">'.$dato['cprov'].'</span></td>
    <td bgcolor="'.$color.'"><span class="text">$ '.number_format($dato['costo'],2,",",".").'</span></td>
    <td bgcolor="'.$color.'"><span class="text">$ '.number_format($dato['mayor'],2,",",".").'</span></td>
    <td bgcolor="'.$color.'"><span class="text">$ '.number_format($dato['venta'],2,",",".").'</span></td>
    <td bgcolor="'.$color.'"><span class="text">'.$dato['cantidad'].'</span></td>
    <td bgcolor="'.$color.'"><span class="text">'.$dato['minimo'].'</span></td>
    <td bgcolor="'.$color.'"><span class="text">'.$n_seccion.'</span></td>
  </tr>';
  }
$codigoHTML.='
</table><br />
<div align="right"><span class="text">Registros Encontrados '.$num.'</span></div>
</div>
</body>
</html>';

$codigoHTML=utf8_decode($codigoHTML);
$dompdf=new DOMPDF();
$dompdf->load_html($codigoHTML);
ini_set("memory_limit","128M");
$dompdf->render();
$dompdf->stream("Listado_Productos_".$fech.".pdf");

?>