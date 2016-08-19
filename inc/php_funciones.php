<?php 
    function mensajes($mensaje,$tipo){
        if ($tipo=='verde'){
            $tipo='alert alert-success';
        }elseif($tipo=='rojo'){
            $tipo='alert alert-error';
        }elseif($tipo=='azul'){
            $tipo='alert alert-info';
        }

        return '<div class="'.$tipo.' center-align">
                        <strong>'.$mensaje.'</strong>
                </div>'; 
    }

?>