<?php

//Guest page
if($session->userlevel == 0){
    include('guest.php');
}elseif($session->userlevel == 9){
    include('admin.php');
}



?>