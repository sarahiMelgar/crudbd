<?php

// Inclusión de archivos de librerías necesarias
require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_SOCIO.php";

// Ejecución del servicio
ejecutaServicio(function () {

    // Recuperación del parámetro 'id' de la solicitud
    $id = recuperaIdEntero("id");

    // Validación de que el ID es un número positivo
    if ($id <= 0) {
        throw new ProblemDetails(
            status: 400,
            title: "ID inválido.",
            type: "/error/id-invalido.html",
            detail: "El ID proporcionado no es válido. Debe ser un número entero positivo."
        );
    }

    // Consulta a la base de datos para obtener el socio por el ID
    $modelo = selectFirst(pdo: Bd::pdo(), from: SOCIO, where: [PAS_ID => $id]);

    // Manejo de error si no se encuentra el socio
    if ($modelo === false) {
        $idHtml = htmlentities($id);  // Protección contra XSS
        throw new ProblemDetails(
            status: NOT_FOUND,
            title: "Socio no encontrado.",
            type: "/error/socionoencontrado.html",
            detail: "No se encontró ningún socio con el id $idHtml."
        );
    }

    // Devolución de los datos del socio en formato JSON
    devuelveJson([
        "id" => ["value" => $id],
        "nombre" => ["value" => $modelo[PAS_NOMBRE]],
        "apellidoP" => ["value" => $modelo[PAS_APELLIDOPATERNO]],
        "apellidoM" => ["value" => $modelo[PAS_APELLIDOMATERNO]],
        "correoElectronico" => ["value" => $modelo[PAS_CORREO]],
    ]);

});
