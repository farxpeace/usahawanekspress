<?php
#include(THEME_LOC."/main_header.php");
?>

<script type="text/javascript" src="<?php echo THEME_LOC; ?>/js/Print-Specified-Area-Of-A-Page-PrintArea/demo/jquery.PrintArea.metro.js"></script>

<script type="text/javascript">
var pakej_10_limit = 2;
var pakej_20_limit = 2;
$(function(){
    $("#order_pakej").change(function(){
        pakej = $(this).val();
        
        pakej_detail(pakej)
    });
});

function check_input_select_book(btn){
    var data = $(btn).data();
    var isSelected = $(btn).hasClass('selected');
    var input = $(btn).children('input.hidden_select');
    if(isSelected){
        $(input).attr('disabled', 'disabled').val('0');
        $(btn).removeClass('selected');
        
    }else{
        $(input).removeAttr('disabled').val(data.ebookid);
        $(btn).addClass('selected');
    }
}

function pakej_detail(pakej){
    if(pakej == '10'){
        $("#pakej_text_detail").html('Pakej ini membenarkan anda memilih 10 ebook dari 5 orang penjual');
    }else if(pakej == '20'){
        $("#pakej_text_detail").html('Pakej ini membenarkan anda memilih 20 ebook dari 10 orang penjual');
    }
    
    //check
    pakej_change_check();
    
}

function pakej_change_check(){
    reset_check_ebook_pilih_order();
}

function reset_check_ebook_pilih_order(){
    $('a.ebook_pilih_order').each(function(){
        ebook_pilih_order_deselect(this);
        var frame = $(this).closest('.frame_choose_ebook');
        $(frame).unblock(); 
    });
    
    //reset block
    
}

function reset_check_ebook_pilih_order_by_id(number){
    var frame = $("#_ebook_pilih_"+number);
    $(frame).find('a.ebook_pilih_order').each(function(){
        ebook_pilih_order_deselect(this);
    });
    unblock_frame(number)
}

function ebook_pilih_order_select(el){
    var data = $(el).data();
    var input = $(el).children('input.input_select_single_ebook');
    $(el).addClass('selected');
    $(input).removeAttr('disabled').val(data.ebookid);
}
function ebook_pilih_order_deselect(el){
    var data = $(el).data();
    var input = $(el).children('input.input_select_single_ebook');
    $(el).removeClass('selected');
    $(input).attr('disabled', 'disabled').val('0');
    
}

/*
function check_ebook(){
    //check each tab
    $('.frame_choose_ebook').each(function(i){
        var ebooks = $(this).find('.ebook');
        var ebook = $(this).find('a.ebook_pilih_order');
        
        $(ebook).each(function(){
            var data = $(this).data();
            var isSelected = $(this).hasClass('selected');
            var input = $(this).children('input.hidden_select');
            if(isSelected){
                $(input).val('0');
                //$(this).removeClass('selected');
            }else{
                $(input).val(data.bookid);
                //$(this).addClass('selected');
            }
        });
        
    });
}
*/

function check_order_by_ebook(el){
    var data = $(el).data();
    var frame = $(el).closest('.frame_choose_ebook');
    var input = $(el).children('input.input_select_single_ebook');
    var isSelected = $(el).hasClass('selected');
    var selected = $(frame).find('a.selected').length;
    var pakej = $("#order_pakej").val();
    
    if(pakej == '10'){
        var limit = pakej_10_limit;
        if(selected < pakej_10_limit){
            if(isSelected){
                $(el).removeClass('selected');
                $(input).attr('disabled', 'disabled').val('0');
            }else{
                
                $(el).addClass('selected');
                $(input).removeAttr('disabled').val(data.ebookid);
                
            }
        }else if(selected == 1){
            console.log('blok');
        }
    }else{
        var limit = pakej_20_limit;
        if(selected < pakej_20_limit){
            if(!isSelected){
                $(el).addClass('selected');
                $(input).removeAttr('disabled').val(data.ebookid);
            }else{
                $(el).removeClass('selected');
                $(input).attr('disabled', 'disabled').val('0');
            }
        }else{
            console.log('blok');
        }
        
    }
    var selected_c = $(frame).find('a.selected').length;
    if(selected_c == limit){
        block_frame(frame);
    }
}

function check_frame_by_id(number){
    var frame = $("#_ebook_pilih_"+number);
    var pakej = $("#order_pakej").val();
    var selected = $(frame).find('a.selected').length;
    
    if(pakej == '10'){
        var limit = pakej_10_limit;
    }else if(pakej == '20'){
        var limit = pakej_20_limit;
    }
    
    if(selected == limit){
        block_frame(frame);
    }
}

