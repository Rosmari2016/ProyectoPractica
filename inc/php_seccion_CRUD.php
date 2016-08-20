<?php
    if(!empty($_POST['s_nombre'])){
        $ss_codigo=$_POST['s_codigo']; $ss_nombre=$_POST['s_nombre'];

        $resultado=$db->mysqli->query("SELECT * FROM seccion WHERE id=$ss_codigo");
        if($row=$resultado->fetch_object()){
            //actualizar seccion
            $xSQL="UPDATE seccion SET nombre='$ss_nombre' WHERE id=$ss_codigo";
            $db->mysqli->query($xSQL);

            echo '<div class="alert alert-success">
                    <strong>Seccion!</strong> Actualizado con Exito <a href="seccion.php">[Click para Actualizar]</a>
                  </div>
                 ';
        }else{
            //guardar seccion
            $sql="INSERT INTO seccion(nombre,estado)VALUES('$ss_nombre','s')";
            $db->mysqli->query($sql);
            echo '<div class="alert alert-success">
                    <strong>Seccion!</strong> Guardado con Exito <a href="seccion.php">[Click para Actualizar]</a>
                  </div>
                 ';
        }
    }

?>