<!-- FoodOrderComponent -->
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

    <!-- checkForFoodID -->
    <?php if (isset($_GET['food_id'])) {
        // getFoodID&Details
        $food_id = $_GET['food_id'];
        // getEverythingBasedOnID
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        // executeQuery
        $res = mysqli_query($conn, $sql);
        // getTheValues
        $count = mysqli_num_rows($res);
        // checkDataAvailability
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            // getTheDetailsFromDatabase
            // $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            // $description = $row['description'];
            $image_name = $row['image_name'];
        } else {
            // getBackToHomePage
            header('location:' . HOMEURL);
        }
    } else {
        // getBackToHomePage
        header('location:' . HOMEURL);
    } ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-menu ">
        <div class="container foodOrderSection">
            <!-- formSection -->
            <div class="orderContainer">
                    <h3 class="text-left">Please fill up delivery details.</h3>
                    <form action="" method="POST" class="order">

                            <!-- <div class="food-menu-desc"> -->
                            <!-- <legend>Food Item</legend> -->
                                <h3 class="primary-color">Dish : <?php echo $title; ?></h3>
                                <input type="hidden" name="food" value="<?php echo $title; ?>"/>
                                <p class="food-price">Price : ₹ <?php echo $price; ?></p>
                                <div class="order-label">Quantity</div>
                                <input type="number" name="qty" class="input-responsive" value="1" required>
                            <!-- </div> -->
                        <!-- <fieldset> -->
                            <!-- <legend>Delivery Details :</legend> -->
                            <div class="order-label">Full Name</div>
                            <input type="text" name="full-name" placeholder="E.g. Vijay Thapa" class="input-responsive" required>

                            <div class="order-label">Phone Number</div>
                            <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                            <div class="order-label">Email</div>
                            <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                            <div class="order-label">Address</div>
                            <textarea name="address" rows="5" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                            <input type="submit" name="submit" value="CONFIRM ORDER" class="btn btn-primary">
                        <!-- </fieldset> -->

                                <!-- checkWhetherSubmitButtonIsClicked? -->
                <?php if (isset($_POST['submit'])) {
                    // fetchAllData
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];
                    $total = $price * $qty;
                    $order_date = date('Y-m-d h:i:sa');
                    $status = 'order-placed';
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_email = $_POST['email'];
                    $customer_address = $_POST['address'];
                    // saveTheOrderInDB
                    $sql_order = "INSERT INTO tbl_order SET 
                        food = '$food', 
                        price = '$price', 
                        qty = '$qty', 
                        total = '$total', 
                        order_date = '$order_date', 
                        status = '$status',
                        customer_name = '$customer_name', 
                        customer_contact = '$customer_contact',  
                        customer_email = '$customer_email', 
                        customer_address = '$customer_address'";
                    // execute
                    $res_order = mysqli_query($conn, $sql_order);
                    // checkForQuerySuccess
                    if ($res_order == true) {
                        $_SESSION['order-placed'] =
                            "<div class='success-message'>Food order placed successfully !</div>";
                        header('location:' . HOMEURL);
                    } else {
                        // failedToSaveOrder
                        $_SESSION['order-not-placed'] =
                            "<div class='error-message'>Failed to place your order !</div>";
                        header('location:' . HOMEURL);
                    }
                } ?>
                    </form>
                </div>

                <div class="foorOrderSeparatorSection"></div>

            <!-- summarySection -->
            <div class="orderSummarySection">
                <h3 class="text-left">Order Summary</h3>
                <form class="order">
                        <div class="food-menu-desc">
                            <div class="order-label">Selected Dish : <?php echo $title; ?></div>
                            <div class="order-label">Order Total : <?php echo $price; ?></div>
                            <!-- <div class="order-label">Quantity</div> -->
                            <!-- <p class="food-price"><?php echo $qty; ?></p> -->
                        </div>
                        <div class="orderSummaryFoodPicture">
                            <!-- checkWhetherImageAvailableOrNot? -->
                            <?php if ($image_name == '') {
                                // imageNotAvailable
                                // $_SESSION['no-food-image-available'] =
                                //     'Image Unvailable !';
                                // header('location:' . HOMEURL);
                                echo "<div class='error-message'>Image not available at the moment !</div>";
                            }
                            // imageAvailable
                            else {
                                 ?>
                                <img src="<?php echo HOMEURL; ?>images/food/<?php echo $image_name; ?>" alt="food-image" class="img-responsive img-circle">
                                <?php
                            } ?>
                        </div>
                </form>
            </div>
        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <!-- footer -->
    <?php include './front-end-partials/footer.php'; ?>
</body>
</html>
