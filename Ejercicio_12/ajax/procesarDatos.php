<?php
    $data = $_REQUEST;
    
    $reg = array();

    $reg['nombre'] = (isset($data['nombre']))? $data['nombre']:null;
    $reg['apellido'] = (isset($data['apellido']))? $data['apellido']:null;
    $reg['edad'] = (isset($data['edad']))? $data['edad']:null;
    $reg['genero'] = (isset($data['genero']))? $data['genero']:null;
    $reg['email'] = (isset($data['email']))? $data['email']:null;
    $reg['telefono'] = (isset($data['telefono']))? $data['telefono']:null;
    $reg['celular'] = (isset($data['celular']))? $data['celular']:null;
    $imagen = (isset($data['imagen']))? $data['imagen']:null;
    $reg['pais'] = (isset($data['pais']))? $data['pais']:null;
    $reg['estado'] = (isset($data['estado']))? $data['estado']:null;
    $reg['latitud'] = (isset($data['latitud']))? $data['latitud']:null;
    $reg['longitud'] = (isset($data['longitud']))? $data['longitud']:null;

    $lat = $reg['latitud'];
    $long = $reg['longitud'];

    foreach($reg as $key => $value){
        if(empty($value)){
            $reg[$key] = "No encontrado";
        }
    }
//Ahora realizo la vista que ira dentro de la card
    function arreglarPalabra($str){
        $result = $str;
        if(!empty($str)){
            $str = mb_strtolower($str);
            $str[0] = mb_strtoupper($str[0]);
            $result = $str;
        }
        return $result;
    }
?>

<div class="row">
    <?php
        $i = 0;
        $max = 6;
        foreach($reg as $key => $value){ 
            if($i == 0){ ?>
                <div class="col-6">
                    <div class="card" style="border-radius: 2em;">
                        <ul class="custom-list">
            <?php
            } ?>
                    <li>
                        <label><?php echo arreglarPalabra($key); ?>:</label>
                        <span><?php echo $value; ?></span>                          
                    </li>
            <?php 
            $i++;
            if($i == $max){ $i = 0; ?>
                    </ul>
                </div>
            </div>
            <?php
            }
        }
        if($i > 0){ ?>
                    </ul>
                </div>
            </div>
    <?php
        }
    ?>
</div>



<div class="card border-0">
    <div class="row">
        <div class="col-12">
            <button class="btn btn-success mt-5" style="max-width: 20vw;" id="btnMap" onclick="verMapa(this,<?php echo $lat; ?>,<?php echo $long; ?>);">Ver mapa...</button>
        </div>
    </div>
    <div class="card-body d-flex justify-content-center">
        <div id="mapid" style="width: 600px; height: 400px;"></div>
    </div>
</div>
