
<?php 
  session_start(); 

  if ($_SESSION['access'] != "admin") {
    $_SESSION['msg'] = "You must be an admin";
    header('location: login.php');
  }
  
?>
<?php
if(count($_FILES) > 0) {
echo "here";
if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
$db = mysqli_connect('localhost', 'root', 'A23690108', 'registration');

if(!$db)
{
  die("Connection error: " . mysqli_connect_errno());
}
echo "here";
$imgData =addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
$sql = "INSERT INTO output_images(imageType ,imageData)
VALUES('{$imageProperties['mime']}', '{$imgData}')";
if(!mysqli_query($db, $sql))
      {
        echo("Error description: " . mysqli_error($db));
      }

header("Location: newnotice.php");
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>UPLOAD NOTICE</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>UPLOAD NOTICE</h2>
  </div>
	
  <form name="frmImage" enctype="multipart/form-data" action="" method="post" class="frmImageUpload">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Title</label>
  	  <input type="text" name="title" value="<?php echo $title; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Date  of Upload</label>
  	  <input type="date" name="date" value="<?php echo $date; ?>">
  	</div>


  	<div class="input-group">
      <label> upload the pdf </label>
      <input name="userImage" type="file" class="inputFile" />

    </div>
  	
  	<div class="input-group">
  	  <!--<button type="submit" class="btn" name="upload_notice">UPLOAD</button>-->
      <input type="submit" value="Submit" class="btnSubmit" />
  	</div>
  	
  </form>
</body>
</html>