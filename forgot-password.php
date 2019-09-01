<?php
  session_start();
  $title = 'Forgot Passwrod';
  require_once('functions/forgot-password-function.php');
  require_once('partials/top.php');
  require_once('partials/navbar.php');
?>

<div class="main-container">  

<?php showMessage(); ?>  

<form id="forgot-password-form" class="form" method="POST">

  <h1>Forgot Password</h1>
  <hr>

  <?php if(!empty($errors)){echo alert($errors);} ?>
  <input type="hidden" name="token" value="<?php echo create_token(); ?>">
  <input type="hidden" name="company" value="">

  <div class="form-group">
    <label>Enter the Email Associated with Your Account</label>
    <input type="text" class="form-control form-control-lg" name="email" value="<?php field('email')?>" placeholder="Enter Email" autofocus>
  </div>

  <button type="submit" class="btn btn-primary btn-lg btn-block">Send</button>
</form>

</div>

<?php
  require_once('partials/footer.php');
  require_once('partials/bottom.php');
?>