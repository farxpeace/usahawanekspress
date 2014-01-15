<?php

class Model {

    public $db;
    public $createXML;    
    //protected $tablename;
    
    function __construct(){
        $this->db = NewADOConnection('mysql');
        $this->db->Connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->db->SetFetchMode(ADODB_FETCH_ASSOC);

        

    }
    
    public function returnAttributes(){
        $list = array(); //Set an Empty List
    
        foreach(array_keys(get_class_vars(__CLASS__)) as $key)
        {
            $list[$key] = $this->$key;
        }
    
        return $list;
    }
    
    

}






?>