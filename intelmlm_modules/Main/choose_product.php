<?php
#include(THEME_LOC."/main_header.php");
?>
<script src="intelmlm_modules/Main/make_payment2.js"></script>
<script type="text/javascript" src="<?php echo THEME_LOC; ?>/js/Print-Specified-Area-Of-A-Page-PrintArea/demo/jquery.PrintArea.metro.js"></script>
<style>
.metro .listview .list.list_upline {
    border: 4px #CF2E2E solid;
}
.metro .listview {
    margin-right: 10px;
}
.metro .listview .list.list_upline.selected:after {
    border-top: 28px solid #0FA00A;
}
.metro .listview .list.list_upline.waiting_for_payment {
    border: 4px #2EA2CF solid;
}
.metro .listview .list.list_upline.selected {
    border: 4px #0FA00A solid;
}

.list-title {
    font-size: 16px !important;
}
.list-ebooks {
    font-size: 14px !important;
}

.list-total {
    font-size: 14px !important;
}
.list-note {
    font-size: 11px;
    line-height: 16px;
    margin: 0;
    padding: 0;
    display: block;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.list-debug {
    font-size: 10px;
    line-height: 16px;
    margin: 0;
    padding: 0;
    display: block;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}
.ebook_info_frame.row:after {
    display: none !important;
} 


</style>
<script type="text/javascript">
var pakej_10_limit = 2;
var pakej_10_upline = 5;
var pakej_20_limit = 2;
var pakej_20_upline = 10;
$(function(){
    choose_pakej();
    run_each_purchase_box();
    $("#order_pakej").change(function(){
        pakej = $(this).val();
        pakej_detail(pakej);
        choose_pakej();
        $("#user_pakej").text(pakej+' ebook');
    });
});

function run_each_purchase_box(){
    $(".colorbox_select_ebooks_class").each(function(){
        var frameId = $(this).attr('id'); 
        var number = frameId.split('_')[3];
        var data = $(this).data();
        var status = data.status;
        
        if(status == 'waiting_for_payment'){
            set_ebook_purchase_count(number, '2');
            //$("#mainframe_purchase_"+number).find('.list_upline').addClass('selected');
            $("#frame_pembayaran_"+number).payment('option', 'status', 'waiting_for_payment');
            
            invoice_show(number);
            invois_update_selected_list(number);
        }else if(status == 'paid'){
            set_ebook_purchase_count(number, '2');
            //$("#mainframe_purchase_"+number).find('.list_upline').addClass('selected');
            
            
            invoice_show(number);
            invois_update_selected_list(number);
            $("#frame_pembayaran_"+number).payment('option', 'status', 'paid');
        }else{
            invoice_hide(number);
        }
        
        
    });
}

function invoice_update(number){
    var frame = $("#table_select_ebook_"+number);
    var data = frame.data();
    var sel = data.selebook;
    
    var c = $("#colorbox_select_ebooks_"+number).data();
    //var trx_date = c.trx_date;
    var invoiceid = c.trx_invoice+'-'+c.trx_id;
    
    frame.find('.invoice_print_numberinvoice').text(invoiceid);
    frame.find('.invoice_print_date').text(c.trx_date);
    
}

function invoice_hide(number){
    $("#frame_invois_unavailable_"+number).show();
    $("#frame_invois_show_"+number).hide();
}

function invoice_show(number){
    $("#frame_invois_unavailable_"+number).hide();
    $("#frame_invois_show_"+number).show();
    invoice_update(number);
}

function choose_pakej(){
    var pakej = $("#order_pakej").val();
    if(pakej == '10'){
        $(".mainframe_purchase_pakej_10").show();
        $(".mainframe_purchase_pakej_20").hide();
    }else if(pakej == '20'){
        $(".mainframe_purchase_pakej_10").show();
        $(".mainframe_purchase_pakej_20").show();
    }
}

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
    unblock_frame(number);
    update_ebook_purchase_count(number);
    update_table_selected_ebooks(0, number, 'clear');
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

function update_table_selected_ebooks(ebook_id, number, operation){
    
    var frame = $("#table_select_ebook_"+number);
    var data = frame.data();
    var sel = data.selebook;
    if(operation == 'clear'){
        console.log('operation: '+operation)
        sel = [];
    }else if(operation == 'add'){
        sel.push(ebook_id);
    }else if(operation == 'remove'){
        sel = jQuery.grep(sel, function(value) {
            return value != ebook_id;
        });
    }
    
    //set again
    frame.data('selebook', sel);
    
    
}

function set_note(number){
    var selected = get_selected_ebook(number);
    var count = selected.length;
    var note = '';
    if(count == 1){
        note = 'Sila pesan 1 lagi ebook';
    }
    
    if(note != ''){
        $("#list_note_"+number).text(note);
    }
}

function get_selected_ebook(number){
    var latest = $("#table_select_ebook_"+number).data('selebook');
    return latest;
}

function invois_update_selected_list(number){
    var frame = $("#table_select_ebook_"+number);
    var data = frame.data();
    var sel = data.selebook;
    console.log('selected ebook: '+sel);
    var spantitle = $('.invois_title_ebook_'+number);
    $.each(sel, function(i, el){
        var title = $("#ebook_pilih_order_title_"+el).text();
        $(spantitle[i]).text(title);
    })
}

function check_order_by_ebook(el){
    
    var logged_in = '<?php echo $session->logged_in; ?>';
    if(!logged_in){
        window_login_register();
        $.colorbox.close();
        return false;
    }
    
    
    
    
    var data = $(el).data();
    var frame = $(el).closest('.frame_choose_ebook');
    var input = $(el).children('input.input_select_single_ebook');
    var isSelected = $(el).hasClass('selected');
    var selected = $(frame).find('a.selected').length;
    var pakej = $("#order_pakej").val();
    var frameId = $(frame).attr('id');
    var number = frameId.split('_')[3];
    console.log('pakej: '+pakej);
    console.log('selected: '+selected);
    
    if(pakej == '10'){
        var limit = pakej_10_limit;
        if(selected <= limit){
            if(isSelected){
                $(el).removeClass('selected');
                $(input).attr('disabled', 'disabled').val('0');
                update_table_selected_ebooks(data.ebookid, number, 'remove');
            }else{
                $(el).addClass('selected');
                $(input).removeAttr('disabled').val(data.ebookid);
                
                update_table_selected_ebooks(data.ebookid, number, 'add');
            }
        }else{
            console.log(selected+' ebooks selected');
        }
    }else{
        var limit = pakej_20_limit;
        
        if(selected <= limit){
            if(isSelected){
                $(el).removeClass('selected');
                $(input).attr('disabled', 'disabled').val('0');
                update_table_selected_ebooks(data.ebookid, number, 'remove');
            }else{
                $(el).addClass('selected');
                $(input).removeAttr('disabled').val(data.ebookid);
                
                update_table_selected_ebooks(data.ebookid, number, 'add');
            }
        }else{
            console.log(selected+' ebooks selected');
        }
        
    }
    console.log('limit: '+limit);
    var selected_c = $(frame).find('a.selected').length;
    if(selected_c == limit){
        block_frame(frame);
    }
    
    update_ebook_purchase_count(number);
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
    var number = frameId.split('_')[3];
    
    var strVar="";
    strVar += "<div style=\"position: absolute;background-color: #FFCCCC;top: 10px;left: 10px;right: 10px;bottom: 10px;top: 10px;\"><\/div>";

    //$("#_ebook_pilih_"+number).css('position', 'relative').append(strVar);
    
    $("#frame_choice_"+number).hide();
    $("#frame_success_"+number).show();
    $("#frame_already_"+number).hide();
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
    $("#frame_already_"+number).hide();
}

function submit_form_checkout(number){
    var pakej = $("#order_pakej").val();
    $("#form_checkout_"+number).ajaxSubmit({
        dataType: 'json',
        data: { pakej: pakej  },
        beforeSubmit: function(){
            
        },
        success: function(data){
            var status = data.status;
            var trx_id = data.trx_id;
            var trx_date = data.trx_date;
            var trx_invoice = data.trx_invoice;
            var trx_ref = data.trx_ref;
            var setData = $("#colorbox_select_ebooks_"+number);
                setData.data('status', status)
                setData.data('trx_id', trx_id)
                setData.data('trx_invoice', trx_invoice)
                setData.data('trx_date', trx_date);
                setData.data('trx_ref', trx_ref);
            $("#frame_pembayaran_"+number).payment('option', {
                status: status,
                trx_ref: trx_ref
            });
            if(status == 'waiting_for_payment'){
                status_waiting_for_payment(number);
                invoice_show(number);
                invoice_update(number);
                
            }else if(status == 'already_waiting_for_payment'){
                status_waiting_for_payment(number);
                invoice_show(number);
                invoice_update(number);
                
            }else if(status == 'paid'){
                status_paid(number);
                invoice_show(number);
                invoice_update(number);
            }
            
            console.log('Ajax success. NUmber '+number);
            invois_update_selected_list(number)
        }
    }); 
    // return false to prevent normal browser submit and page navigation 
    return false; 
}

function status_waiting_for_payment(number){
    $("#colorbox_select_ebooks_"+number).data('status', 'waiting_for_payment');
    $("#frame_choice_"+number).hide();
    $("#frame_success_"+number).hide(); 
    $("#frame_already_"+number).show();
    $("#frame_pembayaran_"+number).payment('option', 'status', 'waiting_for_payment');
    //$("#mainframe_purchase_"+number).find('.list_upline').addClass('selected');
    
}

function status_paid(number){
    $("#colorbox_select_ebooks_"+number).data('status', 'paid');
    $("#frame_choice_"+number).hide();
    $("#frame_success_"+number).hide(); 
    $("#frame_already_"+number).show();
    $("#frame_pembayaran_"+number).payment('option', 'status', 'paid');
    //$("#mainframe_purchase_"+number).find('.list_upline').addClass('selected');
    
}

function update_ebook_purchase_count(number){
    var frame = $("#frame_choice_"+number);
    var boxes = $(frame).find(".ebook_pilih_order");
    var selected = $(frame).find("a.selected");
    var count = $(selected).length;
    var total = $(boxes).length;
    set_ebook_purchase_count(number, count);
    
}

function set_ebook_purchase_count(number, count){
    $(".ebook_purchase_count_"+number).text(count);
    $(".ebook_purchase_total_"+number).text(count*10);
}

function open_colorbox_select_ebook_for_purchase_number(number){
    width = 0.9*($(window).width());
    height = 0.9*($(window).height());
    $.colorbox({
         href: '#colorbox_select_ebooks_'+number,
         inline: true,
         width: width,
         height: height,
         onLoad: function(){
            console.log('box number '+number)
            var data = $("#colorbox_select_ebooks_"+number).data();
            var status = data.status;
            if(status == 'waiting_for_payment'){
                status_waiting_for_payment(number);
            }else if(status == 'already_waiting_for_payment'){
                status_waiting_for_payment(number);
            }else if(status == 'paid'){
                status_paid(number);
            }
         },
         onClosed: function(){
            set_note(number)
         }
    });
}
</script>
<div>Sila pilih E-Book dan buat pembayaran.Sebaik sahaja semua pembayaran selesai, akaun anda akan aktif secara automatik dan anda boleh mula mempromosikan produk anda.</div>
<div class="grid" style="margin-bottom: 0px;">
    <div class="row">
        <div class="span12">
            <table style="width: 100%;">
                <tr>
                    <td valign="center" style="width: 100px;">
                        <div class="input-control text" style="margin-bottom: 0px; width: 100px; padding-top: 5px;">
                            Pilih Pakej
                        </div>
                    </td>
                    <td style="">
                         <div class="input-control select" style="margin-bottom: 0px; width: 500px;">
                        <select name="order[pakej]" id="order_pakej">
                            <option value="10" selected="selected">10 ebook (RM 100) - Pilih 10 ebook dari 5 orang penjual</option>
                            <option value="20">20 ebook (RM 200) - Pilih 20 ebook dari 10 orang penjual</option>         
                        </select>
                        <div style="display: none;" id="order_pakej_tooltip">
                        <div class="padding10">
                            Pilih pakej yang anda mahukan
                        </div>
                        </div>
                        <script type="text/javascript">
                        $(function(){
                            $("#order_pakej").qtip({
                                 style: { classes: 'qtip-bootstrap' },
                                 content: {
                                     text: $("#order_pakej_tooltip"),
                                     title: 'Pilih Pakej'
                                 },
                                 position: {
                                    my: 'bottom center',  // Position my top left...
                                    at: 'top center'
                                }
                             });
                        })
                        </script>
                        </div>
                        <p class="item-title" id="pakej_text_detail" style="display: none;">Sila pilih pakej</p>
                    </td>
                    
                </tr>
            </table>
            
           
                
        </div>
        
    </div>
</div>



<div id="frame_list_choose_product">
    <div>
        <?php for($i=1; $i<=5; $i++){  ?>
        <?php
        $uplineCountArray = $i-1;
        ?>
        <div style="float: left" id="mainframe_purchase_<?php echo $i; ?>" class="mainframe_purchase_pakej_10">
                <div class="listview">
                    
                	<a href="javascript: void(0);" onclick="open_colorbox_select_ebook_for_purchase_number(<?php echo $i; ?>);" class="list list_upline input_select_ebook" data-bookid="54<?php echo $i; ?>">
                        <input class="hidden_select" type="hidden" value="1" name="order[ebook][<?php echo $i; ?>][<?php echo $uplineList[$uplineCountArray]['id']; ?>]" />
                        <div class="list-content">
                            <img src="intelmlm_images/assets/onenote2013icon.png" class="icon">
                            <div class="data">
                                <span class="list-title">Pembelian <?php echo $i; ?></span>
                                <table style="width: 100%;">
                                    <tr>
                                        <td>
                                            <span class="list-ebooks">Ebook : <span class="ebook_purchase_count_<?php echo $i; ?>">0</span>/2</span>
                                        </td>
                                        <td>
                                            <span class="list-total">Harga : RM <span class="ebook_purchase_total_<?php echo $i; ?>">0</span></span>
                                        </td>
                                    </tr>
                                </table>
                                <span class="list-note" id="list_note_<?php echo $i; ?>">Klik untuk membuat pesanan</span>
                                <span class="list-debug">upline: <?php echo $uplineList[$uplineCountArray]['id']; ?>, <?php echo $uplineList[$uplineCountArray]['email']; ?></span>
                            </div>
                        </div>
                    </a>
                   
                </div>
                <div style="display: none;">
                <?php
                $p_status = $Class_Transaction->getSingleTransactionByType($session->uid, $uplineList[$uplineCountArray]['id'], 'pendaftaran');
                
                if($p_status){
                    $p_status['trx_invoice'] = $p_status['trx_date'];
                    $h_status = 'data-status="waiting_for_payment"';
                    $h_trx_id = 'data-trx_id="'.$p_status['id'].'"';
                    $h_trx_date = 'data-trx_date="'.$Mx->timestamp_to_date($p_status['trx_date'], 'd M Y').'"';
                    $h_trx_invoice = 'data-trx_invoice="'.$p_status['trx_invoice'].'"';
                    $selected_ebook = explode(',',$p_status['trx_desc']);
                    
                }else{
                    $h_status = '';
                    $h_trx_id = '';
                    $h_trx_date = '';
                    $h_trx_invoice = '';
                    $selected_ebook = array();
                    $p_status = array();
                }
                
                ?>
                
                
                    <div data-status="<?php echo $p_status['status']; ?>" data-trx_ref="<?php echo $p_status['trx_ref']; ?>" <?php echo $h_trx_id; ?> <?php echo $h_trx_invoice; ?> <?php echo $h_trx_date; ?> class="colorbox_select_ebooks_class" id="colorbox_select_ebooks_<?php echo $i; ?>">
                        <?php include('colorbox_select_ebooks.php'); ?>
                    </div>
                    
                </div>
            </div>
            
             <?php } ?>
            <?php for($i=6; $i<=10; $i++){ ?>
            <?php
            $uplineCountArray = $i-1;
            ?>
            <div style="float: left" id="mainframe_purchase_<?php echo $i; ?>" class="mainframe_purchase_pakej_20">
                <div class="listview">
                    
                	<a href="javascript: void(0);" onclick="open_colorbox_select_ebook_for_purchase_number(<?php echo $i; ?>);" class="list list_upline input_select_ebook">
                        <input class="hidden_select" type="hidden" value="1" name="order[ebook][<?php echo $i; ?>][<?php echo $uplineList[$uplineCountArray]['id']; ?>]" />
                        <div class="list-content">
                            <img src="intelmlm_images/assets/onenote2013icon.png" class="icon">
                            <div class="data">
                                <span class="list-title">Pembelian <?php echo $i; ?></span>
                                <table style="width: 100%;">
                                    <tr>
                                        <td>
                                            <span class="list-ebooks">Ebook : <span class="ebook_purchase_count_<?php echo $i; ?>">0</span>/2</span>
                                        </td>
                                        <td>
                                            <span class="list-total">Harga : RM <span class="ebook_purchase_total_<?php echo $i; ?>">0</span></span>
                                        </td>
                                    </tr>
                                </table>
                                
            
                                <span class="list-note" id="list_note_<?php echo $i; ?>">Klik untuk membuat pesanan</span>
                                <span class="list-debug">upline: <?php echo $uplineList[$uplineCountArray]['id']; ?>, <?php echo $uplineList[$uplineCountArray]['email']; ?></span>
                            </div>
                        </div>
                    </a>
                    
                </div>
                <div style="display: none;">
                <?php
                $p_status = $Class_Transaction->getSingleTransactionByType($session->uid, $uplineList[$uplineCountArray]['id'], 'pendaftaran', 'waiting_for_payment');
                if($p_status){
                    $p_status['trx_invoice'] = $p_status['trx_date'];
                    $h_status = 'data-status="waiting_for_payment"';
                    $h_trx_id = 'data-trx_id="'.$p_status['id'].'"';
                    $h_trx_date = 'data-trx_date="'.$Mx->timestamp_to_date($p_status['trx_date'], 'd M Y').'"';
                    $h_trx_invoice = 'data-trx_invoice="'.$p_status['trx_invoice'].'"';
                    $selected_ebook = explode(',',$p_status['trx_desc']);
                    
                }else{
                    $h_status = '';
                    $h_trx_id = '';
                    $h_trx_date = '';
                    $h_trx_invoice = '';
                    $selected_ebook = array();
                    $p_status = array();
                }
                
                ?>
                    <div data-status="<?php echo $p_status['status']; ?>" data-trx_ref="<?php echo $p_status['trx_ref']; ?>" <?php echo $h_trx_id; ?> <?php echo $h_trx_invoice; ?> <?php echo $h_trx_date; ?> class="colorbox_select_ebooks_class" id="colorbox_select_ebooks_<?php echo $i; ?>">
                        <?php include('colorbox_select_ebooks.php'); ?>
                    </div>
                    
                </div>
            </div>
            <?php } ?>
            <div style="clear: both;"></div>
            <script type="text/javascript">
            $(function(){
                $(".list_upline").each(function(){
                    $(this).qtip({
                        style: { classes: 'qtip-bootstrap' },
                        content: {
                            text: 'Klik untuk pilih E-Book dan membuat pembayaran',
                            title: 'Pembelian dan Pembayaran'
                        },
                        position: {
                            my: 'bottom center',  // Position my top left...
                            at: 'top center',
                            viewport: $(window)
                        }
                    }); 
                });
                
                $(".ebook_pilih_order").each(function(){
                    var ebookid = $(this).data('ebookid');
                    var title = $(this).find('.list-title').text();
                    $(this).qtip({
                        style: { classes: 'qtip-bootstrap' },
                        content: {
                            text: function(event, api) {
                                $.ajax({ url: 'index.php?modules=Main&op=getbookinfo', data: { bookid: ebookid } })
                                    .done(function(html) {
                                        api.set('content.text', html)
                                    })
                                    .fail(function(xhr, status, error) {
                                        api.set('content.text', status + ': ' + error)
                                    })
                    
                                return 'Loading...';
                            },
                            title: title
                        },
                        position: {
                            my: 'bottom center',  // Position my top left...
                            at: 'top center',
                            viewport: $(window)
                        }
                    }); 
                });
            });
            </script>
    </div>

    
    
    
</div>

