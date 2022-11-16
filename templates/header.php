<!-- Starting new session -->
<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Connecting Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Connecting Internal styles -->
    <link rel="stylesheet" href="styles/style.css">
    <!-- Connecting Internal Styles for Mobile Devices -->
    <link
      rel="stylesheet"
      media="screen and (max-width:768px)"
      href="styles/mobile.css"
    />
    <!-- Connecting Google Analytics Tag -->
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-5QBPJ3MB8N"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-5QBPJ3MB8N');
        </script>
        <!-- END of Google tag (gtag.js) --> 
    <!-- Connecting Favicon -->
    <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
  <title>Share Your Vision</title>
</head>
<body>
  <!-- Header Start -->
  <header>
    <div class="container">
      <a href="index.php">  
        <div id="logo" class="text-center">
          <img src="img/logo.png" alt="logo">
            <h1>Share<span>Your Vision</span></h1>
        </div>
      </a>  
      <!-- Navigation Desktop-->
      <ul class="nav justify-content-right myNavBar">
        <li class="nav-item">
          <a class="nav-link" id="HP" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="AB" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="PS" href="posts.php">Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="UPL" href="upload.php">UPLOAD</a>
        </li>
        <!-- "Create Post" is visible only if user is logged in -->
        <?php 
          if(isset($_SESSION['userId'])){
          echo '<li class="nav-item">
                <a class="nav-link" id="CP" href="createpost.php">Create Post</a>
              </li>';
          }
        ?>
        <!-- Removing SignUp if user is logged in -->
        <?php 
          if(isset($_SESSION['userId'])){
          echo '<li class="nav-item">
          <a class="nav-link" href="signup.php" style="display:none">Signup</a>
        </li>';
          } else {
            echo '<li class="nav-item">
            <a class="nav-link" id="SU" href="signup.php" style="display:block">Signup</a>
          </li>';
          }
        ?>
        <!-- LOGIN/LOGOUT is available only when user is logged in/logged out -->
        <?php 
          if(isset($_SESSION['userId'])){
            // Logout Button
            echo '<li class="nav-item">
              <form action="includes/logout.inc.php" action="POST">
                <button type="submit" class="btn btn-primary w-100" name="logout-submit">Logout</button>
              </form>
            </li>';
          } else {
            // Login Button 
            echo '<li class="nav-item">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login-modal">
              Login
            </button>
          </li>';
          }
        ?>
      </ul>
      <div class="clear"></div>  
      <!-- Navigation Desktop END -->
      <!-- Navigation Mobile -->
      <div class="pos-f-t" id="mobileNav">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a class="nav-link" id="pillsHomeTab" data-toggle="pill" href="index.php" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
          <a class="nav-link" id="pillsAboutTab" data-toggle="pill" href="about.php" role="tab" aria-controls="v-pills-profile" aria-selected="false">About</a>
          <a class="nav-link" id="pillsPostsTab" data-toggle="pill" href="posts.php" role="tab" aria-controls="v-pills-messages" aria-selected="false">Posts</a>
          <a class="nav-link" id="pillsUploadPostTab" data-toggle="pill" href="upload.php" role="tab" aria-controls="v-pills-messages" aria-selected="false">Upload</a>          
          <?php 
            if(isset($_SESSION['userId'])){
            echo '<a class="nav-link" id="pillsCreatePostTab" data-toggle="pill" href="createpost.php" role="tab" aria-controls="v-pills-settings" aria-selected="false">Create Post</a>';}
          ?> 
          <?php 
            if(isset($_SESSION['userId'])){
            echo '<a class="nav-link" id="pillsSignUpTab" data-toggle="pill" href="signup.php" role="tab" aria-controls="v-pills-settings" aria-selected="false" style="display:none">Signup</a>';
          } else {
            echo '<a class="nav-link" id="pillsSignUpTab" data-toggle="pill" href="signup.php" role="tab" aria-controls="v-pills-settings" aria-selected="false" style="display:block">Signup</a>';
          }
          ?>
          <?php 
            if(isset($_SESSION['userId'])){
            // Logout Button
          echo '
            <form action="includes/logout.inc.php" action="POST">
              <button type="submit" class="btn btn-primary w-100" name="logout-submit">Logout</button>
            </form>';
          } else {
          // Login Button 
          echo '
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login-modal">
              Login
            </button>';
          }
          ?>
        </div>
      </div>
      <!-- Navigation Mobile End -->  
    </div>
  </header>
  <!-- Header End -->

<!-- Connectin Login Modal -->
<?php require "templates/login.php" ?>


<!-- Login Error Message from GET: START -->
<div class="container mt-3" style="width: 1000px">
  <?php
    // Check $_GET to see if we have any login error messages 
    if(isset($_GET['loginerror'])){
      // Empty fields in Login 
      if($_GET['loginerror'] == "emptyfields"){
        $errorMsg = "Please fill in all fields";

      // SQL Error
      } else if ($_GET['loginerror'] == "sqlerror"){
        $errorMsg = "Internal server error - please try again later";

      // Password does NOT match DB 
      } else if ($_GET['loginerror'] == "wrongpwd"){
        $errorMsg = "Wrong password";
        
      // uidUsers / emailUsers do not match
      } else if ($_GET['loginerror'] == "nouser"){
        $errorMsg = "The user does not exist";
      }
      // Display alert with dynamic error message
      echo '<div class="alert alert-danger" role="alert">'
        .$errorMsg.
      '</div>';

    // Display SUCCESS message for correct login!
    } else if (isset($_GET['login']) == "success"){
      echo '<div class="alert alert-success" role="alert">
        You have successfully logged in.
      </div>';    
    }
  ?>
</div>
<!-- Error Message from GET: END -->