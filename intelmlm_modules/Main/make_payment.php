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
        
            <table style="width: 100%;">
                <tr>
                    <td style="width: 80px;" valign="top">
                        <img style="width: 50px; height: 50px;" src="http://icons.iconarchive.com/icons/visualpharm/icons8-metro-style/64/Numbers-1-icon.png" class="">
                    </td>
                    <td>
                        <div class="balloon right" style="padding: 10px;">
                            <div class="tab-control" data-role="tab-control">
                                <ul class="tabs">
                                    <li class="active"><a href="#_bayar_1">Pembayaran</a></li>
                                    <li><a href="#_bayar_resit_1">Resit</a></li>
                                    
                                </ul>
                             
                                <div class="frames">
                                    <div class="frame" id="_bayar_1">
                                         <p>Nama: Mohamad Farizul</p>
                                        <p>Bank : Maybank</p>
                                        <p>No Akaun : 72293999399933</p>
                                        <div class="tab-control" data-role="tab-control">
                                                    <ul class="tabs">
                                                        <li class="active"><a href="#_bayar_borang_1">Borang</a></li>
                                                        <li><a href="#_bayar_upload_1">Upload</a></li>
                                                        
                                                    </ul>
                                                 
                                                    <div class="frames">
                                                        <div class="frame" id="_bayar_borang_1">
                                                            <div class="grid">
                                                                <div class="row">
                                                                    <div class="span12"> 
                                                                    <p>Sila masukkan maklumat pembayaran anda disini atau upload</p>
                                                                    <form id="bayar">
                                                                        <table style="width: 100%;" id="borang">
                                                                            <tr>
                                                                                <td style="width: 200px;">Tarikh :</td>
                                                                                <td><div class="input-control text datepicker "
                                                                                data-role="datepicker"
                                                                                data-date="01-01-2014"
                                                                                data-format="dd mmmm yyyy"
                                                                                data-position="bottom"
                                                                                data-effect="none"
                                                                                ><input type="text" name="bayar[uplineid][tarikh]" /><button class="btn-date" type="button"></button></div></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 200px;">Masa :</td>
                                                                                <td>
                                                                                    <div class="input-control text" data-role="input-control">
                                            <input type="text" placeholder="type text" name="bayar[uplineid][masa]">
                                            <button class="btn-clear" tabindex="-1" type="button"></button>
                                        </div>

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="width: 200px;">Rujukan :</td>
                                                                                <td ><div class="input-control textarea">
                                                                                        <textarea name="bayar[uplineid][rujukan]"></textarea>
                                                                                    </div></td>
                                                                            </tr>
                                                                        </table>
                                                                    </form>
                                                                    
                                                                    </div>
                                                                </div>
                                                            
                                                            </div>
                                                        </div>
                                                        <div class="frame" id="_bayar_upload_1">
                                                            <div class="frame_upload">
                                                                <span class="btn btn-success fileinput-button">
                                                                    <i class="glyphicon glyphicon-plus"></i>
                                                                    <span>Select files...</span>
                                                                    <!-- The file input field used as target for the file upload widget -->
                                                                    <input class="fileupload" id="_bayar_upload_fileupload_1" type="file" name="files[]" multiple>
                                                                </span>
                                                                <br>
                                                                <br>
                                                                <!-- The global progress bar -->
                                                                <div id="_bayar_upload_progress_1" class="progress">
                                                                    <div class="progress-bar progress-bar-success"></div>
                                                                </div>
                                                                <!-- The container for the uploaded files -->
                                                                <div id="files" class="files"></div>
                                                            </div>
                                                        </div>
                                                    </div>
</div>
                                    </div>
                                    <div class="frame" id="_bayar_resit_1">
                                        <?php include('receipt.php'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="frame" id="_Pembayaran_2">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 80px;" valign="top">
                        <img style="width: 50px; height: 50px;" src="http://icons.iconarchive.com/icons/visualpharm/icons8-metro-style/64/Numbers-2-icon.png" class="">
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
                        <img style="width: 50px; height: 50px;" src="http://icons.iconarchive.com/icons/visualpharm/icons8-metro-style/64/Numbers-3-icon.png" class="">
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
                        <img style="width: 50px; height: 50px;" src="http://icons.iconarchive.com/icons/visualpharm/icons8-metro-style/64/Numbers-4-icon.png" class="">
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
                        <img style="width: 50px; height: 50px;" src="http://icons.iconarchive.com/icons/visualpharm/icons8-metro-style/64/Numbers-5-icon.png" class="">
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