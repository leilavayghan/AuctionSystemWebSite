<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<p><?php
	
		
		session_start();
		if(isset($_POST['uname']))		{ $username = $_POST['uname']; } else $username = "null";
		if(isset($_POST['psw']))  		{ $password = $_POST['psw']; } else $password = "null";
		if(isset($_POST['fname']))		{ $firstname = $_POST['fname']; } else $firstname = "null";
		if(isset($_POST['lname']))		{ $lastname = $_POST['lname']; } else $lastname = "null";
		if(isset($_POST['email']))		{ $email = $_POST['email']; } else $email = "null";
		if(isset($_POST['phone']))		{ $phone = $_POST['phone']; } else $phone = "null";
		if(isset($_POST['address']))	{ $address = $_POST['address']; } else $address = "null";
		if(isset($_POST['city']))		{ $city = $_POST['city']; } else $city = "null";
		if(isset($_POST['country']))	{ $country = $_POST['country']; } else $country = "null";
		if(isset($_POST['postalcode']))	{ $postalcode = $_POST['postalcode']; } else $postalcode = "null";
		if(isset($_POST['dob']))		{ $dob = $_POST['dob']; } else $dob = "1099-01-01";
		
			$xml = '<user>'.
						'<address>'.$address.'</address>'.
						'<city>'.$city.'</city>'.
						'<country>'.$country.'</country>'.
						'<custID></custID>'.
						'<DOB>'.$dob.'</DOB>'.
						'<email>'.$email.'</email>'.
						'<firstname>'.$firstname.'</firstname>'.
						'<lastname>'.$lastname.'</lastname>'.
						'<password>'.$password.'</password>'.
						'<phone>'.$phone.'</phone>'.
						'<postalcode>'.$postalcode.'</postalcode>'.
						'<registrationDate>1099-01-01</registrationDate>'.
						'<username>'.$username.'</username>'.
					'</user>';

$url = "http://regauthservice.appspot.com/rest/RegAuth/register";

if ($username != "null"){
	$ch = curl_init();
  	curl_setopt( $ch, CURLOPT_URL, $url );
  	curl_setopt( $ch, CURLOPT_POST, true );
  	curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
  	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  	curl_setopt( $ch, CURLOPT_POSTFIELDS, $xml );
  	$result = curl_exec($ch);
  	curl_close($ch);
  
 	$condition = substr($result,0,1);
  	if( $condition == "y") {
			
			$info= file_get_contents("http://regauthservice.appspot.com/rest/RegAuth/register/info/login/$username");
			$_SESSION['user'] = $info;
			header('Location: home.php');	
		}
		else{
			echo header('Location: usernametaken.html');;
		}
}

?>.</p>
</body>
</html>