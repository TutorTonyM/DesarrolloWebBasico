<?php
  session_start();
  $title = 'Edit Post';
  require_once('functions/authentication-function.php');
  require_once('functions/edit-post-function.php');
  require_once('partials/top.php');
  require_once('partials/navbar.php');
?>

<div class="main-container">

<form id="edit-post-form" class="form lg" method="POST">

  <h1>Edit Post</h1>
  <hr>

  <?php if(!empty($errors)){echo alerts($errors);} ?>
  <input type="hidden" name="token" value="<?php echo create_token(); ?>">
  <input type="hidden" name="company" value="">

  <div class="form-group">
    <label>Category</label>
    <select class="custom-select" name="category">
        <option disabled selected value="">Select a Category</option>
        <option <?php selected('category', 'Humor', $category) ?> value="Humor">Humor</option>
        <option <?php selected('category', 'Educational', $category) ?> value="Educational">Educational</option>
        <option <?php selected('category', 'Romance', $category) ?> value="Romance">Romance</option>
        <option <?php selected('category', 'Inspirational', $category) ?> value="Inspirational">Inspirational</option>
    </select>
  </div>

  <div id="new-post-fileds">
    <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control form-control-lg" name="title" value="<?php field('title', $title) ?>" placeholder="Enter Title" autofocus>
    </div>

    <div class="form-group">
        <label>Post</label>
        <textarea class="form-control" name="post" placeholder="Enter Post" rows="10"><?php field('post', $post) ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary btn-lg btn-dynamic">Update</button>
    <a href="delete-post.php?post=<?php echo $id ?>" class="btn btn-danger btn-lg btn-dynamic">Delete</a>
    <button type="button" class="btn btn-dark btn-lg btn-dynamic" onclick="goBack()">Cancel (Go Back)</button>
  </div>
  
</form>

</div>

<?php
  require_once('partials/footer.php');
  require_once('partials/bottom.php');
?>