<?php
ob_start();
session_start();
$debug = unserialize($_SESSION['debugdata']);
$debug_r = unserialize($_SESSION['debug_r']);
$Config = unserialize($_SESSION['config']);

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Debugger</title>
	<link rel="stylesheet" href="jquery-ui-1.10.3.custom/css/debugger-theme/jquery-ui-1.10.3.custom.css">
	<script src="jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
	<script src="jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
	<script type="text/javascript" src="Easy-Responsive-Tabs-to-Accordion-master/js/easyResponsiveTabs.js"></script>
	<link rel="stylesheet" href="Easy-Responsive-Tabs-to-Accordion-master/css/easy-responsive-tabs.css">
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.3.0/pure-min.css">
    <style>
        input {
            padding: 5px;
        }   
        input.half {
            width: 50%;
            float: left;
        } 
        .variable_type {
            float: left;
            padding: 5px;
        }
        .subcontent {
            padding: 5px;
            margin: 3px;
            border: 1px solid #FFCCCC;

        }
        
        .subcontent table td.title {
            width: 120px;
        }
        .var2_type {
            padding: 5px;
            border: 1px solid #FFCCCC;
            margin-left: 3px;
            margin-bottom: 5px;
        }
        
        .var2_type_content {
            border: 1px solid #CCCCCC;
            margin-bottom: 10px;
        }
    </style>
    
</head>
<body>
   
<div id="window_container">
<div id="tabs">
	<ul>
        <li><a href="#tabs-settings-system">Configuration</a></li>
        <?php
            foreach($debug as $title => $data){
                echo '<li><a href="#tabs-'.$title.'">'.$title.'</a></li>';
            }
        ?>
        <?php
            foreach($debug_r as $title => $data){
                echo '<li><a href="#tabs-'.$title.'">'.$title.'</a></li>';
            }
        ?>
		
		
	</ul>
        <div id="tabs-settings-system">
        
        <table class="pure-table" style="width: 100%;">
    <thead>
        <tr>
            <th>ID</th>
            <th>References</th>
            <th>Meta</th>
            <th>Value</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($Config as $key => $value){ ?> 
        <tr class="pure-table-odd">
            <td style="width: 20px;"><?php echo $value['id']; ?></td>
            <td style="width: 120px;"><?php echo $value['ref']; ?></td>
            <td style="width: 120px;"><?php echo $value['meta']; ?></td>
            <td><?php echo $value['value']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

        </div>
        
        <?php foreach($debug_r as $title => $data){ ?>
        
            <div id="tabs-<?php echo $title; ?>">
                <pre>
                <?php print_r($data); ?>
                </pre>
            </div>
        <?php } ?>
        
        
        <?php foreach($debug as $title => $data){ ?>
        
            <div id="tabs-<?php echo $title; ?>">
                <div class="search_content">
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 50px;">Search</td>
                            <td><input id="search_input" name="search_input" class="half" /></td>
                        </tr>
                    </table>
                </div>
                <div style="clear: both;"></div>
                <div id="childtabs_<?php echo $title; ?>" class="childtabs">          
                    <ul class="resp-tabs-list">
                    <?php foreach($data as $a => $b){ ?>
                        <li><?php echo $a ?></li>
                    <?php } ?>    
                    </ul> 
        
                    <div class="resp-tabs-container">                                                        
                        <?php
                        
                            foreach($data as $a => $b){ 
                                $object = 0;
                                $obj_data = $b;
                                $var_type = gettype($b);
                                ?>
                                
                                <div class="content_container">
                                    <div class="title">
                                        <button class="variable_type"><?php echo $var_type; ?></button> <input class="half" value="$<?php echo $title; ?>-><?php echo $a; ?>" /></div>
                                    <div style="clear: both"></div>
                                    <div class="content">
                                    
                                        <div class="subcontent">
                                            <?php if(($var_type == 'string') || $var_type == 'integer'){ ?>
                                                <button class="variable_type">value</button> <input class="half" value="<?php echo $b; ?>" />
                                            <?php } ?>
                                            
                                            <?php if($var_type == 'boolean'){ ?>
                                                <button class="variable_type">value</button> <input class="half" value="<?php if($b){ echo 'true'; }else{ echo 'false'; }; ?>" />
                                            <?php } ?>
                                            
                                            <?php if($var_type == 'array'){ ?>
                                                <?php foreach($obj_data as $key => $value){ ?>
                                                <div class="var2_type_content">
                                                <?php
                                                $var2_type = gettype($value);
                                                ?>
                                                
                                                    <?php if(($var2_type == 'string') || $var2_type == 'integer'){ ?>
                                                    <button class="variable_type"><?php echo $var2_type; ?></button> <input class="half" value="$<?php echo $title; ?>-><?php echo $a; ?>[<?php echo $key; ?>]" />

                                                    <div style="clear: both"></div>
                                                    <button class="variable_type">value</button> <input class="half" value="<?php echo $value; ?>" />
                                                    <div style="clear: both"></div>
                                                    <table style="width: 100%;">
                                                        <tr>
                                                            <td class="title">PHP+HTML</td>
                                                            <td class="td_half"><input class="half" value="&lt;?php echo $<?php echo $title.'->'.$a; ?>[<?php echo $key; ?>]; ?&gt;" /></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="title">PHP Echo</td>
                                                            <td class="td_half"><input class="half" value="echo $<?php echo $title.'->'.$a; ?>[<?php echo $key; ?>];" /></td>
                                                        </tr>
                                                    </table>
                                                    
                                                    <?php } ?>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                            
                                            <div style="clear: both"></div>
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td class="title">PHP+HTML</td>
                                                    <td class="td_half"><input class="half" value="&lt;?php echo $<?php echo $title.'->'.$a; ?>; ?&gt;" /></td>
                                                </tr>
                                                <tr>
                                                    <td class="title">PHP Echo</td>
                                                    <td class="td_half"><input class="half" value="echo $<?php echo $title.'->'.$a; ?>;" /></td>
                                                </tr>
                                            </table>
                                            
                                            <?php if($var_type == 'Object'){ ?>
                                                <?php foreach($b as $key => $value){ ?>
                                                <div>
                                                    <button class="variable_type">value</button> <input class="half" value="<?php echo $value; ?>" />
                                                </div>
                                                <?php } ?>
                                                
                                            <?php } ?>
                                            
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            <?php unset($var_type); }
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
        <?php unset($data); } ?>
        
	
	
</div>
</div>
<script type="text/javascript">

$(function(){
    $("#tabs").tabs({
        activate: function( event, ui ) {
            
        }
    });
})
</script>

</body>
</html>
<?php
ob_end_flush();
?>