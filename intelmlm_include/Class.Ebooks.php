<?php
Class Ebooks {
    
    var $list_per_row = 4;
    var $limit_per_upline = 4;
    
    function generateEbooks($count){
        global $database, $session;
        
        
        
        for($i=1; $i<=$count; $i++){
            $title = $session->generateRandStr(6);
            $description = $session->generateRandStr(20);
            $query = mysql_query("INSERT INTO ".$database->tbl_ebooks." (title,description)VALUES('$title', '$description')");
        }
        
    }
    
    function getEbooksTrxById($trx_id){
        global $database;
        $query = mysql_query("SELECT * FROM ".$database->tbl_transaction." WHERE id='".$trx_id."'");
        $row = mysql_fetch_assoc($query);
        return $row['trx_desc'];
    }
    
    function getSingleEbook($ebook_id){
        global $database;
        $query = mysql_query("SELECT * FROM ".$database->tbl_ebooks." WHERE id='".$ebook_id."'");
        $row = mysql_fetch_assoc($query);
        return $row;
    }
    
    function getAllEbooks(){
        global $database;
        $list = array();
        $query = mysql_query("SELECT * FROM ".$database->tbl_ebooks);
        while($row = mysql_fetch_assoc($query)){
            $list[$row['id']] = $row;
        }
        return $list;
    }
    
}
?>