<?php

require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_SOCIO.php";

ejecutaServicio(function () {

 $id = recuperaIdEntero("id");

 $modelo =
  selectFirst(pdo: Bd::pdo(),  from: SOCIO,  where: [SOC_ID => $id]);

 if ($modelo === false) {
  $idHtml = htmlentities($id);
  throw new ProblemDetails(
   status: NOT_FOUND,
   title: "SOCIO no encontrado.",
   type: "/error/socionoencontrado.html",
   detail: "No se encontró ningún SOCIO con el id $idHtml.",
  );
 }

 devuelveJson([
  "id" => ["value" => $id],
  "nombre" => ["value" => $modelo[SOC_NOMBRE]],
  "apellidos" => ["value" => $modelo[SOC_APELLIDOS]],
  "correo" => ["value" => $modelo[SOC_CORREO]],
 ]);
});
