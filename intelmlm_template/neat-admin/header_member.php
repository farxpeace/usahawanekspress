
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $Settings->title; ?></title>
<meta name="description" content="">

<meta name="viewport" content="width=device-width">

<link rel="stylesheet" href="<?php echo THEME_LOC; ?>/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo THEME_LOC; ?>/css/bootstrap-responsive.css">
<link rel="stylesheet" href="<?php echo THEME_LOC; ?>/css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo THEME_LOC; ?>/css/style.css">
</head>
<body>
<div class="style-toggler">
	<img src="<?php echo THEME_LOC; ?>/img/icons/fugue/color.png" alt="" class='tip' title="Toggle style-switcher" data-placement="right">
</div>					
<div class="style-switcher">
	<h3>Style-switcher</h3>
	<ul>
		<li>
			<a href="#" class='style'>Default</a>
		</li>
		<li>
			<a href="#" class='blue'>Blue</a>
		</li>
		<li>
			<a href="#" class='green'>Green</a>
		</li>
		<li>
			<a href="#" class='red'>Red</a>
		</li>
	</ul>
</div>
<div class="topbar">
	<div class="container-fluid">
		<a href="dashboard.html" class='company'><?php echo $Settings->title; ?></a>
		<form action="#">
			<input type="text" value="Search here...">
		</form>
		<ul class='mini'>
			
			<li class='dropdown pendingContainer'>
				<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
					<img src="<?php echo THEME_LOC; ?>/img/icons/fugue/document-task.png" alt="">
					Post Ads
					<span class="label label-important">1</span>
				</a>
				<ul class="dropdown-menu pull-right custom custom-dark">
					<li class='custom'>
						<a class="title" href="#">
							Advertisement
							<span>Affiliate,dropship or ads</span>
						</a>
						
					</li>
                    
                    <li class='custom'>
						<a class="title" href="#">
							Product
							<span>Your own product,control price and stock</span>
						</a>
						
					</li>
				</ul>
			</li>
			<li class='dropdown messageContainer'>
				<a href="#" class='dropdown-toggle' data-toggle='dropdown'>
					<img src="<?php echo THEME_LOC; ?>/img/icons/fugue/balloons-white.png" alt="">
					Messages
					<span class="label label-info">3</span>
				</a>
				<ul class="dropdown-menu pull-right custom custom-dark">
					<li class='custom'>
						<div class="title">
							Hello, whats your name?
							<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>
						</div>
						<div class="action">
							<div class="btn-group">
								<a href="#" class='tip btn btn-mini' title="Show message"><img src="<?php echo THEME_LOC; ?>/img/icons/fugue/magnifier.png" alt=""></a>
								<a href="#" class='tip btn btn-mini' title="Reply message"><img src="<?php echo THEME_LOC; ?>/img/icons/fugue/mail-reply.png" alt=""></a>
							</div>
						</div>
					</li>
				</ul>
			</li>
			<li>
                <?php if($Session->userlevel == 0){ ?> 
	               <a href="#login">
    					<img src="<?php echo THEME_LOC; ?>/img/icons/fugue/control-power.png" alt="">
    					Login
    				</a>
                <?php }else{ ?> 
                    <a href="process.php">
    					<img src="<?php echo THEME_LOC; ?>/img/icons/fugue/control-power.png" alt="">
    					Logout
    				</a>
                <?php } ?>
				
			</li>
		</ul>
	</div>
</div>
<div class="breadcrumbs">
	<div class="container-fluid">
		<ul class="bread pull-left">
			<li>
				<a href="dashboard.html"><i class="icon-home icon-white"></i></a>
			</li>
			<li>
				<a href="dashboard.html">
					Dashboard
				</a>
			</li>
		</ul>

	</div>
</div>
