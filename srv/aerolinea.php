<?php

require_once __DIR__ . "/../lib/php/NOT_FOUND.php";
require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/recuperaIdEntero.php";
require_once __DIR__ . "/../lib/php/selectFirst.php";
require_once __DIR__ . "/../lib/php/ProblemDetails.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_AEROLINEAS.php";

ejecutaServicio(function () {
    $id = recuperaIdEntero("id");
    $modelo = selectFirst(pdo: Bd::pdo(), from: AEROLINEAS, where: [AER_ID => $id]);

    if ($modelo === false) {
        throw new ProblemDetails(
            status: NOT_FOUND,
            title: "Aerolínea no encontrada",
            type: "/error/aerolineanoencontrada.html",
            detail: "No existe aerolínea con el ID proporcionado"
        );
    }

    devuelveJson([
        "id" => ["value" => $id],
        "nombre" => ["value" => $modelo[AER_NOMBRE]],
        "pais" => ["value" => $modelo[AER_PAIS]],
        "siglas" => ["value" => $modelo[AER_SIGLAS]]
    ]);
});
