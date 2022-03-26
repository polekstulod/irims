<?php
require('config.php');

date_default_timezone_set('Asia/Manila');
$userID = $_GET['user_id'];
$quantity = $_POST['quantity'];
$productID = $_POST['product_id'];
$time = date("Y-m-d H:i:s");

$sql = "INSERT INTO `request`(`RequestDateTime`, `UserID`, `ProductID`, `Quantity`, `Status`) VALUES ('$time','$userID','$productID','$quantity',b'0');";
$result = mysqli_query($con, $sql) or die(mysql_error());

echo '<script>window.alert("Successfully Requested!")</script>';
header("Location: customer-products.php");
