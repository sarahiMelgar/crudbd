<?php

require_once __DIR__ . "/BAD_REQUEST.php";
require_once __DIR__ . "/ProblemDetails.php";

function validaApellidoMaterno($apellidoMaterno) {

    if ($apellidoMaterno === false) {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Falta el apellido paterno.",
            type: "/error/faltanteApellidoP.html",
            detail: "La solicitud no tiene el valor del apellido paterno."
        );
    }

    
    $apellidoMaterno = trim($apellidoMaterno);

    if ($apellidoMaterno === "") {
        throw new ProblemDetails(
            status: BAD_REQUEST,
            title: "Apellido paterno en blanco.",
            type: "/error/apellidoen_blanco.html",
            detail: "Pon texto en el campo apellido paterno."
        );
    }

    return $apellidoMaterno;
}
