<?php
class User_Model extends Model {
    
    private $tablename = 'intelmlm_users';
    
    function __construct(){
        parent::__construct();
    }
    
    public function selectOne_by_userid($userid){
        $res = $this->db->GetOne("SELECT * FROM ".$this->tablename);
        if ($res === false) die("failed"); 
    }
    
}
?>