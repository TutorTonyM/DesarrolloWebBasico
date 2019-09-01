<?php
  session_start();
  $title = 'Home'; 
  require_once('functions/post-function.php');
  require_once('partials/top.php');
  require_once('partials/navbar.php');
?>

<div class="main-container-narrow bg-white">  

  <?php showMessage(); ?>  

  <?php allPosts(); ?>

</div>

<?php
  require_once('partials/footer.php');
  require_once('partials/bottom.php');
?>

    