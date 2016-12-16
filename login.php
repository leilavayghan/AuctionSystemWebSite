<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<p><?php 
		session_start();
		$username= $_POST['uname'];
		$password= $_POST['psw'];
		$response= file_get_contents("http://regauthservice.appspot.com/resources/RegAuth/authenticate/$username&$password");
		$condition = substr($response,0,1);
		
		if( $condition == "w") {
			header('Location: WrongLogin.html');
		}
		else{
			
			$info= file_get_contents("http://regauthservice.appspot.com/rest/RegAuth/register/info/login/$username");
			$_SESSION['user'] = $info;
			header('Location: home.php');
			
		}
		
		?>.</p>
</body>
</html>