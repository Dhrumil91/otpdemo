<?php

  // Start session   
  session_start();

  // Include database connection file

  include_once('config.php');

  // Send OTP to email Form post
  if (isset($_POST['otp'])) {
     	
   	$otp    = $_POST['otp'];
   	$mobile = $_SESSION['MOBILE'];
 	  $query  = "SELECT * FROM users WHERE otp = '$otp' AND mobile_number = '$mobile'";
   	$result = $con->query($query);
    $row    = $result->fetch_array();
    
   	if ($result->num_rows > 0) {
       	$con->query("UPDATE users SET otp = '' WHERE mobile_number = '$mobile'");
        $_SESSION['NAME'] = $row['name'];
       	echo "yes";         
   	}else{
       	echo "no";
   	} 
                 
  }

?>