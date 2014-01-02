<?php
include(THEME_LOC."/main_header.php");
?>
<?php
$all_level = $Class_unilevel->getUserLevel($session->uid, ($session->userinfo['pakej']/2));

$loop = $session->userinfo['pakej']/2;


?>
<div class="grid fluid" style="padding: 10px;">
    <div class="row">
        <div class="span12">
        
        
<?php

for($i = 1; $i <= $loop; $i++){
?>

<div class="accordion" data-role="accordion">
    <div class="accordion-frame">
        <a href="#" class="heading">Kumpulan <?php echo $i; ?></a>
        <div class="content">
            <div class="tab-control" data-role="tab-control">
                <ul class="tabs">
                    <li class="active"><a href="#_level_<?php echo $i; ?>_statistik">Statistik</a></li>
                    <li><a href="#_level_<?php echo $i; ?>_members">Senarai Ahli</a></li>
                    
                </ul>
             
                <div class="frames">
                    <div class="frame" id="_level_<?php echo $i; ?>_statistik">
                        
                    </div>
                    <div class="frame" id="_level_<?php echo $i; ?>_members">
                    <?php
                    $this_level = array();
                    $this_level = $Class_unilevel->levelinfo[$i];
                    //print_r($this_level);
                    ?>
                        <?php if(is_array($this_level)){ foreach($this_level['user_id'] as $a => $b){ ?>
                        <?php  $u = $database->getUserInfoById($b); ?>
                        <div style="float: left; width: 200px">
                            <button class="image-button bg-darkGreen fg-white image-left">
                            <?php echo $u['email']; ?>
                            <i class="icon-windows bg-green fg-white"></i>
                        </button>
                        </div>

                                    
                                    
                                    

                                    


                                    
                           
                        <?php }} ?>
                         <div style="clear: both;"></div>
                              
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
</div>



<?php } ?>

</div>
    </div>
</div>