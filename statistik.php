<?php
include(THEME_LOC."/main_header.php");
?>
<style>
.box {
    border: 1px solid #ECECEC;
    padding: 5px;
}
.box-title {
    padding: 5px;
    background-color: #4390df;
}
</style>
<?php
$getUser_level1 = $Class_unilevel->getUserLevel($session->uid, 1);
$getUser_level2 = $Class_unilevel->getUserLevel($session->uid, ($session->userinfo['pakej']/2));
$all_transaction = $Class_Transaction->getAllTransactionByRcx_id($session->uid);
$transaction_paid = $Class_Transaction->getAllTransactionByStatus($session->uid, 'paid');
$transaction_wait = $Class_Transaction->getAllTransactionByStatus($session->uid, 'waiting_for_payment');

$all_level = $Class_unilevel->getUserLevel($session->uid, ($session->userinfo['pakej']/2));

?>
<div class="grid fluid">
    <div class="row">
        <div class="span4">
            <div class="box">
                <div class="box-title">Prospek berdaftar</div>
                <div class="box-content">
                <table style="width: 100%;">
                    <tr>
                        <td>Jumlah</td>
                        <td><?php echo count($getUser_level1); ?></td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
        <div class="span4">
            <div class="box">
                <div class="box-title">Pesanan</div>
                <div class="box-content">
                <table style="width: 100%;">
                    <tr>
                        <td>Menunggu pembayaran</td>
                        <td><?php echo count($transaction_wait); ?></td>
                    </tr>
                    <tr>
                        <td>Pembayaran Selesai</td>
                        <td><?php echo count($transaction_paid); ?></td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td><?php echo count($all_transaction); ?></td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
        <div class="span4">
            <div class="box">
                <div class="box-title">Kumpulan Promosi</div>
                <div class="box-content">
                <table style="width: 100%;">
                    <?php for($i=1; $i<= ($session->userinfo['pakej']/2); $i++){ ?>
                    <tr>
                        <td>Kumpulan <?php echo $i; ?></td>
                        <td><?php echo ($Class_unilevel->levelinfo[$i]['count'] != '' ? $Class_unilevel->levelinfo[$i]['count'] : '0'); ?></td>
                    </tr>
                    <?php } ?>
                    
                </table>
                </div>
            </div>
        </div>
    </div>
</div>