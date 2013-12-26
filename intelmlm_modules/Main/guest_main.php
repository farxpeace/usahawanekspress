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
<?php include(THEME_LOC.'/footer_facebook.php'); ?>
</body>
</html>