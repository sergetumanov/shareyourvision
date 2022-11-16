<?php 
  // Check the user click the submit button from signup form
  if(isset($_POST['signup-submit'])){

    // Connect to database
    require 'connect.inc.php';

    // Collect & store the POST information in variables
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    
    // Check if any fields are empty
    if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
      header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
      exit(); 
    
    // Check for BOTH invalid email AND password syntax (uses A to Z & 0 to 9) 
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("Location: ../signup.php?error=invalidmailuid");
      exit(); 

    // Checks JUST if the email is invalid ONLY
    } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: ../signup.php?error=invalidmail&uid=".$username);
      exit(); 

    // Checks JUST if the username is invalid ONLY
    } else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
      header("Location: ../signup.php?error=invaliduid&mail=".$email);
      exit();

    // Checks if password has NOT been confirmed correctly
    } else if($password !== $passwordRepeat){
      header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
      exit();  

    } else {
      // Check if User Exists in Database
      $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
      $statement = mysqli_stmt_init($conn);

      if(!mysqli_stmt_prepare($statement, $sql))
      {
        header("Location: ../signup.php?error=sqlerror"); 
        exit();

      } else {
        mysqli_stmt_bind_param($statement, "s", $username);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement);

        $resultCheck = mysqli_stmt_num_rows($statement);
        // ERROR: If User Exists - pass back error
        if($resultCheck > 0){
          header("Location: ../signup.php?error=usertaken&mail".$email); 
          exit(); 

        // SUCCESS: No user exists
        } else {
          $sql = "INSERT INTO users (uidUsers, emailUsers, pwd) VALUES (?, ?, ?)";
          $statement = mysqli_stmt_init($conn);

          if(!mysqli_stmt_prepare($statement, $sql)){
            header("Location: ../signup.php?error=sqlerror");
            exit(); 

          } else {
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

            mysqli_stmt_bind_param($statement, "sss", $username, $email, $hashedPwd);
            mysqli_stmt_execute($statement);
            header("Location: ../signup.php?signup=success"); 
            exit();
          }
        }
      }
    }
    // Close prepared statement & DB connection
    mysqli_stmt_close($statement); 
    mysqli_close($conn); 

  // Restrict Access to Script Page
  } else {
    header("Location: ../signup.php");
    exit(); 
  }
?>