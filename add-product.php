<?php
require('config.php');

$target_dir = "assets/img/product-img/";
$target_file = $target_dir . basename($_FILES["productImage"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if (isset($_POST["submitEdit"]) || $_POST["submitAdd"]) {
  $check = getimagesize($_FILES["productImage"]["tmp_name"]);
  if ($check !== false) {
    $uploadOk = 1;
  } else {
    echo '<script>alert("File is not an image")</script>';
    $uploadOk = 0;
  }
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo '<script>alert("Sorry, your file was not uploaded.")</script>';

  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
    if (isset($_POST["submitAdd"])) {
      $productName = $_REQUEST['brandName'];
      $stockQuantity = $_REQUEST['stockQuantity'];
      $manufacturer = $_REQUEST['manufacturerName'];
      $category = $_REQUEST['category'];

      mysqli_query($con, "ALTER TABLE product AUTO_INCREMENT=11;") or die(mysql_error());
      $sql = "INSERT INTO `product`(`ProductName`, `Stocks`, `SupplierID`, `CategoryID`, `IsDeleted`) VALUES ('$productName','$stockQuantity','$manufacturer','$category',b'0');";
      $result = mysqli_query($con, $sql) or die(mysql_error());

      echo "<script>window.alert('Successfully Added Products!')</script>";
      echo "<script>window.location.href = 'admin-products.php'</script>";
    } else {
      $ProductID = $_REQUEST['prodID'];
      $productName = $_REQUEST['brandName'];
      $stockQuantity = $_REQUEST['stockQuantity'];
      $manufacturer = $_REQUEST['manufacturerName'];
      $category = $_REQUEST['category'];

      $sql = "UPDATE `product` SET `ProductName`='$productName',`Stocks`='$stockQuantity',`SupplierID`='$manufacturer',`CategoryID`='$category',`IsDeleted`=b'0' WHERE  ProductID = '$ProductID'";
      $result = mysqli_query($con, $sql) or die(mysql_error());
      $url = 'edit-product.php' . "?title=" . $ProductID;
      echo "<script>window.alert('Successfully Edited Products!')</script>";
      echo "<script>window.location.href = '$url'</script>";
    }
  } else {
    echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
  }
}
