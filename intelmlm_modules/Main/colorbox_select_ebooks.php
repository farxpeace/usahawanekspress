<table style="width: 100%;" id="table_select_ebook_<?php echo $i; ?>" 
data-selebook="[<?php echo $Class_ebooks->getEbooksTrxById($p_status['id']); ?>]"
>
                <tr>
                    <td style="width: 80px;" valign="top">
                        <img style="width: 50px; height: 50px;" src="http://icons.iconarchive.com/icons/visualpharm/icons8-metro-style/64/Numbers-<?php echo $i; ?>-icon.png" class="">
                    </td>
                    <td>
                        <div class="balloon right" style="padding: 10px;">
                            <div class="tab-control" data-role="tab-control">
                                <ul class="tabs">
                                    <li class="active"><a href="#_ebook_pilih_<?php echo $i; ?>">E-Book</a></li>
                                    
                                    <li><a href="#_ebook_invois_<?php echo $i; ?>">Invois</a></li>
                                    
                                </ul>
                             
                                <div class="frames">
                                    
                                    <div class="frame frame_choose_ebook" id="_ebook_pilih_<?php echo $i; ?>">
                                    <form action="?modules=Main&op=checkout_process" method="post" class="form_checkout" id="form_checkout_<?php echo $i; ?>">
                                        <?php include('ebook_list_1.php'); ?>
                                    </form>
                                    </div>
                                    
                                    
                                    <div class="frame" id="_ebook_invois_<?php echo $i; ?>">
                                        <div id="frame_invois_unavailable_<?php echo $i; ?>">
                                            <div style="text-align: center;">Sila pilih ebook untuk membuat pesanan terlebih dahulu</div>
                                        </div>
                                        <div id="frame_invois_show_<?php echo $i; ?>" style="display: none;">
                                        <button class="image-button danger" id="_ebook_invois_<?php echo $i; ?>_print">
                                            Cetak
                                            <i class="icon-printer bg-red"></i>
                                        </button>
                                        <div id="_ebook_print_area_<?php echo $i; ?>">
                                            <script type="text/javascript">
                                                $(function(){
                                                    $("#_ebook_invois_<?php echo $i; ?>_print").click(function(){
                                                        width = (80/100)*$(window).width();
                                                        $('#_ebook_print_area_<?php echo $i; ?>').printArea({ 
                                                            mode : 'popup', 
                                                            popWd: width+'px',
                                                            popClose : false, 
                                                            exclude: ['#_ebook_invois_<?php echo $i; ?>_print'],
                                                            extraCss : '<?php echo THEME_LOC; ?>/css/metro-bootstrap.css',
                                                            extraHead : '\u003cscript src="<?php echo THEME_LOC; ?>/js/metro-loader-with-jquery.js">\u003c/script>'  
                                                        });
                                                    });
                                                });
                                                </script>
                                                <p class="text-center"><strong class="invoice_print_upline_email"><?php echo $uplineList[$up]['email'] ?></strong></p>
                                                <p class="text-center">Pembelian e-book dalam bentuk Portable Document Format (pdf)</p>
                                                
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td class="text-right">
                                                            Id invois : 
                                                        </td>
                                                        <td>
                                                            #<span class="invoice_print_numberinvoice"><?php echo $p_status['trx_invoice'].'-'.$p_status['id']; ?></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">
                                                            Tarikh invois : 
                                                        </td>
                                                        <td>
                                                            <span class="invoice_print_date"><?php echo $Mx->timestamp_to_date($p_status['trx_date'], 'd M Y'); ?></span>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <h4>Kepada :</h4>
                                                
                                                <p><?php echo $session->email; ?></p>
                                                <br />
                                                
                                                <h4>Senarai barang</h4>
                                                <table class="table hovered">
                                                    <thead>
                                                        <tr class="info fg-white">
                                                            <th class="text-left"><strong>No</strong></th>
                                                            <th class="text-left"><strong>Tajuk ebook</strong></th>
                                                            <th class="text-left"><strong>Kuantiti</strong></th>
                                                            <th class="text-left"><strong>Harga</strong></th>
                                                        </tr>
                                                    </thead>
                            
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td class="right"><span class="invois_title_ebook_<?php echo $i; ?>"></span></td>
                                                            <td class="right">1</td>
                                                            
                                                            <td class="right">10</td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td class="right"><span class="invois_title_ebook_<?php echo $i; ?>"></span></td>
                                                            <td class="right">1</td>
                                                            
                                                            <td class="right">10</td>
                                                        </tr>
                                                        <tr class="fg-white">
                                                            <td colspan="3" class=""></td>
                                                            <td class="right bg-darkGreen"><strong>Jumlah (RM) : 20</strong></td>
                                                            
                                                        </tr>
                                                    </tbody>
                            
                                                    <tfoot></tfoot>
                                                </table>
                                                
                                                <div class="grid">
                                                    <div class="row">
                                                        <div class="span6">
                                                            
                                                            
                                                        </div>
                                                        <div class="span6">
                                                        
                                                        </div>
                                                    </div>
                                                </div>
                                        
                                        </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>