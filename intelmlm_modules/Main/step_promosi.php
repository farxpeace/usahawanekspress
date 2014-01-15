Promosikan URL Affiliate anda kepada rakan-rakan anda. Setiap orang yang memasuki dan mendaftar melalui URL Affiliate anda secara automatik akan menjadi pembeli berpotensi.
<br />
<label>URL Promosi</label>
<div class="input-control text" data-role="input-control">
                                            <input type="text" placeholder="URL Promosi" value="<?php echo 'http://usahawanekspress.com/'. $Mx->encrypt_decrypt('encrypt', $session->userinfo['id']); ?>" />
                                            <button class="btn-clear" tabindex="-1" type="button"></button>
                                        </div>
<p class="padding20 bg-red fg-white" <?php echo ($session->userinfo['userlevel'] == '1' ? 'style="display: block"' : 'style="display: none"') ?>>
Akaun anda masih belum aktif, URL Promosi anda juga masih belum aktif.
Anda masih ada peluang selagi mereka belum membuat pilihan pakej. Sekiranya terdapat orang yang membuat pilihan pakej melalui URL Promosi anda, dan anda masih belum menjadi Ahli Verified, nama anda akan terkeluar secara automatik dari senarai Peniaga untuk pembeli tersebut. 
</p>
