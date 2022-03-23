<?php
require('config.php');
?>

<div>
    <nav class="navbar navbar-light navbar-expand-lg navigation-clean-search">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" href="admin-products.php">
                <img class="img-fluid" src="assets/img/IRIMS.png" width="95" height="95">
            </a>
            <a class="nav-link text-body font-weight-bold px-0" href="orders.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" class="me-sm-1 icon-color orders-icon">
                    <path d="M9 5H7C5.89543 5 5 5.89543 5 7V19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19V7C19 5.89543 18.1046 5 17 5H15M9 5C9 6.10457 9.89543 7 11 7H13C14.1046 7 15 6.10457 15 5M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5M12 12H15M12 16H15M9 12H9.01M9 16H9.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <span class="d-sm-inline d-none text-color">Orders</span></a>
            <div class="d-flex justify-content-center">
                <button class="btn btn-primary rounded-pill add-product" type="button" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    <i class="fas fa-capsules"></i>
                </button>
                <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="AddProduct" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content bg-modal">
                            <div class="row p-5">
                                <div class="col-md mb-md-0 mb-5">
                                    <div class="modal-body p-0">
                                        <div class="d-flex align-items-center mb-4">
                                            <h3 class="me-3">Add Product</h3>
                                            <img class="img-fluid" src="assets/img/add-product.png" width="55" height="55" class="rounded-circle">
                                        </div>
                                        <form action="add-product.php" class="add-product-form" method="POST" enctype="multipart/form-data">
                                            <div class="form-group custom-file-button">
                                                <label for="productImage" class="label-modal">Product Image</label>
                                                <input type="file" class="form-control modal-form" name="productImage" id="productImage">
                                            </div>
                                            <div class="form-group">
                                                <label for="brandName" class="label-modal">Product Name</label>
                                                <input type="text" class="form-control modal-form" name="brandName" id="brandName" placeholder="Pearly-C">
                                            </div>
                                            <div class="form-group">
                                                <label for="stockQuantity" class="label-modal">Stock Quantity</label>
                                                <input type="number" class="form-control modal-form" name="stockQuantity" id="stockQuantity" placeholder="60">
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="modal-body p-0" style="margin-top: 5rem;">
                                        <div class="form-group">
                                            <label for="manufacturerName" class="label-modal">Manufacturer Name</label>
                                            <select class="form-select modal-form" name="manufacturerName" id="manufacturerName" placeholder="Jiangxi Xierkangtai Pharmaceutical Co Ltd">
                                                <option value="" disabled selected></option>
                                                <?php
                                                $sql = "SELECT * FROM manufacturer;";
                                                $result = $con->query($sql) or die(mysql_error());

                                                while ($row = $result->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row['ManufacturerID'] ?>"><?php echo $row['ManufacturerName'] ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="category" class="label-modal">Category Name</label>
                                            <select class="form-select modal-form" name="category" id="category">
                                                <option value="" disabled selected></option>
                                                <option selected></option>
                                                <?php
                                                $sql = "SELECT * FROM category;";
                                                $result = $con->query($sql) or die(mysql_error());

                                                while ($row = $result->fetch_assoc()) { ?>
                                                    <option value="<?php echo $row['CategoryID'] ?>"><?php echo $row['CategoryName'] ?></option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="d-flex justify-content-end" style="margin-top: 6rem;">
                                            <div class="form-group me-3">
                                                <button type="button" class="form-control btn btn-cancel rounded submit px-3" data-bs-dismiss="modal">Cancel</button>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="submitAdd" class="form-control btn btn-save rounded px-3">Save</button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dropdown">
                <span>
                    <img class="img-fluid" src="assets/img/avatar.png" width="40" height="40" class="rounded-circle">
                    <span class="d-sm-inline d-none text-color ms-1">
                        <?php
                        echo $_SESSION['username'];
                        ?>
                    </span>
                </span>
                <div class="dropdown-content">
                    <a href="logout.php">Log out</a>
                </div>
            </div>
        </div>
    </nav>
</div>