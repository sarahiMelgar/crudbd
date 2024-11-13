<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/validaCorreo.php";
require_once __DIR__ . "/../lib/php/validaApellidos.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_SOCIO.php";

ejecutaServicio(function () {

 $nombre = recuperaTexto("nombre");
 $apellidos = recuperaTexto("apellidos");
 $correo = recuperaTexto("correo");
 $nombre = validaNombre($nombre);
 $apellidos = validaApellidos( $apellidos);
 $correo = validaCorreo($correo);


 $pdo = Bd::pdo();
 insert(pdo: $pdo, into: SOCIO, values: [PAS_NOMBRE => $nombre, PAS_APELLIDOS => $apellidos, PAS_CORREO => $correo]);
 $id = $pdo->lastInsertId();

 $encodeId = urlencode($id);
 devuelveCreated("/srv/socio.php?id=$encodeId", [
  "id" => ["value" => $id],
  "nombre" => ["value" => $nombre],
  "apellidos" => ["value" => $apellidos],
  "correo" => ["value" => $correo],
 ]);
});
