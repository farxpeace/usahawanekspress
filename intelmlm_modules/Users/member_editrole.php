<?php

    $roleid = $_REQUEST['id'];
    if($roleid){
        $rolesdata = $Users->list_allrole();
        $roledata = $rolesdata[$roleid];
        
        //$user_role = $userdata['userrole'];
        //print_r($roledata);
    }
    

?>

<?php
include(THEME_LOC."/header_member.php");
?>

<div class="main">
	<?php include(THEME_LOC."/member_menu_left.php"); ?>
	<div class="container-fluid">
		<div class="content">
            <div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head tabs">
							<h3>Edit Role</h3>
							<ul class="nav nav-tabs">
								<li class='active'>
									<a href="#basic" data-toggle='tab'>Basic information</a>
								</li>
                                <li>
									<a href="#tab_user" data-toggle='tab'>Users</a>
								</li>
								<li>
									<a href="#sec" data-toggle='tab'>Security</a>
								</li>
                                <li>
									<a href="#role" data-toggle='tab'>User Role</a>
								</li>
								<li>
									<a href="#not" data-toggle='tab'>Notifications</a>
								</li>
							</ul>
						</div>
						<div class="box-content">
                        <?php
                        //echo '<pre>';
                        //print_r($userdata);
                        ?>
							<form action="" method="post" class="form-horizontal">
                            <input type="hidden" name="edit" value="yes" />
							<div class="tab-content">
								<div class="tab-pane active" id="basic">
										<div class="control-group">
											<label for="rolename" class="control-label">Role Name</label>
											<div class="controls">
												<input type="text" name="rolename" id="rolename" value="<?php echo $Users->get_role_name_by_id($roleid); ?>" />
											</div>
										</div>
                                        
                                        <?php foreach($roledata as $meta => $value){ //print_r($roledata); ?>

                                            <div class="control-group">
    											<label for="rolename" class="control-label"><?php echo $Users->get_role_alias_by_meta($roleid, $meta); ?></label>
    											<div class="controls">
    												<input type="text" name="rolename" id="rolename" value="<?php echo $value; ?>" />
    											</div>
    										</div>
                                        <?php } ?>
                                        
										
										
										
										
								</div>
                                <div class="tab-pane" id="tab_user">
									
								</div>
                                <div class="tab-pane" id="role">
                                <?php
                                //echo '<pre>';
                                $role_data = $Users->list_allrole();
                                //print_r($role_data[$userdata['userrole']]);
                                ?>
                                    <div class="control-group">
								        <label for="date" class="control-label">Role</label>
								        <div class="controls">
											<select name="userrole" id="role">
												<?php foreach($role_data as $a => $b){ ?>
                                                    <option <?php if($user_role == $a){ echo 'selected'; } ?> value="<?php echo $a; ?>"><?php echo $b[role_name]; ?></option>
                                                <?php } ?>
                                                
											</select>
										</div>
								    </div>
									
									
								</div>
								<div class="tab-pane" id="sec">
									<div class="control-group">
										<label class="control-label">Cookie duration</label>
										<div class="controls">
											<label class="radio"><input type="radio" name="duration"> 1 day</label>
											<label class="radio"><input type="radio" name="duration"> 7 days</label>
											<label class="radio"><input type="radio" name="duration"> 24 days</label>
											<label class="radio"><input type="radio" name="duration"> 1 year</label>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Hide my email</label>
										<div class="controls">
											<label class="radio"><input type="radio" name="hide"> Yes</label>
											<label class="radio"><input type="radio" name="hide"> No</label>
										</div>
									</div>
								</div>
								<div class="tab-pane" id="not">
									<div class="control-group">
											<label class="control-label">When to email</label>
											<div class="controls">
												<label class="checkbox"><input type="checkbox" checked name="purch"> Product was purchased</label>
												<label class="checkbox"><input type="checkbox" checked name="comm"> Comment on my products</label>
												<label class="checkbox"><input type="checkbox" name="rat"> New rating on product</label>
												<label class="checkbox"><input type="checkbox" checked name="messa"> Message from admin</label>
												<label class="checkbox"><input type="checkbox" name="messu"> Message from user</label>
											</div>
										</div>
								</div>
							</div>
								<div class="form-actions">
									<input type="submit" class='btn btn-primary' value="Save">
									<input type="reset" class='btn btn-danger' value="Reset">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			
		</div>	
	</div>
</div>	
<?php include(THEME_LOC."/member_footer.php"); ?>