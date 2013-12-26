<table style="width: 100%;">
                <tr>
                    <td style="width: 80px;" valign="top">
                        <img style="width: 50px; height: 50px;" src="http://icons.iconarchive.com/icons/visualpharm/icons8-metro-style/64/Numbers-<?php echo $i; ?>-icon.png" class="">
                    </td>
                    <td>
                        <div class="balloon right" style="padding: 10px;">
                            <div class="tab-control" data-role="tab-control">
                                <ul class="tabs">
                                    <li class="active"><a href="#_ebook_pilih_<?php echo $i; ?>">E-Book</a></li>
                                    <li><a href="#_ebook_peniaga_<?php echo $i; ?>">Peniaga</a></li>
                                    <li><a href="#_ebook_invois_<?php echo $i; ?>">Invois</a></li>
                                    
                                </ul>
                             
                                <div class="frames">
                                    
                                    <div class="frame frame_choose_ebook" id="_ebook_pilih_<?php echo $i; ?>">
                                    <form action="?modules=Main&op=checkout_process" method="post" class="form_checkout" id="form_checkout_<?php echo $i; ?>">
                                        <?php include('ebook_list_1.php'); ?>
                                    </form>
                                    </div>
                                    
                                    <div class="frame" id="_ebook_peniaga_<?php echo $i; ?>">
                                        <p>Nama: Mohamad Farizul</p>
                                        <p>Lokasi: Kuala Lumpur</p>
                                        <p>Jumlah jualan: 51 eboo</p>
                                    </div>
                                    <div class="frame" id="_ebook_invois_<?php echo $i; ?>">
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
                                                <p class="text-center"><strong>Mohamad Farizul</strong></p>
                                                <p class="text-center">Pembelian e-book dalam bentuk Portable Document Format (pdf)</p>
                                                
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td class="text-right">
                                                            No invois :
                                                        </td>
                                                        <td>
                                                            #66677766
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right">
                                                            Tarikh invois :
                                                        </td>
                                                        <td>
                                                            26 Disember 2014
                                                        </td>
                                                    </tr>
                                                </table>
                                                <h4>Kepada :</h4>
                                                <p>Adri Andrian (Nama Facebook)</p>
                                                <p>john45@gmail.com</p>
                                                <br /><br />
                                                
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
                                                            <td class="right">tajuk disini</td>
                                                            <td class="right">1</td>
                                                            
                                                            <td class="right">10</td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td class="right">tajuk disini</td>
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
                    </td>
                </tr>
            </table>