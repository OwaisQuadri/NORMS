<?php
// Defining databse constants here to prevent repetition elsewhere
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'dms-project');

function format_money($num)
{
    return "$" . number_format($num, 2, '.', ' ');
}
function format_2dec($num)
{
    $format_2dec = number_format($num, 2, '.', '');
    return $format_2dec;
}
function alert($msg)
{
    echo "<script type='text/javascript'>console.log('$msg');</script>";
}
