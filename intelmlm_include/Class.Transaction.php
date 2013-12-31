<?php
Class Transaction {
    
    function getSingleTransactionById($trx_id){
        global $database;
    }
    
    function getSingle($array){
        global $database;
        
        
        $output = $database->getSingle('intelmlm_transaction', $array);
        return $output;
    }
    
    function getSingleBy($array){
        
    }
    
    
    
    function createMeta($ref, $meta, $value){
        $date = time();
        $query = mysql_query("INSERT INTO intelmlm_transaction_meta (ref,meta,value, create_date)VALUES('$ref', '$meta', '$value', '$date')");
        return $query;
        
        
    }
    
    function getSingleValueByRefMeta($ref, $meta){
        global $database;
        $query = mysql_query("SELECT value FROM intelmlm_transaction_meta WHERE ref='$ref' AND meta='$meta'");
        $row = mysql_fetch_assoc($query);
        return $row['value'];
    }
    
    function update($array){
        global $database;
        $update = $database->update('intelmlm_transaction', $array);
        return $update;
    }
    
    
}
?>