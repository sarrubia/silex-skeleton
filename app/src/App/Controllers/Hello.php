<?php

namespace App\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;


class Hello {
    
    public function indexAction(Request $request, Application $app)
    {
        $app['monolog']->addDebug("Hello world!");
        
        //Read configuration values
        //echo $app['config']->get('debug.mode');
        
        $nombre = $request->get('name');
        
        try{
            return $app['twig']->render('hello/index.twig', array(
                'nombre' => $nombre
            ));
        }catch (\Exception $exp){
            $app['monolog']->addError( $exp->getMessage()  );
        }
    }
    
}

?>
