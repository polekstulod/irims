<?php
require('config.php');
include("session.php");
include("functions.php");
?>

<?php include_once "views/partials/header.html"; ?>

<body>
    <section class="bg-theme">
        <?php include_once "views/partials/admin-navbar.php"; ?>
        <?php include_once "views/partials/menu.html"; ?>
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><span>Home</span></a></li>
                <li class="breadcrumb-item"><a href="#"><span>Over The Counter Medicine</span></a></li>
                <li class="breadcrumb-item"><a href="#"><span>Supplements</span></a></li>
                <li class="breadcrumb-item"><a href="#"><span>Electrolyte Supplements</span></a></li>
                <li class="breadcrumb-item"><a href="#"><span>Rhea Sodium Chloride</span></a></li>
            </ol>
            <div class="d-flex justify-content-between mt-3">
                <?php productInfo($con) ?>
            </div>
        </div>
    </section>

    <?php include_once "views/partials/footer.html"; ?>