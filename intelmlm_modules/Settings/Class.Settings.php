<?php
Class Settings extends MySQLDB {
    var $ref;
    var $title;
    var $shortname;
    
    function __construct(){
        $this->ref = __CLASS__;
        $this->get_allvalue_by_ref($this->ref);
        //$this->get_value_by_meta($this->ref, 'title');
        //$this->get_value_by_meta($this->ref, 'short-name');
    }
    
    function loadAll(){
        
    }
    
    
    
    
    
}

$Settings = new Settings;
?>