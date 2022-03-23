<?php
require('config.php');
include("session.php");
include("functions.php");
?>

<?php include_once "views/partials/header.html"; ?>

<body>
    <section class="bg-theme">
        <?php include_once "views/partials/customer-navbar.php"; ?>
        <?php include_once "views/partials/menu.html"; ?>
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#"><span>Home</span></a></li>
                <li class="breadcrumb-item"><a href="#"><span>All Products</span></a></li>
            </ol>

            <div class="d-flex justify-content-between">
                <?php include_once "views/partials/sort.php";
                $search = $_GET['search-product'] ?? '';
                ?>
                <div class="col-md-9">
                    <form class="d-lg-flex justify-content-lg-between search-form products-menu rounded">
                        <span class="d-flex align-items-center fw-bold ms-3">All Products</span>
                        <div class="d-flex align-items-center search-prod-bar border col-5 rounded-pill">
                            <input class="form-control" type="search" placeholder="Search..." name="search-product" id="search-product" value="<?php echo $search ?>">
                            <label class="form-label d-flex mb-0" for="search-product">
                                <button class="btn btn-primary btn-search-prod rounded-pill" type="submit">
                                    <i class="fa fa-search icon-color"></i>
                                </button>
                            </label>
                        </div>
                    </form>
                    <div class="d-flex flex-wrap card-products">
                        <?php
                        listProducts($con);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once "views/partials/footer.html"; ?>