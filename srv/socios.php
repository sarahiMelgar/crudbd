<?php
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_SOCIO.php";

ejecutaServicio(function () {
    $lista = select(pdo: Bd::pdo(), from: SOCIO, orderBy: PAS_NOMBRE);
    

    $render = "<dl class='row p-4 rounded shadow-sm' style='background-color: #fdecef; font-family: 'Trebuchet MS', sans-serif; color: #5d3a3a;'>";

    foreach ($lista as $modelo) {
        $encodeId = urlencode($modelo[PAS_ID]);
        $id = htmlentities($encodeId);
        $nombre = htmlentities($modelo[PAS_NOMBRE]);
        $apellidos = htmlentities($modelo[PAS_APELLIDOS]);
        $correo = htmlentities($modelo[PAS_CORREO]);
        
        $render .= "
            <div class='col-12'>
                <!-- Título con estilo distintivo -->
                <dt class='font-weight-bold' style='color: #d81b60; font-size: 1.4em; font-family: 'Courier New', monospace;'>
                    <a href='modifica.html?id=$id' class='text-decoration-none'>$nombre</a>
                </dt>
                <!-- Campos con estilo personalizado -->
                <dd class='text-muted' style='font-size: 1em; margin-left: 15px; font-family: 'Lucida Sans', sans-serif; color: #6d4c4c;'>
                    <a href='modifica.html?id=$id' class='text-dark text-decoration-none' style='color: #8d6e63;'>$apellidos, <span class='text-secondary'>$correo</span></a>
                </dd>
            </div>
            <hr class='col-12 my-3' style='border-top: 1px solid #f5c2c7;'>";
    }
    
    $render .= "</dl>";
    
    devuelveJson(["tabla" => ["innerHTML" => $render]]);
});
