<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\Loader\YamlFileLoader;
//use Silex\Provider\SessionServiceProvider;
//use Silex\Provider\SecurityServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;

use HalfTarget\Silex\Helper\Controller as HelperController;


/**
 * REGISTER
 */
$app->register(new UrlGeneratorServiceProvider());

$app->register(new HalfTarget\Silex\ServiceProvider\ConfigServiceProvider( APPLICATION_PATH . '/app/config/config_'. APPLICATION_ENV .'.yml'));

$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => APPLICATION_PATH.'/app/log/'.APPLICATION_ENV.'.log',
    'monolog.level' => $app['config']->get('log.level'),
    'monolog.name' => $app['config']->get('app.codename'),
));

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../app/views',
));

$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
));

/*
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'    => $app['config']->get('database.driver'),
        'host'      => $app['config']->get('database.host'),
        'dbname'    => $app['config']->get('database.dbname'),
        'user'      => $app['config']->get('database.user'),
        'password'  => $app['config']->get('database.password'),
        'charset'   => $app['config']->get('database.charset'),
    ),
));
*/

$app['debug'] = $app['config']->get('debug.mode');

/**
 * i18n
 */

$app['translator'] = $app->share($app->extend('translator', function($translator, $app) {
    $translator->addLoader('yaml', new YamlFileLoader());

    $translator->addResource('yaml', APPLICATION_PATH.'/app/locales/en.yml', 'en');
    $translator->addResource('yaml', APPLICATION_PATH.'/app/locales/de.yml', 'de');
    $translator->addResource('yaml', APPLICATION_PATH.'/app/locales/fr.yml', 'fr');

    return $translator;
}));

/**
 * ERROR
 */
$app->error(function (\Exception $e, $code) {
    switch ($code) {
        case 404:
            $message = 'The requested page could not be found.';
            break;
        default:
            //$message = 'We are sorry, but something went terribly wrong.';
            $message = "ERROR: " . $e->getMessage();
    }

    return new Response($message);
});

/**
 * RUTAS
 */

$app->get('/', HelperController::getNamespaceAction('hello', 'index') );

/*
$app->get('/', function() use ($app) {
    return $app->json( array('Hello!'));
});
*/
/*
$app->get('/{_locale}/hello/{name}', function ($name) use ($app) {
    return $app['twig']->render('hello.twig', array(
        'nombre' => $name
    ));
});
*/
$app->get('/{_locale}/hello/{name}', HelperController::getNamespaceAction('hello', 'index') );


return $app;


