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
                // Opciones: PDO no persistente y lanza excepciones.
                [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );

            
            self::$pdo->exec(
                "CREATE TABLE IF NOT EXISTS SOCIO (
                    PAS_ID INTEGER PRIMARY KEY,
                    PAS_NOMBRE TEXT NOT NULL,
                    PAS_APELLIDOPATERNO TEXT NOT NULL,
                    PAS_APELLIDOMATERNO TEXT NOT NULL,
                    PAS_CORREO TEXT NOT NULL,
                    CONSTRAINT PAS_NOM_UNQ UNIQUE(PAS_NOMBRE, PAS_APELLIDOPATERNO, PAS_APELLIDOMATERNO),
                    CONSTRAINT PAS_NOM_NV CHECK(LENGTH(PAS_NOMBRE) > 0),
                    CONSTRAINT PAS_CORREO_NV CHECK(LENGTH(PAS_CORREO) > 0),
                    CONSTRAINT PAS_CORREO_FORMAT CHECK(PAS_CORREO LIKE '%_@__%.__%')
                )"
            );
        }

        return self::$pdo;
    }
}
