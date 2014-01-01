<!doctype html><html>    <head>        <title>Zebra_Pagination, database example</title>        <meta charset="utf-8">        <link rel="stylesheet" href="reset.css" type="text/css">        <link rel="stylesheet" href="style.css" type="text/css">        <link rel="stylesheet" href="../public/css/zebra_pagination.css" type="text/css">    </head>    <body>        <h2>Zebra_Pagination, database example</h2>        <p>For this example, you need to first import the <strong>countries.sql</strong> file from the examples folder        and to edit the <strong>example2.php file and change your database connection related settings.</strong></p>                <p>Show next/previous page links on the <a href="example2.php?navigation_position=left">left</a> or on the        <a href="example2.php?navigation_position=right">right</a>. Or revert to the <a href="example2.php">default style</a></p>        <?php        // database connection details        $MySQL_host     = '';        $MySQL_username = '';        $MySQL_password = '';        $MySQL_database = '';        // if could not connect to database        if (!($connection = @mysql_connect($MySQL_host, $MySQL_username, $MySQL_password)))            // stop execution and display error message            die('Error connecting to the database!<br>Make sure you have specified correct values for host, username and password.');        // if database could not be selected        if (!@mysql_select_db($MySQL_database, $connection))            // stop execution and display error message            die('Error selecting database!<br>Make sure you have specified an existing and accessible database.');        // how many records should be displayed on a page?        $records_per_page = 10;        // include the pagination class        require '../Zebra_Pagination.php';        // instantiate the pagination object        $pagination = new Zebra_Pagination();        // set position of the next/previous page links        $pagination->navigation_position(isset($_GET['navigation_position']) && in_array($_GET['navigation_position'], array('left', 'right')) ? $_GET['navigation_position'] : 'outside');        // the MySQL statement to fetch the rows        // note how we build the LIMIT        // also, note the "SQL_CALC_FOUND_ROWS"        // this is to get the number of rows that would've been returned if there was no LIMIT        // see http://dev.mysql.com/doc/refman/5.0/en/information-functions.html#function_found-rows        $MySQL = '            SELECT                SQL_CALC_FOUND_ROWS                country            FROM                countries            ORDER BY                country            LIMIT                ' . (($pagination->get_page() - 1) * $records_per_page) . ', ' . $records_per_page . '        ';        // if query could not be executed        if (!($result = @mysql_query($MySQL)))            // stop execution and display error message            die(mysql_error());        // fetch the total number of records in the table        $rows = mysql_fetch_assoc(mysql_query('SELECT FOUND_ROWS() AS rows'));        // pass the total number of records to the pagination class        $pagination->records($rows['rows']);        // records per page        $pagination->records_per_page($records_per_page);        ?>        <table class="countries" border="1">        	<tr><th>Country</th></tr>            <?php $index = 0?>            <?php while ($row = mysql_fetch_assoc($result)):?>            <tr<?php echo $index++ % 2 ? ' class="even"' : ''?>>                <td><?php echo $row['country']?></td>            </tr>            <?php endwhile?>        </table>        <?php        // render the pagination links        $pagination->render();        ?>        <script type="text/javascript" src="jquery-1.7.2.js"></script>        <script type="text/javascript" src="../public/javascript/zebra_pagination.js"></script>    </body></html>