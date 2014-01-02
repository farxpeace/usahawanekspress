<?php
include(THEME_LOC."/main_header.php");
?>
<div class="grid fluid" style="padding: 10px;">
	<div class="row">
		<div class="span9">
			<div class="tab-control main-tab" data-role="tab-control">
                <ul class="tabs">
                    <li class="active"><a href="#_pengenalan">Pengenalan</a></li>
                    
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
                    
                    <div class="frame" id="_langkah_pertama">
                        <h3>Pilih E-book dan buat pembayaran</h3>
                        <?php include('choose_product.php'); ?>
                    </div>
                    <div class="frame" id="_langkah_kedua" data-userrole="<?php echo $session->userinfo['userlevel']; ?>">
                        <h3>Promosikan E-Book yang terdapat disini kepada rakan-rakan anda</h3>
                        <?php include('step_kemudian.php') ?>
                    </div>
                    <div class="frame" id="_kemudian">
                        <h4 class="padding10">Promosikan produk atau perkhidmatan anda kepada rakan-rakan</h4>
                        
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
                    <a href="#" class="heading active bg-amber fg-white">Status</a>
                    <div class="content right_status"
                    data-user_status="<?php echo $session->userinfo['userlevel']; ?>"
                    data-user_pakej="<?php echo $session->userinfo['pakej']; ?>"
                    >
                        <table style="width: 100%;">
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

$(function(){
    $('.main-tab').tabcontrol().bind("tabcontrolchange", function(event, frame){
        var frame = frame;
        var frameId = $(frame).attr('id');
        if(frameId == '_langkah_kedua'){
            getUserInfo(function(data){
                
                console.log(data)
            });
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

<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = 'intelmlm_images/';
    $('.frame_upload .fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                //$('<p/>').text(file.name).appendTo('#files');
                console.log(e);
                console.log(data);
            });
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('.frame_upload .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
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
            beforeSubmit: function(){
                
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