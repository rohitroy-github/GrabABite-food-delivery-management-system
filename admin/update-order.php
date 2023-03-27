<?php
include '../config/constants.php';
include './partials/login-check.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/admin.css" />
    <title>Update Order</title>
</head>

<body>
    <div class="container">
        <div class="col-md-6 col-lg-6">
            <?php if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_email = $row['customer_email'];
                    $customer_contact = $row['customer_contact'];
                    $customer_address = $row['customer_address'];
                } else {
                    // redirectToManageOrder
                    header('location:' . HOMEURL . 'admin/manage-orders.php');
                }
            } else {
                // redirectToManageOrder
                header('location:' . HOMEURL . 'admin/manage-orders.php');
            } ?>
            <form class="login-form" action="" method="POST">
                <h2 class="text-center">Update Order</h2>
                <br />
                <div class="form-group">
                    <label for="username">Customer's Name</label>
                    <input name="customer_name" type="text" class="form-control" id="customer_name"
                        placeholder="Updated customer name ?" value="<?php echo $customer_name; ?>" />
                </div>
                <div class="form-group">
                    <label for="username">Customer's Contact</label>
                    <input name="customer_contact" type="text" class="form-control" id="customer_contact"
                        placeholder="Updated customer contact ?" value="<?php echo $customer_contact; ?>" />
                </div>
                <div class="form-group">
                    <label for="customer_email">Customer's Email</label>
                    <input name="customer_email" type="text" class="form-control" id="customer_email"
                        placeholder="Updated customer email ?" value="<?php echo $customer_email; ?>" />
                </div>
                <div class="form-group">
                    <label for="customer_address">Customer's Address</label>
                    <textarea name="customer_address" type="text" class="form-control" id="customer_address"
                        placeholder="Updated customer address ?" rows="3"><?php echo $customer_address; ?></textarea>
                </div>
                <div class=" form-group">
                    <label for="username">Item Quantity</label>
                    <input name="qty" type="number" class="form-control" id="qty" placeholder="Updated quantity ?"
                        value="<?php echo $qty; ?>" />
                </div>
                <div class="form-group">
                    <label for="status">Current Order Status</label>
                    <select name="status" id="status">
                        <option <?php if ($status == 'order-placed') {
                            echo 'selected';
                        } ?>
                            value="order-placed">order-placed</option>
                        <option <?php if ($status == 'on-the-way') {
                            echo 'selected';
                        } ?>
                            value="on-the-way">on-the-way</option>
                        <option <?php if ($status == 'delivered') {
                            echo 'selected';
                        } ?>value="delivered">delivered
                        </option>
                        <option <?php if ($status == 'cancelled') {
                            echo 'selected';
                        } ?>value="cancelled">cancelled
                        </option>
                    </select>
                </div>

                <button name="submit" type="submit" class="btn btn-primaryColor" value="update-admin">
                    Update Order
                </button>

                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="hidden" name="price" value="<?php echo $price; ?>">
            </form>
            <?php if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = intval($price) * intval($qty);
                $status = $_POST['status'];
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                $sql_updated_order = "UPDATE tbl_order SET
                qty='$qty',
                total='$total',
                status='$status',
                customer_name='$customer_name',
                customer_contact='$customer_contact',
                customer_email='$customer_email',
                customer_address='$customer_address' WHERE id=$id";

                $res_updated_order = mysqli_query($conn, $sql_updated_order);

                if ($res_updated_order == true) {
                    $_SESSION['update-order'] =
                        '<p class="text-center">Order successfully updated !</p>';

                    header('location:' . HOMEURL . 'admin/manage-orders.php');
                } else {
                    $_SESSION['update-food'] =
                        '<p class="text-center">Failed to update selected order !</p>';

                    header('location:' . HOMEURL . 'admin/manage-orders.php');
                }
            } ?>
        </div>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

</html>