<?php
include(THEME_LOC."/main_header.php");
?>
<div class="grid fluid" style="padding: 10px;">
	<div class="row">
		<div class="span9">
			<div class="tab-control main-tab" data-role="tab-control">
                <ul class="tabs">
                    <li class="active"><a href="#_pengenalan">Pengenalan</a></li>
                    <li><a href="#_konsep">Konsep</a></li>
                    <li><a href="#_langkah_pertama">Langkah Pertama</a></li>
                    <li><a href="#_langkah_kedua">Langkah Kedua</a></li>
                    <li><a href="#_kemudian">Kemudian</a></li>
                    <li><a href="#_dan_seterusnya">Dan Seterusnya</a></li>

                </ul>
             
                <div class="frames">
                    <div class="frame" id="_pengenalan">
                        <h3>Selamat datang ke Program Galakan Usahawan 1Malaysia</h3>
                        <p>Program ini menawarkan kepelbagaian jenis perniagaan yang boleh menjana pendapatan dikala kenaikan kos sara diri ketika ini.</p>
                        <p>Kami komited dalam menggalakkan perniagaan di kalangan rakyat Malaysia terutamanya.</p>
                    </div>
                    
                    <div class="frame" id="_konsep">
                        <blockquote>
                            <p>Single Buyer Multiple Seller</p>
                            <small>menggalakkan promosi dan keusahawanan</small>
                        </blockquote>
                        <br />
                        <p>Program ini berkonsepkan <strong>Single Buyer Multiple Seller</strong> (SBMS) dimana anda perlu membuat pembelian dengan lebih dari seorang Peniaga</p>
                        <div class="text-center">
                            <img src="<?php echo FOLDER_IMAGES.'/assets/konsep1.png' ?>" />
                        </div>
                    </div>
                    
                    <div class="frame" id="_langkah_pertama">
                        <h3>Pilih E-book dan buat pembayaran</h3>
                        <?php include('choose_product.php'); ?>
                    </div>
                    <div class="frame" id="_langkah_kedua" data-userrole="<?php echo $session->userinfo['userlevel']; ?>">
                        <h3>Promosikan E-Book yang terdapat disini kepada rakan-rakan anda</h3>
                        <?php include('step_kemudian.php') ?>
                    </div>
                    <div class="frame" id="_kemudian">
                        <h3>Promosikan E-Book yang terdapat disini kepada rakan-rakan anda</h3>
                        <?php include('step_calculator.php') ?>
                    </div>
                    <div class="frame" id="_dan_seterusnya">
                        <?php include('step_seterusnya.php') ?>
                    </div>
                    
                </div>
            </div>
		</div>
        
		<div class="span3 bg-white">
            <div class="accordion" data-role="accordion">
                <div class="accordion-frame">
                    <a href="#" class="heading active bg-darkGreen fg-white">Status</a>
                    <div class="content right_status"
                    data-user_status="<?php echo $session->userinfo['userlevel']; ?>"
                    data-user_pakej="<?php echo $session->userinfo['pakej']; ?>"
                    >
                    <div class="listview small">
                    <a href="javascript: void(0);" <?php echo ($session->logged_in ? '' : 'onclick="window_login_register();"'); ?> id="status_login_register" class="list <?php echo ($session->logged_in ? 'selected' : ''); ?>">
                        <div class="list-content">
                            <img src="<?php echo FOLDER_IMAGES.'/assets/Register-icon32x32.png'; ?>" class="icon">
                            <div class="data">
                                <span class="list-title" style="line-height: normal;">Login / Register</span>
                                <span class="list-remark">Sila login atau register dahulu</span>
                            </div>
                        </div>
                        <div style="display: none;" class="tooltip">
                            Anda perlu Register sebagai ahli ataupun Login sekiranya anda telah mendaftar sebelum ini.
                        </div>
                    </a>
                    <a href="#" id="status_pakej_pilih" class="list <?php echo ($session->userinfo['pakej'] == '' ? '' : 'selected'); ?>">
                        <div class="list-content">
                            <img src="<?php echo FOLDER_IMAGES.'/assets/Devices-secure-card-icon.png'; ?>" class="icon">
                            <div class="data">
                                <span class="list-title" style="line-height: normal;">Pilih Pakej</span>
                                <span class="list-remark">Sila pilih pakej</span>
                            </div>
                        </div>
                        <div style="display: none;" class="tooltip">
                            Pakej 10 E-Books membenarkan anda mempunyai 5 Kumpulan Promosi manakala Pakej 20 E-Books pula memberikan 10 Kumpulan Promosi
                        </div>
                    </a>
                    <a href="#" id="status_pembayaran_" class="list <?php echo ($session->userinfo['userlevel'] == '3' ? 'selected' : ''); ?>">
                        <div class="list-content">
                            <img src="<?php echo FOLDER_IMAGES.'/assets/payment-icon.png'; ?>" class="icon">
                            <div class="data">
                                <span class="list-title" style="line-height: normal;">Buat Pembayaran</span>
                                <span class="list-remark">Bayar kepada setiap penjual</span>
                            </div>
                        </div>
                        <div style="display: none;" class="tooltip">
                            Pilih 2 E-Book dari setiap Penjual dan buat Pembayaran.
                        </div>
                    </a>
                    </div>
                    <script type="text/javascript">
                    $(function(){
                        $("a#status_login_register").qtip({
                            style: { classes: 'qtip-bootstrap' },
                            content: {
                                text: function(){
                                    var html = $(this).children('.tooltip').html();
                                    return html;
                                },
                                title: 'Login atau Register'
                            },
                            position: {
                                my: 'center right',  // Position my top left...
                                at: 'top left'
                            }
                        });
                        $("a#status_pakej_pilih").qtip({
                            style: { classes: 'qtip-bootstrap' },
                            content: {
                                text: function(){
                                    var html = $(this).children('.tooltip').html();
                                    return html;
                                },
                                title: 'Pilih Pakej'
                            },
                            position: {
                                my: 'center right',  // Position my top left...
                                at: 'top left'
                            }
                        });
                        $("a#status_pembayaran_").qtip({
                            style: { classes: 'qtip-bootstrap' },
                            content: {
                                text: function(){
                                    var html = $(this).children('.tooltip').html();
                                    return html;
                                },
                                title: 'Pesanan dan Pembayaran'
                            },
                            position: {
                                my: 'center right',  // Position my top left...
                                at: 'top left'
                            }
                        });
                    });
                    </script>
                        <table style="width: 100%; display: none">
                            <tr>
                                <td>
                                    Status
                                </td>
                                <td>
                                    <span id="user_status"></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Pakej
                                </td>
                                <td>
                                    <span id="user_pakej"></span>
                                </td>
                            </tr>
                        </table>
                        
                    </div>
                </div>
            </div>
		</div>
        
	</div>
