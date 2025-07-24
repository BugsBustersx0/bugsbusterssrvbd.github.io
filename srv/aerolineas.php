<?php

require_once __DIR__ . "/../lib/php/ejecutaServicio.php";
require_once __DIR__ . "/../lib/php/select.php";
require_once __DIR__ . "/../lib/php/devuelveJson.php";
require_once __DIR__ . "/Bd.php";
require_once __DIR__ . "/TABLA_AEROLINEAS.php";

ejecutaServicio(function () {
  $lista = select(pdo: Bd::pdo(), from: AEROLINEAS, orderBy: AER_NOMBRE);

  $render = "";
  foreach ($lista as $modelo) {
      $id = urlencode($modelo[AER_ID]);
      $nombre = htmlentities($modelo[AER_NOMBRE]);
      $pais = htmlentities($modelo[AER_PAIS]);
      $siglas = htmlentities($modelo[AER_SIGLAS]);
      
      $render .= "<li>
          <dl>
              <dt>Nombre</dt><dd>$nombre</dd>
              <dt>País</dt><dd>$pais</dd>
              <dt>Siglas</dt><dd>$siglas</dd>
          </dl>
          <p><a href='modifica.html?id=$id'>Modificar</a></p>
      </li>";
  }

  devuelveJson(["lista" => ["innerHTML" => $render]]);
});
