<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="<?php echo THEME_LOC; ?>/css/metro-bootstrap.css">
<script src="<?php echo THEME_LOC; ?>/docs/js/jquery/jquery.min.js"></script>
<script src="<?php echo THEME_LOC; ?>/docs/js/jquery/jquery.widget.min.js"></script>

<script src="<?php echo THEME_LOC; ?>/js/metro-loader.js"></script>

<style>
        .list {
            width: 100% !important;
        }
</style>
</head>
<body class="metro">
<nav class="navigation-bar">
<nav class="navigation-bar-content">
<div class="element">
	<a class="dropdown-toggle" href="#">Kedai Online</a>
	<ul class="dropdown-menu" data-role="dropdown">
        <li><a href="index.php">Dashboard</a></li>
        <?php if($session->logged_in){ ?> 
        <li><a href="index.php?modules=Ads&op=myads">My Ads</a></li>
        <li><a href="index.php?modules=Ads&op=mystore">My Store</a></li>
        <?php } ?>
		<li><a href="#">About us</a></li>
		<li><a href="#">Contact</a></li>
		<li class="divider"></li>
		<li><a href="#">Terms and regulations</a></li>
		<li class="divider"></li>
		<li><a href="#">Exit</a></li>
	</ul>
    
</div>

<span class="element-divider"></span>
<a class="element brand" href="#"><span class="icon-spin"></span></a>
<a class="element brand" href="#"><span class="icon-printer"></span></a>
<span class="element-divider"></span>
<div class="element input-element">
	<form>
		<div class="input-control text">
			<input style="width: 400px;" type="text" placeholder="Search...">
			<button class="btn-search"></button>
		</div>
	</form>
</div>

<div class="element place-right">
	<a class="dropdown-toggle" href="#">
	<span class="icon-cog"></span>
	</a>
	<ul class="dropdown-menu place-right" data-role="dropdown">
        
        <?php if($session->logged_in){ ?> 
		<li><a href="index.php?modules=Main&op=account">Account</a></li>
        <li><a href="process.php">Logout</a></li>
        <?php }else{ ?> 
		
		
		
        
        <?php } ?>
        <li><a href="#">Pricing</a></li>
        <li><a href="#">Support</a></li>
	</ul>
</div>
<span class="element-divider place-right"></span>
<?php if(!$session->logged_in){ ?> 
<a class="element place-right" href="#" id="window_login"><!--<span class="icon-locked-2">-->Login / Register</span></a>
<?php } ?>
<script type="text/javascript">
$("#window_login").on('click', function(){
    window_login_register();
});

function window_login_register(){
    $.Dialog({
        overlay: true,
        shadow: true,
        flat: true,
        icon: '<img src="http://metroui.org.ua/images/excel2013icon.png">',
        title: 'Login to Kedai Online',
        content: '',
        onShow: function(_dialog){
            console.log(_dialog)
            var content = $('.content_login').clone().wrap('<div>').parent().html();
            _dialog.html(content);
        }
    });
}
</script>
<div style="display: none;">
<div class="content_login grid fluid" style="padding: 42px 10px 10px; padding-top: 0px !important;">
    <div class="row">
        <div class="span6">
            <form action="process.php" method="post">
                <legend>Login</legend>
        		<label>Email</label>
        		<div class="input-control text">
        			<input type="text" name="user"><button class="btn-clear"></button>
        		</div>
        		<label>Password</label>
        		<div class="input-control password">
        			<input type="password" name="pass"><button class="btn-reveal"></button>
        		</div>
        		<div class="input-control checkbox">
        			<label><input type="checkbox" name="remember" checked=""><span class="check"></span>Remember me</label>
        		</div>
        		<div class="form-actions">
                <input type="hidden" name="sublogin" value="1" />
        			<button type="submit" class="button primary">Login to...</button>
        		</div>
	       </form>
        </div>
        <div class="span6">
            <form action="process.php" method="post">  
                <legend>Register</legend>
        		<label>Email</label>
        		<div class="input-control text">
        			<input type="text" name="email" /><button class="btn-clear"></button>
        		</div>
        		<label>Password</label>
        		<div class="input-control password">
        			<input type="password" name="pass"><button class="btn-reveal"></button>
        		</div>
        		<div class="input-control checkbox">
        			<label><input type="checkbox" name="c1" checked=""><span class="check"></span>I agree with terms and agreements</label>
        		</div>
        		<div class="form-actions">
                <input type="hidden" name="subjoin" value="1" />
        			<button class="button primary">Register with...</button>
        		</div>
	       </form>
        </div>
    </div>
	
</div>
</div>

<span class="element-divider place-right"></span>
<?php if($session->logged_in){ ?>
<button class="element image-button image-left place-right">
<?php echo $session->userinfo['fullname'];  ?> <img src="<?php  echo $database->const_thm_img.'/default-profile-256x256.png'; ?>"/>
</button>
<?php } ?>
<span class="element-divider place-right"></span>
<!--    -->
<div class="element place-right" style="padding: 2px;">
<?php
if($session->logged_in){ ?>
    <button class="command-button primary" onclick="location.href='?modules=Ads&op=post_ads_form'">
        <i class="icon-share-2 on-left"></i>
        Post an Adsvertisement
        <small>also upload ads image</small>
    </button>
<?php }else{ ?>
    <button class="command-button primary" onclick="window_login_register();">
        <i class="icon-share-2 on-left"></i>
        Post an Adsvertisement
        <small>but please login first</small>
    </button>
<?php } ?>


 
</div>
</nav>
</nav>