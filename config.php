<?php

/* Configuration */

define('LIMIT', 30); // Quantité de mots dans l'extrait du chapitre sur la page d'accueil

$root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];

define('ROOT', $root . 'p4_Final/');
define('HOST', 'http://' . $host . '/p4_Final/');

define('FRONTCONTROLLER', ROOT . 'frontend/controller/');
define('MODEL', ROOT . 'model/');
define('FRONTVIEW', ROOT . 'frontend/view/');

define('ASSETS', HOST . 'assets/');