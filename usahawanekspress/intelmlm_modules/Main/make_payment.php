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
                $('<p/>').text(file.name).appendTo('#files');
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
<div class="tab-control" data-role="tab-control">
    <ul class="tabs">
        <li class="active"><a href="#_Pembayaran_1">Pembayaran 1</a></li>
        <li><a href="#_Pembayaran_2">Pembayaran 2</a></li>
        <li><a href="#_Pembayaran_3">Pembayaran 3</a></li>
        <li><a href="#_Pembayaran_4">Pembayaran 4</a></li>
        <li><a href="#_Pembayaran_5">Pembayaran 5</a></li>
        
    </ul>
 
    <div class="frames">
        <div class="frame" id="_Pembayaran_1">
        
            
        </div>
        <div class="frame" id="_Pembayaran_2">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 80px;" valign="top">
                        <img style="width: 50px; height: 50px;" src="<?php echo FOLDER_IMAGES.'/assets/'; ?>Numbers-2-icon.png" class="">
                    </td>
                    <td>
                        <div class="balloon right" style="padding: 10px;">
                            <div class="tab-control" data-role="tab-control">
                                <ul class="tabs">
                                    <li class="active"><a href="#_bayar_2">Pembayaran</a></li>
                                    <li><a href="#_bayar_resit_2">Resit</a></li>
                                    
                                </ul>
                             
                                <div class="frames">
                                    <div class="frame" id="_bayar_2">...</div>
                                    <div class="frame" id="_bayar_resit_2">...</div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="frame" id="_Pembayaran_3">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 80px;" valign="top">
                        <img style="width: 50px; height: 50px;" src="<?php echo FOLDER_IMAGES.'/assets/'; ?>Numbers-3-icon.png" class="">
                    </td>
                    <td>
                        <div class="balloon right" style="padding: 10px;">
                            <div class="tab-control" data-role="tab-control">
                                <ul class="tabs">
                                    <li class="active"><a href="#_bayar_3">Pembayaran</a></li>
                                    <li><a href="#_bayar_resit_3">Resit</a></li>
                                    
                                </ul>
                             
                                <div class="frames">
                                    <div class="frame" id="_bayar_3">...</div>
                                    <div class="frame" id="_bayar_resit_3">...</div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="frame" id="_Pembayaran_4">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 80px;" valign="top">
                        <img style="width: 50px; height: 50px;" src="<?php echo FOLDER_IMAGES.'/assets/'; ?>Numbers-4-icon.png" class="">
                    </td>
                    <td>
                        <div class="balloon right" style="padding: 10px;">
                            <div class="tab-control" data-role="tab-control">
                                <ul class="tabs">
                                    <li class="active"><a href="#_bayar_4">Pembayaran</a></li>
                                    <li><a href="#_bayar_resit_4">Resit</a></li>
                                    
                                </ul>
                             
                                <div class="frames">
                                    <div class="frame" id="_bayar_4">...</div>
                                    <div class="frame" id="_bayar_resit_4">...</div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="frame" id="_Pembayaran_5">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 80px;" valign="top">
                        <img style="width: 50px; height: 50px;" src="<?php echo FOLDER_IMAGES.'/assets/'; ?>Numbers-5-icon.png" class="">
                    </td>
                    <td>
                        <div class="balloon right" style="padding: 10px;">
                            <div class="tab-control" data-role="tab-control">
                                <ul class="tabs">
                                    <li class="active"><a href="#_bayar_5">Pembayaran</a></li>
                                    <li><a href="#_bayar_resit_5">Resit</a></li>
                                    
                                </ul>
                             
                                <div class="frames">
                                    <div class="frame" id="_bayar_5">...</div>
                                    <div class="frame" id="_bayar_resit_5">...</div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>