<?php 
include('../connect.php');

if (!isset($_SESSION['uid'])) {
  echo "<script> window.location.href='../login.php'; </script>";
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theater</title>
</head>
<body>

<?php include('header.php'); ?>

<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <form action="theater.php" method="post" enctype="multipart/form-data">
        <div class="form-group mb-4">
          <label for="theater_name">Theater Name</label> 
          <input type="text" class="form-control" name="theater_name">
        </div>

        <div class="form-group mb-4">
          <select name="movieid" class="form-control">
            <option value="">Select Movie</option>
            <?php
            $sql = "SELECT * FROM `movies`"; // Fetching all movies
            $res = mysqli_query($con, $sql);
            if (mysqli_num_rows($res) > 0) {
              while ($data = mysqli_fetch_array($res)) {
                echo "<option value='{$data['movieid']}'>{$data['title']}</option>";
              }
            } else {
              echo "<option value=''>No Movies Found</option>";
            }
            ?>
          </select>
        </div>

        <div class="form-group mb-4">
          <input type="time" class="form-control" name="timing">
        </div>

        <div class="form-group mb-4">
          <input type="text" class="form-control" name="days" placeholder="Enter Days">
        </div>

        <div class="form-group mb-4">
          <input type="date" class="form-control" name="date">
        </div>

        <div class="form-group mb-4">
          <input type="number" class="form-control" name="price" placeholder="Enter Price">
        </div>

        <div class="form-group mb-4">
          <input type="text" class="form-control" name="location" placeholder="Enter Location">
        </div>

        <div class="form-group">
          <input type="submit" class="btn btn-primary" value="Add Theater" name="add">
        </div>
      </form>
    </div>
  
    <div class="col-lg-6">
      <table class="table">
        <tr>
          <th>#</th>
          <th>Theater</th>
          <th>Movie</th>
          <th>Category</th>
          <th>Date</th>
          <th>Days/Time</th>
          <th>Ticket</th>
          <th>Location</th>
          <th>Action</th>
        </tr>
        
        <?php
        // Fetching theater information along with associated movie and category
        $sql = "SELECT theater.*, movies.title, categories.catname
                FROM theater
                INNER JOIN movies ON movies.movieid = theater.movieid
                INNER JOIN categories ON categories.catid = movies.catid"; // Joining tables to get details
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) > 0) {
          while ($data = mysqli_fetch_array($res)) {
            echo "
            <tr>
              <td>{$data['theaterid']}</td>
              <td>{$data['theater_name']}</td>
              <td>{$data['title']}</td>
              <td>{$data['catname']}</td>
              <td>{$data['date']}</td>
              <td>{$data['days']} - {$data['timing']}</td>
              <td>{$data['price']}</td>
              <td>{$data['location']}</td>
              <td>
                <!-- Delete button to remove the theater -->
                <a href='theater.php?deleteid={$data['theaterid']}' class='btn btn-danger'>Delete</a>
              </td>
            </tr>";
          }
        } else {
          echo "<tr><td colspan='9'>No Theaters Found</td></tr>";
        }
        ?>
      </table>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>

<!-- adding theater -->
<?php
if (isset($_POST['add'])) {
  $theater_name = $_POST['theater_name'];
  $movieid = $_POST['movieid'];
  $days = $_POST['days'];
  $timing = $_POST['timing'];
  $price = $_POST['price'];
  $date = $_POST['date'];
  $location = $_POST['location'];

  $sql = "INSERT INTO `theater`(`theater_name`, `timing`, `days`, `date`, `price`, `location`, `movieid`) 
          VALUES ('$theater_name', '$timing', '$days', '$date', '$price', '$location', '$movieid')";

  if (mysqli_query($con, $sql)) {
    echo "<script> alert('Theater added'); window.location.href='theater.php'; </script>";
  } else {
    echo "<script> alert('Theater not added'); </script>";
  }
}

// Delete theater 
if (isset($_GET['deleteid'])) {
  $deleteid = $_GET['deleteid'];
  $sql = "DELETE FROM `theater` WHERE theaterid = '$deleteid'";
  if (mysqli_query($con, $sql)) {
    echo "<script> alert('Theater deleted'); window.location.href='theater.php'; </script>";
  } else {
    echo "<script> alert('Theater not deleted'); </script>";
  }
}
?>

