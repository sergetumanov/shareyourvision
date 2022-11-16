<!-- Connecting Header -->
<?php require "templates/header.php" ?>

<main class="container p-4 bg-light mt-3">
  <!-- signup.inc.php - Will process the data from this form-->
  <form action="includes/signup.inc.php" method="post">
    <h2>LogOut</h2>
    
    <!-- 1. USERNAME -->
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>

    </div>  

    <!-- 2. EMAIL -->
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>

    </div>

    <!-- 5. SUBMIT BUTTON -->
    <button type="submit" name="logout-submit" class="btn btn-danger w-100">Logout</button>
  </form>
</main>

<!-- Connecting Footer -->
<?php require "templates/footer.php" ?>