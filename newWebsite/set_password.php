<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Reset Password</h2>
  </div>
	
  <form method="post" action="set_password.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Enter the new password</label>
  	  <input type="password" name="password" >
  	</div>
    <div class="input-group">
      <label>Confirm new password</label>
      <input type="password" name="password_2" >
    </div>
  	
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reset_password">SUBMIT</button>
  	</div>
  
  </form>
</body>
</html>