<?php
  session_start();
  $title = 'Login';
  require_once('functions/guess-function.php');
  require_once('functions/login-function.php');
  require_once('partials/top.php');
  require_once('partials/navbar.php');
?>

<div class="main-container">  

<?php showMessage(); ?>

  <form class="form" method="POST">

    <h1>Login Form</h1>
    <hr>

    <?php if(!empty($errors)){ echo alerts($errors); } ?>

    <input type="hidden" name="token" value="<?php echo create_token() ?>">
    <input type="hidden" name="company" value="">

    <div class="form-group">
      <label>Username or Email</label>
      <input type="text" class="form-control form-control-lg" name="username-or-email" value="<?php field('username-or-email') ?>" placeholder="Enter Username or Email">        
    </div>

    <div class="form-group">
      <label>Password</label>
      <input type="password" class="form-control form-control-lg" name="password" placeholder="Enter Password">        
    </div>

    <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>

    <a href="forgot-password.php" class="d-block text-center mt-2">I Forgot my Password</a>
    
  </form>

</div>

<?php
  require_once('partials/footer.php');
  require_once('partials/bottom.php');
?>