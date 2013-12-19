<?php
#print_r($session);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $Settings->title; ?></title>
<meta name="description" content="">

<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">

<link rel="stylesheet" href="<?php echo THEME_LOC; ?>/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo THEME_LOC; ?>/css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo THEME_LOC; ?>/css/style.css">
</head>
<body class='login_body'>
	<div class="wrap">
		<h2><?php echo $Settings->title; ?></h2>
		<h4>Welcome to the login page</h4>
		<form action="process.php"  autocomplete="off" method="post">
		<div class="login">
			<div class="email">
				<label for="user">Username</label><div class="email-input"><div class="input-prepend"><span class="add-on"><i class="icon-envelope"></i></span><input type="text" id="user" name="user"></div></div>
			</div>
			<div class="pw">
				<label for="pw">Password</label><div class="pw-input"><div class="input-prepend"><span class="add-on"><i class="icon-lock"></i></span><input type="password" id="pw" name="pass"></div></div>
			</div>
			<div class="remember">
				<label class="checkbox">
					<input type="checkbox" value="1" name="remember"> Remember me on this computer
				</label>
			</div>
		</div>
		<div class="submit">
			<a href="#">Lost password?</a>
			<a href="index.php?modules=Main&amp;op=register">Register</a>
			<input type="hidden" name="sublogin" value="1">
			<button class="btn btn-red5">Login</button>
		</div>
		</form>
        <form action="process.php" method="post" id="facebook_login">
            <input type="hidden" name="user" value="<?php echo $Fb->userid; ?>" />
            <input type="hidden" name="pass" value="123456" />
            <input type="hidden" name="sublogin" value="1" />
        </form>
	</div>
<script src="<?php echo THEME_LOC; ?>/js/jquery.js"></script>
<script type="text/javascript">
$(function(){
    var isEmbeded = !(top === self);
    if(isEmbeded){
        $("#facebook_login").submit();
    }
    
})
</script>
</body>
</html>