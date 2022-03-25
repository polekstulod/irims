<?php
$globalProdID = 0;
$globalCatID = 0;
function productInfo($con)
{ ?>
    <?php
    $productID = $_GET['title'];
    $sql = "SELECT p.ProductID, p.CategoryID, p.BrandName, p.StockQuantity, p.Price, p.DosageStrength, p.GenericName, p.DosageForm, p.DrugAdministration, m.ManufacturerName, cg.CategoryName, cond.ConditionName 
                FROM `product` p
                LEFT OUTER JOIN `manufacturer` m
                    ON p.ManufacturerID = m.ManufacturerID
                LEFT OUTER JOIN `category` cg
                    ON p.CategoryID = cg.CategoryID
                LEFT OUTER JOIN `cond`cond
                    ON cg.CategoryID = cond.CategoryID
                WHERE p.ProductID = $productID
                GROUP BY p.ProductID";

    $result = $con->query($sql) or die(mysql_error());

    while ($row = $result->fetch_assoc()) {
        $globalProdID = $row['ProductID'];
        $globalCatID = $row['CategoryID']; ?>
        <div class="col-md-6">
            <div class="d-flex justify-content-center bg-white shadow p-3 mb-5 bg-body rounded"><img class="img-fluid product-img" src="assets/img/product-img/<?php echo $row['ProductID']; ?>.jpeg"></div>
        </div>
        <div class="col-md-6">
            <div class="card prod-card shadow p-3 mb-5 bg-body rounded">
                <div class="card-body">
                    <h3 class="card-title mt-2 mb-3 fw-bold prod-title"><?php echo $row['BrandName'] ?></h3>
                    <h5 class="text-muted mb-4 prod-availability">Availability :&nbsp;
                        <span class="text-color fs-5 fw-bold">&nbsp;
                            <?php
                            if ($row['StockQuantity'] > 0) {
                                echo "In Stock";
                            } else {
                                echo "Out of Stock";
                            }
                            ?>
                        </span>
                    </h5>
                    <p class="mb-2">Product Name :
                        <span class="fw-bold">&nbsp;<?php echo $row['BrandName'] ?></span>
                    </p>
                    <p class="mb-2">Manufacturer :
                        <span class="fw-bold">&nbsp;<?php echo $row['ManufacturerName'] ?></span>
                    </p>
                    <p class="mb-2">Category :
                        <span class="fw-bold">&nbsp;<?php echo $row['CategoryName'] ?></span>
                    </p>
                    <?php
                    if ($_SESSION['username'] == 'admin') { ?>
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary product-btn-edit rounded-pill" type="button" data-bs-toggle="modal" data-bs-target="#editProductModal">EDIT</button>
                            <a href="<?php echo 'delete-product.php' . '?prodID=' . $row['ProductID'] ?>" class="btn btn-primary product-btn-edit rounded-pill" type="button">DELETE</a>
                            <div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="AddProduct" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content bg-modal">
                                        <div class="row p-5">
                                            <div class="col-md mb-md-0 mb-5">
                                                <div class="modal-body p-0">
                                                    <div class="d-flex align-items-center mb-4">
                                                        <h3 class="me-3">Edit Product</h3>
                                                        <img class="img-fluid" src="assets/img/add-product.png" width="55" height="55" class="rounded-circle">
                                                    </div>
                                                    <form action="add-product.php" class="add-product-form" method="POST" enctype="multipart/form-data">
                                                        <div class="form-group custom-file-button">
                                                            <label for="productImage" class="label-modal">Product Image</label>
                                                            <input type="file" class="form-control modal-form" name="productImage" id="productImage">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="brandName" class="label-modal">Product Name</label>
                                                            <input type="text" class="form-control modal-form" name="brandName" id="brandName" value="<?php echo $row['BrandName'] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="stockQuantity" class="label-modal">Stock Quantity</label>
                                                            <input type="number" class="form-control modal-form" name="stockQuantity" id="stockQuantity" value="<?php echo $row['StockQuantity'] ?>">
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="modal-body p-0" style="margin-top: 5rem;">
                                                    <div class="form-group">
                                                        <label for="manufacturerName" class="label-modal">Manufacturer Name</label>
                                                        <select class="form-select modal-form" name="manufacturerName" id="manufacturerName" value="Jiangxi Xierkangtai Pharmaceutical Co Ltd">
                                                            <option value="" disabled selected></option>
                                                            <?php
                                                            $sql = "SELECT * FROM manufacturer;";
                                                            $result = $con->query($sql) or die(mysql_error());

                                                            while ($row = $result->fetch_assoc()) { ?>
                                                                <option <?php if ($globalProdID == $row['ManufacturerID']) echo 'selected' ?> value="<?php echo $row['ManufacturerID'] ?>"><?php echo $row['ManufacturerName'] ?></option>
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
                                                                <option <?php if ($globalProdID == $row['CategoryID']) echo 'selected' ?> value="<?php echo $row['CategoryID'] ?>"><?php echo $row['CategoryName'] ?></option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="d-flex justify-content-end" style="margin-top: 6rem;">
                                                        <div class="form-group me-3">
                                                            <button type="button" class="form-control btn btn-cancel rounded submit px-3" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="hidden" value="<?php echo $globalProdID ?>" name="prodID" />
                                                            <button type="submit" name="submitEdit" class="form-control btn btn-save rounded px-3">Save</button>
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
                    <?php } else {
                        $username = $_SESSION['username'];
                        $sql = "SELECT UserID FROM user WHERE Username = '$username'";
                        $userID = mysqli_query($con, $sql) or die(mysql_error());
                        while ($row1 = mysqli_fetch_row($userID)) {
                            $user_ID = $row1[0];
                        }  ?>

                        <form action="cart.php?user_id=<?php echo $user_ID ?>" method="post">
                            <div class="d-flex justify-content-between">
                                <button class="d-flex justify-content-center align-items-center btn btn-primary product-btn-buy rounded-pill" type="submit">BUY</button>
                                <button class="btn btn-primary product-btn-add rounded-pill" id="addcounter" type="button" onClick="addCounter(1)">ADD</button>
                                <div id="counter" class="d-none align-items-center">
                                    <a class="quantity-minus" href="#">
                                        <span>-</span>
                                    </a>
                                    <input type="number" class="quantity-input" name="quantity" value="1">
                                    <a class="quantity-plus" href="#">
                                        <span>+</span>
                                    </a>
                                </div>
                                <input type="hidden" name="product_id" value="<?php echo $row['ProductID'] ?>">
                                <input type="hidden" name="price" value="<?php echo $row['Price'] ?>">
                            </div>
                        </form>
                    <?php }
                    ?>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
    <?php }

function listProducts($con)
{
    $username = $_SESSION['username'];
    $sql = "SELECT UserID FROM user WHERE Username = '$username'";
    $userID = mysqli_query($con, $sql) or die(mysql_error());
    while ($row = mysqli_fetch_row($userID)) {
        $user_ID = $row[0];
    }

    /*     $search = $_GET['search-product'] ?? '';

    $catArr = '';
    if (isset($_GET['category'])) {
        $name = $_GET['category'];
        foreach ($name as $category) {
            $catArr .= $category . ', ';
        }
    }
    $newCatArr = rtrim($catArr, ", ");

    $manArr = '';
    if (isset($_GET['manufacturer'])) {
        $name = $_GET['manufacturer'];
        foreach ($name as $manufacturer) {
            $manArr .= $manufacturer . ', ';
        }
    }
    $newManArr = rtrim($manArr, ", ");

    $sortMin = 0;
    $sortMax = 0;
    if (isset($_GET['sortMin']) && isset($_GET['sortMax'])) {
        $sortMin = $_GET['sortMin'];
        $sortMax = $_GET['sortMax'];
    }

    if (isset($_GET['category']) || isset($_GET['manufacturer'])) {
        if (!isset($_GET['manufacturer'])) {
            $sql = "SELECT * from product
            INNER JOIN manufacturer
                ON product.ManufacturerID = manufacturer.ManufacturerID
            INNER JOIN category
                ON product.CategoryID = category.CategoryID
                AND category.CategoryID IN ($newCatArr)
            WHERE product.Is_Deleted = 0;";
        } else if (!isset($_GET['category'])) {
            $sql = "SELECT *
            FROM product
            INNER JOIN manufacturer
                ON product.ManufacturerID = manufacturer.ManufacturerID
                AND manufacturer.ManufacturerID IN ($newManArr)
            WHERE product.Is_Deleted = 0;";
        } else {
            $sql = "SELECT * FROM product INNER JOIN manufacturer ON product.ManufacturerID = manufacturer.ManufacturerID AND manufacturer.ManufacturerID IN ($newManArr) INNER JOIN category ON product.CategoryID = category.CategoryID AND category.CategoryID IN ($newCatArr) WHERE product.Is_Deleted = 0 AND product.Price BETWEEN $sortMin AND $sortMax;";
        }
    } else if ($search) {
        $sql = "SELECT * FROM product INNER JOIN manufacturer ON product.ManufacturerID = manufacturer.ManufacturerID
        WHERE product.BrandName LIKE '%$search%' || product.Price LIKE '%$search%' || product.DosageStrength LIKE '%$search%'  
        || manufacturer.ManufacturerName LIKE '%$search%'";
    } else {
        $sql = "SELECT * FROM product INNER JOIN manufacturer ON product.ManufacturerID = manufacturer.ManufacturerID;";;
    } */
    $sql = "SELECT * FROM `product` INNER JOIN supplier ON product.SupplierID = supplier.SupplierID;";
    $result = $con->query($sql) or die(mysql_error());

    while ($row = $result->fetch_assoc()) { ?>
        <div class="card card-product rounded-3 mb-3" style="width: 14.85em;">
            <img class="img-fluid card-img-top w-100 d-block d-inline-block mx-auto" src="assets/img/product-img/<?php echo $row['ProductID']; ?>.png">
            <div class="card-body">
                <hr>
                <a class="card-link product-link" href="<?php
                                                        $url = '';
                                                        if ($_SESSION['username'] == 'admin') {
                                                            $url = 'edit-product.php';
                                                        } else {
                                                            $url = 'product.php';
                                                        }
                                                        echo $url . '?title=' . $row['ProductID'];
                                                        ?>">
                    <?php echo $row['ProductName'] ?></a>
                <p class="product-brand"><?php echo $row['SupplierName'] ?></p>
                <p class="sale-price"><?php echo $row['Stocks'] ?> items left</p>
                <?php
                if ($_SESSION['username'] == 'admin') { ?>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-primary btn-view rounded-pill ms-1 me-1" href="<?php echo 'edit-product.php' . '?title=' . $row['ProductID']  ?>">VIEW</a>
                    </div>
                <?php } else { ?>
                    <form action="cart.php?user_id=<?php echo $user_ID ?>" method="post">
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-primary btn-buy rounded-pill" type="submit">BUY</button>
                            <button class="btn btn-primary btn-add rounded-pill" id="addcounter" type="button" onClick="addCounter(<?php echo $row['ProductID'] ?>)">ADD</button>
                            <div id="counter" class="d-none align-items-center">
                                <a class="quantity-minus" href="#">
                                    <span>-</span>
                                </a>
                                <input type="number" class="quantity-input" name="quantity" value="1">
                                <a class="quantity-plus" href="#">
                                    <span>+</span>
                                </a>
                            </div>
                            <input type="hidden" name="product_id" value="<?php echo $row['ProductID'] ?>">
                        </div>
                    </form>
                <?php }
                ?>
            </div>
        </div>
<?php }
}

?>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function addCounter(productID) {
        const prodID = productID - 1;

        const addcounter = document.querySelectorAll('#addcounter');
        const counter = document.querySelectorAll('#counter');
        const minus = document.querySelectorAll('.quantity-minus');
        const plus = document.querySelectorAll('.quantity-plus');
        const input = document.querySelectorAll('.quantity-input');


        minus[prodID].addEventListener('click', (e) => {
            e.preventDefault();
            var value = input[prodID].value;
            if (value > 1) {
                value--;
            }
            input[prodID].value = value;
        });

        plus[prodID].addEventListener('click', (e) => {
            e.preventDefault();
            var value = input[prodID].value;
            value++;
            input[prodID].value = value;
        });
        addcounter[prodID].style.display = "none";
        counter[prodID].classList.remove('d-none');
        counter[prodID].style.display = "flex";
        return input[prodID].value;
    }
</script>