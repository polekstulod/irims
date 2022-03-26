<?php
require('config.php');
include("session.php");
?>

<?php include_once "views/partials/header.html"; ?>


<body>
    <section class="bg-theme">
        <?php include_once "views/partials/admin-navbar.php"; ?>
        <div class="container">
            <?php /*
            $search = $_GET['search-order'] ?? '';

            if ($search) {
                $sql = "SELECT * FROM orderdetails WHERE OrderID LIKE '%$search%' || OrderDate LIKE '%$search%' || Username LIKE '%$search%' || Total LIKE '%$search%'";
            } else {
                $sql = "SELECT * FROM orderdetails";
            }
            $orders = $con->query($sql) or die($con->error);
            $row = $orders->fetch_assoc(); */
            ?>
            <!-- <div class="d-flex justify-content-between search-orders border mt-2 mb-5">
                <form class="d-inline-flex">
                    <input class="ms-2" type="search" placeholder="Search..." name="search-order" id="search-order" value="<?php //echo $search 
                                                                                                                            ?>">
                    <label class="form-label d-flex ms-4 mb-0" for="search-order">
                        <button class="btn btn-primary btn-search-prod rounded-pill" id="search-icon" type="submit" onclick="searchDropDown()">
                            <i class="fa fa-search icon-color"></i>
                        </button>
                    </label>
                </form>
            </div> -->

            <h4>Requests</h4>
            <div class="table-responsive">
                <table class="table orders-table mb-5">
                    <thead class="orders-header">
                        <tr>
                            <th class="text-center">Request ID</th>
                            <th class="text-center">Request Date</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Department</th>
                            <th class="text-center">Product Name</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT request.RequestID, request.RequestDateTime, CONCAT(user.FirstName, ' ', user.LastName) as Name, department.DepartmentName, product.ProductName, request.Quantity, category.CategoryName, request.Status FROM `request` INNER JOIN `user` ON request.UserID = user.UserID INNER JOIN `product` ON request.ProductID = product.ProductID INNER JOIN `department` ON user.DepartmentID = department.DepartmentID INNER JOIN `category` ON product.CategoryID = category.CategoryID; ";
                        $orders = $con->query($sql) or die($con->error);
                        do { ?>
                            <tr>
                                <td class="text-center"><?php echo $row['RequestID'] ?></td>
                                <td class="text-center"><?php echo $row['RequestDateTime'] ?></td>
                                <td class="text-center"><?php echo $row['Name'] ?></td>
                                <td class="text-center"><?php echo $row['DepartmentName'] ?></td>
                                <td class="text-center"><?php echo $row['ProductName'] ?></td>
                                <td class="text-center"><?php echo $row['Quantity'] ?></td>
                                <td class="text-center"><?php echo $row['CategoryName'] ?></td>
                                <td class="text-end"><?php echo $row['Status'] ?></td>
                            </tr>

                        <?php  } while ($row = $orders->fetch_assoc());
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- <script>
        function searchDropDown() {
            const btn = document.querySelector('#search-icon');

            btn.addEventListener('click', (e) => {
                e.preventDefault();
                let category = document.querySelector('#filter-orders').value;
                if (category == 'order-id') {
                    <?php
                    /* $sql = "SELECT * FROM orderdetails WHERE OrderID = '$search'";
                    echo $sql; */
                    ?>
                } else if (category == 'username') {
                    <?php
                    /* $sql = "SELECT * FROM orderdetails WHERE Username = '$search'";
                    echo $sql; */
                    ?>
                } else {
                    <?php
                    /* $sql = "SELECT * FROM orderdetails WHERE Total = '$search'";
                    echo $sql; */
                    ?>
                }
            })

        }
    </script> -->

    <?php include_once "views/partials/footer.html"; ?>