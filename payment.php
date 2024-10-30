<?php 
include('connect.php');

// Ensure the user is logged in
if(!isset($_SESSION['uid'])){
  echo "<script> window.location.href='login.php';  </script>";
  exit;
}

// Retrieve booking_id from GET parameters
$booking_id = $_GET['booking_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<section id="payment" class="payment section-bg">
  <div class="container">
    <div class="section-title">
      <h2>Make Payment</h2>
    </div>
    
    <form action="process_payment.php" method="POST">
      <!-- Hidden input field to pass booking_id -->
      <input type="hidden" name="booking_id" value="<?= $booking_id ?>">

      <div class="row">
        <div class="col form-group mb-3">
          <label for="card_number">Card Number:</label>
          <input type="text" class="form-control" name="card_number" placeholder="Enter your card number" required>
        </div>
      </div>

      <!-- Pay Now button -->
      <div class="text-center">
        <button type="submit" class="btn btn-primary">Pay Now</button>
      </div>
    </form>
  </div>
</section>

</body>
</html>

