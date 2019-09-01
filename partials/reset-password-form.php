<form id="reset-password-form" class="form" method="POST">

  <h1>Reset Password</h1>
  <hr>

  <?php if(!empty($errors)){echo alert($errors);} ?>
  <input type="hidden" name="token" value="<?php echo create_token(); ?>">
  <input type="hidden" name="company" value="">

  <div class="form-group">
    <label>Enter Your New Password</label>
    <input type="password" class="form-control form-control-lg" name="password" value="<?php field('password')?>" placeholder="New Password" autofocus>
  </div>

  <div class="form-group">
    <label>ReEnter Your New Password</label>
    <input type="password" class="form-control form-control-lg" name="repassword" value="<?php field('repassword')?>" placeholder="ReEnter New Password" autofocus>
  </div>

  <button type="submit" class="btn btn-primary btn-lg btn-block">Reset Password</button>
</form>