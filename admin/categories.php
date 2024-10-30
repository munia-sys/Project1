<?php 
include('../connect.php');

// Redirect to login if user is not authenticated
if(!isset($_SESSION['uid'])){
  echo "<script> window.location.href='../login.php';  </script>";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>

<?php include('header.php'); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <form action="categories.php" method="post">
        <div class="form-group mb-4">
          <input type="text" class="form-control" name="catname" placeholder="Enter category">
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Add" name="add">
        </div>
      </form>
    </div>

    <div class="col-lg-6">
      <table class="table">
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Action</th>
        </tr>
<!-- display catagory -->
        <?php
        $sql = "SELECT * FROM `categories`";
        $res  = mysqli_query($con, $sql);
        if(mysqli_num_rows($res) > 0){
          while($data = mysqli_fetch_array($res)){
        ?>
        <tr>
          <td><?= $data['catid'] ?></td>
          <td><?= $data['catname'] ?></td>
          <td>
            <a href="categories.php?deleteid=<?= $data['catid'] ?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
        <?php
          }
        } else {
          echo '<tr><td colspan="3">No categories found</td></tr>';
        }
        ?>
      </table>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>

<?php
// Add category
if(isset($_POST['add'])){
  $name = $_POST['catname'];
  $sql = "INSERT INTO `categories` (`catname`) VALUES ('$name')";
  if(mysqli_query($con, $sql)){
    echo "<script> alert('Category added'); window.location.href='categories.php'; </script>";
  } else {
    echo "<script> alert('Category not added'); </script>";
  }
}

// Delete category
if(isset($_GET['deleteid'])){
  $deleteid = $_GET['deleteid'];
  $sql = "DELETE FROM `categories` WHERE catid='$deleteid'";
  if(mysqli_query($con, $sql)){
    echo "<script> alert('Category deleted'); window.location.href='categories.php'; </script>";
  } else {
    echo "<script> alert('Category not deleted'); </script>";
  }
}
?>
