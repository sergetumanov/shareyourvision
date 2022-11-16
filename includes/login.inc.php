<?php
  // Check user clicked submit button on Login Form
  if(isset($_POST['login-submit'])){

    // Connect to database
    require 'connect.inc.php';

    // Collect & store the POST username + password in variables
    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    // Check username and password fields are not blank
    if(empty($mailuid) || empty($password)){
      header("Location: ../index.php?loginerror=emptyfields"); 
      exit(); 
    
    // Check if User Exists in Database WHERE No Form Error (Preapred Statements)
    } else {
      $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?"; 
      $statement = mysqli_stmt_init($conn);

      if(!mysqli_stmt_prepare($statement, $sql)) {
        header("Location: ../index.php?loginerror=sqlerror"); 
        exit(); 
      } else {
        // SUCCESS: Bind our user data with statement + escape strings

        mysqli_stmt_bind_param($statement, "ss", $mailuid, $mailuid);
        mysqli_stmt_execute($statement);

        $result = mysqli_stmt_get_result($statement);       
        
        // Check $result to see if a user EXISTS in DB
        if($row = mysqli_fetch_assoc($result)){
          $pwdCheck = password_verify($password, $row['pwd']);

          if($pwdCheck == false){
            header("Location: ../index.php?loginerror=wrongpwd");
            exit(); 
          } else if ($pwdCheck == true) {
            // Start session
            session_start();
            // Add user data to session variable 
            $_SESSION['userId'] = $row['idUsers']; 
            $_SESSION['userUid'] = $row['uidUsers']; 
            header("Location: ../index.php?login=success");
            exit(); 
          
          } else {
            header("Location: ../index.php?loginerror=wrongpwd");
            exit(); 
          }
        
        } else {
          header("Location: ../index.php?loginerror=nouser");
          exit(); 
        }
      }
    }
  // Restrict Access to Script Page
  } else {
    header("Location: ../index.php");
    exit();
  }
  
?>