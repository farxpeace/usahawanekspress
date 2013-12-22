<?php
include(THEME_LOC."/main_header.php");
?>
<div class="grid fluid" style="padding: 10px;">
    <div class="row">
        <div class="span6">
        <div class="accordion" data-role="accordion">
            <div class="accordion-frame">
                <a href="#" class="heading active">Profile</a>
                <div class="content">
                    <form>
                                    <fieldset>
                                        <legend>Profile</legend>
                                        <lable>Fullname</lable>
                                        <div class="input-control text" data-role="input-control">
                                            <input type="text" placeholder="type text">
                                            <button class="btn-clear" tabindex="-1" type="button"></button>
                                        </div>
                                        <lable>Email</lable>
                                        <div class="input-control password" data-role="input-control">
                                            <input type="text" placeholder="type text" autofocus="" value="<?php echo $session->email; ?>" />
                                            <button class="btn-clear" tabindex="-1" type="button"></button>
                                        </div>
                                        <input type="submit" value="Submit">
                                    </fieldset>
                                </form>
                </div>
            </div>
        </div>
        
        <div class="accordion" data-role="accordion">
            <div class="accordion-frame">
                <a href="#" class="heading">Password</a>
                <div class="content">
                    <form>
                                    <fieldset>
                                        <legend>Change password</legend>
                                        <lable>Current password</lable>
                                        <div class="input-control password" data-role="input-control">
                                            <input type="password" placeholder="type password">
                                            <button class="btn-reveal" tabindex="-1" type="button"></button>
                                        </div>
                                        <lable>New password</lable>
                                        <div class="input-control password" data-role="input-control">
                                            <input type="password" placeholder="type password">
                                            <button class="btn-reveal" tabindex="-1" type="button"></button>
                                        </div>
                                        <label>Retype new password</label>
                                        <div class="input-control password" data-role="input-control">
                                            <input type="password" placeholder="type password">
                                            <button class="btn-reveal" tabindex="-1" type="button"></button>
                                        </div>
                                        <input type="submit" value="Submit">
                                    </fieldset>
                                </form>
                </div>
            </div>
        </div>
        
            
        </div>
        <div class="span6">
            <div class="accordion" data-role="accordion">
                <div class="accordion-frame">
                    <a href="#" class="heading active">Account</a>
                    <div class="content">
                        <form>
                                    <fieldset>
                                        <legend>Account</legend>
                                        <label>Type</label>
                                        <div class="input-control text">
                                            <input type="text" value="<?php echo $database->getSingleValueByMetaAndRef('level_package', $session->userlevel); ?>" placeholder="input text" disabled/>
                                            <button class="btn-clear"></button>
                                        </div>
                                        
                                        <p class="tertiary-text">Enterprise can post unlimited ads. But limited photo upload and member get member</p>
                                        <p class="tertiary-text-secondary">...</p>
                                        
                                        
                                    </fieldset>
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>