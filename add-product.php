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

// Allow certain file formats
if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif"
) {
  echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.")</script>';
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo '<script>alert("Sorry, your file was not uploaded.")</script>';

  // if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
    if (isset($_POST["submitAdd"])) {
      $brandName = $_REQUEST['brandName'];
      $genericName = $_REQUEST['genericName'];
      $dosageStrength = $_REQUEST['dosageStrength'];
      $dosageForm = $_REQUEST['dosageForm'];
      $drugAdministration = $_REQUEST['drugAdministration'];
      $stockQuantity = $_REQUEST['stockQuantity'];
      $price = $_REQUEST['price'];
      $manufacturer = $_REQUEST['manufacturerName'];
      $category = $_REQUEST['category'];
      $condition = $_REQUEST['condition'];

      mysqli_query($con, "ALTER TABLE product AUTO_INCREMENT=51;") or die(mysql_error());
      $sql = "INSERT INTO product( BrandName, GenericName, DosageStrength, DosageForm, DrugAdministration, StockQuantity, Price, ManufacturerID, CategoryID) VALUES('$brandName', '$genericName', '$dosageStrength', '$dosageForm', '$drugAdministration', '$stockQuantity', '$price', '$manufacturer', '$category');";
      $result = mysqli_query($con, $sql) or die(mysql_error());

      echo "<script>window.alert('Successfully Added Products!')</script>";
      echo "<script>window.location.href = 'admin-products.php'</script>";
    } else {
      $ProductID = $_REQUEST['prodID'];
      $brandName = $_REQUEST['brandName'];
      $genericName = $_REQUEST['genericName'];
      $dosageStrength = $_REQUEST['dosageStrength'];
      $dosageForm = $_REQUEST['dosageForm'];
      $drugAdministration = $_REQUEST['drugAdministration'];
      $stockQuantity = $_REQUEST['stockQuantity'];
      $price = $_REQUEST['price'];
      $manufacturer = $_REQUEST['manufacturerName'];
      $category = $_REQUEST['category'];
      $condition = $_REQUEST['condition'];

      $sql = "UPDATE product SET BrandName = '$brandName', GenericName = '$genericName', DosageStrength = '$dosageStrength', DosageForm = '$dosageForm', DrugAdministration = '$drugAdministration', StockQuantity = '$stockQuantity', Price = '$price', ManufacturerID = '$manufacturer', CategoryID = '$category' WHERE  ProductID = '$ProductID'";
      $result = mysqli_query($con, $sql) or die(mysql_error());
      $url = 'edit-product.php' . "?title=" . $ProductID;
      echo "<script>window.alert('Successfully Edited Products!')</script>";
      echo "<script>window.location.href = '$url'</script>";
    }
  } else {
    echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
  }
}
