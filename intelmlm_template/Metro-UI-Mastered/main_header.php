<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="<?php echo THEME_LOC; ?>/css/metro-bootstrap.css">
<script src="<?php echo THEME_LOC; ?>/docs/js/jquery/jquery.min.js"></script>
<script src="<?php echo THEME_LOC; ?>/docs/js/jquery/jquery.widget.min.js"></script>

<script src="<?php echo THEME_LOC; ?>/js/metro-loader.js"></script>

<link rel="stylesheet" href="<?php echo THEME_LOC; ?>/js/colorbox-master/example5/colorbox.css">
<script type="text/javascript" src="<?php echo THEME_LOC; ?>/js/colorbox-master/jquery.colorbox.js"></script>
<script type="text/javascript" src="<?php echo THEME_LOC; ?>/js/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo THEME_LOC; ?>/js/jquery.form.js"></script>

<link rel="stylesheet" href="<?php echo THEME_LOC; ?>/js/jquery.qtip/jquery.qtip.css" />
<script type="text/javascript" src="<?php echo THEME_LOC; ?>/js/jquery.qtip/jquery.qtip.js"></script>
<script type="text/javascript" src="<?php echo THEME_LOC; ?>/js/ui/jquery-ui.custom.js"></script>


<style>
        .list {
            width: 100% !important;
        }
</style>
</head>
<body class="metro">
<?php if($session->isAdmin()){ ?>
<?php include_once(THEME_LOC.'/admin_panel.php'); ?>
<?php } ?>
<nav class="navigation-bar">
<nav class="navigation-bar-content">
<div class="element">
	<a class="dropdown-toggle" href="#">Usahawan Ekspress</a>
	<ul class="dropdown-menu" data-role="dropdown">
        <li><a href="index.php">Dashboard</a></li>
        <?php if($session->logged_in){ ?>
            <?php if($Class_unilevel->isVerified($session->uid)){ ?>
                <li><a href="main.php?modules=Main&op=choose_product">E-Book</a></li>
                <li><a href="index.php?modules=Main&op=kumpulan">Kumpulan</a></li>
                <li><a href="index.php?modules=Main&op=pesanan">Pesanan</a></li>
                <li><a href="main.php?modules=Main&op=promosi">Promosi</a></li>
                <li><a href="index.php?modules=Main&op=statistik">Statistik</a></li>
            <?php } ?>
        <?php } ?>
        
        
		
		<li class="divider"></li>
		<li><a href="#">Terma dan syarat</a></li>
		<li class="divider"></li>
		<li><a href="#">Keluar</a></li>
	</ul>
    
</div>

<span class="element-divider"></span>
<a class="element brand" href="#"><span class="icon-spin"></span></a>
<a class="element brand" href="#"><span class="icon-printer"></span></a>


<div class="element place-right">
	<a class="dropdown-toggle" href="#">
	<span class="icon-cog"></span>
	</a>
	<ul class="dropdown-menu place-right" data-role="dropdown">
        
        <?php if($session->logged_in){ ?> 
		  <li><a href="main.php?modules=Main&op=account">Account</a></li>
            <li><a href="process.php">Logout</a></li>
        <?php }else{ ?> 
		
		
		
        
        <?php } ?>
        <li><a href="#">Support</a></li>
	</ul>
</div>
<span class="element-divider place-right"></span>
<?php if(!$session->logged_in){ ?> 
<a class="element place-right" href="#" id="window_login"><!--<span class="icon-locked-2">-->Login / Register</span></a>
<?php } ?>
<script type="text/javascript">
var isEmbeded = !(top === self);
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
                    <button type="button" class="button primary" onclick="login_form_fb();">Login using Facebook</button>
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
                <input type="hidden" name="uplineid" value="<?php echo $Class_unilevel->uplineInfo['id']; ?>" />
        			<button class="button primary">Register with...</button>
        		</div>
	       </form>
        </div>
    </div>
	
</div>
</div>

<span class="element-divider place-right"></span>
<?php if($session->logged_in){ ?>
    <?php if($session->login_using == 'facebook'){ ?>
    <button class="element image-button image-left place-right">
    <?php echo $session->fbinfo['name'];  ?> <img src="https://graph.facebook.com/<?php echo $session->userinfo['fb_id']; ?>/picture">
    </button>
    <?php }else{ ?>
    <button class="element image-button image-left place-right">
    <?php echo $session->userinfo['email'];  ?> <img src="<?php  echo $database->const_thm_img.'/default-profile-256x256.png'; ?>"/>
    </button>
    <?php } ?>
<?php } ?>
<span class="element-divider place-right"></span>



 
</div>
</nav>
</nav>
<style>
.stat_head .notice {
    padding: 10px !important;
}
</style>
<div class="grid fluid stat_head" style="padding: 0 20px 0 20px; margin-bottom: 0px; margin-top: 0px">
    <div class="row" style="margin-top: 0px;">
        <div class="span3 text-center">
            <div style="font-size: 40px;"><?php echo 'RM '.$Class_Transaction->countTransactionByStatus('paid')*20; ?></div>
            <div class="notice marker-on-top bg-darkRed fg-white">
            Jumlah transaksi
            </div>

        </div>
        <div class="span3 text-center">
            <div style="font-size: 40px;"><?php echo $database->getNumMembersVerified(); ?></div>
            <div class="notice marker-on-top bg-pink fg-white">
            Ahli aktif
            </div>

        </div>
        <div class="span3 text-center">
            <div style="font-size: 40px;"><?php echo $Class_Transaction->countTransactionByStatus('paid'); ?></div>
            <div class="notice marker-on-top bg-darkTeal fg-white">
            Jualan ebook
            </div>

        </div>
        <div class="span3 text-center">
            <div style="font-size: 40px;"><?php echo ($database->calcNumActiveUsers()+$database->calcNumActiveGuests()); ?></div>
            <div class="notice marker-on-top fg-white">
            Ahli Online
            </div>

        </div>
    </div>

</div>