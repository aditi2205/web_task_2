<?php include('server.php') ?>

  

<!DOCTYPE html>
<html>
<head>
  
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  
  <div class="header">
  	<h2>FORGOT PASSWORD</h2>
  </div>
	
  <form method="post" action="forgot.php">
  	<?php include('errors.php'); ?>
    <div class="input-group">
      <label>Enter Email Address</label>
      <input type="email1" name="email1">
    </div>
  	
  	<div class="input-group">
  	  <button type="submit" class="btn" name="fp1">Send OTP</button>
  	</div>
  	
    
  </form>
</body>
</html>