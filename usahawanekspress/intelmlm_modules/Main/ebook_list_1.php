<div class="grid fluid">
    <div class="row">
        <div id="frame_choice_<?php echo $i; ?>">
    <?php
    $limit_per_upline = $Class_ebooks->limit_per_upline;
    $max = $i*$limit_per_upline;
    $start = $max-($limit_per_upline-1);
    $up = $i-1;
    ?>
        <?php for($v=$start; $v<=$max; $v++){ ?>
        <?php
        $ebook_id = $v;
        if(in_array($ebook_id, $selected_ebook)){
            $class_selected_a = 'selected';
        }else{
            $class_selected_a = '';
        }
        
        ?> 
        <div class="span3">
            
            <div class="listview">
            	<a href="javascript: void(0);" class="<?php echo $class_selected_a; ?> list ebook ebook_pilih_order" data-ebookid="<?php echo $ebook_id; ?>" data-purchaseno="<?php echo $i; ?>" onclick="check_order_by_ebook(this);">
                    <input type="hidden" value="0" class="input_select_single_ebook" data-ebookid="<?php echo $ebook_id; ?>" data-purchaseno="<?php echo $i; ?>" name="order[ebook][<?php echo $uplineList[$up]['id'] ?>][]" />
                    <div class="list-content">
                        <img src="intelmlm_images/assets/onenote2013icon.png" class="icon">
                        <div class="data">
                            <span class="list-title" id="ebook_pilih_order_title_<?php echo $ebook_id; ?>"><?php echo $ebookList[$ebook_id]['title']; ?></span>
                            <div class="progress-bar small" data-role="progress-bar" data-value="75"><div class="bar bg-cyan" style="width: 75%;"></div></div>
                            <span class="list-remark">Download...75%</span>
                        </div>
                    </div>
                </a>
            </div>
            
        </div>
        <?php $ebook_info = array(); } ?>
        </div>
        <div id="frame_success_<?php echo $i; ?>" style="display: none; text-align: center">
            <p>Adakah anda pasti?</p><br /><button onclick="submit_form_checkout('<?php echo $i; ?>')" type="button" class="button primary">Ya</button> &nbsp <button onclick="reset_check_ebook_pilih_order_by_id('<?php echo $i; ?>');" type="button" class="button danger">Pilih semula</button>
        </div>
        <div id="frame_already_<?php echo $i; ?>" style="display: none; text-align: center">
            Pesanan diterima. Sila buat pembayaran dengan kadar yang segera.
        </div>
    </div>
</div>
