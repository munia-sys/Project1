<?php 
include('../connect.php');

// Redirect to login if user is not authenticated
if(!isset($_SESSION['uid'])){
  echo "<script> window.location.href='../login.php'; </script>";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
</head>
<body>

<?php include('header.php'); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <form action="movies.php" method="post" enctype="multipart/form-data">
        <div class="form-group mb-4">
          <select name="catid" class="form-control">
            <option value="">Select Category</option>
            <?php
            // Fetch categories
            $sql = "SELECT * FROM `categories`";
            $res  = mysqli_query($con, $sql);
            if(mysqli_num_rows($res) > 0){
              while($data = mysqli_fetch_array($res)){
                echo "<option value='{$data['catid']}'>{$data['catname']}</option>";
              }
            } else {
              echo "<option value=''>No Category found</option>";
            }
            ?>
          </select>
        </div>

        <div class="form-group mb-4">
          <input type="text" class="form-control" name="title" placeholder="Enter title">
        </div>

        <div class="form-group mb-4">
          <input type="text" class="form-control" name="description" placeholder="Enter description">
        </div>

        <div class="form-group mb-4">
          <input type="date" class="form-control" name="releasedate">
        </div>

        <div class="form-group mb-4">
          Poster: <input type="file" class="form-control" name="image">
        </div>

        <div class="form-group mb-4">
          Trailer: <input type="file" class="form-control" name="trailer">
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
          <th>Category</th>
          <th>Poster</th>
          <th>Action</th>
        </tr>
        
        <?php
        // Fetch movies and their associated categories
        $sql = "SELECT movies.*, categories.catname FROM movies 
                INNER JOIN categories ON categories.catid = movies.catid";
        $res  = mysqli_query($con, $sql);
        if(mysqli_num_rows($res) > 0){
          while($data = mysqli_fetch_array($res)){
        ?>
        <tr>
          <td><?= $data['movieid'] ?></td>
          <td><?= $data['title'] ?></td>
          <td><?= $data['catname'] ?></td>
          <td><img src="uploads/<?= $data['image'] ?>" height="50" width="50" alt=""></td>
          <td>
            <a href="movies.php?deleteid=<?= $data['movieid'] ?>" class="btn btn-danger">Delete</a>
          </td>
        </tr>
        <?php
          }
        } else {
          echo '<tr><td colspan="5">No movies found</td></tr>';
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
// Add movie
if(isset($_POST['add'])){
  $catid = $_POST['catid'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $releasedate = $_POST['releasedate'];

  $image = $_FILES['image']['name'];
  $tmp_image = $_FILES['image']['tmp_name'];

  $trailer = $_FILES['trailer']['name'];
  $tmp_trailer = $_FILES['trailer']['tmp_name'];

  move_uploaded_file($tmp_image, "uploads/$image");
  move_uploaded_file($tmp_trailer, "uploads/$trailer");

  $sql = "INSERT INTO `movies`(`title`, `description`, `releasedate`, `image`, `trailer`, `catid`) 
          VALUES ('$title','$description','$releasedate','$image','$trailer','$catid')";

  if(mysqli_query($con, $sql)){
    echo "<script> alert('Movie added'); window.location.href='movies.php'; </script>";
  } else {
    echo "<script> alert('Movie not added'); </script>";
  }
}

// Delete movie
if(isset($_GET['deleteid'])){
  $deleteid = $_GET['deleteid'];
  $sql = "DELETE FROM `movies` WHERE movieid = '$deleteid'";
  if(mysqli_query($con, $sql)){
    echo "<script> alert('Movie deleted'); window.location.href='movies.php'; </script>";
  } else {
    echo "<script> alert('Movie not deleted'); </script>";
  }
}
?>
