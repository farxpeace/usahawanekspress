<?php

class Controller
{

	protected $view;
	protected $model;
	protected $view_name;
    protected $child_class;
    protected $controller_name;
    public $action;
    public static $modules_name;
    protected $function;
    

    public function __construct() {
        global $router;
        $this->Load_Model('User');
        $this->Load_Model('Main');
        $this->child_class = get_class($this);
		$this->modules_name = $this->getModuleName();
        $this->view = new View($this);
        //$this->controller = $this;
        
        //check for xml controller
        
        $classdir = $this->getDir();
		if(file_exists($classdir . DS .$this->child_class.'.xml')){
            $xml = simplexml_load_file($classdir . DS .$this->child_class.'.xml');
            $array = json_decode(json_encode((array)simplexml_load_file($classdir . DS .$this->child_class.'.xml')),1);
            
            //controller name
            $this->controller_name = $this->getAttr($array, 'name');
            //echo '<pre>';
            //print_r($this);
            //echo '</pre>';
            
            $this->view->Assign('controller_name', $this->controller_name);
            
            
            
            //$this->function = new stdClass();
            //$this->function->{$array['function']['@attributes']['name']} = '';
            //echo '<pre>';
            //print_r($array);
            //$a = $this->search($array, 'name', 'guest_index');
            //print_r($this->function);
            //echo '</pre>';
		}
        
        //echo '<pre>';
        //print_r($router);
        //echo '</pre>';
        
        $data = array(
            'modules_name' => $this->modules_name,
            'function_name' => $router['action']
        );
        $this->view->Assign('admin', $data);
        //$this->view->Render(FOLDER_INCLUDE. DS . 'debugger' . DS . 'admin_panel'. DS .'admin_panel.php');
        
        //$this->view->Render(FOLDER_INCLUDE. DS . 'jquery.database.php');
        
        
    }
    
    public function getModuleName(){
        return substr($this->child_class, 0,-11);
    }
    
    protected function getDir() {
        $rc = new ReflectionClass(get_class($this));
        return dirname($rc->getFileName());
    }
    
    private function listFunction($array){
        
    }
    
    private function getAttr($array, $name){
        return $array['@attributes'][$name];
    }
    
    private function search($array, $key, $value) 
{ 
    $results = array(); 

    if (is_array($array)) 
    { 
        if (isset($array[$key]) && $array[$key] == $value) 
            $results[] = $array; 

        foreach ($array as $subarray) 
            $results = array_merge($results,$this->search($subarray, $key, $value)); 
    } 

    return $results; 
} 
    
    private function recursive_array_search($needle,$haystack) {
        foreach($haystack as $key=>$value) {
            $current_key=$key;
            if($needle===$value OR (is_array($value) && $this->recursive_array_search($needle,$value) !== false)) {
                return $current_key;
            }
        }
        return false;
    }
    
    private function load_xml(){
        $xml = simplexml_load_file($this->child_class.'xml');
        $arr = (array) $xml;
    }
	
	public function index(){
		$this->Assign('content', 'This is index class index method, Method is not set yet.');
	}
	
	function Assign($variable, $value) {
		$this->view->Assign($variable, $value);
	}
	
	
	function Load_Model($name){
		$modelName = $name . '_Model';
		$this->model->$modelName = new $modelName();
	}
	
	function Load_View($name){
		//if(file_exists( ROOT . DS . 'views' . DS . strtolower($name) . '.php')){
		$this->view_name = $name;
        $this->modules_name = $this->getModuleName();
        //$name->modules_name = 'sdf';
		//}
	}
	

	public function __destruct() {
		if(!empty($this->view_name)){
			$this->view->Render($this->view_name);
		}
        
	}
	
}

