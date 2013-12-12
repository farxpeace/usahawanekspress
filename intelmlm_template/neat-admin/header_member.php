
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
			<li class='dropdown dropdown-noclose supportContainer'>
				<a href="#" class='dropdown-toggle' data-toggle="dropdown">
					<img src="img/icons/fugue/book-question.png" alt="">
					Support tickets
					<span class="label label-warning">5</span>
				</a>
				<ul class="dropdown-menu pull-right custom custom-dark">
					<li class='custom'>
						<div class="title">
							What is the question?
							<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>
						</div>
						<div class="action">
							<div class="btn-group">
								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="img/icons/fugue/magnifier.png" alt=""></a>
								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="img/icons/fugue/cross.png" alt=""></a>
							</div>
						</div>
					</li>
					<li class='custom'>
						<div class="title">
							How can i do this and that?
							<span>Jul 19, 2012 by <a href="#" class='pover' data-title="Username" data-content="User information comes here">Username</a></span>
						</div>
						<div class="action">
							<div class="btn-group">
								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="img/icons/fugue/magnifier.png" alt=""></a>
								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="img/icons/fugue/cross.png" alt=""></a>
							</div>
						</div>
					</li>
					<li class='custom'>
						<div class="title">
							I want more support tickets!
							<span>Jul 19, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Lorem</a></span>
						</div>
						<div class="action">
							<div class="btn-group">
								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="img/icons/fugue/magnifier.png" alt=""></a>
								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="img/icons/fugue/cross.png" alt=""></a>
							</div>
						</div>
					</li>
					<li class='custom custom-hidden'>
						<div class="title">
							This is a great feature, BUT...
							<span>Jul 18, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Ipsum</a></span>
						</div>
						<div class="action">
							<div class="btn-group">
								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="img/icons/fugue/magnifier.png" alt=""></a>
								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="img/icons/fugue/cross.png" alt=""></a>
							</div>
						</div>
					</li>
					<li class='custom custom-hidden'>
						<div class="title">
							I want more colors! How?
							<span>Jul 16, 2012 by <a href="#" class='pover' data-title="Lorem" data-content="User information comes here">Lorem</a></span>
						</div>
						<div class="action">
							<div class="btn-group">
								<a href="#" class='tip btn btn-mini' title="Show ticket"><img src="img/icons/fugue/magnifier.png" alt=""></a>
								<a href="#" class='tip btn btn-mini' title="Delete ticket"><img src="img/icons/fugue/cross.png" alt=""></a>
							</div>
						</div>
					</li>
					<li class="custom">
						<div class="expand_custom">
							<a href="#">Show all support tickets</a>
						</div>
					</li>
				</ul>
			</li>
			<li class='dropdown pendingContainer'>
				<a href="#" data-toggle="dropdown" class='dropdown-toggle'>
					<img src="img/icons/fugue/document-task.png" alt="">
					Pending orders
					<span class="label label-important">1</span>
				</a>
				<ul class="dropdown-menu pull-right custom custom-dark">
					<li class='custom'>
						<div class="title">
							Pending order #1 
							<span>Jul 22, 2012 by <a href="#" class='pover' data-title="Hover me" data-content="User information comes here">Hover me</a></span>
						</div>
						<div class="action">
							<div class="btn-group">
								<a href="#" class='tip btn btn-mini' title="Show order"><img src="img/icons/fugue/magnifier.png" alt=""></a>
								<a href="#" class='tip btn btn-mini' title="Delete order"><img src="img/icons/fugue/cross.png" alt=""></a>
							</div>
						</div>
					</li>
				</ul>
			</li>
			<li class='dropdown messageContainer'>
				<a href="#" class='dropdown-toggle' data-toggle='dropdown'>
					<img src="img/icons/fugue/balloons-white.png" alt="">
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
								<a href="#" class='tip btn btn-mini' title="Show message"><img src="img/icons/fugue/magnifier.png" alt=""></a>
								<a href="#" class='tip btn btn-mini' title="Reply message"><img src="img/icons/fugue/mail-reply.png" alt=""></a>
							</div>
						</div>
					</li>
				</ul>
			</li>
			<li>
				<a href="#">
					<img src="img/icons/fugue/gear.png" alt="">
					Settings
				</a>
			</li>
			<li>
				<a href="process.php">
					<img src="<?php echo THEME_LOC; ?>/img/icons/fugue/control-power.png" alt="">
					Logout
				</a>
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
