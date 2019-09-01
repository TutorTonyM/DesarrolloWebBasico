<?php
  session_start();
  $title = 'New Post';
  require_once('functions/new-post-function.php');
  require_once('partials/top.php');
  require_once('partials/navbar.php');
?>

<div class="main-container">

<form id="new-post-form" class="form lg" method="POST" enctype="multipart/form-data">

  <h1>Add New Post</h1>
  <hr>

  <?php if(!empty($errors)){echo alerts($errors);} ?>
  <input type="hidden" name="token" value="<?php echo create_token(); ?>">
  <input type="hidden" name="company" value="">

  <div class="form-group">
    <label>Category</label> <a href="new-category.php">Add New Category</a>
    <select class="custom-select" name="category" id="category-selector">
        <option disabled selected value="">Select a Category</option>
        <?php
          $categories = categories();
          if($categories->num_rows > 0){
            $categories->bind_result($name);
            while($categories->fetch()){
              echo "<option ".selectedDb('category', "$name")." value=\"$name\">$name</option>";
            }
          }
          else{
            echo '<option>There are no categories</option>';
          }
        ?>        
    </select>
  </div>

  <div id="new-post-fileds">
    <div class="form-group">
        <label>Title</label>
        <input type="text" class="form-control form-control-lg" name="title" value="<?php field('title')?>" placeholder="Enter Title" autofocus>
    </div>

    <div class="form-group">
        <label>Post</label>
        <textarea class="form-control" name="post" placeholder="Enter Post" rows="10"><?php field('post')?></textarea>
    </div>

    <div class="form-group">
        <label>Post Image:</label>
        <input type="file" name="image">
    </div>

    <button type="submit" class="btn btn-primary btn-lg btn-dynamic">Publish</button>
    <button type="button" class="btn btn-dark btn-lg btn-dynamic" onclick="goBack()">Cancel (Go Back)</button>
  </div>
  
</form>

</div>

<?php
  require_once('partials/footer.php');
  require_once('partials/bottom.php');
?>