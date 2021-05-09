<?php

$name = $_POST['name'];
$number  = $_POST['number'];
$pnumber = $_POST['pnumber'];
$email= $_POST['email'];
$address= $_POST['address'];
$area= $_POST['area'];
$department= $_POST['department'];
$year= $_POST['year'];
$password= $_POST['password'];
$cpassword= $_POST['cpassword'];




if (!empty($name) || !empty($number) || !empty($pnumber) || !empty($email) || !empty($address) || !empty($area) || !empty($department)  || !empty($year) || !empty($password)  || !empty($cpassword)  )
{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "user";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From registeruser Where email = ? Limit 1";
  $INSERT = "INSERT Into registeruser(name , number , pnumber , email , address , area , department ,year , password , cpassword )values(?,?,?,?,?,?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking name
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("siissssiss", $name,$number,$pnumber,$email,$address,$area,$department,$year,$password,$cpassword);
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