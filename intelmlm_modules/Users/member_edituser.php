<?php

    $userid = $_REQUEST['id'];
    if($userid){
        $userdata = $database->getUserInfo_by_id($userid);
        $user_role = $userdata['userrole'];
        //print_r($userdata);
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
							<h3>User profile</h3>
							<ul class="nav nav-tabs">
								<li class='active'>
									<a href="#basic" data-toggle='tab'>Basic information</a>
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
                                <li>
									<a href="#delete" data-toggle='tab'>Delete</a>
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
											<label for="username" class="control-label">Username</label>
											<div class="controls">
												<input type="text" name="username" id="username" value="<?php echo $userdata['username']; ?>" />
											</div>
										</div>
                                        <div class="control-group">
											<label for="username" class="control-label">Fullname</label>
											<div class="controls">
												<input type="text" name="fullname" id="fullname" value="<?php echo $userdata['fullname']; ?>" />
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Password</label>
											<div class="controls">
												<div class="input-append">
													<span class="input-medium uneditable-input">******</span><span class="add-on"><i class="icon-lock"></i></span>
												</div>
												<a href="#" class="btn-danger btn">New password</a>
												<p class="help-block">The password is for security reasons hidden!</p>
											</div>
										</div>
										<div class="control-group">
											<label for="email" class="control-label">Email</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" name="email" id="email" value="<?php echo $userdata['email']; ?>"><span class="add-on"><i class="icon-envelope"></i></span>
												</div>
											</div>
										</div>
										<div class="control-group">
											<label for="date" class="control-label">Birthday</label>
											<div class="controls">
												<div class="input-append">
													<input type="text" name="date" class='datepick' id="date" value="06/10/1900"><span class="add-on"><i class="icon-calendar"></i></span>
												</div>
											</div>
										</div>
										
								</div>
                                <div class="tab-pane" id="role">
                                <?php
                                //echo '<pre>';
                                $role_data = $Users->get_allrole();
                                //print_r($user_role);
                                //print_r($role_data[$userdata['userrole']]);
                                ?>
                                    <div class="control-group">
								        <label for="date" class="control-label">Role</label>
								        <div class="controls">
											<select name="userrole" id="role">
                                                <?php if(!$user_role){ ?>
                                                    <option>Please select user role</option>
                                                <?php } ?>
                                                
												<?php foreach($role_data as $a => $b){  ?>
                                                    <option <?php if($user_role == $b[id]){ echo 'selected'; } ?> value="<?php echo $b[id]; ?>"><?php echo $b[name]; ?></option>
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
                                <div class="tab-pane" id="delete">
                                <?php
                                //echo '<pre>';
                                $role_data = $Users->list_allrole();
                                //print_r($role_data[$userdata['userrole']]);
                                ?>
                                    <div class="control-group">
								        <label for="date" class="control-label"></label>
								        <div class="controls">
                                        Are you sure to do this? This action cannot be undone<br />
											<a class="btn btn-danger" href="index.php?modules=Users&op=deleteuser&id=<?php echo $userid; ?>">Delete this user</a>
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