<?php
//error_reporting(E_ALL ^ E_NOTICE);
#include('../intelmlm_include/constants.php');
include('../bootstrap.php');

/*
 * jQuery File Upload Plugin PHP Example 5.14
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

//error_reporting(E_ALL ^ E_NOTICE);
$options = array(
    'delete_type' => 'POST',
    'db_host' => DB_SERVER,
    'db_user' => DB_USER,
    'db_pass' => DB_PASS,
    'db_name' => DB_NAME,
    'db_table' => 'intelmlm_files'
);


require('UploadHandler.php');

class CustomUploadHandler extends UploadHandler {

    protected function initialize() {
    	$this->db = new mysqli(
    		$this->options['db_host'],
    		$this->options['db_user'],
    		$this->options['db_pass'],
    		$this->options['db_name']
    	);
        parent::initialize();
        $this->db->close();
    }
    
    public function get($print_response = true) {
        global $session, $database;
        
        $uploads_array = array();
        $files = mysql_query("SELECT * FROM ".$database->tbl_files_name." WHERE uid='".$session->uid."'");
        
        while($row = mysql_fetch_assoc($files)){
            
            if(!$row['url']){ $row['url'] = $this->get_full_url().'/'.$row['name']; }
            if(!$row['thumbnailUrl']){ $row['thumbnailUrl'] = $this->get_full_url().'/uploaded/thumbnail/'.$row['name']; }
            if(!$row['deleteUrl']){ $row['deleteUrl'] = $this->get_full_url().'/?file='.$row['name'].'&_method=DELETE'; }
            
            $file[] = array(
                'id'    => $row['id'],
                'userid'=> $row['uid'],
                'name'  => $row['name'],
                'size'  => $row['size'],
                'url'   => $row['url'],
                'thumbnailUrl' => $row['thumbnailUrl'],
                'deleteUrl' => $row['deleteUrl'],
                'deleteType' => 'POST',
                'title' => $row['title'],
                'description' => $row['description']
            );
            //array_push($uploads_array,$file);
        }
        
        
        
        header('Content-type: application/json');
        echo json_encode(array('files' => $file));
    }
    
    
    protected function handle_form_data($file, $index) {
        //$file->userid = @$_REQUEST['uid'][$index];
    	$file->title = @$_REQUEST['title'][$index];
    	$file->description = @$_REQUEST['description'][$index];
        //$file->upload_type = @$_REQUEST['upload_type'][$index];
    }

    protected function handle_file_upload($uploaded_file, $name, $size, $type, $error,
            $index = null, $content_range = null) {
                global $session;
        $file = parent::handle_file_upload(
        	$uploaded_file, $name, $size, $type, $error, $index, $content_range
        );
        if (empty($file->error)) {
			$sql = 'INSERT INTO `'.$this->options['db_table']
				.'` (`name`, `size`, `type`, `title`, `description`)'
				.' VALUES (?, ?, ?, ?, ?)';
            $upload_type = $file->upload_type;
            $sql2 = "INSERT INTO ".$this->options['db_table']." (uid,name,size,type,title,description,upload_type,trx_uid)VALUES(
                '".$session->uid."',
                '".$file->name."',
	        	'".$file->size."',
	        	'".$file->type."',
	        	'".$file->title."',
	        	'".$file->description."',
                '".$_REQUEST['upload_type']."',
                '".$_REQUEST['trx_uid']."'
            )";
	        $query = $this->db->prepare($sql2);
	        
	        $query->execute();
	        $file->id = $this->db->insert_id;
        }
        return $file;
    }

    protected function set_additional_file_properties($file) {
        parent::set_additional_file_properties($file);
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        	$sql = 'SELECT uid,`id`, `type`, `title`, `description` FROM `'
        		.$this->options['db_table'].'` WHERE `name`=?';
        	$query = $this->db->prepare($sql);
 	        $query->bind_param('s', $file->name);
	        $query->execute();
	        $query->bind_result(
                $uid,
	        	$id,
	        	$type,
	        	$title,
	        	$description
	        );
	        while ($query->fetch()) {
                $file->userid = $uid;
	        	$file->id = $id;
        		$file->type = $type;
        		$file->title = $title;
        		$file->description = $description;
    		}
        }
    }

    public function delete($print_response = true) {
        $response = parent::delete(false);
        foreach ($response as $name => $deleted) {
        	if ($deleted) {
	        	$sql = 'DELETE FROM `'
	        		.$this->options['db_table'].'` WHERE `name`=?';
	        	$query = $this->db->prepare($sql);
	 	        $query->bind_param('s', $name);
		        $query->execute();
        	}
        } 
        return $this->generate_response($response, $print_response);
    }

}

$upload_handler = new CustomUploadHandler($options);

