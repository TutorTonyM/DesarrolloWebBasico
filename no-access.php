<?php
  session_start();
  $title = 'No Access';
  require_once('functions/messages-function.php');
  require_once('partials/top.php');
  require_once('partials/navbar.php');
?>

<div class="main-container">

<h1 class="text-center">You have no access to this page.</h1>

</div>

<?php
  require_once('partials/footer.php');
  require_once('partials/bottom.php');
?>