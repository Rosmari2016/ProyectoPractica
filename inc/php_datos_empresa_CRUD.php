<?php
    if(!empty($_POST['empresa']) and !empty($_POST['nit'])){
        $nameimagen = $_FILES['imagen']['name'];
		$tmpimagen = $_FILES['imagen']['tmp_name'];
		$extimagen = pathinfo($nameimagen);
		$ext = array("png","jpg");
		$urlnueva = "img/logo.png";			
		if(is_uploaded_file($tmpimagen)){
			if(array_search($extimagen['extension'],$ext)){
				copy($tmpimagen,$urlnueva);	
			}
		}
        $nempresa=$_POST['empresa'];    $ndireccion=$_POST['direccion'];    $ntel1=$_POST['telefono'];  $ntel2=$_POST['celular'];
        $ncorreo=$_POST['correo'];      $nweb=$_POST['web'];                $nciudad=$_POST['ciudad'];  $nnit=$_POST['nit'];
        $iva=$_POST['iva'];             $tamano=$_POST['tamano'];
        $xSQL="UPDATE empresa SET empresa='$nempresa',
                                  nit='$nnit',
                                  direccion='$ndireccion',
                                  ciudad='$nciudad',
                                  tel1='$ntel1',
                                  tel2='$ntel2',
                                  web='$nweb',
                                  correo='$ncorreo',
                                  iva='$iva',
                                  tamano='$tamano'
                       WHERE id=1";
        $db->mysqli->query($xSQL);
        $mensaje="1";
    }
?>