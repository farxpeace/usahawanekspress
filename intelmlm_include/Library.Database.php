<?php
Class db extends MDB2 {
    
    
    function __construct(){
        $dsn="mysql://".DB_USER.":".DB_PASS."@".DB_SERVER."/".DB_NAME;
        $mdb2 = $this->connect($dsn);
        if (PEAR::isError($mdb2))
        {
            die($mdb2->getMessage());
        }
        
        return $mdb2;
    }

}


$db = new db;
?>