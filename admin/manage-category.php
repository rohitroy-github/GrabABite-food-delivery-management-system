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

    <?php include 'partials/menu.php'; ?>

    <!-- Main Content Section-->

    <div class="main-content">
      <div class="wrapper">
        <h2 style="text-align: center">Manage Categories</h2>

        <br />

        <!-- Button to add new categoty -->

        <a href="#" class="btn-new-admin">Add New Category</a>

        <br /><br />

        <table class="tbl-full">

          <tr>
            <th>Serial Number</th>
            <th>Fullname</th>
            <th>Username</th>
            <th>Actions</th>
          </tr>

          <tr>
            <td>1.</td>
            <td>Rohit Roy</td>
            <td>rohitroy</td>
            <td>
              <a href="#" class="btn-table">Update Admin</a>
              <a href="#" class="btn-table">Delete Admin</a>
            </td>
          </tr>

          <tr>
            <td>1.</td>
            <td>Rohit Roy</td>
            <td>rohitroy</td>
            <td>
              <a href="#" class="btn-table">Update Admin</a>
              <a href="#" class="btn-table">Delete Admin</a>
            </td>
          </tr>

          <tr>
            <td>1.</td>
            <td>Rohit Roy</td>
            <td>rohitroy</td>
            <td>
              <a href="#" class="btn-table">Update Admin</a>
              <a href="#" class="btn-table">Delete Admin</a>
            </td>
          </tr>

        </table>
      </div>
    </div>

    <!-- Footer Section -->

    <?php include 'partials/footer.php'; ?>
  </body>
</html>
