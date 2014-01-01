<div id="frame_receipt_hide_<?php echo $i; ?>">
    Sila buat pembayaran terlebih dahulu
</div>

    <div id="frame_receipt_show_<?php echo $i; ?>" style="">
                                        <button class="image-button danger" id="_receipt_print_area_<?php echo $i; ?>_print">
                                            Cetak
                                            <i class="icon-printer bg-red"></i>
                                        </button>
                                        <div id="_receipt_print_area_<?php echo $i; ?>">
                                        <style>
                                            .receipt_underline {
    text-align: center; 
    border-bottom: 1px solid #BEBABA;
    font-weight: bold !important;
}
                                        </style>
                                            <script type="text/javascript">
                                                $(function(){
                                                    $("#_receipt_print_area_<?php echo $i; ?>_print").click(function(){
                                                        width = (80/100)*$(window).width();
                                                        $('#_receipt_print_area_<?php echo $i; ?>').printArea({ 
                                                            mode : 'popup', 
                                                            popWd: width+'px',
                                                            popClose : false, 
                                                            exclude: ['#_receipt_print_area_<?php echo $i; ?>_print'],
                                                            extraCss : '<?php echo THEME_LOC; ?>/css/metro-bootstrap.css',
                                                            extraHead : '\u003cscript src="<?php echo THEME_LOC; ?>/js/metro-loader-with-jquery.js">\u003c/script>'  
                                                        });
                                                    });
                                                });
                                                </script>
                                                <p class="text-center"><strong class="invoice_print_upline_email"><?php echo $uplineList[$up]['email']; ?></strong></p>
                                                <h2 class="text-center"><strong>Resit Pembayaran</strong></h2>
                                                <div class="grid fluid">
                                                    <div class="row">
                                                        <div class="span6">
                                                            <span><strong>Receipt Id : </strong>#<?php echo $p_status['trx_invoice'].'-'.$p_status['id']; ?></span>
                                                        </div>
                                                        <div class="row6 text-right">
                                                            <span><strong>Tarikh : </strong><?php echo $Mx->timestamp_to_date($p_status['trx_date'], 'd M Y'); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="receipt_text" style="float: left; width: 200px;">
                                                        Pembayaran diterima dari 
                                                    </div>
                                                    <div class="receipt_underline" style="float: left; width: 400px;">
                                                        <?php echo $session->email; ?>
                                                    </div>
                                                    <div class="receipt_text" style="float: left; width: 80px;">
                                                        sebanyak
                                                    </div>
                                                    <div class="receipt_underline" style="float: left; width: 100px;">
                                                        RM 20
                                                    </div>
                                                    <div class="receipt_text" style="float: left; width: 80px;">
                                                        untuk
                                                    </div>
                                                    <div class="receipt_underline" style="float: left; width: 650px;">
                                                        Pembelian dua (2) e-book dalam bentuk Portable Document Format (pdf).
                                                    </div>
                                                    <div style="clear: both;"></div>
                                                </div>
                                                
                                                <br />  
                                        Note: This receipt is computer generated and no signature is required.

                                        </div>
                                        </div>
