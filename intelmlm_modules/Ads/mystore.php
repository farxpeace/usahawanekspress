<?php
include(THEME_LOC."/main_header.php");
$storeid = $_REQUEST['storeid'];
if($Class_Ads->check_storeid_is_valid_userid($storeid, $session->uid)){
    $Class_Ads->store['id'] = $storeid;
    //$edit_ads = $Class_Ads->create_ads_by_userid();
    //print_r($Class_Ads);
    //exit();
    $store = $Class_Ads->get_store_by_storeid();
    
    //print_r($store);
    //exit();
}


$all_store = $Class_Ads->get_all_store_by_userid($session->uid);
?>


<div class="grid fluid" style="padding: 10px;">
    <div class="row">
        
        <div class="span12">
            <button class="image-button primary" onclick="open_window_create_store();">
    Create store
    <img src="http://metroui.org.ua/images/download-32.png" class="bg-cobalt">
</button>
        </div>
    </div>
</div>

<div>

<?php foreach($all_store as $count => $store_detail){ ?>
<?php
if($store_detail['store_status'] == 'need_admin_approval'){
    $store_detail['store_status'] = 'Waiting for approval';
}
?>
<div class="fx-float-left" style="float: left; min-width: 50%">
    <div class="grid fluid" style="padding: 10px;">
    <div class="row">
            <div class="span12">
                <div class="accordion" data-role="accordion">
                    <div class="accordion-frame">
                        <a href="#" class="heading"><?php echo $store_detail['store_name']; ?></a>
                        <div class="content">
                            <form action="?modules=Ads&op=view_store&storeid=<?php echo $store_detail['id']; ?>" method="post">
                                <fieldset>
                                    
                                        <label>Store name</label>
                                        <div class="input-control text" data-role="input-control">
                                            <input type="text" placeholder="type text" value="<?php echo $store_detail['store_name']; ?>" />
                                            <button class="btn-clear" tabindex="-1"></button>
                                        </div>
                                        <label>Store status</label>
                                        <div class="input-control text" data-role="input-control">
                                            <input type="text" placeholder="type text" value="<?php echo $store_detail['store_status']; ?>" disabled="disabled" />
                                            <button class="btn-clear" tabindex="-1"></button>
                                        </div>
                                        

                                        

                                        <input type="submit" value="View store" />&nbsp;<a href="?modules=Ads&op=edit_store&storeid=<?php echo $store_detail['id']; ?>" class="button primary">Edit store</a>
                                    </fieldset>
                                </form>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
</div>


<div style="display: none;">
    <div id="content_create_store" style="padding: 42px 10px 10px; padding-top: 0px !important;">
        <form action="?modules=Ads&op=post_new_store" method="post">
                                    <fieldset>
                                        <legend>Create new store</legend>
                                        <label>Store name</label>
                                        <div class="input-control text" data-role="input-control">
                                            <input type="text" placeholder="type text" name="store[name]" />
                                            <button class="btn-clear" tabindex="-1" type="button"></button>
                                        </div>
                                        
                                        <label>Category</label>
        								<div class="input-control select">
        									<select id="store_category" name="store[category]">
                                                <option class="temp" value="temp">Please select category</option>
                                                <?php foreach($database->getAllValueByRefAndMeta('store_category', 'name') as $id => $value){  ?>
                                                    <option value="<?php echo $id; ?>"><?php echo $value; ?></option>
                                                <?php } ?>
        										
        									</select>
        								</div>
                                        <script type="text/javascript">
                                
                                        </script>
                                        
                                        <div class="input-control checkbox" data-role="input-control">
                                            <label>
                                                <input type="checkbox" checked="" />
                                                <span class="check"></span>
                                                I Agree with terms and conditions
                                            </label>
                                        </div>
                                        <input type="submit" value="Submit">
                                    </fieldset>
                                </form>
    </div>
</div>

<script type="text/javascript">
$(function(){
     
});

function open_window_create_store(){
    $.Dialog({
        overlay: true,
        shadow: true,
        flat: true,
        icon: '<img src="http://metroui.org.ua/images/excel2013icon.png">',
        title: 'Create new store',
        content: '',
        onShow: function(_dialog){
            console.log(_dialog)
            var content = $('#content_create_store').clone().wrap('<div>').parent().html();
            _dialog.html(content);
            store_category();
        }
    });
}

function store_category(){
    $("select#store_category").change(function(){
        $(this).children('option.temp').remove();
    });
}
</script>

</body>
</html>