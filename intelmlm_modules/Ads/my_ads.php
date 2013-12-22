<?php
include(THEME_LOC."/main_header.php");

$list_ads = $Class_Ads->get_list_ads_by_userid($session->uid);
?>
<div class="grid fluid" style="padding: 10px;">
    <div class="row">
        <div class="span12">
<table class="table hovered">
<thead>
<tr class="info">
    
	<th class="text-left">
		Title
	</th>
	<th class="text-left">
		Publish date
	</th>
	<th class="text-left">
		Status
	</th>
	<th class="text-left">
		Action
	</th>
</tr>
</thead>
<tbody>
<?php foreach($list_ads as $count => $ads_detail){ ?> 
<tr>
    
	<td class="right">
		<?php echo $Mx->truncate($ads_detail['title'],20); ?>
	</td>
    <td class="right">
		<?php echo $Mx->timestamp_to_date($ads_detail['publish_date'],'d-m-Y h:i:s A'); ?>
	</td>
	
	
	<td class="right">
		<?php echo $database->getSingleValueByMetaAndRef('ads_status', $ads_detail['status']); ?>
	</td>
    <td class="right">
		<a href="?modules=Ads&op=post_ads_form&adsid=<?php echo $ads_detail['id']; ?>" class="button mini">edit</a>
        <a href="?modules=Ads&op=view_ads&id=<?php echo $ads_detail['id']; ?>" class="button mini">view</a>
        <a href="?modules=Ads&op=post_ads_form&adsid=<?php echo $ads_detail['id']; ?>" class="button mini">stat</a>
	</td>
</tr>
<?php } ?>
</tbody>
<tfoot>
</tfoot>
</table>
                    </div>
                    </div>
                    </div>