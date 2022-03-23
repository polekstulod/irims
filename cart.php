<?php
require('config.php');
include("session.php");
?>

<?php include_once "views/partials/header.html"; ?>

<body>
    <?php
    $userID = $_GET['user_id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $productID = $_POST['product_id'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        $total = $price * $quantity;

        $sql = "UPDATE cart SET CartID = '$userID', Total = '$total' WHERE CartCustomer = '$userID';";
        $result = mysqli_query($con, $sql) or die(mysql_error());

        $sql = "UPDATE cart_details SET CartProductID = '$productID', Quantity = '$quantity', Subtotal = '$total' WHERE CartID = '$userID';";
        $result = mysqli_query($con, $sql) or die(mysql_error());
    }
    ?>
    <section class="bg-theme">
        <?php include_once "views/partials/customer-navbar.php"; ?>
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="col-md-8">
                    <form action="checkout-order.php" class="checkout-order-form" method="POST">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <h4 class="fw-bold mt-2 mb-0">MY CART</h4>
                            </li>
                            <?php
                            $userID = $_GET['user_id'];
                            $sql = "SELECT * FROM cart WHERE CartCustomer = $userID;";
                            $result = $con->query($sql) or die(mysql_error());
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <li class="list-group-item">
                                    <?php
                                    $cartID = $row['CartID'];
                                    $sql2 = "SELECT * FROM cart_details WHERE CartID = $cartID;";
                                    $result2 = $con->query($sql2) or die(mysql_error());
                                    while ($row2 = $result2->fetch_assoc()) {
                                    ?>
                                        <div class="d-flex justify-content-between">
                                            <input type="hidden" name="cartID" value=<?php echo $cartID ?>>
                                            <?php
                                            $productID = $row2['CartProductID'];
                                            $sql3 = "SELECT * FROM product WHERE ProductID = $productID;";
                                            $result3 = $con->query($sql3) or die(mysql_error());
                                            while ($row3 = $result3->fetch_assoc()) {
                                            ?>
                                                <div class="col-md-2 d-flex justify-content-center align-items-md-center">
                                                    <img class="img-fluid medicine-img" src="assets/img/product-img/<?php echo $row3['ProductID']; ?>.jpeg">
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="mt-3">
                                                        <p class="mb-0 fw-bold medicine-name"><?php echo $row3['BrandName'] . ' ' . $row3['DosageStrength'] ?>
                                                        </p>
                                                        <p class="mb-0 medicine-form">Medicine Form :&nbsp;
                                                            <span class="fw-bold"><?php echo $row3['DosageForm']; ?></span>
                                                        </p>
                                                        <p class="availability">
                                                            <?php
                                                            if ($row3['in_stock'] == 1) {
                                                                echo "In Stock";
                                                            } else {
                                                                echo "Out of Stock";
                                                            }
                                                            ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            <div class="col-md-3">
                                                <div class="mt-3 text-end">
                                                    <p class="fw-bold"><?php echo $row2['Subtotal'] ?></p>
                                                    <div class="justify-content-end quantity">
                                                        <i class="fa fa-trash me-3"></i>
                                                        <a class="quantity-minus" href="#">
                                                            <span>-</span>
                                                        </a>
                                                        <input type="text" class="quantity-input" name="quantity" value="<?php echo $row2['Quantity'] ?>">
                                                        <a class="quantity-plus" href="#">
                                                            <span>+</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </li>
                        </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-group ms-5">
                        <li class="list-group-item">
                            <h5 class="fw-bold mt-2">Summary</h5>
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Product Total:</p>
                                <p class="mt-1 mb-0"><?php echo $row['Total'] ?></p>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <p class="mb-0">Total:</p>
                                <p class="mt-1 mb-0"><?php echo $row['Total'] ?></p>
                            </div>
                        </li>
                    </ul>
                <?php
                            }
                ?>
                <div class="row">
                    <div class="col-md-11">
                        <button class="d-flex justify-content-center btn checkout-btn mt-4 ms-5" href="checkout-order.php" type="submit" name="checkout">Continue Checkout</button>
                    </div>
                </div>
                </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        // const url = new URL(window.location.href);
        // product_id = url.searchParams.get("product_id");
        // let quantity = localStorage.getItem("quantity");

        // let counter = document.querySelectorAll('.quantity-input');
        // counter[0].setAttribute("value",quantity);
        //     console.log(product_id)
        //     console.log(quantity)
    </script>