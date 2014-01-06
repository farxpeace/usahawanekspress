<?php
$term = $_REQUEST['term'];



//search user
$user_column = array('email', 'pakej', 'phone');
foreach($user_column as $column){
    $q_user = mysql_query("SELECT ". $column ." AS co FROM ".$database->tbl_users_name." WHERE ". $column." LIKE '%".$term."%' LIMIT 3");
    while($row = mysql_fetch_array($q_user)){
        $items[] = array($column => $row['co']);
    }
}

$result = array();

foreach($items as $i => $arr){
    $key = key($arr); $value = $arr[$key];
    if (strpos(strtolower($value), $term) !== false) {
		$result[] =  array("id"=> $value, "label"=> $value, "value" => strip_tags($value));
        
	}
    
	if (count($result) > 11)
		break;
}

echo json_encode($result);

?>