<?php require "templates/header.php";?>

<?php
  // Dynamic Errors
  if(isset($_GET['no_file_selected'])){
    $error_msg = 'Please select a file to upload.';
      echo '<div class="alert alert-danger" role="alert">' . $error_msg . '</div>';
    }
  if(isset($_GET['wrong_filetype'])){
    $error_msg = 'Wrong file type, please use only jpeg, jpg, png or gif files.';
      echo '<div class="alert alert-danger" role="alert">' . $error_msg . '</div>';
    }
  if(isset($_GET['file_exist'])){
    $error_msg = 'The file already exists!';
      echo '<div class="alert alert-danger" role="alert">' . $error_msg . '</div>';
    }
  if(isset($_GET['error'])){
    $error_msg = 'Please fill the TITLE and COMMENTS';
      echo '<div class="alert alert-danger" role="alert">' . $error_msg . '</div>';
    }
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-8">
    <!-- File Upload Form: START -->
    <form action="includes/upload.inc.php" method="POST" enctype="multipart/form-data" id="uploadPage">
      <!-- 1. TITLE -->
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" placeholder="Title" value="">
      </div>  

      <!-- 2. COMMENT SECTION -->
      <div class="mb-3">
        <label for="comment" class="form-label">Comment</label>
        <textarea class="form-control" name="comment" rows="3" placeholder="Comment" ></textarea>
      </div>

      <!-- 3. IMAGE SECTION -->  
      <div class="input-group mb-3">
        <!-- File Input -->
        <input type="file" class="form-control" id="inputGroupFile" name="fileToUpload">

        <!-- Submit Button -->
        <input type="submit" value="Upload" name="submit" class="btn btn-primary input-group-text"></input>
      </div>

    </form>
    <!-- File Upload Form: END -->

    </div>
  </div>
</div>

<?php require "templates/footer.php" ?>  