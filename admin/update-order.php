<!-- pageToUpdateFoodOrdersPlacedThroughClientSide -->
<!-- redirectedFromManageOrderPage -->

<?php include 'partials/menu.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Food Order</title>
    <link rel="stylesheet" href="../css/admin.css" />
  </head>
  <body>
<div class="main-content">
    <div class="wrapper">
        <h3>Update Food Order</h3>
        <br><br>
        <!-- check?ID=Set?/Not? -->
        <?php if (isset($_GET['id'])) {
            // getOrderDetails
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_order WHERE id=$id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if ($count == 1) {
                // fetchingDetails
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
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Dish Name : </td>
                    <td><b><?php echo $food; ?></b></td>
                </tr>
                <tr>
                    <td>Quantity : </td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"></td>
                </tr>
                <tr>
                    <td>Price : </td>
                    <td>₹ <?php echo $price; ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><select name="status" id="">
                        <option <?php if ($status == 'order-placed') {
                            echo 'selected';
                        } ?>value="order-placed">order-placed</option>
                        <option <?php if ($status == 'on-the-way') {
                            echo 'on-the-way';
                        } ?>value="on-the-way">on-the-way</option>
                        <option <?php if ($status == 'delivered') {
                            echo 'delivered';
                        } ?>value="delivered">delivered</option>
                        <option <?php if ($status == 'cancelled') {
                            echo 'cancelled';
                        } ?>value="cancelled">cancelled</option>
                    </select></td>
                </tr>
                <tr>
                    <td>Customer Name : </td>
                    <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Contact : </td>
                    <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Email : </td>
                    <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>
                </tr>
                <tr>
                    <td>Customer Address : </td>
                    <td><textarea name="customer_address" rows="5" cols="30"><?php echo $customer_address; ?></textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update Order" class="btn-table">
                    </td>
                </tr>
            </table>
        </form>
        <!-- check?UpdateButtonClicked? -->
        <?php if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
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
                $_SESSION['update-order'] = 'Order updated successfully !';
                header('location:' . HOMEURL . 'admin/manage-orders.php');
            } else {
                $_SESSION['update-food'] = 'Order updation failed !';
                header('location:' . HOMEURL . 'admin/manage-orders.php');
            }
        } ?>
    </div>
</div>
</body>
</html>
