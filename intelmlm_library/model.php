<?php
class Model {
    public $db;
    
    function __construct($model){
        $this->db = NewADOConnection('mysql');
        $this->db->Connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->db->SetFetchMode(ADODB_FETCH_ASSOC);
        
        foreach ($model as $i => $modelname){
            $xml = simplexml_load_file(FOLDER_MODULES.'/'.$modelname.'/Model.xml');
            $arr = (array) $xml;
            $this->{strtolower($modelname)} = $arr;
            var_dump($this->table_exists('iasdasd'));
        }
    }
    
    function table_exists($tablename) {
        
        $res = $this->db->Execute("
            SELECT COUNT(*) AS count 
            FROM information_schema.tables 
            WHERE table_name = '$tablename'
        ");
        return ($res ? true : false);
    }
}






?>