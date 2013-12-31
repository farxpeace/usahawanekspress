<?php
include(THEME_LOC."/main_header.php");
?>
<div class="grid fluid" style="padding: 10px;">
	<div class="row">
		<div class="span12">
			<div class="tab-control" data-role="tab-control">
                <ul class="tabs">
                    <li class="active"><a href="#_pengenalan">Pengenalan</a></li>
                    
                    <li><a href="#_langkah_pertama">Langkah Pertama</a></li>
                    <li><a href="#_langkah_kedua">Langkah Kedua</a></li>
                    <li><a href="#_kemudian">Kemudian</a></li>
                    <li><a href="#_dan_seterusnya">Dan Seterusnya</a></li>

                </ul>
             
                <div class="frames">
                    <div class="frame" id="_pengenalan">
                        <h4 class="padding10">Selamat datang ke Program Galakan Usahawan 1Malaysia</h4>
                        <p>Program ini menawarkan kepelbagaian jenis perniagaan yang boleh menjana pendapatan dikala kenaikan kos sara diri ketika ini.</p>
                        <p>Kami komited dalam menggalakkan perniagaan di kalangan rakyat Malaysia terutamanya.</p>
                    </div>
                    
                    <div class="frame" id="_langkah_pertama">
                        <h4 class="padding10">Pilih produk atau perkhidmatan yang anda ingin</h4>
                        
                        
                        
                        
                        <?php include('choose_product.php'); ?>
                    </div>
                    <div class="frame" id="_langkah_kedua">
                        <h4 class="padding10">Buat pesanan dan pembayaran kepada peniaga-peniaga</h4>
                        <?php include('make_payment.php'); ?>
                    </div>
                    <div class="frame" id="_kemudian">
                        <h4 class="padding10">Promosikan produk atau perkhidmatan anda kepada rakan-rakan</h4>
                        <?php include('step_kemudian.php') ?>
                    </div>
                    <div class="frame" id="_dan_seterusnya">
                        <h4 class="padding10"></h4>
                    </div>
                    
                </div>
            </div>
		</div>
        <!--
		<div class="span4 bg-white">
            <div class="accordion" data-role="accordion">
                <div class="accordion-frame">
                    <a href="#" class="heading active bg-amber fg-white">Cara menyertai</a>
                    <div class="content">
                        <div class="accordion" data-role="accordion">
                            <div class="accordion-frame">
                                <a href="#" class="heading active bg-cobalt fg-white">Pilih produk</a>
                                <div class="content">
                                    
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion" data-role="accordion">
                            <div class="accordion-frame">
                                <a href="#" class="heading active bg-cobalt fg-white">Buat pembayaran</a>
                                <div class="content">
                                    
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="accordion" data-role="accordion">
                            <div class="accordion-frame">
                                <a href="#" class="heading active bg-cobalt fg-white">Promosi kepada rakan</a>
                                <div class="content">
                                    
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
		</div>
        -->
	</div>
</div>
<script type="text/javascript">
$(function(){
    $('.tab-control').tabcontrol().bind("tabcontrolchange", function(event, frame){
        
        console.log(frame)
    });
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
    
    $("#form_bayar_"+number).ajaxSubmit({
        dataType: 'json',
            type: 'post',
            data: {  },
            beforeSubmit: function(){
                
            },
            success: function(data){
                var status = data.payment_status;
                var id = data.id;
                console.log(status)
                if(status == 'success'){
                    update_bayar_form_status(number,status, id)
                }
            }
    })
}
function update_bayar_form_status(number,status, id){
    var frame = $("#_ebook_payment_"+number);
    frame.data('status', status);
    frame.data('paymentid', id);
}

$(function(){
    
});
</script>
<?php include(THEME_LOC.'/footer_facebook.php'); ?>
</body>
</html>