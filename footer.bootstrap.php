<?php
if($Settings->const_debug_mode == 'yes'){
    
    #$debugger['session'] = (array) $session;
    $Class_debugger->debug('Session', $session);
    $Class_debugger->debug('Users', $session->userinfobyid);
    $Class_debugger->debug('Database', $database);
    
    $Class_debugger->debug('Models', $models);
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