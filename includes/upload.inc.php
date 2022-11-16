<?php 
  // Start Session
  session_start();

  //Connecting to the database to pass data about uploaded file
  require 'connect.inc.php';

  // Declare general variables initial states for UPLOAD 
  $directory = "../img/uploads";
  $addressURL = 'http://localhost:8888/shareyourvision/img/uploads';
  $uploadOk = 1;
  $the_message = '';
  
  // Save upload data to variables (using $_FILES superglobal)
  if(isset($_POST['submit'])){
    // File name of the temporary copy of the file stored on the server
    $temp_name = $_FILES['fileToUpload']['tmp_name'];

    // Name of the uploaded file
    $target_file = $_FILES['fileToUpload']['name'];

    // Name of file type extension (converted to lower case for better handling)
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Stores our URL path to the uploaded image on the server
    $my_url = $addressURL . DIRECTORY_SEPARATOR . $target_file;

    // Set additional error handler to pick up the PHP error number & pass back the custom message corresponding to the number
    $error_msg = '';
    $the_error = $_FILES['fileToUpload']['error'];
    if($_FILES['fileToUpload']['error'] != 0){
      $error_msg = "no_file_selected";
      $uploadOk = 0;
    }
    
    // Set custom error handlers
    // File Already Exists
    if($error_msg == "" && file_exists($imageURL)){
      $error_msg = "file_exist";
      $uploadOk = 0;
    }

    // Incorrect File Extension
    if($error_msg == "" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
      $error_msg = "wrong_filetype";
      $uploadOk = 0;
    }
    
    // Set our main error capture & successful upload case
    if($uploadOk == 0) {
      header("Location: ../upload.php?error=uploaderror&".$error_msg);
      exit();
    } else {
      // If all ok (remains value of 1) - try to upload file to permanent location
      if(move_uploaded_file($temp_name, $directory . "/" . $target_file)){
        
        //Passing uploaded file URL and main information to the database
        $title = $_POST['title'];
        $imageURL = $my_url;
        $comment = $_POST['comment'];
        $websiteLikes = 0;
        $websiteURL = 'http://localhost:8888/shareyourvision';
        $websiteTitle = 'http://localhost:8888/shareyourvision';

          // VALIDATION: Check if any fields are empty
          $error_msg = '';
          if (empty($title ) || empty($imageURL) || empty($comment)) {
            header("Location: ../upload.php?error=emptyfields");
            $error_msg = 'emptyfields';
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
              header("Location: ../upload.php?error=sqlerror"); 
              $error_msg = 'sqlerror';
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
        }
    }

  } else {
      header("Location: ../index.php");
       exit();
  }
?>