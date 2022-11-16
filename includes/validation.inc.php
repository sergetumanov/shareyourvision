<?php
  // If error/success in $_GET - display appropriate message
  if(isset($_GET['error'])){

  // Empty fields validation 
  if($_GET['error'] == "emptyfields"){
  $errorMsg = "Please fill in all fields";

  // Invalid Email AND Password
  } else if ($_GET['error'] == "invalidmailuid") {
  $errorMsg = "Invalid email and Password";

  // Invalid Email
  } else if ($_GET['error'] == "invalidmail") {
  $errorMsg = "Invalid email";

  // Invalid Username
  } else if ($_GET['error'] == "invaliduid") {
  $errorMsg = "Invalid username";

  // Password Confirmation Error
  } else if ($_GET['error'] == "passwordcheck") {
  $errorMsg = "Passwords do not match";

  // Username MATCH in database on save
  } else if ($_GET['error'] == "usertaken") {
  $errorMsg = "Username already taken";

  // Internal server error 
  } else if ($_GET['error'] == "sqlerror") {
  $errorMsg = "An internal server error has occurred - please try again later";

  // Echo Back Danger Alert with the Dynamic Error Message
  }
  echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';

  // SUCCESS MESSAGE: Successful sign up to DB
  } else if (isset($_GET['signup']) == "success") {
  echo '<div class="alert alert-success" role="alert">You have successfully signed up!</div>';    
  }
?>