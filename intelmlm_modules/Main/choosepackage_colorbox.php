<div id="choosepackage_colorbox" style="display: none;">
    <div id="colorbox_choosepackage">
        <h3>Anda memilih pakej <span class="pakej_selected">pakej</span> E-Books. Adakah anda pasti?</h3>
        <div class="grid fluid">
            <div class="row">
                <div class="span6">
                    <div class="hosting_plans_area">
<div class="hosting_plans_center_div">
        <div class="plan_box" id="plan_box_10">
        	<div class="plan_box_price"><h3>RM 100<br><i>/</i></h3></div>
            <div class="plan_box_title"><h3>Pakej 10<br>E-Book</h3></div>
            <div class="plan_box_content">
                <ul>
                    <li>10 buah E-Book</li>
                    <li>5 Kumpulan Promosi</li>
                    
                </ul>
           	</div>
        	<div class="plan_box_shadow"></div>
        </div><!-- end a Plan --> 
        
        <div class="plan_box last" id="plan_box_20">
        	<div class="plan_box_price"><h3>RM 200<br><i>/m</i></h3></div>
            <div class="plan_box_title"><h3>Pakej 20<br>E-Book</h3></div>
            <div class="plan_box_content">
                <ul>
                    <li>20 buah E-Book</li>
                    <li>10 Kumpulan Promosi</li>
                    
                </ul>
           <h6><a href="#" class="plans_button">pilih pakej ini</a></h6>
           	</div>
        	<div class="plan_box_shadow"></div>
        </div><!-- end a Plan -->
        <div style="clear: both;"></div>
    </div>
</div>
                </div>
                <div class="span6">
                <form id="form_choose_package" method="post" action="?modules=Main&op=process_choose_package">
        
            <select name="package[package]" id="choose_package_dropdown" data-selected="10">
                <option value="10" selected="selected">10 ebook (RM 100) - Pilih 10 ebook dari 5 orang penjual</option>
                <option value="20">20 ebook (RM 200) - Pilih 20 ebook dari 10 orang penjual</option>         
            </select>
        
            
            <br />
            
            
            <fieldset>
                                       
                                        <label>No Tel Bimbit</label>
                                        <div class="input-control text" data-role="input-control">
                                            <input type="text" placeholder="Contoh: 0124355266" name="package[tel]" id="package_tel" />
                                            <button class="btn-clear" tabindex="-1" type="button"></button>
                                        </div>
                                        
                                        
<input type="hidden" name="package[op]" value="choose_package" />
            <input type="submit" value="Submit" />
                                    </fieldset>
            
            
        </form>
                </div>
            </div>
        </div>
    
        
    </div>
</div>

<script type="text/javascript">
function colorbox_get_id(){
    if ($("#colorbox").css("display")=="block") {  
        var content = $("#cboxLoadedContent");
        if($(content).children().length == 1){
            var contentid = $(content).children().attr('id');
        }else{
            var contentid = 0;
        }
    }else{  
        
        return false;
    }  
    return contentid;
}
function set_package(pakej){
    var frame = $("#colorbox_choosepackage");
    var d = $("#choose_package_dropdown");
    var s = d.val();
    if(pakej == 'reset'){
        //d.show();
        d.val(10);
        d.data('selected', 10);
        open_colorbox_choosepackage(10);
        return false;
    }
    if(s != pakej){
        d.data('selected', pakej);
        d.val(pakej);
        d.hide();
    }
    
    var selected = $("#choose_package_dropdown").data('selected');
    
    frame.find('.pakej_selected').text(pakej);
    $("#plan_box_10").hide();
    $("#plan_box_20").hide();
    
    $("#plan_box_"+pakej).show()
    
}
function open_colorbox_choosepackage(pakej){ //0 mean no selected
    
    if(!pakej){
        //alert('Please put pakej value. Given value: '+pakej);
        //reset
        var dropdown = $("#choose_package_dropdown");
        //dropdown.show();
        open_colorbox_choosepackage(10)
        return false;
    }else if((pakej == 10) || (pakej == 20)){
        
        var dropdown = $("#choose_package_dropdown");
        var selected = dropdown.val();
        
        if(colorbox_get_id() != "colorbox_choosepackage"){
            $.colorbox({
                href: "#colorbox_choosepackage",
                inline: true,
                onLoad: function(){
                    dropdown.hide();
                    set_package(pakej);
                }
            });
        }else{
            set_package(pakej);
        }
        
        return false;
    }else if(pakej == 'reset'){
        set_package(pakej)
    }
    
    
    return false;
}
$(function(){
    $("#form_choose_package").ajaxForm({
        dataType: 'json',
        beforeSubmit: function(data, $form, options){
            //check mobile;
            var tel = $("#package_tel").val();
            if(!tel){
                alert('Please put your mobile number');
                return false;
            }
            
        },
        success: function(data){
            console.log(data);
            if(data.status == 'success'){
                $("#status_pakej_pilih").data('package', data.pakej);
                cache.session.pakej = data.pakej;
            }
        }
    })
});
</script>