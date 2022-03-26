<?php
require('config.php');
?>

<div class="col-md-3">
    <div class="card me-2 rounded-3">
        <div class="card-body">
            <form method="get">
                <h6 class="card-subtitle mt-2 sort-color">Sort by Categories</h6>
                <div class="filter-border">
                    <?php
                    $sql = "SELECT * FROM category";
                    $result = $con->query($sql) or die(mysql_error());

                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="form-check"><input class="form-check-input" type="radio" name="category" id="category-<?php echo $row['CategoryID'] ?>" value="<?php echo $row['CategoryID'] ?>">
                            <label class="form-check-label" for="category-<?php echo $row['CategoryID'] ?>"><?php echo $row['CategoryName'] ?>
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