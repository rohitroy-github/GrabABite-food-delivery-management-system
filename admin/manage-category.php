<!-- Manage Category Panel  -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="../css/admin.css" />

    <!-- Add Bootstrap Code -->

    <title>Food Ordering App - Home Page</title>
  </head>
  <body>
    <!-- Menu Section -->

    <?php include 'partials/menu.php';?>

    <!-- Main Content Section-->

    <div class="main-content">
      <div class="wrapper">
        <h2 style="text-align: center">Manage Categories</h2>

        <br />

        <!-- Button to add new Category -->

        <a href="add-category.php" class="btn-new-admin">Add New Category</a>

        <br /><br /><br />

        <!-- Printing success message -->
        <?php

if (isset($_SESSION['add-category'])) {
    echo $_SESSION['add-category'];
    // Ending session
    unset($_SESSION['add-category']);
}

?>

        <br />

        <table class="tbl-full">

          <tr>
            <th>Serial Number</th>
            <th>Title</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Actions</th>
          </tr>

          <?php
$sql = "SELECT * FROM tbl_category";

$res = mysqli_query($conn, $sql);

if ($res == true) {

    // Count rows for checking data availibility
    $count = mysqli_num_rows($res);

    $sn = 1;

    if ($count > 0) {
        while ($rows = mysqli_fetch_assoc($res)) {
            //Run as long as data is available
            $id = $rows['id'];
            $title = $rows['title'];
            $image_name = $rows['image_name'];
            $featured = $rows['featured'];
            $active = $rows['active'];
        }
        ?>

          <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $title; ?></td>
            <td>
              <?php
// Check if image name is available ?

        if ($image_name != "") {
            ?>
                <img src="<?php echo HOMEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
                <?php
} else {
            echo "<div class='message'>No Categories Found !</div>";
        }
        ?>
            </td>
            <td><?php echo $featured; ?></td>
            <td><?php echo $active; ?></td>
            <td>
              <a
                href="<?php echo HOMEURL; ?>admin/update-category.php?id=<?php echo $id; ?>"
                class="btn-table"
                >Update Category</a
              >

              <a
                href="<?php echo HOMEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>"
                class="btn-table"
                >Delete Category</a
              >
            </td>
            </tr>

          <?php

    } else {
        ?>
            <tr>
              <td colspan="6">
                <div class="message">No Categories Found !</div>
              </td>
            </tr>
            <?php
}
}
?>

        </table>
      </div>
    </div>

    <!-- Footer Section -->

    <?php include 'partials/footer.php';?>
  </body>
</html>