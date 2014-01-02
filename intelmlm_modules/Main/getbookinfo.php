<?php
$bookinfo = $Class_ebooks->getSingleEbook($_REQUEST['bookid']);
?>
<div>
    <img src="<?php echo FOLDER_IMAGES."/assets/Book-icon.png"; ?>" style="width: 72px; height: 72px; float: left" />
    <?php echo $bookinfo['description']; ?>
    <div style="clear: both;"></div>
</div>