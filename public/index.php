<?php
// index.php


// 1- Composer Autoload
// Automatic dependency management
require_once __DIR__.'/../vendor/autoload.php';


// 2- Intantiate Silex Application Class 
$app = new Silex\Application();


// 3- Debug Mode Activation
$app['debug'] = true;


// 4- Define routes
$app->mount('/', new LivresVoyageurs\Controller\Provider\UserControllerProvider() );
$app->mount('/private', new LivresVoyageurs\Controller\Provider\AdminControllerProvider() );



// 5-1 Twig Activation
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => [
        __DIR__.'/../ressources/views',
        __DIR__.'/../ressources/layout',
    ],
));

// 5-2 Add LivresVoyageursTwig as a Twig Extension 
$app->extend('twig', function($twig, $app) {
    $twig->addExtension(new LivresVoyageurs\Extension\LivresVoyageursTwigExtension());
    return $twig;
});

// 6- Asset Activation (link to CSS/JS/IMG...)
$app->register(new Silex\Provider\AssetServiceProvider() );


// 7-1 Doctrine DBAL Activation
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_mysql',
        'host'     => 'localhost',
        'dbname'   => 'livresVoyageurs',
        'user'     => 'root',
        'password' => 'root'
    ),
));

// 7-2 Idiorm Activation
$app->register(new Idiorm\Silex\Provider\IdiormServiceProvider(), array(
    'idiorm.db.options' => array(
        'connection_string'   => 'mysql:host=localhost;dbname=livresVoyageurs',
        'username'     => 'root',
        'password' => 'root',
        'id_column_overrides' => array(
        'view_articles' => 'IDARTICLE'
        )
    ),
));

// 8- Allow render(controller()) in the view
$app->register(new Silex\Provider\HttpFragmentServiceProvider());


// 9- Silex Execution
$app->run();