</div>
<script type="text/javascript">
function update_right_status(){
    var frame = $(".right_status");
    var data = frame.data();
    
    var user_status = 'Tidak Aktif';
    if(data.user_status == '1'){
        user_status = 'Tidak Aktif';
    }else if(data.user_status == '3'){
        user_status = 'Aktif';
    }
    $("#user_status").text(user_status);
    
    
    var user_pakej = '';
    if(data.user_pakej == '10'){
        user_pakej = '10 Ebook';
    }else if(data.user_pakej == '20'){
        user_pakej = '20 Ebook';
    }
    $("#user_pakej").text(user_pakej);
    
}
function getUserInfo(callback){
    $.ajax({
        url: '?modules=Main&op=getuserinfo',
        dataType: 'json',
        data: { user_id: '<?php echo $session->uid; ?>' },
        success: function(data){
            callback(data)
        }
    });
}

function step_calculator(){
    FB.getLoginStatus(function(response) {
        if(response.status == 'connected'){
        
        var uid = response.authResponse.userID;
        var accessToken = response.authResponse.accessToken;
        $("#calculator_fb").show();
        calculator_initialize();
        calc_init();
      }else if(response.status == 'not_authorized') {
        $("#calculator_fb").hide();
      }else{
        $("#calculator_fb").hide();
      }
    });
}

function calc_init(){
    calc_update_pakej();
}

function calculator_initialize(){
    FB.api('me/friends', function(friends) {
        $("#_fbc_total_friend").text((friends.data).length)
    });
}

function calc_update_pakej(){
    $("#_fbc_pakej").text($("#order_pakej").val());
    $("#_fbc_level").text(($("#order_pakej").val())/2);
}

