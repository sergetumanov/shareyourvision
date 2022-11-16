<!-- Connecting Header -->
<?php require "templates/header.php" ?>

  <main class="container p-4 bg-light mt-3" id="postsPage" style="width: 1000px">
    <?php
      // Connection to the DB
      require './includes/connect.inc.php';

      // Declare SQL command to DB to retrieve ALL rows from posts table in DB
      $sql = "SELECT id, title, imageurl ,comment, websiteurl, websitetitle FROM posts";

      // Call query & store result in variable
      $result = mysqli_query($conn, $sql);
    ?>

    <?php 
      // Dynamic message
      if(isset($_GET['post']) == "success"){
        echo '<div class="alert alert-success" role="alert">
          Post created!
        </div>';  
      } else if(isset($_GET['edit']) == "success"){
        echo '<div class="alert alert-success" role="alert">
          Post edited!
        </div>'; 
      }

      // Dynamic Errors
      if(isset($_GET['error'])){
        if ($_GET['error'] == "sqlerror") {
          $errorMsg = "An internal server error has occurred - please try again later";
        }
        echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';
        } else if (isset($_GET['delete']) == "success"){
          echo '<div class="alert alert-success" role="alert">
            Post successfully deleted!
          </div>';    
      }
    ?>

    <?php
      // Checking for posts
      if(mysqli_num_rows($result) > 0){
        $output = "";
        while($row = mysqli_fetch_assoc($result)) {
          $output .= 
          '
            <div class="card border-0 mt-3" id="' . $row['id'] . '">
              <img src="' . $row['imageurl'] . '" class="card-img-top post-image" alt="' . $row['title'] . '">
              <div class="card-body postsMain">
                <h5 class="card-title">' . $row['title'] . '</h5>
                <p class="card-text">' . $row['comment'] . '</p>
                <a href="' . $row['websiteurl'] . '" class="btn btn-primary w-100" target="_blank">' . $row['websitetitle'] . '</a>';
                
                if(isset($_SESSION['userId'])){
                  $output .= '
                  <div class="admin-btn">
                    <a href="editpost.php?id=' . $row['id'] . '" class="btn btn-secondary mt-2 editBtn">Edit</a>
                    <a href="includes/deletepost.inc.php?id=' . $row['id'] . '" class="btn btn-danger mt-2 deleteBtn">Delete</a>
                    
                  </div><div class="clear"></div>';
                }

            $output .= 
            '
              </div>
            </div>
            ';
        }
        
        echo $output;

      // Error Message
      } else {
        echo "0 results";
      }
      mysqli_close($conn);
    ?>
  </main>

<!-- Connecting Footer -->
<?php require "templates/footer.php" ?>