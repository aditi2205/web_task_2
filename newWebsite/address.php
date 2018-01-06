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
  	<h2>Edit Address</h2>
  </div>
	
  <form method="post" action="address.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
      <p>Old Address <strong><?php echo $_SESSION['address']; ?></strong></p>
    </div>
  	<div class="input-group">
  	  <label>Enter new address</label>
  	  <input type="address1" name="address1">
  	</div>

  	<div class="input-group">
  	  <button type="submit" class="btn" name="edit_address">Edit Address</button>
  	</div>

    <div class="input-group">
      <p>YOU WILL BE DIRECTED TO LOGIN PAGE TO LOGIN WITH UPDATED CREDENTIALS</p>
    </div>
  	
  </form>
</body>
</html>