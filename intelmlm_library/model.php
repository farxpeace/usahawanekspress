<?php
class Model {

    public $db;
    //protected $tablename;
    
    function __construct($model){
        $this->db = NewADOConnection('mysql');
        $this->db->Connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->db->SetFetchMode(ADODB_FETCH_ASSOC);
    }

}






?>