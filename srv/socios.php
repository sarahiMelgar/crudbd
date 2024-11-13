<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_SOCIO.php";

ejecutaServicio(function () {

    // Selecciona datos de la tabla SOCIO ordenados por nombre
    $lista = select(pdo: Bd::pdo(), from: SOCIO, orderBy:PAS_NOMBRE);

    // Inicializa el render para las tarjetas
    $render = "";
    foreach ($lista as $modelo) {
        $encodeId = urlencode($modelo[PAS_ID]);
        $id = htmlentities($encodeId);
        $nombre = htmlentities($modelo[PAS_NOMBRE]);
        $correo = htmlentities($modelo[PAS_CORREO]);
        
        // Estructura de la tarjeta para cada registro
        $render .= "
        <div class='card mb-3'>
            <div class='card-body'>
                <dl>
                    <dt>Nombre:</dt>
                    <dd><a href='modifica.html?id=$id'>$nombre</a></dd>
                    <dt>Correo Electrónico:</dt>
                    <dd>$correo</dd>
                </dl>
            </div>
        </div>";
    }

    // Devuelve la respuesta en formato JSON con el HTML generado
    devuelveJson(["lista" => ["innerHTML" => $render]]);
});
