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
    "CREATE TABLE IF NOT EXISTS AEROLINEAS (
      AER_ID INTEGER,
      AER_NOMBRE TEXT NOT NULL,
      AER_PAIS TEXT NOT NULL,
      AER_SIGLAS TEXT NOT NULL,
      CONSTRAINT AER_PK PRIMARY KEY(AER_ID),
      CONSTRAINT AER_NOMBRE_UNQ UNIQUE(AER_NOMBRE),
      CONSTRAINT AER_SIGLAS_UNQ UNIQUE(AER_SIGLAS),
      CONSTRAINT AER_NOMBRE_NV CHECK(LENGTH(AER_NOMBRE) > 0),
      CONSTRAINT AER_PAIS_NV CHECK(LENGTH(AER_PAIS) > 0),
      CONSTRAINT AER_SIGLAS_FMT CHECK(LENGTH(AER_SIGLAS) = 3)
    )"
   );
  }

  return self::$pdo;
 }
}
