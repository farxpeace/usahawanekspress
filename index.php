<?php
include('bootstrap.php');

$modules = $_REQUEST["modules"];
$op = $_REQUEST['op'];

if($modules == ''){
    $modules = 'Main';
    include(FOLDER_MODULES."/".$modules."/index.php");
}else{
    include(FOLDER_MODULES."/".$modules."/index.php");
}









if(DEBUG_MODE){
    $debugger = array();
    $debugger['session'] = (array) $session;
    $debugger['database'] = (array) $database;
    $debugger['form'] = (array) $form;
    $debugger['mailer'] = (array) $mailer;
    
    $_SESSION['debugdata'] = serialize($debugger);
    
    ?>
    <script type="text/javascript">

    var myWindow = window.open("<?php echo FOLDER_INCLUDE; ?>/debugger/debugger.php","debug","width=700,height=500");
    myWindow.document.close();
    </script>
    <?php
    
}

?>



