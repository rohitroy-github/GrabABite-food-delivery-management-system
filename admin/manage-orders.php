<!-- Main CMS/ Admin file  -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/adminStyles.css">
    <title>Manage Orders</title>
</head>

<body>
    <!-- Menu Section -->
    <div class="top-container">
        <?php include './partials/menu.php'; ?>
    </div>

    <!-- mainContentSection -->
    <div class="main-container container">
        <div class="content">
            <h2 style="font-weight: 500; text-align: center;">
                <b>Manage Orders</b>
            </h2>

            <div>
              <?php if (isset($_SESSION['update-order'])) {
                  echo $_SESSION['update-order'];
                  // Ending session
                  unset($_SESSION['update-order']);
              } ?>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>
                                <h6><b>Serial</b></h6>
                            </th>
                            <th>
                                <h6><b>Food</b></h6>
                            </th>
                            <th>
                                <h6><b>Quantity</b></h6>
                            </th>
                            <!-- <th>
                                <h6><b>Price</b></h6>
                            </th> -->
                            <th>
                                <h6><b>Total</b></h6>
                            </th>
                            <th>
                                <h6><b>Date</b></h6>
                            </th>
                            <th>
                                <h6><b>Status</b></h6>
                            </th>
                            <th>
                                <h6><b>Customer</b></h6>
                            </th>
                            <th>
                                <h6><b>Contact</b></h6>
                            </th>
                            <th>
                                <h6><b>Email</b></h6>
                            </th>
                            <th>
                                <h6><b>Address</b></h6>
                            </th>
                            <th>
                                <h6><b>Actions</b></h6>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = 'SELECT * FROM tbl_order ORDER BY id DESC';

                        $res = mysqli_query($conn, $sql);

                        if ($res == true) {
                            // Count rows for checking data availibility
                            $count = mysqli_num_rows($res);

                            $sn = 1;

                            if ($count > 0) {
                                while ($rows = mysqli_fetch_assoc($res)) {

                                    //Run as long as data is available
                                    $id = $rows['id'];
                                    $food = $rows['food'];
                                    $price = $rows['price'];
                                    $qty = $rows['qty'];
                                    $total = $rows['total'];
                                    $order_date = $rows['order_date'];
                                    $status = $rows['status'];
                                    $customer_name = $rows['customer_name'];
                                    $customer_contact =
                                        $rows['customer_contact'];
                                    $customer_email = $rows['customer_email'];
                                    $customer_address =
                                        $rows['customer_address'];
                                    ?>
                        <tr>
                            <td>
                                <p>
                                    <?php echo $sn++; ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $food; ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $qty; ?>
                                </p>
                            </td>
                            <!-- <td>
                                <p>
                                <?php echo $price; ?>
                                </p>
                            </td> -->
                            <td>
                                <p>
                                    <?php echo $total; ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $order_date; ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $status; ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $customer_name; ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $customer_contact; ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $customer_email; ?>
                                </p>
                            </td>
                            <td>
                                <p>
                                    <?php echo $customer_address; ?>
                                </p>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="<?php echo HOMEURL; ?>admin/update-order.php?id=<?php echo $id; ?>"
                                        class="btn adminPanelBtn mr-2">
                                        Update Order
                                    </a>
                                    <!-- <a href="<?php echo HOMEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                                        class="btn adminPanelBtn mr-2">
                                        Remove Dish
                                    </a> -->
                                </div>
                            </td>
                        </tr>

                        <?php
                                }
                            } else {
                                 ?>
                        <tr>
                            <td>
                                <p>
                                    Currently there are no orders !
                                </p>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- footerSection -->
    <div class="bottom-container">
        <?php include 'partials/footer.php'; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>