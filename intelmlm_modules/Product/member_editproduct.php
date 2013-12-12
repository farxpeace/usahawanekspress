<?php

    $productid = $_REQUEST['id'];
    if($productid){
        $productdata = $Product->getProductById($productid);
        
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
											<label for="productname" class="control-label">Product Name </label>
											<div class="controls">
												<input type="text" name="productname" id="productname" value="<?php echo $productdata['productname']; ?>" />
											</div>
										</div>
                                        <div class="control-group">
    								        <label for="date" class="control-label">Category</label>
    								        <div class="controls">
    											<select name="category" id="category">
                                                    <?php if(!$user_role){ ?>
                                                        <option>Please select category</option>
                                                    <?php } ?>
                                                    
    												<?php foreach($Product->list_all_category() as $a){  ?>
                                                        <option <?php if($user_role == $a[id]){ echo 'selected'; } ?> value="<?php echo $a[id]; ?>"><?php echo $a[name]; ?></option>
                                                    <?php } ?>
                                                    
    											</select>
    										</div>
    								    </div>

										
										
									
										
								</div>
                                <div class="tab-pane" id="role">
                                
									
									
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