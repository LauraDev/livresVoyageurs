<?php
use Silex\Provider\SwiftmailerServiceProvider;

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

#6 : Forms
$app->register(new Silex\Provider\CsrfServiceProvider());
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\LocaleServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.domains' => array(),
));

#7 : Swiftmailer
$app->register(new SwiftmailerServiceProvider());

#8 : Doctrine DBAL
require PATH_RESSOURCES . '/config/database.config.php';

#9 : Security
require PATH_RESSOURCES . '/config/security.php';

#10 : Return $app
return $app;
