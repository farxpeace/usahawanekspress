<?php
class Main_Controller extends Controller {
    //public $modules_name;
    
    
    function __construct(){
        parent::__construct();
    }
    
    function guest_index(){
        
        //print_r($this);
        $this->view->modules_name = $this->modules_name;
        
    }
    
    public function __destruct() {
        
        //echo FOLDER_INCLUDE. DS . 'debugger' . DS . 'admin_panel'. DS .'admin_panel.php';
        // FOOTER
		//$footer = new View();
		//$this->Assign('footer', $footer->Render(FOLDER_INCLUDE. DS . 'debugger' . DS . 'admin_panel'. DS .'admin_panel.php', false)); 
        //$content_view->Render(FOLDER_INCLUDE. DS . 'debugger' . DS . 'admin_panel'. DS .'admin_panel.php');
        //include(FOLDER_INCLUDE. DS . 'debugger' . DS . 'admin_panel'. DS .'admin_panel.php');
    }
}
?>