<button type="button" onclick="colorbox_open_pesanan();">Pesanan</button>

<script type="text/javascript">
function colorbox_open_pesanan(){
    $.colorbox({
        href: 'main.php?modules=Main&op=view_pesanan',
        width: $(window).width(),
        height: $(window).height()
    });
    
}
</script>