<?php
include(THEME_LOC."/main_header.php");
$ads_detail = $Class_Ads->get_ads_by_adsid($_REQUEST['id']);
//echo '<pre>';
//print_r($ads_detail);
//echo '</pre>';
$Class_debugger->debug_r('view ads', $ads_detail);

?>

<div class="grid fluid" style="padding: 10px;">
    <div class="row">
        <img class="span4" src="<?php echo FOLDER_IMAGES.'/uploaded/'.$ads_detail['images']['0']['name']; ?>" />
        
        <div class="span8">
            <h1><?php echo $ads_detail['title']; ?></h1>
            <h3>Price: RM<?php echo $ads_detail['price_sale']; ?></h3>
            <h3>Advertise: <?php echo $database->getSingleUserDetailById($ads_detail['userid'], 'email'); ?></h3>
            <p><?php echo $ads_detail['description']; ?></p>
        </div>
    </div>
</div>