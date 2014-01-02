<?php
Class Transaction {
    
    
    
    function getSingleTransactionById($trx_id){
        global $database;
    }
    
    
    
    function getSingleTransactionByType($user_id, $upline_id, $type){
        global $database;
        $query = mysql_query("SELECT * FROM ".$database->tbl_transaction." WHERE trx_uid='".$user_id."' AND rcx_uid='".$upline_id."' AND trx_type='".$type."'");
        $row = mysql_fetch_assoc($query);
        return $row;
   }
   
   function getAllTransactionByStatus($rcx_id, $status){
    global $database;
    $list = array();
    $query = mysql_query("SELECT * FROM ".$database->tbl_transaction." WHERE rcx_uid='".$rcx_id."' AND status='".$status."'");
    while($row = mysql_fetch_assoc($query)){
        $list[] = $row;
    }
    return $list;
   }
   
   
   function getAllTransactionByRcx_id($rcx_id){
    global $database;
    $list = array();
    $query = mysql_query("SELECT * FROM ".$database->tbl_transaction." WHERE rcx_uid='".$rcx_id."'");
    while($row = mysql_fetch_assoc($query)){
        $list[] = $row;
    }
    return $list;
   }
    
    function getSingle($array, $column=NULL){
        global $database;
        
        $data = $database->getSingle($database->tbl_transaction, $array);
        if($column){
            $output = $data[$column];
        }else{
            $output = $data;
        }
        return $output;
    }
    
    function getSingleTransaction($array, $column=NULL){
        global $database;
        
        $data = $database->getSingle($database->tbl_transaction, $array);
        if($column){
            $output = $data[$column];
        }else{
            $output = $data;
        }
        return $output;
    }
    
    function getSingleBy($array){
        
    }
    
    
    
    
    
    function getStatusByTrx_Ref($trx_ref){
        global $database;
        $array = array(
            'trx_ref' => $trx_ref
        );
        $output = $this->getSingle($array, 'status');
        return $output;
    }
    
    function updateStatusByTrx_ref($trx_ref, $status){
        global $database;
        
        
        
    }
    
    
    
    function createMeta($ref, $meta, $value){
        global $database;
        $date = time();
        $query = mysql_query("INSERT INTO ".$database->tbl_transaction_meta." (ref,meta,value, create_date)VALUES('$ref', '$meta', '$value', '$date')");
        return $query;
        
        
    }
    
    function createTransaction($user_id, $upline_id, $amount, $book_id, $type, $status){
        global $database;
        $time = time();
        $trx_ref = 'user'.$user_id."_upline".$upline_id;
      /* If admin sign up, give admin user level */
      $query = mysql_query("INSERT INTO ".$database->tbl_transaction." (
            trx_ref,
            trx_uid,
            rcx_uid,
            amount,
            trx_type,
            trx_desc,
            trx_date,
            status
      )VALUES(
            '$trx_ref',
            '$user_id',
            '$upline_id',
            '$amount',
            '$type',
            '$book_id',
            '$time',
            '$status'
      )");
       $insert_id = mysql_insert_id();
       
       //create meta status
       $this->createMeta($trx_ref, 'status', $status);
       
      return $insert_id;
   }
    
    function getSingleValueByRefMeta($ref, $meta){
        global $database;
        $query = mysql_query("SELECT value FROM ".$database->tbl_transaction_meta." WHERE ref='$ref' AND meta='$meta'");
        $row = mysql_fetch_assoc($query);
        return $row['value'];
    }
    
    function getallByRefMeta($ref, $meta){
        global $database;
        $query = mysql_query("SELECT value FROM ".$database->tbl_transaction_meta." WHERE ref='$ref' AND meta='$meta'");
        while($row = mysql_fetch_assoc($query)){
            $list[] = $row;
        }
        return $list;
    }
    
    function update($array){
        global $database;
        $update = $database->update($database->tbl_transaction, $array);
        return $update;
    }
    
    
}
?>