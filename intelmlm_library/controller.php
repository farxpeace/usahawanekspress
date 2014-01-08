<?php

class Controller
{

	protected $view;
	protected $model;
	protected $view_name;
    protected $child_class;
    
    protected $function;

    public function __construct() {
        //check for xml controller
        $this->child_class = get_class($this);
        $classdir = $this->getDir();
		if(file_exists($classdir . DS .$this->child_class.'.xml')){
            $xml = simplexml_load_file($classdir . DS .$this->child_class.'.xml');
            $array = json_decode(json_encode((array)simplexml_load_file($classdir . DS .$this->child_class.'.xml')),1);
            
            
            

            //$this->function = new stdClass();
            //$this->function->{$array['function']['@attributes']['name']} = '';
            //echo '<pre>';
            //print_r($array);
            //$a = $this->search($array, 'name', 'guest_index');
            //print_r($this->function);
            //echo '</pre>';
		}
    }
    
    protected function getDir() {
        $rc = new ReflectionClass(get_class($this));
        return dirname($rc->getFileName());
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
		$this->model = new $modelName();
	}
	
	function Load_View($name){
		if(file_exists( ROOT . DS . 'views' . DS . strtolower($name) . '.php')){
			$this->view_name = $name;
		}
	}
	

	public function __destruct() {
		if(!empty($this->view_name)){
			$this->view->Render($this->view_name);
		}
	}
	
}

