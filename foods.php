<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>

    <!-- navbarPortion -->
<?php include './front-end-partials/menu.php'; ?>

    <!-- FoodSearchBarSectionStarts -->
    <section class="food-search text-center">
        <div class="container">

            <form action="<?php echo HOMEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- FoodSearchBarSectionEnds -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
    <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            // gettingFoodMenuFromDatabase
            // condition?Only3&Featured=Yes&Active=Yes
            $sql_food =
                'SELECT * FROM tbl_food WHERE active="Yes" AND featured="Yes" LIMIT 6';
            $res_food = mysqli_query($conn, $sql_food);
            $count_food = mysqli_num_rows($res_food);

            if ($count_food > 0) {
                // foodAvailable
                while ($rows = mysqli_fetch_assoc($res_food)) {

                    // gettingTheValuesFromDatabase
                    $title = $rows['title'];
                    $id = $rows['id'];
                    $price = $rows['price'];
                    $description = $rows['description'];
                    $image_name = $rows['image_name'];
                    ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <!-- checkWhetherImageAvailableOrNot? -->
                        <?php if ($image_name == '') {
                            // imageNotAvailable
                            $_SESSION['no-food-image-available'] =
                                'Image Unvailable !';
                            header('location:' . HOMEURL);
                        }
                        // imageAvailable
                        else {
                             ?>
                            <img src="<?php echo HOMEURL; ?>images/food/<?php echo $image_name; ?>" class="img-responsive img-curve" />
                            <?php
                        } ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price"><?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>
                        <a href="order.html" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
                    <?php
                }
            } else {
                // foodUnavailable
                $_SESSION['no-food-available'] = 'No Food Available !';
                header('location:' . HOMEURL);
            }
            ?>
            <div class="clearfix"></div>
    </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <!-- footer -->
    <?php include './front-end-partials/footer.php'; ?>

</body>
</html>
