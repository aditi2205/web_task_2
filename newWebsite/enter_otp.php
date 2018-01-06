<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Enter OTP</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
    <h2>Enter OTP</h2>
  </div>
  
  <form method="post" action="enter_otp.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label>Enter OTP received va email</label>
      <input type="otp" name="otp" >
    </div>
    
    <div class="input-group">
      <button type="submit" class="btn" name="fp2">VALIDATE OTP</button>
    </div>
  
  </form>
</body>
</html>