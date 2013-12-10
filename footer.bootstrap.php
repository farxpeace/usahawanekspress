<?php
if(DEBUG_MODE){
    
    $debugger['session'] = (array) $session;
    $debugger['Users'] = (array) $Users;
    $debugger['database'] = (array) $database;
    $debugger['models'] = (array) $models;
    $debugger['Settings'] = (array) $Settings;
    $debugger['form'] = (array) $form;
    $debugger['mailer'] = (array) $mailer;
    
    
    $_SESSION['debugdata'] = serialize($debugger);
    
    ?>
    <script type="text/javascript">
    
    var myWindow = window.open("<?php echo FOLDER_INCLUDE; ?>/debugger/debugger.php","com_","width=700,height=500");
    
    myWindow.document.close();
    
    </script>
    <?php
    
}
?>