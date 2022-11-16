<!-- Connecting Header -->
<?php require "templates/header.php" ?>

  <main class="container p-4 bg-light mt-3">
    <!-- createpost.inc.php - Will process the data from this form-->
    <form action="includes/createpost.inc.php" method="POST">
      <h2 id="createpostPage">Create Post</h2>

      <!-- 1. TITLE -->
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" placeholder="Title" value="">
      </div>  

      <!-- 2. IMAGE URL -->
      <div class="mb-3">
        <label for="imageurl" class="form-label">Image URL</label>
        <input type="text" class="form-control" name="imageurl" placeholder="Image URL" value="" >
      </div>

      <!-- 3. COMMENT SECTION -->
      <div class="mb-3">
        <label for="comment" class="form-label">Comment</label>
        <textarea class="form-control" name="comment" rows="3" placeholder="Comment" ></textarea>
      </div>

      <!-- 4. WEBSITE URL -->
      <div class="mb-3">
        <label for="websiteurl" class="form-label">Website URL</label>
        <input type="text" class="form-control" name="websiteurl" placeholder="Website URL" value="" >
      </div>

      <!-- 5. WEBSITE TITLE -->
      <div class="mb-3">
        <label for="websitetitle" class="form-label">Website Title</label>
        <input type="text" class="form-control" name="websitetitle" placeholder="Website Title" value="" >
      </div>

      <!-- 6. SUBMIT BUTTON -->
      <button type="submit" name="post-submit" class="btn btn-primary w-100">Post</button>
    </form>
  </main>

<!-- Connecting Footer -->
<?php require "templates/footer.php" ?>