<?php
require('config.php');
?>

<div class="col-md-3">
    <div class="card me-2 rounded-3">
        <div class="card-body">
            <form method="get">
                <h6 class="card-subtitle mt-2 sort-color">Sort by Price</h6>
                <hr class="mt-2">
                <div class="col-md-12">
                    <div class="price-input">
                        <div class="field">
                            <span class="d-flex align-items-center me-5 justify-content-start">₱
                                <input name="sortMin" type="number" class="input-min border-0" value="0">
                            </span>
                        </div>
                        <div class="separator mb-2">-</div>
                        <div class="field">
                            <span class="d-flex align-items-center ms-5 justify-content-end">₱
                                <input name="sortMax" type="number" class="input-max border-0" value="10000">
                            </span>
                        </div>
                    </div>
                    <div class="slider">
                        <div class="progress"></div>
                    </div>
                    <div class="range-input">
                        <input type="range" class="range-min" min="0" max="10000" value="2500" step="100">
                        <input type="range" class="range-max" min="0" max="10000" value="7500" step="100">
                    </div>
                </div>
                <h6 class="card-subtitle mt-2 sort-color">Sort by Categories</h6>
                <div class="filter-border">
                    <?php
                    $sql = "SELECT * FROM category";
                    $result = $con->query($sql) or die(mysql_error());

                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="category[]" value="<?php echo $row['CategoryID'] ?>">
                            <label class="form-check-label" for="category-<?php echo $row['CategoryID'] ?>"><?php echo $row['CategoryName'] ?>
                            </label>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <h6 class="card-subtitle mt-2 sort-color">Sort by Manufacturer</h6>
                <div class="filter-border">
                    <?php
                    $sql = "SELECT * FROM manufacturer";
                    $result = $con->query($sql) or die(mysql_error());

                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="manufacturer[]" value="<?php echo $row['ManufacturerID'] ?>">
                            <label class="form-check-label" for="manufacturer-<?php echo $row['ManufacturerID'] ?>"><?php echo $row['ManufacturerName'] ?>
                            </label>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div class="m-3">
                    <button class="btn btn-primary product-btn-edit rounded-pill" type="submit">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>