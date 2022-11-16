<?php
  // Start Session
  session_start();

  // Check user clicked submit button from createpost form and user is logged in
  if(isset($_POST['post-submit']) && isset($_SESSION['userId'])){
    require 'connect.inc.php';

    // Collect & store POST data
    $title = $_POST['title'];
    $imageURL = $_POST['imageurl'];
    $comment = $_POST['comment'];
    $websiteLikes = 0;
    $websiteURL = $_POST['websiteurl'];
    $websiteTitle = $_POST['websitetitle'];

    // VALIDATION: Check if any fields are empty
    if (empty($title ) || empty($imageURL) || empty($comment) || empty($websiteURL) || empty($websiteTitle)) {
      header("Location: ../createpost.php?error=emptyfields");
      exit();

    // Save Post to DB using Prepared Statements
    } else {
      // Declare Template SQL with ? Placeholders to save values to table
      $sql = "INSERT INTO posts (id, title, imageurl, comment, likes, websiteurl, websitetitle) VALUES (NULL, ?, ?, ?, ?, ?, ?)"; 

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
        mysqli_stmt_bind_param($statement, "sssiss", $title, $imageURL, $comment, $websiteLikes, $websiteURL, $websiteTitle);

        // Execute the SQL Statement with user data
        mysqli_stmt_execute($statement);

        // SUCCESS: Post is saved to "posts" table - redirect with success message
        header("Location: ../posts.php?post=success"); 
        exit();
      }
    }

  // Restrict Access to Script Page
  } else {
    header("Location: ../index.php");
    exit();
  }
?>
