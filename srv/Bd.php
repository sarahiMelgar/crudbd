<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function pdo(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    // cadena de conexión
    "sqlite:srvbd.db",
    // usuario
    null,
    // contraseña
    null,
    // Opciones: pdos no persistentes y lanza excepciones.
    [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS SOCIO (
      SOC_ID INTEGER,
      SOC_NOMBRE TEXT NOT NULL,
      SOC_APELLIDOS TEXT NOT NULL,
      SOC_CORREO TEXT NOT NULL,

      CONSTRAINT SOC_PK
       PRIMARY KEY(SOC_ID),

      CONSTRAINT SOC_NOM_CHECK
       CHECK(LENGTH(SOC_NOMBRE) > 0),
       
      CONSTRAINT SOC_APE_CHECK
       CHECK(LENGTH(SOC_APELLIDOS) > 0),
       
      CONSTRAINT SOC_CORREO_UNIQUE
       UNIQUE(SOC_CORREO),
       
      CONSTRAINT SOC_CORREO_CHECK
       CHECK(LENGTH(SOC_CORREO) > 0)
     )"
   );
  }

  return self::$pdo;
 }
}
