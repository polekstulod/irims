<?php
include('config.php');

$prodID = $_GET['prodID'];
$sql = "UPDATE product SET Is_Deleted = '1' WHERE ProductID = $prodID";
mysqli_query($con, $sql) or die(mysql_error());
echo "<script> window.alert('Deleted Successfully')</script>";
echo '<script>window.location.href = "admin-products.php"</script>';
