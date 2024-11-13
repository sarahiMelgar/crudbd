<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaApellidoPaterno.php";  // Asegúrate de que esta función esté disponible
require_once __DIR__ . "/../lib/php/validaApellidoMaterno.php";  // Asegúrate de que esta función esté disponible
require_once __DIR__ . "/../lib/php/validaCorreo.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_SOCIO.php";

ejecutaServicio(function () {

    // Recuperamos los datos desde la solicitud
    $id = recuperaIdEntero("id");
    $nombre = recuperaTexto("nombre");
    $apellidoPaterno = recuperaTexto("apellidoPaterno");  // Usamos apellido paterno
    $apellidoMaterno = recuperaTexto("apellidoMaterno");  // Usamos apellido materno
    $correoElectronico = recuperaTexto("correoElectronico");

    // Validamos los datos recibidos
    $nombre = validaNombre($nombre);
    $apellidoPaterno = ValidaApellidoPaterno($apellidoPaterno);  // Validación del apellido paterno
    $apellidoMaterno = ValidaApellidoMaterno($apellidoMaterno);  // Validación del apellido materno
    $correoElectronico = validaCorreo($correoElectronico);

    // Realizamos la actualización en la base de datos
    update(
        pdo: Bd::pdo(),
        table: SOCIO,
        set: [
            PAS_NOMBRE => $nombre,
            PAS_APELLIDOPATERNO => $apellidoPaterno,  // Usamos el apellido paterno
           PAS_APELLIDOMATERNO => $apellidoMaterno,  // Usamos el apellido materno
            PAS_CORREO=> $correoElectronico
        ],
        where: [PAS_ID => $id]
    );

    // Devolvemos los datos actualizados en formato JSON
    devuelveJson([
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "apellidoP" => ["value" => $apellidoPaterno],  // Usamos el apellido paterno
        "apellidoM" => ["value" => $apellidoMaterno],  // Usamos el apellido materno
        "correoElectronico" => ["value" => $correoElectronico],
    ]);
});
