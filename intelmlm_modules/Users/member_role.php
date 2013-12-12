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
							<h3>Users Role</h3>
						</div>
						<div class="box-content">
							

							
						</div>
					</div>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span12">
					<div class="box">
						<div class="box-head">
							<h3>Results (<?php echo count($Users->list_allrole()); ?>)</h3>
						</div>
						<div class="box-content box-nomargin">
										<table class='table table-striped dataTable table-bordered dataTable-noheader'>
											<thead>
												<tr>
													<th>No</th>
													<th>Role Name</th>
													<th>Action</th>
													
												</tr>
											</thead>
											<tbody>
                                            <?php
                                            //echo '<pre>';
        //print_r($Users->list_allrole());
                                            $i = 1;
                                            ?>
                                            <?php foreach($Users->get_allrole() as $roles => $role){ ?>
												<tr>
													<td><?php echo $i; ?></td>
													<td><?php echo $role['name']; ?></td>
													
													<td>
                                                        
										<div class="btn-group">
											
											<a class="btn btn-primary" href="index.php?modules=Users&op=editrole&id=<?php echo $role['id']; ?>">edit</a>
											
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