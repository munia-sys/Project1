<?php
include('connect.php');

// Ensure the user is logged in
if(!isset($_SESSION['uid'])){
  echo "<script> window.location.href='login.php';  </script>";
  exit;
}

// Retrieve POST data from the payment form
$bookingid = $_POST['bookingid']; // Ensure the form field is named correctly
$card_number = $_POST['card_number']; // Card number from the form

// Here, you would typically call a payment gateway API (e.g., Stripe, PayPal) to process the payment
// For simplicity, we'll assume the payment is successful

// If payment is successful, update the booking in the database
$payment_status = 'Paid'; // Example status

// Update the booking status in the database
$update_sql = "UPDATE booking SET status='$status' WHERE bookingid='$bookingid'"; // Use the correct column names

if(mysqli_query($con, $update_sql)){
  echo "<script> alert('Payment successful! Booking confirmed.'); </script>";
  echo "<script> window.location.href='index.php';  </script>";
} else {
  echo "<script> alert('Payment failed!'); </script>";
}
?>

