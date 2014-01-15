<script type="text/javascript" src="./js/ydn.db-iswu-sql-e-dev.js"></script>
<script type="text/javascript" src="./js/intelmlm_database.js"></script>
<script type="text/javascript">
var jQinfo_php = '<?php echo json_encode($session->jqinfo); ?>';
var jQinfo_object = $.parseJSON(jQinfo_php);
var jQinfo_array = [];
jQinfo_array.push(jQinfo_object);
var schema = {
        stores: [{
            name: 'users',
            keyPath: 'userid',
            indexes: function(){
                var array = [];
                $.each(jQinfo_object, function(key, element){
                    array.push({ keyPath: key });
                });
                return array;
            }
            
            
        }]
    };

//$.database.create('usahawanekspress', schema);


//$.database.insert('users', [jQinfo_object]);
//$.database.select('users', "SELECT * FROM users WHERE userid=\'57\' LIMIT 1",['username', 'userid'], function(a){ console.log(a) });


</script>
<?php

if($Settings->const_debug_mode == 'yes'){
    
    #$debugger['session'] = (array) $session;
    $Class_debugger->debug('session', $session);
    $Class_debugger->debug('users', $session->userinfobyid);
    $Class_debugger->debug('database', $database);
    
    $Class_debugger->debug('Models', $models);
    $Class_debugger->debug('Ads', $Class_Ads);
    $Class_debugger->debug('Settings', $Settings);
    $Class_debugger->debug('Form', $form);
    $Class_debugger->debug('Mailer', $mailer);
    
    
    
    $_SESSION['debugdata'] = serialize($debugger);
    
    ?>
    <script type="text/javascript">
    
    $(function(){
        var width = (90/100) * ($(window).innerWidth());
        
        var myWindow = window.open("<?php echo FOLDER_INCLUDE; ?>/debugger/debugger.php","com_","width="+width+"px,height=500");
    
        myWindow.document.close();
    });
    
    </script>
    <?php
    
}
?>