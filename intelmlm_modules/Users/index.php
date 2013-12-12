<?php
if(!$session->logged_in){
    
}else{
    include('Class.Users.php');
    $Users = new Users;
    $op = $_REQUEST['op'];
    if($op == ''){
        include('member_users.php');
    }elseif($op == 'register'){
        include('guest_register.php');
    }elseif($op == 'search'){
        include('member_search.php');
    }elseif($op == 'role'){
        include('member_role.php');
    }elseif($op == 'edituser'){
        //if($_REQUEST['edit'] == 'yes'){
            $output = $Users->add_edit_user();
            if($output[status] == 'ok'){
                Header("Location: ".$session->referrer);
            }elseif($output['add'] == 'yes'){
                Header("Location: ".$session->referrer);
            }
        //}
        
        include('member_edituser.php');
    }elseif($op == 'editrole'){
        //if($_REQUEST['edit'] == 'yes'){
            
        include('member_editrole.php');
    }
    elseif($op == 'deleteuser'){
        $output = $Users->delete_user($_REQUEST['id']);
        if($output['status'] == 'ok'){
            Header("Location: index.php?modules=Users&op=search&query_style=alluser");
        }
        include('member_editrole.php');
    }
}




/*
//Guest page
if($session->userlevel == 0){
    include('guest.php');
}elseif($session->userlevel == 9){
    include('admin.php');
}
*/


?>