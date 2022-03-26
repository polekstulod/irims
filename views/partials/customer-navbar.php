<div>
    <nav class="navbar navbar-light navbar-expand-lg navigation-clean-search">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" href="customer-products.php">
                <h2 class="text-center rxpress-color fw-bold">IRIMS</h2>
            </a>
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
            <?php
            $username = $_SESSION['username'];
            $sql = "SELECT UserID FROM user WHERE Username = '$username'";
            $userID = mysqli_query($con, $sql) or die(mysql_error());
            while ($row = mysqli_fetch_row($userID)) {
                $user_ID = $row[0];
            }
            ?>
        </div>
    </nav>
</div>