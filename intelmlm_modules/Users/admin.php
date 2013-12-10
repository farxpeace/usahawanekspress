<?php
$op = $_REQUEST['op'];
if($op == ''){
    include('admin_main.php');
}elseif($op == 'Search'){
    include('member_search.php');
}
?>