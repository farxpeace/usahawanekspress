<script type="text/javascript" src="intelmlm_modules/Main/Zebra_Pagination-master/public/javascript/zebra_pagination.js"></script>

<?php
// how many records should be displayed on a page?
$records_per_page = 10;

// include the pagination class
require 'intelmlm_modules/Main/Zebra_Pagination-master/Zebra_Pagination.php';

// instantiate the pagination object
$pagination = new Zebra_Pagination();

// the MySQL statement to fetch the rows
// note how we build the LIMIT
// also, note the "SQL_CALC_FOUND_ROWS"
// this is to get the number of rows that would've been returned if there was no LIMIT
// see http://dev.mysql.com/doc/refman/5.0/en/information-functions.html#function_found-rows
$MySQL = "
    SELECT
        *
    FROM
        intelmlm_transaction
    WHERE
        rcx_uid='".$session->uid."'
    LIMIT
        " . (($pagination->get_page() - 1) * $records_per_page) . ", " . $records_per_page . "
";

// if query could not be executed
if (!($result = @mysql_query($MySQL))) {

    // stop execution and display error message
    die(mysql_error());

}

// fetch the total number of records in the table
$rows = mysql_fetch_assoc(mysql_query('SELECT FOUND_ROWS() AS rows'));

// pass the total number of records to the pagination class
$pagination->records($rows['rows']);

// records per page
$pagination->records_per_page($records_per_page);

?>

<table class="table hovered" border="1">

    <tr>
        <th>Dari</th>
        <th>Jenis</th>
        <th>E-Books</th>
        <th>Amount (RM)</th>
        <th>Status</th>
    </tr>

    <?php $index = 0?>

    <?php while ($row = mysql_fetch_assoc($result)):?>
    <?php
    $tx_user = $database->getUserInfoById($row['trx_uid']);
    if($row['trx_type'] == 'pendaftaran'){
        $trx_type = 'Pembelian';
    }
    ?>
    <tr<?php echo $index++ % 2 ? ' class="even"' : ''?>>
        <td><?php echo $tx_user['email']?></td>
        <td><?php echo $trx_type; ?></td>
        <td>
        <?php
        $ebooks_arr = explode(',', $row['trx_desc']);
        if(is_array($ebooks_arr)){
            foreach($ebooks_arr as $a=> $b){
                $ebook = $Class_ebooks->getSingleEbook($b);
                echo '<div>'.$ebook['title'].'</div>';
            }
        }
        ?>
        </td>
        <td><?php echo $row['amount']; ?></td>
        <td>
        <?php
        if($row['status'] == 'waiting_for_payment'){
            $xstatus = 'Menunggu pembayaran';
        }elseif($row['status'] == 'paid'){
            $xstatus = 'Selesai';
        }
        ?>
        <?php echo $xstatus; ?>
        </td>
    </tr>

    <?php endwhile?>

</table>

<?php

// render the pagination links
$pagination->render();

?>