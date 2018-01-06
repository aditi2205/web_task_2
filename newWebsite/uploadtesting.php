<?php

// GrabFile.php: Takes the details

// of the new file posted as part

// of the form and adds it to the

// myBlobs table of our myFiles DB.

global $strDesc;

global $fileUpload;

global $fileUpload_name;

global $fileUpload_size;

global $fileUpload_type;
if(empty($strDesc) || $fileUpload == "none")

die("You must enter both a description and file");
$dbServer = "localhost";

$dbDatabase = "myFiles";

$dbUser = "admin";

$dbPass = "password";

$fileHandle = fopen($fileUpload, "r");

$fileContent = fread($fileHandle, $fileUpload_size);

$fileContent = addslashes($fileContent);



$sConn = mysql_connect($dbServer, $dbUser, $dbPass)

or die("Couldn't connect to database server");



$dConn = mysql_select_db($dbDatabase, $sConn)

or die("Couldn't connect to database $dbDatabase");


$dbQuery = "INSERT INTO myBlobs VALUES ";

$dbQuery .= "(0, '$strDesc', '$fileContent', '$fileUpload_type')";



mysql_query($dbQuery) or die("Couldn't add file to database");


echo "<h1>File Uploaded</h1>";

echo "The details of the uploaded file are shown below:<br><br>";

echo "<b>File name:</b> $fileUpload_name <br>";

echo "<b>File type:</b> $fileUpload_type <br>";

echo "<b>File size:</b> $fileUpload_size <br>";

echo "<b>Uploaded to:</b> $fileUpload <br><br>";

echo "<a href='uploadfile.php'>Add Another File</a>";

?>