function block_frame(frame){
    var frameId = $(frame).attr('id');
    var number = frameId.substr(frameId.length - 1);
    
    var strVar="";
    strVar += "<div style=\"position: absolute;background-color: #FFCCCC;top: 10px;left: 10px;right: 10px;bottom: 10px;top: 10px;\"><\/div>";

    //$("#_ebook_pilih_"+number).css('position', 'relative').append(strVar);
    
    $("#frame_choice_"+number).hide();
    $("#frame_success_"+number).show();
    /*
    $(frame).block({ 
            message: '<p>Adakah anda pasti?</p><br /><button onclick="submit_form_checkout('+number+')" type="button" class="button primary">Ya</button> &nbsp <button onclick="reset_check_ebook_pilih_order_by_id('+number+');" type="button" class="button danger">Pilih semula</button>', 
            css: { 
                backgroundColor: 'transparent',
                border: 'none'
            } 
        });
    */
       
}

function unblock_frame(number){
    $("#frame_choice_"+number).show();
    $("#frame_success_"+number).hide(); 
}

function submit_form_checkout(number){
    var pakej = $("#order_pakej").val();
    $("#form_checkout_"+number).ajaxSubmit({
        dataType: 'json',
        data: { pakej: pakej  },
        beforeSubmit: function(){
            
        },
        success: function(data){
            console.log(data)
        }
    }); 
    // return false to prevent normal browser submit and page navigation 
    return false; 
}

function open_colorbox_select_ebook_for_purchase_number(number){
    $.colorbox({
         href: '#colorbox_select_ebooks_'+number,
         inline: true,
         onComplete: function(){
            $.colorbox.resize();
         }
    });
}
</script>

<div class="grid" style="margin-bottom: 0px;">
    <div class="row">
        <div class="span4">
            <table>
                <tr>
                    <td valign="center">
                        <div class="input-control text" style="margin-bottom: 0px; width: 100px; padding-top: 5px;">
                            Pilih Pakej
                        </div>
                    </td>
                    <td >
                         <div class="input-control select" style="margin-bottom: 0px;">
                        <select name="order[pakej]" id="order_pakej">
                            <option value="10" selected="selected">10 ebook (RM 100)</option>
                            <option value="20">20 ebook (RM 200)</option>
                                        
                        </select>
                        </div>
                    </td>
                </tr>
            </table>
            
           
                
        </div>
        <div class="span8 bg-white">
            <div class="padding5 bg-amber">
                    <p class="fg-white item-title" id="pakej_text_detail">Sila pilih pakej</p>
                </div>
                
            
            
        </div>
        
    </div>
</div>

<div id="frame_list_choose_product">
    <div>
        <?php for($i=1; $i<=5; $i++){  ?>
        <?php
        $uplineCountArray = $i-1;
        ?>
        <div style="float: left">
                <div class="listview">
                    
                	<a href="javascript: void(0);" onclick="open_colorbox_select_ebook_for_purchase_number(<?php echo $i; ?>);" class="list list_upline input_select_ebook" data-bookid="54<?php echo $i; ?>">
                        <input class="hidden_select" type="hidden" value="1" name="order[ebook][<?php echo $i; ?>][<?php echo $uplineList[$uplineCountArray]['id']; ?>]" />
                        <div class="list-content">
                            <img src="images/onenote2013icon.png" class="icon">
                            <div class="data">
                                <span class="list-title">Pembelian <?php echo $i; ?></span>
                                <span>Ebook : 0/2</span>
                            </div>
                        </div>
                    </a>
                   
                </div>
                <div style="display: none;">
                    <div id="colorbox_select_ebooks_<?php echo $i; ?>">
                        <?php include('colorbox_select_ebooks.php'); ?>
                    </div>
                    
                </div>
            </div>
            
             <?php } ?>
            <?php for($i=6; $i<=10; $i++){ ?>
            <?php
            $uplineCountArray = $i-1;
            ?>
            <div style="float: left">
                <div class="listview">
                    
                	<a href="javascript: void(0);" onclick="open_colorbox_select_ebook_for_purchase_number(<?php echo $i; ?>);" class="list list_upline input_select_ebook">
                        <input class="hidden_select" type="hidden" value="1" name="order[ebook][<?php echo $i; ?>][<?php echo $uplineList[$uplineCountArray]['id']; ?>]" />
                        <div class="list-content">
                            <img src="images/onenote2013icon.png" class="icon">
                            <div class="data">
                                <span class="list-title">Pembelian <?php echo $i; ?></span>
                                <div class="progress-bar small" data-role="progress-bar" data-value="75"><div class="bar bg-cyan" style="width: 75%;"></div></div>
                                <span class="list-remark">Download...75%</span>
                            </div>
                        </div>
                    </a>
                    
                </div>
                <div style="display: none;">
                    <div id="colorbox_select_ebooks_<?php echo $i; ?>">
                        <?php include('colorbox_select_ebooks.php'); ?>
                    </div>
                    
                </div>
            </div>
            <?php } ?>
            <div style="clear: both;"></div>
    </div>

    
    
    
</div>


<p>Anda perlu membuat 5 pembelian dari peniaga kami</p>
