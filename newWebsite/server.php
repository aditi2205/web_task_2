<?php
session_start();

// variable declaration
$username = "";
$email    = "";
$rollno = "";
$address = "";
$access = "";
$errors = array(); 
$_SESSION['success'] = "";

// connect to database
$db = mysqli_connect('localhost', 'root', 'A23690108', 'registration');

if(!$db)
{
  die("Connection error: " . mysqli_connect_errno());
}
// REGISTER USER
if (isset($_POST["reg_user"])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST["username"]);
  $email = mysqli_real_escape_string($db, $_POST["email"]);
  $password_1 = mysqli_real_escape_string($db, $_POST["password_1"]);
  $password_2 = mysqli_real_escape_string($db, $_POST["password_2"]);
  $rollno = mysqli_real_escape_string($db, $_POST["rollno"]);
  $address = mysqli_real_escape_string($db, $_POST["address"]);
  $access = mysqli_real_escape_string($db, $_POST["access"]);

  // form validation: ensure that the form is correctly filled
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
  array_push($errors, "The two passwords do not match");
  if (empty($rollno)) { array_push($errors, "Roll number is required"); }
  if (empty($address)) { array_push($errors, "Address is required"); }
   if (empty($access)) { array_push($errors, "Access type is required"); }
  }

  // register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password_1);//encrypt the password before saving in the database
    $query = "INSERT INTO igdtuw(username, email, password, rollno, address, access) 
          VALUES('$username', '$email', '$password', '$rollno', '$address', '$access')";
    if(!mysqli_query($db, $query))
      {
        echo("Error description: " . mysqli_error($db));
      }
    $_SESSION['username'] = $username;
    $_SESSION['rollno'] = $rollno;
    $_SESSION['address'] = $address;
    $_SESSION['access'] = $access;
    $_SESSION['success'] = "You are now logged in";
    header('location: index.html');
  }

}

// ... 
// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $access = mysqli_real_escape_string($db, $_POST["access"]);
  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }
  if (empty($access)) {
    array_push($errors, "Access type is required");
  }
 

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM igdtuw WHERE username='$username' AND password='$password'";
    

    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      while($row = mysqli_fetch_assoc($results)) {
        $rollno= $row["rollno"];
        $address= $row["address"];
    }
    if (empty($rollno)) { array_push($errors, "Roll number is required"); }
    if (empty($address)) { array_push($errors, "Address is required"); }


      $_SESSION['username'] = $username;
      $_SESSION['rollno'] = $rollno;
      $_SESSION['address'] = $address;
      $_SESSION['access'] = $access;

      $_SESSION['success'] = "You are now logged in";
      header('location: index.html');
    }
    else {
      array_push($errors, "Wrong username/password combination");
      header('location: login_fail.php');
    }
  }
}

// EDIT ADDRESS
if (isset($_POST['edit_address'])) {
  $new_addr = mysqli_real_escape_string($db, $_POST['address1']);
  $old_addr= $_SESSION['address'];
  $username= $_SESSION['username'] ;
  if (empty($new_addr)) {
    array_push($errors, "New address is required");
  }
  if (empty($old_addr)) {
    array_push($errors, "Old address is required");
  }
 

  if (count($errors) == 0) {
    $password = md5($password);
    $query1 = "UPDATE igdtuw SET address='$new_addr' WHERE address='$old_addr' AND username='$username'";
    if ($db->query($query1) === TRUE) {
    echo "Record updated successfully";
    $_SESSION['address'] = $new_addr;
    header('location: index.php');
    } else {
        echo "Error updating record: " . $db->error;
    }

    
  }
}

// EDIT PASSWORD
if (isset($_POST['edit_password'])) {
  //old
  $password1 = mysqli_real_escape_string($db, $_POST["password1"]);
  //new
  $password2 = mysqli_real_escape_string($db, $_POST["password2"]);
  //confirm new
  $password3 = mysqli_real_escape_string($db, $_POST["password3"]);

  $username= $_SESSION['username'] ;

  if (empty($password1)) { array_push($errors, "Existing Password is required"); }
  if (empty($password2)) { array_push($errors, "New Password is required"); }
  if (empty($password3)) { array_push($errors, "Confirm New Password is required"); }
  if ($password2 != $password3) {
  array_push($errors, "The two passwords do not match");
  }
  //check if existing password is correct with the help of username
  $query = "SELECT * FROM igdtuw WHERE username='$username'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      while($row = mysqli_fetch_assoc($results)) {
        $old_password= $row["password"];
        }
      }
    $password1 = md5($password1);
    if($password1 != $old_password)
    {
      array_push($errors, "Existing password is incorrect");
    }

  //update password in database

  if (count($errors) == 0) {
    $password2 = md5($password2);
    $query1 = "UPDATE igdtuw SET password='$password2' WHERE password='$password1' AND username='$username' ";
    if ($db->query($query1) === TRUE) {
    echo "Record updated successfully";
    header('location: login.php');
    } else {
        echo "Error updating record: " . $db->error;
    }

    
  }

}



