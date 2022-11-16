<?php
  // Start session
  session_start();

  // Take all session values in $_SESSION variable and removes them
  session_unset(); 

  // End session
  session_destroy();
  header("Location: ../index.php");
?>