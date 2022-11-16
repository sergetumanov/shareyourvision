<!-- Connecting Header -->
<?php require "templates/header.php" ?>
  
<!-- Welcome Message -->
<main class="container mt-3 p-4 bg-light welcome">
  <h2 id='homePage'>Welcome to ShareYour Vision Website!</h2>
  <h2>This website is for sharing pictures!</h2>
    <!-- Offering SignUp link if user is not logged in and to create a post if user is logged in -->
    <?php 
      if(isset($_SESSION['userId'])){
        echo '<p style="display:none;">Please make sure to <a href="signup.php">SIGNUP</a> to be able to post a new photo or to comment one on the website</p>';
        echo '<p style="display:block;">Please share your picture by creating a new <a href="posts.php">submission</a></p>';
      } else {
        echo '<p style="display:block;">Please make sure to <a href="signup.php">SIGNUP</a> to be able to post a new photo or to comment one on the website</p>';
        echo '<p style="display:none;">Please share your picture by creating a new <a href="posts.php">submission</a></p>';
      }
    ?>
</main>
<!-- Alert Messages -->
<?php require "templates/alert.php" ?>

<!-- Connecting Footer -->
<?php require "templates/footer.php" ?>