// FORGOT PASSWORD: EMAIL ID
if (isset($_POST['fp1'])) {
  
$email1 = mysqli_real_escape_string($db, $_POST['email1']);
  if (empty($email1)) {
    array_push($errors, "email address is required");
  }
   $_SESSION['email1']=$email1;

  if (count($errors) == 0) {
      echo 'inside the script';
      require 'PHPMailer/PHPMailerAutoload.php';
      echo 'file included';
      $mail = new PHPMailer;
      echo 'instance created';
      $mail->isSMTP();                            // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                     // Enable SMTP authentication
      $mail->Username = 'aditigunjanigdtuw@gmail.com';          // SMTP username
      $mail->Password = 'aditigunjan'; // SMTP password
      $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;                          // TCP port to connect to

      $mail->setFrom('aditigunjanigdtuw@gmail.com', 'Aditi');
      $mail->addReplyTo('aditigunjanigdtuw@gmail.com', 'Aditi');
      $mail->addAddress($email1);   // Add a recipient


      $mail->isHTML(true);  // Set email format to HTML

      $rand_num= mt_rand(100000, 999999);
      $_SESSION['rand_num'] = $rand_num;
      $bodyContent = $rand_num;
      $bodyContent .= '<p>This is the HTML email sent from localhost using PHP script</p>';

      $mail->Subject = 'Email from Registration System';
      $mail->Body    = $bodyContent;

      if($mail->send()) {
          header('location:enter_otp.php');
          echo 'Message has been sent';
          
      } else {
          
        echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $mail->ErrorInfo;  
      }

}
}

//validate otp

if (isset($_POST['fp2'])) {

  $otp = mysqli_real_escape_string($db, $_POST['otp']);
  if (empty($otp)) {
    array_push($errors, "otp is required");
  }
  $old_otp= $_SESSION['rand_num'];
    if($old_otp != $otp)
    {
      array_push($errors, "otp do not match");
    }
  

  
  if (count($errors) == 0) {

     header('location: set_password.php');
  }
}


//reset password
if (isset($_POST['reset_password'])) {

       $pass = mysqli_real_escape_string($db, $_POST['password']);
       $pass1 = mysqli_real_escape_string($db, $_POST['password_2']);
       
       if(empty($pass)){ array_push($errors, "password is required"); }
       if($pass != $pass1){ array_push($errors, "password do not match"); }
       $pass=md5($pass);
       if (count($errors) == 0) {
        $user = $_SESSION['email1'];
         $query = "UPDATE igdtuw SET password= '$pass' WHERE email='$user'";
         $results = mysqli_query($db, $query);
         header('location: login.php');

       }else {
        echo "" . $db->error;
        }



}

if (isset($_POST['upload_notice'])) {


      //title, date, content
  
       $title = mysqli_real_escape_string($db, $_POST['title']);
       $date = mysqli_real_escape_string($db, $_POST['date']);
       $fileUpload= mysqli_real_escape_string($db, $_POST['file1']);
       $fileUpload_size = '200';
       if(empty($fileUpload)){ array_push($errors, "file content should not be empty"); }
        if(empty($title)){ array_push($errors, "title should not be empty"); }
        if(empty($date)){ array_push($errors, "date should not be empty"); }
        if (count($errors) == 0) {
       $fileHandle = fopen($fileUpload, "r");

       $fileContent = fread($fileHandle, $fileUpload_size);

       $fileContent = addslashes($fileContent);
       $query = "INSERT INTO notices (title, date_, content) VALUES ('$title', '$date','$fileContent')";
       mysqli_query($db, $query);
      header('location: index.html@q=uni_notices.html');
     }else {
        echo "" . $db->error;
        }

}

?>

