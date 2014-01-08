<?php
class Main_Controller extends Controller {
    function __construct(){
        parent::__construct();
    }
    
    function guest_index(){
        $this->Load_Model('User');
        
    }
}
?>