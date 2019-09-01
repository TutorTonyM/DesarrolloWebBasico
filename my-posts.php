<?php
  session_start();
  $title = 'My Posts';
  require_once('functions/authentication-function.php');
  require_once('functions/post-function.php');
  require_once('partials/top.php');
  require_once('partials/navbar.php');
?>

<div class="main-container">

    <h1 class="text-center">My Posts</h1>

    <?php myPosts(); ?>

</div>

<?php
  require_once('partials/footer.php');
  require_once('partials/bottom.php');
?>