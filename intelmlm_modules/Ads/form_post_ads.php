<?php

include(THEME_LOC."/main_header.php");
$adsid = $_REQUEST['adsid'];
$image_list = array();
if(is_numeric($adsid)){
    $Class_Ads->ads['id'] = $adsid;
    //$edit_ads = $Class_Ads->create_ads_by_userid();
    //print_r($Class_Ads);
    //exit();
    $ads = $Class_Ads->get_ads_by_adsid();
    
    //print_r($ads);
}

?>
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?php echo THEME_LOC; ?>/js/jQuery-File-Upload-master/css/jquery.fileupload.css">
<link rel="stylesheet" href="<?php echo THEME_LOC; ?>/js/jQuery-File-Upload-master/css/jquery.fileupload-ui.css">


<div class="grid fluid" style="padding: 10px;">
	<div class="row">
		<div class="span6">
			<form action="?modules=Ads&op=post_ads" method="post" id="form_post">
                <input type="hidden" name="ads[id]" value="<?php echo $adsid; ?>" />
				<fieldset>
					<legend>Post an Ads</legend>
					<label>Ads title</label>
					<div class="input-control text" data-role="input-control">
						<input type="text" placeholder="type text" name="ads[title]" value="<?php echo $ads['title']; ?>" />
						<button class="btn-clear" tabindex="-1" type="button"></button>
					</div>
					<label>Description</label>
					<div class="input-control textarea" data-role="input-control">
						<textarea name="ads[description]"><?php echo $ads['description']; ?></textarea>
					</div>
					<div class="grid fluid">
						<div class="row">
							<div class="span6">
								<label>Category</label>
								<div class="input-control select">
									<select id="select_category" name="ads[category]">
                                        <option class="temp" value="temp">Please select category</option>
                                        <?php foreach($database->getAllValueByRefAndMeta('ads_category', 'name') as $id => $value){  ?>
                                            <option <?php if($id == $ads['category']){ echo 'selected="selected"'; } ?> value="<?php echo $id; ?>"><?php echo $value; ?></option>
                                        <?php } ?>
										
									</select>
								</div>
							</div>
                            <script type="text/javascript">
                            $(function(){
                                $("#select_subcategory").html('<option class="temp" value="temp">Please select category</option>')
                                $("#select_subcategory").attr('disabled', 'disabled');
                                $("#select_category").change(function(){
                                    var subcategory = $(this).val();
                                    $(this).children('option.temp').remove();
                                    if(subcategory == 'temp'){
                                        $("#select_subcategory").html('<option class="temp" value="temp">Please select category</option>')
                                        $("#select_subcategory").attr('disabled', 'disabled');
                                    }else{
                                        $("#select_subcategory").removeAttr('disabled');
                                        $("#select_subcategory").children('option.temp').remove()
                                        $("#select_subcategory").html($('#content_subcategory option[ref|='+subcategory+']').clone())
                                    
                                    }
                                    
                                });
                                
                                var cat = 0;
                                <?php if($ads['category']){ ?>
                                cat = '<?php echo $ads['category']; ?>';
                                <?php } ?>;
                                if(cat == $("#select_category").val()){
                                    var subcategory = $("#select_category").val();
                                    $(this).children('option.temp').remove();
                                    if(subcategory == 'temp'){
                                        $("#select_subcategory").html('<option class="temp" value="temp">Please select category</option>')
                                        $("#select_subcategory").attr('disabled', 'disabled');
                                    }else{
                                        $("#select_subcategory").removeAttr('disabled');
                                        $("#select_subcategory").children('option.temp').remove()
                                        $("#select_subcategory").html($('#content_subcategory option[ref|='+subcategory+']').clone())
                                    
                                    }
                                }
                                
                                
                                
                            });
                            </script>
							<div class="span6">
								<label>Sub category</label>
								<div class="input-control select">
									<select id="select_subcategory" name="ads[subcategory]">
                                        
										
									</select>
                                    <div style="display: none;" id="content_subcategory">
                                        <?php foreach($database->getAllIdMetaValueByRef('ads_subcategory') as $id){ print_r($id); ?>
                                            <?php #foreach($id as $a => $b){ print_r($id); ?>
                                                <option class="option_subcategory" ref="<?php echo $id['meta']; ?>" value="<?php echo $id['id']; ?>"><?php echo $id['value']; ?></option>
                                            <?php #} ?>
                                            
                                        <?php } ?>
                                    </div>
								</div>
							</div>
						</div>
					</div>
                    
                    <div class="accordion" data-role="accordion" data-closeany="true">
        				<div class="accordion-frame">
        					<a class="active heading collapsed" href="#">Price</a>
        					<div class="content" style="display: none;">
        						 <label>Sale Price (RM)</label>
                					<div class="input-control text" data-role="input-control">
                						<input type="text" placeholder="type text" name="ads[sale_price]" value="<?php echo $ads['price_sale']; ?>" />
                						<button class="btn-clear" tabindex="-1" type="button"></button>
                					</div>
        					</div>
        				</div>
        				
        				
        			</div>
					
					<div class="input-control checkbox" data-role="input-control">
						<label>
						<input type="checkbox" value="accept" checked="" name="ads[agreement]" />
						<span class="check"></span>
						I Agree with terms and conditions </label>
					</div>
					<input type="submit" value="Submit">
				</fieldset>
                <?php if(is_array($ads['images'])){ ?>
                    <?php foreach($ads['images'] as $count => $image_detail){ ?>
                    <input type="hidden" id="input_image_to_upload_<?php echo $image_detail['id']; ?>" name="ads[image][]" value="<?php echo $image_detail['id']; ?>" />
                    <?php } ?>
                <?php } ?>


			</form>
		</div>
		<div class="span6">
			<div class="accordion" data-role="accordion" data-closeany="true">
				<div class="accordion-frame">
					<a class="heading collapsed" href="#">Picture</a>
					<div class="content">
                        
                        <div id="choosed_picture" style="margin-bottom: 20px;display: inline-block;">
                            
                            <?php
                                if(is_array($ads['images'])){
                                    
                                
                                foreach($ads['images'] as $count => $image_detail){
                                    //$image_detail = $Class_Ads->get_single_image_by_imageid($imageid);
                                    //print_r($image_detail);
                                ?>
                                <div id="image_to_upload_<?php echo $image_detail['id']; ?>" class="image-container shadow place-left" style="width: auto !important; margin-right: 10px; margin-top: 10px; background-color: transparent !important;">
                                    <img src="http://intelmlm.com/intelmlm_images/uploaded/thumbnail/<?php echo $image_detail['name']; ?>" style="width: 100px;">
                                    <div class="overlay-fluid">
                                        <button data-imageid="<?php echo $image_detail['id']; ?>" class="small" type="button" onclick="remove_image(this);">remove</button>
                                    </div>
                                </div>
                                <?php
                                }
                            }
                            ?>
                            
                            <div style="clear: both;"></div>
                        </div>
                        <div style="clear: both;"></div>
                        
                    
                        <div class="tab-control" data-role="tab-control">
                            <ul class="tabs">
                                
                                <li class="active"><a href="#_page_2">Upload</a></li>
                                <li><a href="#_page_3"><i class="icon-rocket"></i></a></li>
                                <li class="place-right"><a href="#_page_4"><i class="icon-cog"></i></a></li>
                            </ul>
                         
                            <div class="frames">
                                
                                <div class="frame" id="_page_2">
                                <form id="fileupload" action="intelmlm_images/index.php" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="uid" value="<?php echo $session->uid; ?>">
                                <!-- Redirect browsers with JavaScript disabled to the origin page -->
                                <noscript><input type="hidden" name="redirect" value="http://blueimp.github.io/jQuery-File-Upload/"></noscript>
                                <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                <div class="row fileupload-buttonbar">
                                    <div class="col-lg-7">
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn btn-success fileinput-button">
                                            <i class="glyphicon glyphicon-plus"></i>
                                            <span style="cursor: pointer;">Add files...</span>
                                            <input type="file" name="files[]" style="" multiple  />
                                        </span>
                                        <button type="submit" class="btn btn-primary start">
                                            <i class="glyphicon glyphicon-upload"></i>
                                            <span>Start upload</span>
                                        </button>
                                        <button type="reset" class="btn btn-warning cancel">
                                            <i class="glyphicon glyphicon-ban-circle"></i>
                                            <span>Cancel upload</span>
                                        </button>
                                        <button type="button" class="btn btn-danger delete">
                                            <i class="glyphicon glyphicon-trash"></i>
                                            <span>Delete</span>
                                        </button>
                                        <input type="checkbox" class="toggle">
                                        <!-- The global file processing state -->
                                        <span class="fileupload-process"></span>
                                    </div>
                                    <!-- The global progress state -->
                                    <div class="col-lg-5 fileupload-progress fade">
                                        <!-- The global progress bar -->
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                        </div>
                                        <!-- The extended global progress state -->
                                        <div class="progress-extended">&nbsp;</div>
                                    </div>
                                </div>
                                <!-- The table listing the files availabel for upload/download -->
                                <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                            </form></div>
                                <div class="frame" id="_page_3">...</div>
                            </div>
                        </div>
						 <!-- The file upload form used as target for the file upload widget -->
                            
					</div>
				</div>
				<div class="accordion-frame">
					<a class="heading collapsed" href="#">Payment</a>
					<div class="content clearfix" style="">
                        <div class="tab-control" data-role="tab-control">
    <ul class="tabs">
        <li class="active"><a href="#_payment_1">Maybank2Pay</a></li>
        <li><a href="#_payment_2">Paypal</a></li>
        <li><a href="#_payment_3">Bank Deposit</a></li>
        <li class="place-right"><a href="#_payment_4"><i class="icon-cog"></i></a></li>
    </ul>
 
    <div class="frames">
        <div class="frame" id="_payment_1">
        Maybank content here
        </div>
        <div class="frame" id="_payment_2">
            Bank
        </div>
        <div class="frame" id="_payment_3">...</div>
    </div>
