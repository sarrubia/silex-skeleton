<?php
namespace HalfTarget\Silex\Helper;

/**
 * Description of Controller
 *
 * @author sarrubia
 */
class Controller {
    
    public static function getNamespaceAction($controller,$action){
        
        return "App\\Controllers\\".ucwords(strtolower($controller))."::".strtolower($action)."Action";
            
        
    }
}

?>
