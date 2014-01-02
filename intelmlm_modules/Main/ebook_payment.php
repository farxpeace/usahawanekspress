<?php
$number = $i;
$uplineInfo = $uplineList[$uplineCountArray];
$transactionStatus = $Class_Transaction->getStatusByTrx_Ref($p_status['trx_ref']);

?>
<div id="frame_pembayaran_hide_<?php echo $i; ?>" style="display: none;" class="frame_payment_status_info">
    <div style="text-align: center;">Sila buat pesanan terlebih dahulu</div>
</div>
<div id="frame_pembayaran_hide_paid_<?php echo $i; ?>" style="display: none;" class="frame_payment_status_info">
    <div style="text-align: center;">Pembayaran telah diterima</div>
</div>
<div id="frame_pembayaran_<?php echo $number; ?>" class="frame_pembayaran_tab frame_payment_status_info" 
data-status="<?php echo $transactionStatus; ?>" data-number="<?php echo $number; ?>" data-trx_ref="<?php echo $p_status['trx_ref']; ?>"
>

<div class="frame_listview listview">
    <a href="#" class="list">
        <div class="list-content">
            <img src="intelmlm_images/assets/maybank175x175.jpg" class="icon" />
            <div class="data">
                <span class="list-title">Nama Akaun: <?php echo $uplineInfo['bank_holder']; ?></span>
                <span class="list-bank_acc">No Akaun: <?php echo $uplineInfo['bank_acc']; ?> (Maybank)</span>
                <span class="list-remark">Klik untuk cetak nama dan no akaun.</span>
            </div>
        </div>
    </a>
 

</div>
<div class="grid fluid">
	<div class="row">
		<div class="span7">
			<div class="padding5" style="border: 1px solid #ECECEC;">
				<div class="fg-white bg-lightBlue padding5">
					 Masukkan maklumat pembayaran
				</div>
				<div class="frame_form_payment" id="frame_form_payment_<?php echo $number; ?>" data-role="input-control">
					<form data-number="<?php echo $number; ?>" id="form_bayar_<?php echo $number; ?>" method="post" action="?modules=Main&op=payment_process">
        				<table style="width: 100%;" id="borang_bayar_<?php echo $number; ?>">
        				<tr>
        					<td style="width: 200px;">
        						Tarikh :
        					</td>
        					<td>
        						<div class="input-control text datepicker " data-role="datepicker" data-date="01-01-2014" data-format="dd mmmm yyyy" data-position="bottom" data-effect="none">
        							<input type="text" name="bayar[<?php echo $uplineInfo['id']; ?>][tarikh]"/><button class="btn-date" type="button"></button>
        						</div>
        					</td>
        				</tr>
        				<tr>
        					<td style="width: 200px;">
        						Masa :
        					</td>
        					<td>
        						<div class="input-control text" data-role="input-control">
        							<input type="text" class="input_bayar_masa" placeholder="Contoh: 01:29:30 PM" name="bayar[<?php echo $uplineInfo['id']; ?>][masa]">
        							<button class="btn-clear" tabindex="-1" type="button"></button>
        						</div>
        					</td>
        				</tr>
        				<tr>
        					<td style="width: 200px;">
        						Rujukan :
        					</td>
        					<td>
        						<div class="input-control textarea">
        							<textarea class="input_bayar_rujukan" name="bayar[<?php echo $uplineInfo['id']; ?>][rujukan]"></textarea>
        						</div>
        					</td>
        				</tr>
                        
        				</table>
                        <div class="frame_upload" data-trx_uid="<?php echo $uplineInfo['id']; ?>" data-number="<?php echo $i; ?>">
                				<div class="listview small" style="margin-right: 0;">
                                    <a href="#" class="list btn fileinput-button">
                                    <div class="list-content">
                                        <img src="<?php echo FOLDER_IMAGES.'/assets/up-icon.png'; ?>" class="icon image_src">
                                    <div class="data">
                                        <span class="list-title">Upload screenshot. No file selected</span>
                                        <div class="progress-bar small" data-role="progress-bar" data-value="0"></div>
                                    </div>
                                    </div>
                                    <input class="fileupload" type="file" name="files[]" multiple>
                                </a>
                                </div>
                                
                                <!-- The fileinput-button span is used to style the file input field as button -->
            
                                <br>
                                <br>
                                <!-- The global progress bar -->
            
                                <!-- The container for the uploaded files -->
                                <div class="files">
                                    
                                    <span class="image_name" style="display: none;"></span>
                                </div>
                                <br>
                			</div>
                        <input type="button" onclick="submit_form_bayar(<?php echo $number; ?>);" class="button" name="submit" value="submit" />
        			</form>
                    
				</div>
			</div>
			
		</div>
		<div class="span5">
            
			
		</div>
	</div>
</div>
</div>



                                                     
                                                        
                                                            

                                    