</div>
                        
					</div>
				</div>
				<div class="accordion-frame">
					<a class="heading collapsed" href="#">Shipping</a>
					<div class="content clearfix" style="">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/x-tmpl" id="template-library-picture">
<div id="image_to_upload_${imageid}" class="image-container shadow place-left" style="width: auto !important; margin-right: 10px; margin-top: 10px; background-color: transparent !important;">
                            <img src="${thumbnailurl}" style="width: 100px;">
                            <div class="overlay-fluid">
                                <button data-imageid="${imageid}" class="small" type="button" onclick="remove_image(this);">remove</button>
                            </div>
                        </div>
</script>
<script type="text/x-tmpl" id="template-library-picture_input">
<input type="hidden" id="input_image_to_upload_${imageid}" name="ads[image][]" value="${imageid}" />
</script>
<!-- The blueimp Gallery widget -->
<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<!-- The template to display files availabel for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files availabel for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" data-userid="{%=file.userid%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                    <br /><button data-thumbnailUrl="{%=file.thumbnailUrl%}" class="btn_upload_use_this_image" data-imageid="{%=file.id%}" data-userid="{%=file.userid%}" data-url="{%=file.url%}" data-title="{%=file.name%}" type="button" onclick="btn_upload_use_this_image(this);"><i class="icon-plus-2 on-left"></i>Use this image</button>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo THEME_LOC; ?>/js/jQuery-File-Upload-master/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo THEME_LOC; ?>/js/jQuery-File-Upload-master/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo THEME_LOC; ?>/js/jQuery-File-Upload-master/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo THEME_LOC; ?>/js/jQuery-File-Upload-master/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo THEME_LOC; ?>/js/jQuery-File-Upload-master/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo THEME_LOC; ?>/js/jQuery-File-Upload-master/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo THEME_LOC; ?>/js/jQuery-File-Upload-master/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo THEME_LOC; ?>/js/jQuery-File-Upload-master/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="<?php echo THEME_LOC; ?>/js/jQuery-File-Upload-master/js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="<?php echo THEME_LOC; ?>/js/jQuery-File-Upload-master/js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
<script type="text/javascript" src="http://cdn.tutsplus.com/net/uploads/legacy/811_templatingPlugin/templatePlugin/jquery.tmpl.js"></script>
<script type="text/javascript">
function open_library(){
    
        $.Dialog({
            overlay: true,
            shadow: true,
            flat: true,
            icon: '<img src="images/excel2013icon.png">',
            title: 'Flat window',
            content: '',
            onShow: function(_dialog){
                var content = $('.content_login').clone().wrap('<div>').parent().html();
                content.html('Set content from event onShow');
            }
        });
  
}

function btn_upload_use_this_image(btn){
    var self = btn, data = $(btn).data();
    
    console.log($("#choosed_picture").find("#image_to_upload_"+data.imageid))
    if($("#choosed_picture").find("#image_to_upload_"+data.imageid).length == 0){
        var output = { imageid: data.imageid, thumbnailurl: data.thumbnailurl, title: data.title }
        //console.log(data);
        $('#template-library-picture').tmpl(output).prependTo('#choosed_picture'); 
        
        //var $form = $("#form_post");
        $('#template-library-picture_input').tmpl(output).appendTo('#form_post');
        //console.log($('#template-library-picture_input').tmpl(output).appendTo('#form_post'))
         
    }
    
    
    
}

function remove_image(btn){
    var self = btn, data = $(btn).data();
    if($("#choosed_picture").find("#image_to_upload_"+data.imageid).length != 0){
        console.log(data);
        $("#image_to_upload_"+data.imageid).remove();
        $("#input_image_to_upload_"+data.imageid).remove();
        
    }
}
</script>
<script type="text/javascript">
$(function(){
    
});
</script>
</body>
</html>
<?php

?>