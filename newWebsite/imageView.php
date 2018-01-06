<?php
$db = mysqli_connect('localhost', 'root', 'A23690108', 'registration');

if(!$db)
{
  die("Connection error: " . mysqli_connect_errno());
}
if(isset($_GET['image_id']) ) {
	
$sql = "SELECT imageType,imageData FROM output_images WHERE imageId=".$_GET['image_id'];
$result= mysqli_query($db, $sql);

if($result)

{
	$row = mysqli_fetch_assoc($result);

//$row = mysql_fetch_array($result);
header("Content-type: " . $row["imageType"]);
echo $row["imageData"];


}

}else{
	echo "sorry";
}

?>