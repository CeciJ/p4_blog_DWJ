<?php

/* Exemple de Configuration à renommer en config.php */

define('LIMIT', 30); // Quantité de mots dans l'extrait du chapitre sur la page d'accueil

$root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];

define('ROOT', $root . 'p4_Final/');
define('HOST', 'http://' . $host . '/p4_Final/');

define('FRONTCONTROLLER', ROOT . 'frontend/controller/');
define('ADMINCONTROLLER', ROOT . 'admin/controller/');
define('MODEL', ROOT . 'model/');
define('FRONTVIEW', ROOT . 'frontend/view/');
define('ADMINVIEW', ROOT . 'admin/view/');

define('ASSETS', HOST . 'assets/');

// Values are for example. You must change host, dbName, dbUser and dbPassword
define('DB_HOST', 'localhost');
define('DB_NAME', 'p4_blog_ecrivain');
define('DB_PASS', 'root');
define('DB_USER', 'root');