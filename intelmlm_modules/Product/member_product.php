<?php



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
						<div class="box-head">
							<h3>Search user</h3>
						</div>
						<div class="box-content">
							<ul class="quicktasks">
								<li>
									<a href="index.php?modules=Product&op=editproduct&add=yes">
										<img src="<?php echo THEME_LOC; ?>/img/icons/essen/32/basket.png" alt="">
										<span>Add New Product</span>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icons/essen/32/lock.png" alt="">
										<span>Security</span>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="img/icons/essen/32/free-for-job.png" alt="">
										<span>Cloud settings</span>
									</a>
								</li>
								
							</ul>

										<div class="controls">
											<input value="<?php echo $Users->query_style; ?>" type="text" name="search" id="search" class="tip input-square" data-placement="right" data-original-title="Type search query here">
										</div>
							
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Results (<?php echo $Users->result_count; ?>)</h3>
						</div>
						<div class="box-content box-nomargin">
										<table class='table table-striped dataTable table-bordered dataTable-noheader'>
											<thead>
												<tr>
													<th>No</th>
													<th>Username</th>
													<th>Fullname</th>
													<th>Role</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
                                            <?php
                                            $i = 1;
                                            ?>
                                            <?php foreach($Users->search() as $number => $data){ ?>
                                                <?php $rolename = $database->get_value_by_meta_and_table(TBL_ROLE_META,'roleid',$data['userrole'],'role_name'); ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $data['username']; ?></td>
													<td><?php echo $data['fullname']; ?></td>
													<td><?php echo $rolename['value']; ?></td>
													<td>
                                                        
										<div class="btn-group">
											
											<a class="btn btn-primary" href="index.php?modules=Users&op=edituser&id=<?php echo $data['id']; ?>">edit</a>
											
										</div>
									
                                                    </td>
												</tr>
											<?php $i++; } ?>
											</tbody>
										</table>
						</div>
					</div>
				</div>
			</div>
			
			
		</div>	
	</div>
</div>	
<?php include(THEME_LOC."/member_footer.php"); ?>