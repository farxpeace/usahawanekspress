<?php

    
    //$search_return = $Users->search();

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
													<th>CSS grade</th>
												</tr>
											</thead>
											<tbody>
                                            <?php
                                            $i = 1;
                                            ?>
                                            <?php foreach($Users->list_allrole() as $number => $data){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $data['username']; ?></td>
													<td><?php echo $data['fullname']; ?></td>
													<td><?php echo $data['userrole']; ?></td>
													<td>
                                                        
										<div class="btn-group">
											<button class="btn btn-danger">delete</button>
											<button class="btn btn-primary">edit</button>
											
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