<div>
    <nav class="navbar navbar-light navbar-expand-lg navigation-clean-search">
        <div class="container d-flex justify-content-between">
            <a class="navbar-brand" href="customer-products.php">
                <img class="img-fluid" src="assets/img/IRIMS.png" width="90" height="90">
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
            <a href="cart.php?user_id=<?php echo $user_ID ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-bag-fill icon-color">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z"></path>
                </svg>
            </a>
        </div>
    </nav>
</div>