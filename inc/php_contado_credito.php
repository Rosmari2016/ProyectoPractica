<?php
    session_start();
    require("php_conexion.php");
    $db = new Db();
    $usuario=$_SESSION['username'];
    if(!$_SESSION['tipo_usu']=='a' OR !$_SESSION['tipo_usu']=='a'){
        header("location:../error.php");
    }

    $query=$db->mysqli->query("SELECT MAX(factura) as maximo FROM factura");//codigo de la factura

    if($row=$query->fetch_object()){ $cfactura=$row->maximo+1; }
    if($cfactura==1){$cfactura=1000;}
    $hoy=$fechay=date("Y-m-d");

    if($_GET['button']=="Cobrar Dinero Recibido");{ //contado
        $ccpago=$_GET['ccpago'];
        $tpagar=$_GET['tpagar'];
        $t_importe=0;

        if($tpagar<=$ccpago){
            //guarda tabla factura
            $factura_sql="INSERT INTO factura(factura,cajera,fecha,estado)VALUES('$cfactura','$usuario','$hoy','s')";
            $db->mysqli->query($factura_sql);
            //codigo de la factura / guardar en detalles
            $can=$db->mysqli->query("SELECT * FROM caja_tmp WHERE usu='$usuario'");
            while($row=$can->fetch_object()){
                $cod=$row->cod; $nom=$row->nom; $cant=$row->cant;
                $venta=$row->venta; $importe=$row->importe; $t_importe+=$importe;
                
                $detalle_sql="INSERT INTO detalle(factura,codigo,nombre,cantidad,valor,importe,tipo) VALUES ('$cfactura','$cod','$nom','$cant','$venta','$importe','CONTADO')";

                $db->mysqli->query($detalle_sql);

                ///ACTUALIZAR LA EXISTENCIA///////////////////
                $ca=$db->mysqli->query("SELECT * FROM producto WHERE cod='$cod'");
                if($row=$ca->fetch_object()){
                    $e_actual=$date['cantidad'];
                }
                $n_cantidad=$e_actual-$cant;
                if($n_cantidad<0){$n_cantidad=0;}// si la cantidad de negativo ponerlo en 0
                $sql="UDPATE producto SET cantidad='$n_cantidad' WHERE cod='$cod'";
                $db->mysqli->query($sql);
                ///////////////////////////////////////////////
            }

            $borrar_sql="DELETE FROM caja_tmp WHERE usu='$usuario'";//borrar todo de la caja temporal
            $db->mysqli->query($borrar_sql);

            header('location:../contado.php?tpagar='.$tpagar.'&ccpago='.$ccpago.'&factura='.$cfactura);
        }else{
            header('location:../contado.php?mensaje=error');
        }
    }
    $_SESSION['ddes']=0;

?>