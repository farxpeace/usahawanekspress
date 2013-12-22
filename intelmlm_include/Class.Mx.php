<?php
Class Mx {
    
    function timestamp_to_date($timestamp, $format = 'Y-m-d'){
        return date($format, $timestamp);
    }
    
    function truncate($text, $chars = 25) {
        $text = $text." ";
        $text = substr($text,0,$chars);
        $text = substr($text,0,strrpos($text,' '));
        $text = $text."...";
        return $text;
    }
}
$Mx = new Mx;
?>