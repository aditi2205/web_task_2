<?php
echo "h";$db = mysqli_connect('localhost', 'root', 'A23690108', 'registration');

if(!$db)
{
  die("Connection error: " . mysqli_connect_errno());
}

$sql = "SELECT imageId FROM output_images "; 
$result = mysqli_query($db,$sql);
?>
<HTML>
<HEAD>
<TITLE>List BLOB Images</TITLE>
<link href="imageStyles.css" rel="stylesheet" type="text/css" />
</HEAD>
<BODY>
<?php
while($row = mysqli_fetch_assoc($result)) {

?>
<a href="imageView.php?image_id=<?php echo $row["imageId"]; ?>"> link</a><br/>
<?php		
}

?>
</BODY>
</HTML>