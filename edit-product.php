<?php
require('config.php');
include("session.php");
include("functions.php");
?>

<?php include_once "views/partials/header.html"; ?>

<body>
    <section class="bg-theme">
        <?php include_once "views/partials/admin-navbar.php"; ?>
        <div class="container">
            <div class="d-flex justify-content-between mt-3">
                <?php productInfo($con) ?>
            </div>
        </div>
    </section>

    <?php include_once "views/partials/footer.html"; ?>