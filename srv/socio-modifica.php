<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaCorreo.php";
require_once __DIR__ . "/../lib/php/validaApellidos.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_SOCIO.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");
 $nombre = recuperaTexto("nombre");
 $apellidos = recuperaTexto("apellidos");
 $correo = recuperaTexto("correo");
 $nombre = validaNombre($nombre);
 $apellidos = validaApellidos($apellidos);
 $correo = validaCorreo($correo);

 

 update(
  pdo: Bd::pdo(),
  table: SOCIO,
  set: [PAS_NOMBRE => $nombre, PAS_APELLIDOS => $apellidos, PAS_CORREO => $correo],
  where: [PAS_ID => $id]
 );

 devuelveJson([
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
  "apellidos" => ["value" => $apellidos],
  "correo" => ["value" => $correo],
 ]);
});
