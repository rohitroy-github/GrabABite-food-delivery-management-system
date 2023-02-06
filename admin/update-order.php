<!-- pageToUpdateFoodOrdersPlacedThroughClientSide -->
<!-- redirectedFromManageOrderPage -->

<?php include 'partials/menu.php'; ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Food Orders</title>
    <link rel="stylesheet" href="../css/admin.css" />
  </head>
  <body>
<div class="main-content">
    <div class="wrapper">
        <h3>Update Food Order</h3>
        <br><br>
        <!-- check?ID=Set?/Not? -->
        <?php if (isset($GET['id'])) {
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
                header('location:' . HOMEURL . 'admin/manage-order.php');
            }
        } else {
            // redirectToManageOrder
            header('location:' . HOMEURL . 'admin/manage-order.php');
        } ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Dish Name : </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Quantity : </td>
                    <td><input type="number" name="qty" value=""></td>
                </tr>
                <tr>
                    <td>Price : </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><select name="status" id="">
                        <option value="order-placed">order-placed</option>
                        <option value="on-the-way">on-the-way</option>
                        <option value="delivered">delivered</option>
                        <option value="cancelled">cancelled</option>
                    </select></td>
                </tr>
                <tr>
                    <td>Customer Name : </td>
                    <td><input type="text" name="customer_name" value=""></td>
                </tr>
                <tr>
                    <td>Customer Contact : </td>
                    <td><input type="text" name="customer_contact" value=""></td>
                </tr>
                <tr>
                    <td>Customer Email : </td>
                    <td><input type="text" name="customer_email" value=""></td>
                </tr>
                <tr>
                    <td>Customer Address : </td>
                    <td><textarea name="customer_address" rows="5" cols="30">

                    </textarea></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
</body>
</html>
