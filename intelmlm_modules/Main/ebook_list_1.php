<div class="grid fluid">
    <div class="row">
        <div id="frame_choice_<?php echo $i; ?>">
    <?php
    $max = $i*4;
    $start = $max-3;
    $up = $i-1;
    ?>
        <?php for($v=$start; $v<=$max; $v++){ ?>
        <?php
        $ebook_id = $v;
        
        ?> 
        <div class="span3">
            
            <div class="listview">
            	<a href="javascript: void(0);" class="list ebook ebook_pilih_order" data-ebookid="<?php echo $ebook_id; ?>" data-purchaseno="<?php echo $i; ?>" onclick="check_order_by_ebook(this);">
                    <input type="hidden" value="0" class="input_select_single_ebook" data-ebookid="<?php echo $ebook_id; ?>" data-purchaseno="<?php echo $i; ?>" name="order[ebook][<?php echo $uplineList[$up]['id'] ?>][]" />
                    <div class="list-content">
                        <img src="images/onenote2013icon.png" class="icon">
                        <div class="data">
                            <span class="list-title">Ebook id#<?php echo $v; ?></span>
                            <div class="progress-bar small" data-role="progress-bar" data-value="75"><div class="bar bg-cyan" style="width: 75%;"></div></div>
                            <span class="list-remark">Download...75%</span>
                        </div>
                    </div>
                </a>
            </div>
            
        </div>
        <?php } ?>
        </div>
        <div id="frame_success_<?php echo $i; ?>" style="display: none;">
            <p>Adakah anda pasti?</p><br /><button onclick="submit_form_checkout('<?php echo $i; ?>')" type="button" class="button primary">Ya</button> &nbsp <button onclick="reset_check_ebook_pilih_order_by_id('<?php echo $i; ?>');" type="button" class="button danger">Pilih semula</button>
        </div>
        <div id="frame_already_<?php echo $i; ?>" style="display: none;">
            Pesanan diterima. Sila buat pembayaran dengan kadar yang segera.
        </div>
    </div>
</div>
