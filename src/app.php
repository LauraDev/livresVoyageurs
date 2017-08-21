<?php

#1 : Debug Mode Activation
$app['debug'] = true;

#2 : Controllers management via ControllerProvider
require PATH_SRC . '/routes.php';

#3 : Twig Activation
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => [
        PATH_VIEWS,
        PATH_RESSOURCES .'/layout'
    ],
));

#4 : Add LivresVoyageursTwig as a Twig Extension 
$app->extend('twig', function($twig, $app) {
    $twig->addExtension(new LivresVoyageurs\Extension\LivresVoyageursTwigExtension());
    return $twig;
});

#5 : Asset Activation (link to CSS/JS/IMG...)
$app->register(new Silex\Provider\AssetServiceProvider() );

#6 : Doctrine DBAL
require PATH_RESSOURCES . '/config/database.config.php';

#7 : Security
require PATH_RESSOURCES . '/config/security.php';

#8 : Return $app
return $app;













