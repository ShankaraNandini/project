<?php

$username = $_POST['username'];
$number  = $_POST['number'];
$bnumber = $_POST['bnumber'];
$password= $_POST['password'];
$cpassword= $_POST['cpassword'];




if (!empty($username) || !empty($number) || !empty($bnumber) || !empty($password) || !empty($cpassword) )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "admin";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT bnumber From register Where bnumber = ? Limit 1";
  $INSERT = "INSERT Into register (username , number , bnumber , password , cpassword )values(?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $bnumber);
     $stmt->execute();
     $stmt->bind_result($bnumber);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssss", $username,$number,$bnumber,$password,$cpassword);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>