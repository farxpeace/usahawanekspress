<!DOCTYPE html>
<html>
    <head>
        <!--
        <link rel="stylesheet" href="css/metro-bootstrap.css" />
        <script src="js/jquery/jquery.min.js"></script>
        <script src="js/jquery/jquery.widget.min.js"></script>
        <script src="js/metro/metro.min.js"></script>
        
        <script type="text/javascript" src="<?php echo FOLDER_INCLUDE. DS . 'debugger' . DS . 'admin_panel'. DS . 'admin_panel.php'; ?>"></script>
        -->
        <link type="text/css" href="<?php echo FOLDER_INCLUDE. DS . 'debugger' . DS . 'jquery.jixedbar-0.0.5-branch/themes/vista/jx.stylesheet.css'; ?>" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo FOLDER_INCLUDE. DS . 'debugger' . DS . 'jquery-ui-1.10.3.custom'. DS . 'js' . DS . 'jquery-1.9.1.js'; ?>">
        
        </script>
        <script src="<?php echo FOLDER_INCLUDE. DS . 'debugger' . DS . 'jquery-migrate-1.2.1.js'; ?>"></script>
        <script type="text/javascript">
        var $j = jQuery.noConflict();
        </script>
        <script type="text/javascript" src="<?php echo FOLDER_INCLUDE. DS . 'debugger' . DS . 'jqueryNoConflict$j.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo FOLDER_INCLUDE. DS . 'debugger' . DS . 'jquery.jixedbar-0.0.5-branch/src/jquery.jixedbar.js'; ?>"></script>
        
        
    </head>
    <body class="metro">
    <div id="admin-bar" style="z-index: 1000000 !important; display: none;">
	<ul>
		<li title="Home"><a href="javascript: void(0);">Admin area</a></li>
	</ul>
	<span class="jx-separator-left"></span>
    <div>
		Module: <?php echo $data['modules_name']; ?>
	</div>
    <span class="jx-separator-left"></span>
    <div>
		Controller: <?php echo $data['admin']['function_name']; ?>
	</div>
	<ul class="jx-bar-button-right">
		<li title="Feeds"><a href="#"><img src="<?php echo FOLDER_INCLUDE . DS . 'debugger' . DS . 'jquery.jixedbar-0.0.5-branch' . DS ?>demo/icons/info.png" alt=""/></a>
		<ul>
			<li><a href="http://your.domain.tld/feed/"><img src="<?php echo FOLDER_INCLUDE . DS . 'debugger' . DS . 'jquery.jixedbar-0.0.5-branch' . DS ?>demo/icons/info.png" title="Content Feeds"/>Content Feed</a></li>
			<li><a href="http://your.domain.tld/comments/"><img src="<?php echo FOLDER_INCLUDE . DS . 'debugger' . DS . 'jquery.jixedbar-0.0.5-branch' . DS ?>demo/icons/info.png" title="Comment Feeds"/>Comment Feed</a></li>
		</ul>
		</li>
	</ul>
	<span class="jx-separator-right"></span>
</div>
        <script type="text/javascript">
        $j(function(){
            $j("#admin-bar").jixedbar({
                onShow: function(){
                    
                }
            });
            
        });
        </script>
    </body>
</html>