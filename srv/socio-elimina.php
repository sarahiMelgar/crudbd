<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/delete.php";
require_once __DIR__ . "/../lib/php/devuelveNoContent.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_SOCIO.php";
ejecutaServicio(function () {
    // Recuperamos el ID que se va a eliminar
    $id = recuperaIdEntero("id");

    // Eliminamos el socio correspondiente de la base de datos
    delete(pdo: Bd::pdo(), from: SOCIO, where: [PAS_ID => $id]);

    // Respondemos con estado 204 No Content
    devuelveNoContent();
});
