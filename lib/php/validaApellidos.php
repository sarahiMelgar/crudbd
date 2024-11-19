<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaApellidos(false|string $apellidos)
{
    if ($apellidos === false) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Falta el apellidos.",
            type: "/error/faltaApellidos.html",
            detail: "La solicitud no tiene el valor de apellidos."
        );
    }

    $trimApellidos = trim($apellidos);

    if ($trimApellidos === "") {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "apellidos en blanco.",
            type: "/error/apellidosenblanco.html",
            detail: "Pon texto en el campo apellidos."
        );
    }

    // Validación de longitud mínima
    if (strlen($trimApellidos) <= 2) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "apellidos demasiado corto.",
            type: "/error/apellidoscorto.html",
            detail: "El apellidos debe tener minimo 3 caracteres."
        );
    }

    return $trimApellidos;
}