$(function(){
    $('.main-tab').tabcontrol().bind("tabcontrolchange", function(event, frame){
        var frame = frame;
        var frameId = $(frame).attr('id');
        if(frameId == '_langkah_kedua'){
            getUserInfo(function(data){
                
                console.log(data)
            });
        }else if(frameId == '_kemudian'){
            step_calculator();
        }
    });
    
    update_right_status();
    
})
</script>
<style>
#borang tbody tr td:first-child {
    width: 200px !important;
}
</style>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo THEME_LOC; ?>/js/jQuery-File-Upload-master/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo THEME_LOC; ?>/js/jQuery-File-Upload-master/js/jquery.fileupload.js"></script>

<style>
.frame_upload .progress {
height: 20px;
margin-bottom: 20px;
overflow: hidden;
background-color: #f5f5f5;
border-radius: 4px;
-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
}
.frame_upload .progress-bar-success {
    background-color: #5cb85c;
}
.frame_upload .progress-bar {
    float: left;
    width: 0;
    height: 100%;
    font-size: 12px;
    line-height: 20px;
    color: #fff;
    text-align: center;
    background-color: #428bca;
    
}
.fileinput-button {
position: relative;
overflow: hidden;
}
.fileinput-button input {
position: absolute;
top: 0;
right: 0;
margin: 0;
opacity: 0;
-ms-filter: 'alpha(opacity=0)';
font-size: 200px;
direction: ltr;
cursor: pointer;
}
</style>
<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'intelmlm_images/';
    $('.frame_upload').each(function(){
        var self = this;
        var fileupload = $(this).find('.fileupload');
        var progress_bar = $(this).find('.progress-bar');
        var files = $(this).find('.files');
        var trx_uid = $(self).data('trx_uid');
        var number = $(self).data('number');
        $(fileupload).fileupload({
            url: url,
            dataType: 'json',
            formData: { upload_type: 'upload_transaction', trx_uid: trx_uid },
            done: function (e, data) {
                var result = data.result.files[0];
                $(self).find('.list-title').text(result['name']);
                $(self).data('upload_id', result['id']);
                $(self).find('.image_src').attr('src', result['thumbnailUrl']);
            },
            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                
                $(progress_bar).css(
                    'width',
                    progress + '%'
                );
            }
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled'); 
    });
});
</script>
<script type="text/javascript">

function submit_form_bayar(number){
    var frame = $("#_ebook_payment_"+number);
    var trx_ref = $("#frame_pembayaran_"+number).data('trx_ref');
    $("#form_bayar_"+number).ajaxSubmit({
        dataType: 'json',
            type: 'post',
            data: { trx_ref: trx_ref },
            beforeSubmit: function(arr, $form, options){
                //validate first
                //validate masa
                var inputmasa = $("#form_bayar_"+number).find('input.input_bayar_masa').val();
                if(!inputmasa){
                    $("#form_bayar_"+number).find('input.input_bayar_masa').parent('div').addClass('error-state')
                    return false;
                }
                
                var inputrujukan = $("#form_bayar_"+number).find('textarea.input_bayar_rujukan').val();
                if(!inputrujukan){
                    $("#form_bayar_"+number).find('textarea.input_bayar_rujukan').parent('div').addClass('error-state')
                    return false;
                }
                
                
                var upload_id = $("#form_bayar_"+number).find('.frame_upload').data('upload_id');
                arr.push({ name: 'upload_id',required: 'false', type: 'text', value: upload_id });
                return true;
            },
            success: function(data){
                if(data.status == 'success'){
                    var payment_status = data.payment_status;
                    var id = data.id;
                    update_bayar_form_status(number,payment_status, id);
                    
                    if(data.user_status == 'unverified'){
                        
                    }else if(data.user_status == 'verified'){
                        
                    }
                    /*
                    if(data.need_update == 'yes'){
                        $.colorbox({
                            href: "#form_update_user",
                            inline: true
                        });
                    }
                    */
                }
            }
    })
}
function update_bayar_form_status(number,status, id){
    var frame = $("#_ebook_payment_"+number);
    var data = frame.data();
    frame.data('status', status);
    frame.data('paymentid', id);
    $("#frame_pembayaran_"+number).payment('option', {
        status: status
    });
}

$(function(){
    
});
</script>
<?php include(THEME_LOC.'/footer_facebook.php'); ?>

</body>
</html>