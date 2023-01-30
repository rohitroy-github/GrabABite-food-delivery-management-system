<!-- DisplayingFoodsForAParticularCategory -->

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

    <!-- checkIfIdPassed? -->
    <?php if (isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];
        // getTheCategoryTitleBasedOnCategoryID
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
        // executeQuery
        $res = mysqli_query($conn, $sql);
        // getTheValues
        $row = mysqli_fetch_assoc($res);
        // getTheTitle
        $category_title = $row['title'];
    } else {
        header('location:' . HOMEURL);
    } ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <h2>Foods in category : <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- FoodMenuSectionStarts -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Category Menu</h2>

            <?php
            // queryToGetFoodBasedOnSearch
            // searchingFromTitleOrDescription
            $sql2 = "SELECT * FROM tbl_food WHERE category_id=$category_id";

            // executeTheQuery
            $res2 = mysqli_query($conn, $sql2);

            $count = mysqli_num_rows($res2);

            // checkIfFoodAvailable
            if ($count > 0) {
                // foodAvailable
                while ($row = mysqli_fetch_assoc($res2)) {

                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
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
                echo "
                <div class = 'error-message'>
                Searched category isn't having any listed food items at the moment !
                </div>";
            }
            ?>
            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- FoodMenuSectionEnds -->

    <!-- footer -->
    <?php include './front-end-partials/footer.php'; ?>

</body>
</html>
