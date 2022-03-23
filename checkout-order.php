<?php
require('config.php');
if (isset($_POST['checkout'])) {
    $cart_id = $_REQUEST['cartID'];
    date_default_timezone_set('Asia/Manila');
    $order_date = date("Y-m-d");
    echo $order_date;

    $sql = "INSERT INTO ordercart(OrderDate, CartID) VALUES('$order_date', '$cart_id');";
    $result = mysqli_query($con, $sql) or die(mysql_error());

    header("Location: customer-products.php");
}
