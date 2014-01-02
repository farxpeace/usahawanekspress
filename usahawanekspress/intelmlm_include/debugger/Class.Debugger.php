<?php
Class Debugger {
    var $debug = array();
    var $debug_r = array();
    var $debug_on = 1;
    
    function __construct(){
        $this->configuration($this->get_all_settings());
    }
    
    function configuration($data){
        $_SESSION['Config'] = serialize($data);
    }
    
    function debug($name,$object){
        $this->debug[$name] = (array) $object;
    }
    
    function debug_r($name = null,$object){
        $this->debug_r[$name] = (array) $object;
    }
    
    function get_all_settings(){
        global $database;
        $query = mysql_query("SELECT * FROM ".TBL_SETTINGS);
        while($row = mysql_fetch_assoc($query)){
            $list[] = $row;
        }
        return $list;
    }
    
    function __destruct() {
        if($this->debug_on){
            $_SESSION['debugdata'] = serialize($this->debug);
            $_SESSION['debug_r'] = serialize($this->debug_r);
            $_SESSION['config'] = serialize($this->get_all_settings());
        }
       
   }

}

$Class_debugger = new Debugger;

?>