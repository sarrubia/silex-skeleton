<?php
namespace HalfTarget;

/**
 * Description of Config
 *
 * @author sarrubia
 */
class Config {
    
    private $_arr_config = array();
    
    function __construct( array $values ) {
        
        $this->_arr_config = $values;
        
    }
    
    public function get($option){
        
        $opt = explode('.', $option);
        $ret = '$this->_arr_config';
        $value = null;
        
        foreach($opt as $o){
            $ret .= "['".$o."']";
        }
        
        if($ret != '$this->_arr_config')
        {
            $isset = null;
            eval( '$isset = isset('.$ret.');' );
            
            if($isset){
                eval('$value = '.$ret.';');
            }
        }
        
        return $value;
        
    }
    
    
}

?>
