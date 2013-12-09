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
    
      
    
</head>
<body>
   
<div id="window_container">
<div id="tabs">
	<ul>
        <?php
            foreach($debug as $title => $data){
                echo '<li><a href="#tabs-'.$title.'">'.$title.'</a></li>';
            }
        ?>
		
		
	</ul>
        <?php foreach($debug as $title => $data){ ?>
        
            <div id="tabs-<?php echo $title; ?>">
                <div id="childtabs_<?php echo $title; ?>" class="childtabs">          
                    <ul class="resp-tabs-list">
                        <?php
                            foreach($data as $a => $b){
                                echo '<li>'.$a.'</li>';
                            }
                        ?>    
                    </ul> 
        
                    <div class="resp-tabs-container">                                                        
                        <?php
                            foreach($data as $a => $b){ 
                                $object = 0;
                                if(is_numeric($b) || is_string($b)){
                                    $variable = ' : '.$b;
                                }else{
                                    $variable = ' : Object';
                                }
                                ?>
                                
                                <div>
                                    <div class="title"><input value="$<?php echo $title; ?>-><?php echo $a; ?>" /><?php echo $variable; ?></div>
                                    <div class="content">
                                        <?php
                                        if(is_object($b) || is_array($b)){
                                            echo '<ul>';
                                            foreach($b as $c => $d){ ?>
                                                <li>
                                                    <div>
                                                    <?php echo $c; ?> : <?php echo $d; ?><br />
                                                    <input style="width:100%" value="$<?php echo $title; ?>-><?php echo $a; ?>[<?php echo $c; ?>]" />
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            echo '</ul>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php }
                        ?>    
                    </div>
                </div>
                <div style="clear: both;"></div>
	       </div>
           <script type="text/javascript">
            $('#childtabs_<?php echo $title; ?>').easyResponsiveTabs({
                type: 'vertical', //Types: default, vertical, accordion           
                width: 'auto', //auto or any custom width
                fit: true,   // 100% fits in a container
                closed: false, // Close the panels on start, the options 'accordion' and 'tabs' keep them closed in there respective view types
                activate: function() {
                    var height = $("#tabs-<?php echo $title; ?>").height();
                    $("#tabs-<?php echo $title; ?>").find(".resp-tabs-container").css('height', height+'px')
                },  // Callback function, gets called if tab is switched
                start: function(){
                    console.log('start')
                }
            });
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
})
</script>

</body>
</html>