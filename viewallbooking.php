<?php 
include('../connect.php');

if(!isset($_SESSION['uid'])){
  echo "<script> window.location.href='../login.php';  </script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
</head>
<body>

<?php include('header.php')  ?>

<div class="container" style="margin-top:100px!important;">
</div>

<div class="container">
<div class="row mt-5">
  <div class="col-lg-12">
     <table class="table">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Category</th>
        <th>Date</th>
        <th>Day/Time</th>
        <th>Tickets</th>
        <th>Total Price</th>
        <th>Location</th>
        <th>User</th>
        <th>Status</th>
        <th>Action</th>
      </tr>

      <?php
        $sql = "SELECT booking.bookingid, booking.bookingdate, booking.person, theater.theater_name, theater.timing, theater.days, theater.price, theater.location, 
                       movies.title, categories.catname, users.name AS 'username', booking.status
                FROM booking
                INNER JOIN theater ON theater.theaterid = booking.theaterid
                INNER JOIN users ON users.userid = booking.userid
                INNER JOIN movies ON movies.movieid = theater.movieid
                INNER JOIN categories ON categories.catid = movies.catid";
        
        $res  = mysqli_query($con, $sql);
        if(mysqli_num_rows($res) > 0){
          while($data = mysqli_fetch_array($res)){
      ?>

            <tr>
              <td><?= $data['bookingid'] ?></td>
              <td><?= $data['theater_name'] ?></td>
              <td><?= $data['title'] ?> - <?= $data['catname'] ?></td>
              <td><?= $data['bookingdate'] ?></td>
              <td><?= $data['days'] ?> - <?= $data['timing'] ?></td>       
              <td><?= $data['person'] ?> tickets</td> <!-- Displaying the number of people/tickets -->
              <td><?= $data['price'] * $data['person'] ?> tk</td> <!-- Displaying total price -->
              <td><?= $data['location'] ?></td>
              <td><?= $data['username'] ?></td>
              <td>
                <?php
                if($data['status'] == 0){
                  echo "<a href='#' class='btn btn-warning'> Pending </a>";
                }else{
                  echo "<a href='#' class='btn btn-success'> Approved </a>";
                }
                ?>
              </td>
              <td>
                <?php
                if($data['status'] == 1){
                  echo "<button type='button' class='btn btn-light' disabled> Completed </button>";
                }else{
                  echo "<a href='viewallbooking.php?bookingid=".$data['bookingid']."' class='btn btn-primary'> Approve</a>";
                }
                ?>
              </td>
            </tr>

      <?php
          }
        } else {
          echo 'No booking found';
        }
      ?>
     </table>
  </div>
</div>
</div>

<?php include('footer.php')  ?>

</body>
</html>

<?php
if(isset($_GET['bookingid'])){
  $bookingid  = $_GET['bookingid'];
  $sql = "UPDATE `booking` SET `status`= 1 WHERE bookingid = '$bookingid'";

  if(mysqli_query($con,$sql)){
    echo "<script> alert('Booking approved successfully!') </script>";
    echo "<script> window.location.href='viewallbooking.php';  </script>";
  }else{
    echo "<script> alert('Approval failed!') </script>";
  }
}
?>
