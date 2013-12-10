<?php
Class Settings {
    var $ref;
    var $title;
    var $shortname;
    
    function __construct(){
        global $database;
        $this->ref = __CLASS__;
        
        $this->title = $database->get_value_by_meta($this->ref, 'title');
        $this->shortname = $database->get_value_by_meta($this->ref, 'shortname');
        
        //$this->get_value_by_meta($this->ref, 'title');
        //$this->get_value_by_meta($this->ref, 'short-name');
    }
    
    
    
    
    
    
}

$Settings = new Settings;

?>