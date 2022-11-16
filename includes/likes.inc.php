<?php
  // Check User is Logged In and Id passed in via GET
  session_start();

  $userId = $_SESSION['userId'];

  if(isset($_SESSION['userId']) && isset($_GET['id'])){
    // Connect to DB
    require 'connect.inc.php';

    // Collect, escape string & store POST data
    $id = mysqli_real_escape_string($conn, $_GET['id']); 

    // Check that data is an integer (ensure random letters/symbols aren't passed in!)
    $id = intval($id);

    // Sending information to the database
    $sql = "INSERT INTO likes (likesId, postId, userId) VALUES (NULL, ?, ?)"; 

    // Init SQL statement
    $statement = mysqli_stmt_init($conn);

    // Prepare + send statement to database to check for errors
    if(!mysqli_stmt_prepare($statement, $sql))
    {
      // ERROR: Something wrong when preparing the SQL
      header("Location: ../createpost.php?error=sqlerror"); 
      exit();
    } else {
      // SUCCESS: Bind our user data with statement + escape strings
      mysqli_stmt_bind_param($statement, "ii", $id, $userId);

      // Execute the SQL Statement with user data
      mysqli_stmt_execute($statement);

      // SUCCESS: Post is saved to "posts" table - redirect with success message
      header("Location: ../posts.php?like=success"); 
      exit();
    }

  // Restrict Access to Script Page
  } else {
    header("Location: ../signup.php");
    exit();
  } 
?>