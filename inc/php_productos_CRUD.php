<?php
    if (!empty($_POST['nom'])){
        $gnom=$_POST['nom'];    $gprov=$_POST['prov'];  $gcosto=$_POST['costo'];
        $gmayor=$_POST['mayor']; $gventa=$_POST['venta'];   $gcantidad=$_POST['cantidad'];
        $gminimo=$_POST['minimo'];  $gseccion=$_POST['seccion'];    $gfecha=$_POST['fecha'];
        $gcodigo=$_POST['codigo']; $gcprov=$_POST['cprov'];

        $sql=$db->mysqli->query("SELECT * FROM producto WHERE cod='$gcodigo'");
        if($row=$sql->num_rows>0){
            $update = "UPDATE producto SET prov='$gprov',
                                         cprov='$gcprov',
                                         nom='$gnom',
                                         costo='$gcosto',
                                         mayor='$gmayor',
                                         venta='$gventa',
                                         cantidad='$gcantidad',
                                         minimo='$gminimo',
                                         seccion='$gseccion',
                                         fecha='$gfecha'
                            WHERE cod='$gcodigo'";
            $db->mysqli->query($update);
            echo '<div class="alert alert-success">
                    <strong>Producto / Articulo '.$gnom.' </strong> Actualizado con Exito
                  </div>';
        }else{
            $insert = "INSERT INTO producto (cod,prov,cprov,nom,costo,mayor,venta,cantidad,minimo,seccion,fecha,estado)
                                 VALUES($gcodigo,'$gprov','$gcprov','$gnom','$gcosto','$gmayor','$gventa','$gcantidad','$gminimo','$gseccion','$gfecha','s')";

            $resul = $db->mysqli->query($insert);

    
            echo '<div class="alert alert-success">
                    <strong>Producto / Articulo '.$gnom.' </strong> Guardado con Exito
                  </div>';
        }
        //subir la imagen del articulo
        $nameimagen=$_FILES['imagen']['name'];
        $tmpimagen=$_FILES['imagen']['tmp_name'];
        $extimagen=pathinfo($nameimagen);
        $ext=array("png","jpg");
        $urlnueva="../img/articulo/".$gcodigo.".jp";
        if(is_uploaded_file($tmpimagen)){
            if(array_search($extimagen['extension'],$ext)){
                copy($tmpimagen,$urlnueva);
            }
        }


    }

?>