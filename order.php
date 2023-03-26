<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/checkout.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
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
            $description = $row['description'];
            $image_name = $row['image_name'];
        }
    } else {
        // getBackToHomePage
        header('location:' . HOMEURL);
    } ?>
    <div class="container">
        <h2 class=" text-center">Checkout</h2>
        <div class="mainContainer">
            <div class="row">
                <div class="col-md-8 submitDetailsContainer">
                    <form class="form-container" action="" method="POST">
                        <div class="form-group">
                            <h4 class=" text-left">Please fill out delivery details !</h4>
                        </div>
                        <div class="form-group">
                            <label for="customer-name">Name</label>
                            <input type="text" class="form-control" id="customer-name" name="full-name"
                                placeholder="Enter your full name ?" required>
                        </div>
                        <div class="form-group">
                            <label for="customer-address">Address</label>
                            <textarea class="form-control" id="customer-address" name="address"
                                placeholder="Enter your address ?" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="customer-contact-number">Contact Number</label>
                            <input type="tel" class="form-control" id="customer-contact-number" name="contact"
                                placeholder="Enter your contact number ?" required>
                        </div>
                        <div class="form-group">
                            <label for="customer-email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter your email ?" required>
                        </div>
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" class="form-control" id="customer-email" name="qty"
                                placeholder="Enter number of plates ?" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn adminPanelBtn" name="submit">Submit</button>
                        </div>

                        <input type="hidden" name="price">
                        <input type="hidden" name="title">
                        <!-- POSTCode -->
                        <?php if (isset($_POST['submit'])) {
                            $_POST['price'] = $price;
                            $_POST['title'] = $title;
                            // fetchAllData
                            $food = $_POST['title'];
                            $price = $_POST['price'];
                            $qty = $_POST['qty'];
                            $total = intval($price) * intval($qty);
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
                                // header('location:' . HOMEURL);
                            } else {
                                // failedToSaveOrder
                                $_SESSION['order-not-placed'] =
                                    "<div class='error-message'>Failed to place your order !</div>";
                                // header('location:' . HOMEURL);
                            }
                        } ?>
                    </form>
                </div>
                <div class="col-md-4 summaryContainer">
                    <div class="row">
                        <form class="form-container">
                            <div class="form-group">
                                <h4 class=" text-left">Order summary !</h4>
                            </div>
                            <div class="form-group">
                                <?php if ($image_name == '') { ?>
                                <h6 class="text-center">Image not found !</h6>
                                <?php } else { ?>
                                <img src="<?php echo HOMEURL; ?>images/food/<?php echo $image_name; ?>"
                                    class="img-fluid" alt="Food Image">
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <p>Item :
                                    <?php echo $title; ?>
                                </p>
                            </div>
                            <div class="form-group">
                                <p>
                                    <?php echo $description; ?>
                                </p>
                            </div>
                            <div class="form-group">
                                <p>Price :
                                    <?php echo $price; ?>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footerPortion -->
    <?php include './front-end-partials/footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>