<?php

namespace HalfTarget\Silex\ServiceProvider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Yaml\Yaml;

use HalfTarget\Config as HTConfig;

class ConfigServiceProvider implements ServiceProviderInterface {
    
    protected $file;

    public function __construct($file) {
        $this->file = $file;
    }

    public function register(Application $app) {
        $config = Yaml::parse(file_get_contents($this->file));

        if (is_array($config)) {
            $configClass = new HTConfig($config); 
            $app['config'] = $configClass;
        }

    }

    public function boot(Application $app) {
    }

}

?>
