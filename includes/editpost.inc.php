<?php
  // Check If User Clicked Edit-Submit Button and Logged In
  session_start();
  if(isset($_POST['edit-submit']) && isset($_SESSION['userId'])){
    require 'connect.inc.php';

    // Collect & store POST data
    $id = mysqli_real_escape_string($conn, $_GET['id']); 
    $id = intval($id);
    $title = $_POST['title'];
    $imageURL = $_POST['imageurl'];
    $comment = $_POST['comment'];
    $websiteURL = $_POST['websiteurl'];
    $websiteTitle = $_POST['websitetitle'];

    // VALIDATION: Check if any fields are empty
    if (empty($id) || empty($title) || empty($imageURL) || empty($comment) || empty($websiteURL) || empty($websiteTitle)) {
      header("Location: ../editpost.php?id=$id&error=emptyfields");
      exit();

    // Save Edited Post to DB using Prepared Statements
    } else {
      $sql = "UPDATE posts SET title=?, imageurl=?, comment=?, websiteurl=?, websitetitle=? WHERE id=?"; 

      $statement = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($statement, $sql))
      {
        header("Location: ../editpost.php?id=$id&error=sqlerror"); 
        exit();
      } else {
        mysqli_stmt_bind_param($statement, "sssssi", $title, $imageURL, $comment, $websiteURL, $websiteTitle, $id);

        mysqli_stmt_execute($statement);

        header("Location: ../posts.php?id=$id&edit=success"); 
        exit();
      }
    }

  // Restrict Access to Edit Script Page
  } else {
    header("Location: ../signup.php");
    exit();
  }
?>