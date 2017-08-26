<?php
// index.php


#1 : Paths
define('PATH_ROOT', dirname( __DIR__ ) );
define('PATH_PUBLIC', PATH_ROOT . '/public');
define('PATH_SRC', PATH_ROOT . '/src');
define('PATH_RESSOURCES', PATH_ROOT . '/ressources');
define('PATH_VIEWS', PATH_RESSOURCES . '/views');
define('PATH_VENDOR', PATH_ROOT . '/vendor');
define('PATH_IMAGES', PATH_PUBLIC . '/assets/images');

#2 : Autoload Import
require_once PATH_VENDOR . '/autoload.php';


#3 : Silex Application Class Intantiate
$app = new Silex\Application();


#4 : App Configuration
require PATH_SRC . '/app.php';

#5 : Silex Execution
$app->run();
