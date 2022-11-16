<div class="container alertMsg">
<!-- Connecting to the database and showing a success or error message -->
<?php 
  if(isset($_SESSION['userId'])){
    echo '<div class="alert alert-success" role="alert">You are logged in!</div>';
  } else {
    echo '<div class="alert alert-warning" role="alert">You are not logged in</div>';
  }
?>
</div>