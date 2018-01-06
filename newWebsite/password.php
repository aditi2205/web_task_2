<?php include('server.php') ?>
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  
?>
<!DOCTYPE html>
<html>
<head>
  
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  
  <div class="header">
  	<h2>EDIT PASSWORD</h2>
  </div>
	
  <form method="post" action="address.php">
  	<?php include('errors.php'); ?>
    <div class="input-group">
      <label>Enter Existing Password</label>
      <input type="password" name="password1">
    </div>
  	<div class="input-group">
      <label>Enter New Password</label>
      <input type="password" name="password2">
    </div>
    <div class="input-group">
      <label>Confirm new password</label>
      <input type="password" name="password3">
    </div>

  	<div class="input-group">
  	  <button type="submit" class="btn" name="edit_password">Edit Password</button>
  	</div>
  	
    <div class="input-group">
      <p>YOU WILL BE DIRECTED TO LOGIN PAGE TO LOGIN WITH UPDATED CREDENTIALS</p>
    </div>
  </form>
</body>
</html>