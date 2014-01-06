<?php
Class Settings extends MySQLDB {
    var $ref;
    var $title;
    var $shortname;
    var $const_debug_mode;
    
    var $track_visitors;
    
    function __construct(){
        global $database;
        $this->ref = __CLASS__;
        
        $this->title = $database->getSingleValueByMetaAndRef('system', 'title');
        $this->shortname = $database->getSingleValueByMetaAndRef('system', 'shortname');
        $this->const_debug_mode = $this->process_debug_mode();
        //$this->get_value_by_meta($this->ref, 'title');
        //$this->get_value_by_meta($this->ref, 'short-name');
    }
    
    
    
    function process_debug_mode(){
        global $database;
        $tblname = $database->getSingleValueByMetaAndRef('constants', 'debug_mode');
        return $tblname;
   }
   
    
}

$Settings = new Settings;

?>