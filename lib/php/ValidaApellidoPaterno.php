<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaApellidoPaterno(false|string $apellidoPaterno) {

    if ($apellidoPaterno === false) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Falta el apellido paterno.",
            type: "/error/faltaapellidopaterno.html",
            detail: "La solicitud no tiene el valor de apellido paterno."
        );
    }

    $trimApellidoPaterno = trim($apellidoPaterno);

    if ($trimApellidoPaterno === "") {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Apellido paterno en blanco.",
            type: "/error/apellidopaternoenblanco.html",
            detail: "Pon texto en el campo apellido paterno."
        );
    }

    return $trimApellidoPaterno;
}
