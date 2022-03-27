<?php
require('config.php');

$id = $_GET['id'];
$sql = "UPDATE `request` SET `Status` = b'1' WHERE `request`.`RequestID` = $id;";
mysqli_query($con, $sql) or die(mysql_error());

echo '<script>window.alert("Done!")</script>';
echo "<script>window.location.href = 'orders.php'</script>";
