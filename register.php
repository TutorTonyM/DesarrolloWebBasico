<?php
  session_start();
  $title = 'Register';
  require_once('functions/guess-function.php');
  require_once('functions/register-function.php');
  require_once('partials/top.php');
  require_once('partials/navbar.php');
?>
    
<div class="main-container">  

<?php showMessage(); ?>

  <form class="form" method="POST">

    <h1>Registration Form</h1>
    <hr>

    <?php if(!empty($errors)){ echo alerts($errors); } ?>

    <input type="hidden" name="token" value="<?php echo create_token() ?>">
    <input type="hidden" name="company" value="">

    <div class="form-group">
      <label>Username</label>
      <input type="text" class="form-control form-control-lg" name="username" value="<?php field('username') ?>" placeholder="Enter Username">        
    </div>

    <div class="form-group">
      <label>Email</label>
      <input type="text" class="form-control form-control-lg" name="email" value="<?php field('email') ?>" placeholder="Enter Email">        
    </div>

    <div class="form-group">
      <label>Password</label>
      <input type="password" class="form-control form-control-lg" name="password" placeholder="Enter Password">        
    </div>

    <div class="form-group">
      <label>Re-Password</label>
      <input type="password" class="form-control form-control-lg" name="repassword" placeholder="Re-Enter Password">        
    </div>

    <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
    
  </form>

</div>

<?php
  require_once('partials/footer.php');
  require_once('partials/bottom.php');
?>