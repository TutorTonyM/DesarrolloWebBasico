<?php
  session_start();
  $title = 'Post';
  require_once('functions/post-function.php');
  require_once('partials/top.php');
  require_once('partials/navbar.php');
?>

<div class="main-container">

    <?php singlePost(); ?>

</div>

<?php
  require_once('partials/footer.php');
  require_once('partials/bottom.php');
?>