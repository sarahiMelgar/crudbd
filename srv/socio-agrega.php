<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaApellidoPaterno.php";  // Corregido: Asegúrate de que esté el nombre correcto de la función
require_once __DIR__ . "/../lib/php/validaApellidoMaterno.php";  // Corregido: Asegúrate de que esté el nombre correcto de la función
require_once __DIR__ . "/../lib/php/validaCorreo.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_SOCIO.php";

ejecutaServicio(function () {

    // Recuperación de los valores desde la solicitud
    $nombre = recuperaTexto("nombre");
    $apellidoPaterno = recuperaTexto("apellidoPaterno");  // Renombrado para mejor claridad
    $apellidoMaterno = recuperaTexto("apellidoMaterno");  // Renombrado para mejor claridad
    $correoElectronico = recuperaTexto("correoElectronico");

    // Validación de los datos recibidos
    $nombre = validaNombre($nombre);
    $apellidoPaterno = ValidaApellidoPaterno($apellidoPaterno);  // Validación del apellido paterno
    $apellidoMaterno = validaApellidoMaterno($apellidoMaterno);  // Validación del apellido materno
    $correoElectronico = validaCorreo($correoElectronico);

    // Conexión a la base de datos
    $pdo = Bd::pdo();

    // Inserción de los datos en la base de datos
    insert(
        pdo: $pdo, 
        into: SOCIO, 
        values: [
            PAS_NOMBRE => $nombre,
            PAS_APELLIDOPATERNO => $apellidoPaterno,  // Corregido: Usar la variable correcta
            PAS_APELLIDOMATERNO => $apellidoMaterno,  // Corregido: Usar la variable correcta
            PAS_CORREO => $correoElectronico  // Corregido: Nombre correcto de la columna
        ]
    );

    // Obtención del último ID insertado
    $id = $pdo->lastInsertId();

    // Codificación del ID y retorno de la respuesta con estado 'Created'
    $encodeId = urlencode($id);
    devuelveCreated("/srv/cliente.php?id=$encodeId", [
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "apellidoP" => ["value" => $apellidoPaterno],  // Corregido: Usar el apellido paterno
        "apellidoM" => ["value" => $apellidoMaterno],  // Corregido: Usar el apellido materno
        "correoElectronico" => ["value" => $correoElectronico],
    ]);
});
