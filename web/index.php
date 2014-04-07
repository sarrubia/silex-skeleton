<?php

// Define path to application directory
defined('APPLICATION_PATH') || define('APPLICATION_PATH',  dirname(__DIR__) );

// Define application environment
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));


require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

require __DIR__.'/../app/bootstrap.php';

$app->run();
