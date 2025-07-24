<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/recuperaTexto.php";
require_once __DIR__ . "/../lib/php/validaNombre.php";
require_once __DIR__ . "/../lib/php/update.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_AEROLINEAS.php";

ejecutaServicio(function () {
    $id = recuperaIdEntero("id");
    $nombre = validaNombre(recuperaTexto("nombre"));
    $pais = validaNombre(recuperaTexto("pais"));
    $siglas = validaNombre(recuperaTexto("siglas"));

    update(
        pdo: Bd::pdo(),
        table: AEROLINEAS,
        set: [
            AER_NOMBRE => $nombre,
            AER_PAIS => $pais,
            AER_SIGLAS => $siglas
        ],
        where: [AER_ID => $id]
    );

    devuelveJson([
        "id" => ["value" => $id],
        "nombre" => ["value" => $nombre],
        "pais" => ["value" => $pais],
        "siglas" => ["value" => $siglas]
    ]);
});
