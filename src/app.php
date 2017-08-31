<?php
use Silex\Provider\SwiftmailerServiceProvider;
use FabSchurt\Silex\Provider\Captcha\CaptchaServiceProvider;
use Silex\Provider;

#1 : Debug Mode Activation
$app['debug'] = true;

#2 : Controllers management via ControllerProvider
require PATH_SRC . '/routes.php';

#3 : Twig Activation
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => [
        PATH_VIEWS,
        PATH_RESSOURCES .'/layout',
        PATH_RESSOURCES .'/template'

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
    'translator.domains' => array()
));

#7 : Swiftmailer
$app->register(new SwiftmailerServiceProvider());

#8 : Capcha
$captchaProvider = new CaptchaServiceProvider();
$app->register(new Provider\SessionServiceProvider());
$app->register($captchaProvider);
$app->mount('', $captchaProvider);

#9 : Doctrine DBAL
require PATH_RESSOURCES . '/config/database.config.php';

#10 : Security
require PATH_RESSOURCES . '/config/security.php';

#11 : Errors Management
#  : https://gist.github.com/tournasdim/171b443065936bbb5ef3
$app->error(function (\Exception $e) use ($app) {
    if ($e instanceof NotFoundHttpException) {
        return $app['twig']->render('error.html.twig', [
            'message' => $e->getMessage()
        ]);
    };
});

#10 : Return $app
return $app;
