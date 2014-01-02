<?php
session_start();
$debug = unserialize($_SESSION['debugdata']);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>jQuery UI Tabs - Default functionality</title>
	<link rel="stylesheet" href="jquery-ui-1.10.3.custom/css/debugger-theme/jquery-ui-1.10.3.custom.css">
	<script src="jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
	<script src="jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="Easy-Responsive-Tabs-to-Accordion-master/js/easyResponsiveTabs.js"></script>
	<link rel="stylesheet" href="Easy-Responsive-Tabs-to-Accordion-master/css/easy-responsive-tabs.css">
    <link rel="stylesheet" href="pure-min.css">
    
      
    
</head>
<body>
   
<div id="window_container">

    
<div id="tabs">

	<ul>
        <?php foreach($debug as $title => $data){ ?>
        <li><a href="#tabs-<?php echo $title; ?>"><?php echo $title; ?></a></li>
        <?php } ?>
    </ul>
    
    <?php foreach($debug as $title => $data){ ?>
    <div id="tabs-<?php echo $title; ?>">
    
        <div class="pure-g center">
            <div class="pure-u-1-3">
            s
            </div>
            <div class="pure-u-2-3">
            s
            </div>
        </div>
    
    
    
    
    
    
    
    
        <div id="childtabs-<?php echo $title; ?>">
            
        	<ul>
                <?php foreach($data as $key => $value){ ?>
                <li><a href="#childtabs-<?php echo $key; ?>"><?php echo $key; ?></a></li>
                <?php } ?>
        	</ul>
            
                <?php foreach($data as $key => $value){ ?>
                <div id="childtabs-<?php echo $key; ?>">
                    <div>
                    <?php echo $data[$key]; ?>
                    </div>
                </div>  
                <?php } ?> 
        </div>
        
    </div>  
    <script>
    $(function(){
        $("#childtabs-<?php echo $title; ?>").tabs({
            
        })
    })
    </script>
    <?php } ?>
</div>


</div>
<script type="text/javascript">
jQuery.browser = {};
(function () {
    jQuery.browser.msie = false;
    jQuery.browser.version = 0;
    if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
        jQuery.browser.msie = true;
        jQuery.browser.version = RegExp.$1;
    }
})();
function SelectText(element) {
    var text = $(element).text();
    if ($.browser.msie) {
        var range = document.body.createTextRange();
        range.moveToElementText(text);
        range.select();
    } else if ($.browser.mozilla || $.browser.opera) {
        var selection = window.getSelection();
        var range = document.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
    } else if ($.browser.safari) {
        var selection = window.getSelection();
        selection.setBaseAndExtent(text, 0, text, 1);
    }
}
$(function(){
    $("#tabs").tabs();
    //$(".childtabs").tabs();
})
</script>

</body>
</html>