<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/insert.php";
require_once __DIR__ . "/../lib/php/devuelveCreated.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_AEROLINEAS.php";

ejecutaServicio(function () {
    $nombre = validaNombre(recuperaTexto("nombre"));
    $pais = validaNombre(recuperaTexto("pais"));
    $siglas = validaNombre(recuperaTexto("siglas")); // Por ejemplo: "AMX", "VVA", etc.

    $pdo = Bd::pdo();
    insert(pdo: $pdo, into: AEROLINEAS, values: [
        AER_NOMBRE => $nombre,
        AER_PAIS => $pais,
        AER_SIGLAS => $siglas
    ]);
    $id = $pdo->lastInsertId();

    devuelveCreated("/srv/aerolinea.php?id=" . urlencode($id), [
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "pais" => ["value" => $pais],
        "siglas" => ["value" => $siglas]
    ]);
});
