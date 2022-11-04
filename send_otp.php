<?php

  // Start session   
  session_start();

  // Include database connection file

  include_once('config.php');

  // Send OTP to mobile Form post
   if (isset($_POST['mobile'])) {
      
      $mobile = $con->real_escape_string($_POST['mobile']);
      $otp    = mt_rand(1111, 9999);
      $query  = "SELECT * FROM users WHERE mobile_number = '$mobile'";
      $result = $con->query($query);

      if ($result->num_rows > 0) {
         $con->query("UPDATE users SET otp = '$otp' WHERE mobile_number = '$mobile'");
         // Check mobile number is not empty than send OTP
         if (!empty($mobile)) {
            sendSMS($mobile, $otp);
            $_SESSION['MOBILE'] = $mobile;
         }
         echo "yes";
      }else{
         echo "no";
      }            
   }


   // Create a common function for send SMS
   function sendSMS($mobile, $otp) {
   
   	//echo "====$mobile === $otp";
      // Account details
     /* $apiKey = "Ac60362bc5b7b66ec2e8d5bc1054c0121";
	  $message = rawurlencode('Your One Time Password is '.$otp.' for verification your account.');
	  $senderId = "KLRHXA";
	  $baseUrl = "https://api.kaleyra.io/v1/HXIN1725039450IN/messages";
	  $apiBaseUrl = $baseUrl."&method=sms&message=".$message."&to=".$mobile."&sender=".$senderId;
	//  echo "-=-=-=-=-=>>>> ".$apiBaseUrl;
	 // echo $apiBaseUrl = "https://alerts.sinfini.com/api/web2sms.php?username=qarmatek&password=dhaval12345&sender=QRMTEK&to=8980577565&message=$otp";
  	
      // Send the POST request with cURL
      $body = "to=+1".$mobile."&sender=".$senderId."&type=TXN&body=".$message."&source=API&template_id=";
	  $ch = curl_init($baseUrl);
	  $headers = [
			'Content-Type: application/x-www-form-urlencoded; charset=utf-8',
			'api-key: '.$apiKey,
		];
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	  
	 // $body = ''
	  
	  curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
      curl_setopt( $ch, CURLOPT_POSTFIELDS, $body );
	  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	//  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      print_r($ch);
	  $response = curl_exec($ch);
      var_dump($response);exit;
	  curl_close($ch);      
      // Process your response here
      return $response;*/
	  
	  $curl = curl_init();

	curl_setopt_array($curl, array(
		  CURLOPT_URL => 'http://alerts.sinfini.com/api/web2sms.php?username=qarmatek&password=dhaval12345&sender=MOBEXX&to='.$mobile.'&message=Dear%20Customer,%20your%20mobex%20OTP%20is%20'.$otp.'%20Use%20this%20OTP%20to%20get%20an%20estimate.',
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_HTTPHEADER => array(
			'Cookie: AWSALB=NzYlpP9GWFEhpfqrZo7dvy/+TMRajSBh0FtKQMA6Vrd5szuJ4ITd4E0egqcKNtAFADD6m8Hgav1IqSBFidjut+SGh5A+thl59xkGKxsVC05vS9p41l++n1xgGTTa; AWSALBCORS=NzYlpP9GWFEhpfqrZo7dvy/+TMRajSBh0FtKQMA6Vrd5szuJ4ITd4E0egqcKNtAFADD6m8Hgav1IqSBFidjut+SGh5A+thl59xkGKxsVC05vS9p41l++n1xgGTTa'
		  ),
		));
		
		$response = curl_exec($curl);
		
		curl_close($curl);
		//echo "yes";
	  
   }
   
   
   
   function sendSMSMobexx($mobile, $otp) {
   
   	echo "====$mobile === $otp";
      // Account details
      $apiKey = "902425lo98xxxxxxxxxxxxxxxxxxxxxxxxx";
	  $message = rawurlencode('Your One Time Password is '.$otp.' for verification your account.');
	  $senderId = "MOBEXX";
	  $baseUrl = "https://alerts.solutionsinfini.com/api/v4/?api_key=".$apiKey;
	  $apiBaseUrl = $baseUrl."&method=sms&message=".$message."&to=".$mobile."&sender=".$senderId;
	  echo "-=-=-=-=-=>>>> ".$apiBaseUrl;
	 // echo $apiBaseUrl = "https://alerts.sinfini.com/api/web2sms.php?username=qarmatek&password=dhaval12345&sender=QRMTEK&to=9426039129&message=$otp";
  	
      // Send the POST request with cURL
      $body = "";
	  $ch = curl_init($apiBaseUrl);
	  curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
      curl_setopt( $ch, CURLOPT_POSTFIELDS, $body );
	  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	//  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      print_r($ch);
	  $response = curl_exec($ch);
      var_dump($response);exit;
	  curl_close($ch);      
      // Process your response here
      return $response;
   }
    function sendSMSOld($mobile, $otp) {
      // Account details
      $apiKey = urlencode('Your API key');
      // Message details
      $numbers = array($mobile);
      $sender  = urlencode('TXTLCL');
      $message = rawurlencode('Your One Time Password is '.$otp.' for verification your account.');
      $numbers = implode(',', $numbers);
    
      // Prepare data for POST request
      $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);

      // Send the POST request with cURL
      $ch = curl_init('https://api.textlocal.in/send/');
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      curl_close($ch);      
      // Process your response here
      return $response;
   }

?>