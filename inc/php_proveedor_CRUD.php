<?php
    if(!$_SESSION['tipo_usu']=='a' or !$_SESSION['tipo_usu']=='ca'){
        header('location:../seccion.php');
    }
    if(!empty($_POST['empresa']) AND !empty($_POST['contacto'])){
                    $codigo=$_POST['codigo'];   $contacto=$_POST['contacto'];   $empresa=$_POST['empresa'];
                    $ciudad=$_POST['ciudad'];   $correo=$_POST['correo'];   $direccion=$_POST['direccion'];
                    $telefono=$_POST['telefono'];   $celular=$_POST['celular']; $obs=$_POST['obs'];

                    $query=$db->mysqli->query("SELECT * FROM proveedor WHERE codigo=$numero");
                    if($row=$query->fetch_object()){
                        if($boton=='Actualizar Proveedor'){
                            $xSQL="UPDATE proveedor SET empresa='$empresa',
                                                        nom='$contacto',
                                                        dir='$direccion',
                                                        ciudad='$ciudad',
                                                        tel='$telefono',
                                                        cel='$celular',
                                                        correo='$correo',
                                                        obs='$obs'
                                          WHERE codigo=$numero";
                            $db->mysqli->query($xSQL);
                            echo '<div class="alert alert-success">
                                    <strong>Proveedor! </strong> Actualizado con Exito
                                  </div>';
                        }
                    }else{
                        $sql = "INSERT INTO proveedor(empresa,nom,dir,ciudad,tel,cel,correo,obs,estado)
                                VALUES ('$empresa','$contacto','$direccion','$ciudad','$telefono','$celular','$correo','$obs','s')";
                        $db->mysqli->query($sql);
                        echo '<div class="alert alert-success">
                                <strong>Proveedor! </strong> Guardado con Exito
                              </div>';
                        $query=$db->mysqli->query("SELECT MAX(codigo) AS numero FROM proveedor");
                        if($row=$query->fetch_object()){
                            $numero=$row->numero+1;
                            $codigo='';$contacto='';$empresa='';$ciudad='';$correo='';$direccion='';$telefono='';$celular='';$obs='';
                        }
                    }
                }

?>