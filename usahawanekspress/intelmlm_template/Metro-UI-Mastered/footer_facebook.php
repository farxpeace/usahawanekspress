
<script type="text/javascript">
function fb_login(fb_id, fb_email, fb_token){
    $.ajax({
                    url: 'process.php',
                    dataType: 'json',
                    type: 'post',
                    data: { sublogin_fb: '1', fb_id: fb_id, fb_email: fb_email, fb_token: fb_token },
                    success: function(data){
                        if(data.status == 'reload_window'){
                            window.location.reload();
                        }
                    }
                })
}
function fb_login_form(){
    FB.login(function(response) {
        if (response.authResponse) {
            var fb_id = response.authResponse.userID;
            var fb_token = response.authResponse.accessToken;
            fb_login_user(fb_token);
            
        } else {
            console.log('User cancelled login or did not fully authorize.');
        }
    }, { scope: 'email,user_location,user_photos,publish_actions,user_online_presence,friends_online_presence,publish_stream,read_friendlists' });
}

function fb_login_user(fb_token){
    FB.api('/me', function(response2) { 
                var fb_email = response2.email;
                var fbname = response2.name;
                var fb_id = response2.id;
                fb_login(fb_id, fb_email, fb_token);  
    });
}
function login_form_fb(){
    FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                
                var uid = response.authResponse.userID;
                var fb_token = response.authResponse.accessToken;
                
                console.log('FB Connected');
                console.log(response);
                fb_login_user(fb_token);
            } else if (response.status === 'not_authorized') {
                // the user is logged in to Facebook, 
                // but has not authenticated your app
                console.log('FB Not authorized');
                fb_login_form();
            } else {
                // the user isn't logged in to Facebook.
                console.log('Not login')
            }
        });
}
$(function(){
    $.ajaxSetup({ cache: true });
    $.getScript('//connect.facebook.net/en_UK/all.js', function(){
        FB.init({
            appId: '567145173378045',
        });

        FB.getLoginStatus(function(response) {
            if (response.status === 'connected') {
                
                var uid = response.authResponse.userID;
                var fb_token = response.authResponse.accessToken;
                
                console.log('FB Connected');
                console.log(response);
                //fb_login_user(fb_token);
            } else if (response.status === 'not_authorized') {
                // the user is logged in to Facebook, 
                // but has not authenticated your app
                console.log('FB Not authorized');
                //fb_login_form();
            } else {
                // the user isn't logged in to Facebook.
                console.log('Not login')
            }
        });
        
        
    });
});
</script>