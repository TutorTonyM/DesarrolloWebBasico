<?php
  session_start();
  $title = 'Reset Password';
  require_once('functions/reset-password-function.php');
  require_once('partials/top.php');
  require_once('partials/navbar.php');
?>

<div class="main-container">

<?php

if($result){
  require_once('partials/reset-password-form.php');
}
else{
  require_once('partials/invalid-link-alert.php');
}

?>

</div>

<?php
  require_once('partials/footer.php');
  require_once('partials/bottom.php');
?>