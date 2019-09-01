<?php
  session_start();
  $title = 'New Category';
  require_once('functions/new-category-function.php');
  require_once('partials/top.php');
  require_once('partials/navbar.php');
?>

<div class="main-container">

<form id="new-category-form" class="form" method="POST">

    <h1>Add New Category</h1>
    <hr>

    <?php if(!empty($errors)){echo alerts($errors);} ?>
    <input type="hidden" name="token" value="<?php echo create_token(); ?>">
    <input type="hidden" name="company" value="">

    <div class="form-group">
        <label>Category</label>
        <input type="text" class="form-control form-control-lg" name="category" value="<?php field('category')?>" placeholder="Enter New Category Name" autofocus>
    </div>

    <button type="submit" class="btn btn-primary btn-lg btn-block">Add Category</button>
    <button type="button" class="btn btn-dark btn-lg btn-block" onclick="goBack()">Cancel (Go Back)</button>
  
</form>

</div>

<?php
  require_once('partials/footer.php');
  require_once('partials/bottom.php');
?>