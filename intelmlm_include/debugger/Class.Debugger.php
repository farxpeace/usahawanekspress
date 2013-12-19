<?php
Class Debugger {
    var $debug = array();
    
    function __construct(){
        
    }
    
    function debug($name,$object){
        $this->debug[$name] = (array) $object;
    }
    
    function __destruct() {
       $_SESSION['debugdata'] = serialize($this->debug);
   }

}

$Class_debugger = new Debugger;

?>