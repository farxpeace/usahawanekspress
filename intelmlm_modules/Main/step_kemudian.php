<div id="s_update_userinfo" style="display: none;">
<div id="form_update_user">
<form id="form_update_maybank" method="POST" action="?modules=Main&op=update_bank">
                                    <fieldset>
                                        
                                        <div class="grid fluid">
                                            <div class="row">
                                                <div class="span6">
                                                    <label>Bank anda</label>
                                        <div class="input-control select">
                                            <select>
                                                <option value="maybank">Maybank</option>
                                            </select>
                                        </div>
                                        <label>Nama Pemegang Akaun</label>
                                        <div class="input-control text" data-role="input-control">
                                            <input type="text" placeholder="Contoh: Mohd Razak Bin Daim" name="bank_holder">
                                            <button class="btn-clear" tabindex="-1" type="button"></button>
                                        </div>
                                        <label>No Akaun Bank</label>
                                        <div class="input-control text" data-role="input-control">
                                            <input type="text" placeholder="Contoh: 553554777388999" name="bank_acc">
                                            <button class="btn-clear" tabindex="-1" type="button"></button>
                                        </div>
                                        <div class="input-control checkbox" data-role="input-control">
                                            <label>
                                                <input type="checkbox" checked="">
                                                <span class="check"></span>
                                                Saya bersetuju dengan terma dan syarat yang ditetapkan
                                            </label>
                                        </div>
                                        
                                                </div>
                                                <div class="span6">
                                                    <label>No Telefon Bimbit</label>
                                        <div class="input-control text" data-role="input-control">
                                            <input type="text" placeholder="Contoh: 0175565654" name="tel">
                                            <button class="btn-clear" tabindex="-1" type="button"></button>
                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <input type="submit" value="Submit">
                                </form>
</div>

</div>
<div id="s_show" style="">

<div class="padding5" style="border: 1px solid #ECECEC;">
    <div class="fg-white bg-lightBlue padding5">
        Referral link
    </div>
    Gunakan referral link ini untuk kegunaan promosi.
    <div class="input-control text" data-role="input-control">
                                            <input type="text" placeholder="type text" value="<?php echo $database->getSingleValueByMetaAndRef('constants', 'referral_url').'/'.$Mx->encrypt_decrypt('encrypt',$session->uid); ?>">
                                            
                                        </div>
</div>

<div class="padding5" style="border: 1px solid #ECECEC;">
    <div class="fg-white bg-lightBlue padding5">
        Invite rakan Facebook
    </div>
    <button type="button" onclick="invite_fb();">Invite</button>
</div>

</div>
<script type="text/javascript">
function invite_fb(){
    FB.api('/me', function (response) {
        var name = response.name;
        FB.ui({method: 'apprequests',
            message: 'Jom join '+name+' menjual E-Books'
        }, function(data){
            
        });
    })
    

}
$(function(){
    $("#form_update_maybank").ajaxForm({
        dataType: 'json',
        success: function(data){
            if(data.status == 'ok'){
                $.colorbox.close();
            }
        }
    });
    
    
})
</script>
