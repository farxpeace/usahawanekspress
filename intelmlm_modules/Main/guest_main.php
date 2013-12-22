<?php
include(THEME_LOC."/main_header.php");
?>
<div class="grid fluid" style="padding: 10px;">
	<div class="row">
		<div class="span6">
			<div class="listview">
				
				<?php
                $left_ads = $Class_Ads->get_latest_ads_limit_by('50', 'published');
                $all_ads = $Class_Ads->get_latest_ads_limit_by('50', 'published');
                //print_r($left_ads);
                //echo '<pre>';
                $total_ads = 5;//count($left_ads);
                $half_event = ($total_half & 1);
                $is_odd = ($total_ads & 1);
                
                
                //echo 'Total ads: '.$total_ads."<br>Is odd: ".$is_odd."<br>";
                
                
                if($is_odd){
                    
                    $total_minus = $total_ads-1;
                    $total_half = $total_minus/2;
                    $left_count = $total_half+1;
                    $right_count = $total_half;
                    
                }else{
                    $total_half = $total_ads/2;
                    $left_count = $total_half;
                    $right_count = $total_half;
                }
                //echo 'left: '.$left_count." right: ".$right_count."<br>";
                //foreach($left_ads as $id => $ads){
                for ($i=0;$i<$left_count;$i++){ ?>
				<a href="index.php?modules=ads&op=view_ads&id=<?php echo $all_ads[$i]['id']; ?>" class="list bg-lightBlue fg-white">
				<div class="list-content">
					<img src="<?php echo 'intelmlm_images/uploaded/thumbnail/'.$all_ads[$i]['images'][0]['name']; ?>" class="icon">
					<div class="data">
						<span class="list-title"><?php echo $all_ads[$i]['title']; ?></span>
						
						<div class="rating small no-margin fg-yellow" data-score="4" data-role="rating" data-stars="5">
							<ul style="margin-bottom: 0px;">
								<li class="rated"></li>
								<li class="rated"></li>
								<li class="rated"></li>
								<li class="rated"></li>
								<li></li>
							</ul>
						</div>
                        <span class="list-remark">Price: RM<?php echo $all_ads[$i]['price_sale']; ?></span>
					</div>
				</div>
				</a>
                <?php } ?>
                
			</div>
		</div>
		<div class="span6">
			<div class="listview">
				
                <?php for ($i=0;$i<$right_count;$i++){ ?>
				<a href="index.php?modules=ads&op=view_ads&id=<?php echo $all_ads[$i]['id']; ?>" class="list bg-lightBlue fg-white">
				<div class="list-content">
					<img src="<?php echo 'intelmlm_images/uploaded/thumbnail/'.$all_ads[$i]['images'][0]['name']; ?>" class="icon">
					<div class="data">
						<span class="list-title"><?php echo $all_ads[$i]['title']; ?></span>
						<span class="list-desc" style="font-size: 12px;"><?php echo $all_ads[$i]['description']; ?></span>
						<span class="list-remark">Price: RM<?php echo $all_ads[$i]['price_sale']; ?></span>
					</div>
				</div>
				</a>
                <?php } ?>
			</div>
		</div>
		<div class="span4">
		</div>
	</div>
</div>
</body>
</html>