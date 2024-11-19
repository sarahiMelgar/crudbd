<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaCorreo(false| string  $correo)
{
    if ($correo === false) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Falta el correo.",
            type: "/error/faltacorreo.html",
            detail: "La solicitud no tiene el valor de correo."
        );
    }

    $trimCorreo = trim($correo);

    if ($trimCorreo === "") {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "correo en blanco.",
            type: "/error/correoenblanco.html",
            detail: "Pon texto en el campo correo."
        );
    }

    // Validación de longitud mínima
    if (strlen($trimCorreo) <= 2) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "correo demasiado corto.",
            type: "/error/correocorto.html",
            detail: "El correo debe tener minimo 3 caracteres."
        );
    }

    return $trimCorreo;
}
