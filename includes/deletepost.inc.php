<?php
  // Check User is Logged In and Id passed in via GET
  session_start();
  if(isset($_SESSION['userId']) && isset($_GET['id'])){
    // Connect to DB
    require 'connect.inc.php';

    // Collect, escape string & store POST data
    $id = mysqli_real_escape_string($conn, $_GET['id']); 

    // Check that data is an integer (ensure random letters/symbols aren't passed in!)
    $id = intval($id);

    // Delete Post from DB
    // Declare Template SQL with ? Placeholders to delete values from table
    $sql = "DELETE FROM posts WHERE id=?"; 

    // Init SQL statement
    $statement = mysqli_stmt_init($conn);

    // Prepare + send statement to database to check for errors
    if(!mysqli_stmt_prepare($statement, $sql))
    {
      // ERROR: Something wrong when preparing the SQL
      header("Location: ../posts.php?id=$id&error=sqlerror"); 
      exit();
    } else {
      // SUCCESS: Bind our user data with statement + escape integer
      mysqli_stmt_bind_param($statement, "i", $id);

      // Execute the SQL Statement (to run in DB)
      mysqli_stmt_execute($statement);

      // SUCCESS: Post is deleted from "posts" table - redirect with success message
      header("Location: ../posts.php?id=$id&delete=success"); 
      exit();
    }

  // Restrict Access to Script Page
  } else {
    header("Location: ../signup.php");
    exit();
  }
?>