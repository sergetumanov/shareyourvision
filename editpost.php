<!-- Connecting Header -->
<?php require "templates/header.php" ?>

  <main class="container p-4 bg-light mt-3" style="width: 1000px">
    <?php
      // Check User is Logged In + Id passed in via GET
      if(isset($_SESSION['userId']) && isset($_GET['id'])){
        require './includes/connect.inc.php';
        $row;
        $id = mysqli_real_escape_string($conn, $_GET['id']); 
        $id = intval($id);
  
        // Declare SQL command to extract data from DB relating to post id (Prepared Statements)
        $sql = "SELECT title, imageurl ,comment, websiteurl, websitetitle FROM posts WHERE id=?";
  
        $statement = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($statement, $sql))
        {
          header("Location: editpost.php?id=$id&error=sqlerror"); 
          exit();
        } else {
          // SUCCESS: Bind our user data with statement
          mysqli_stmt_bind_param($statement, "i", $id);
  
          // Execute the SQL Statement
          mysqli_stmt_execute($statement);
  
          // SUCCESS: Store result & convert to array
          $result = mysqli_stmt_get_result($statement);
          $row = mysqli_fetch_assoc($result);
  
        // PRE-POPULATE data IF we have it from the $row variable in form below
        }

      // Restrict Access to Edit Page
      } else {
        header("Location: index.php");
        exit();
      }
    ?>

    <?php 
      // Dynamic Error Messages
      if(isset($_GET['error'])){
        // Empty fields validation 
        if($_GET['error'] == "emptyfields"){
          $errorMsg = "Please fill in all fields";

        // Internal server error 
        } else if ($_GET['error'] == "sqlerror") {
          $errorMsg = "An internal server error has occurred - please try again later";
        }

        // Dynamic Error Alert based on Variable Value 
        echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';

        // SUCCESS MESSAGE
      }
    ?>

    <!-- Send ID via GET ALONG with our POST form data -->
    <form action="includes/editpost.inc.php?id=<?php echo $id ?>" method="POST">
      <h2>Edit Post</h2>

      <!-- 1. TITLE -->
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" placeholder="Title" value="<?php echo $row['title'] ?>">
      </div>  

      <!-- 2. IMAGE URL -->
      <div class="mb-3">
        <label for="imageurl" class="form-label">Image URL</label>
        <input type="text" class="form-control" name="imageurl" placeholder="Image URL" value="<?php echo $row['imageurl'] ?>" >
      </div>

      <!-- 3. COMMENT SECTION -->
      <div class="mb-3">
        <label for="comment" class="form-label">Comment</label>
        <textarea class="form-control" name="comment" rows="3" placeholder="Comment"><?php echo $row['comment'] ?></textarea>
      </div>

      <!-- 4. WEBSITE URL -->
      <div class="mb-3">
        <label for="websiteurl" class="form-label">Website URL</label>
        <input type="text" class="form-control" name="websiteurl" placeholder="Website URL" value="<?php echo $row['websiteurl'] ?>" >
      </div>

      <!-- 5. WEBSITE TITLE -->
      <div class="mb-3">
        <label for="websitetitle" class="form-label">Website Title</label>
        <input type="text" class="form-control" name="websitetitle" placeholder="Website Title" value="<?php echo $row['websitetitle'] ?>" >
      </div>

      <!-- 6. SUBMIT BUTTON -->
      <button type="submit" name="edit-submit" class="btn btn-primary w-100">Edit</button>
    </form>
  </main>

<!-- Connecting Footer -->
<?php require "templates/footer.php" ?>