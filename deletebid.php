<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>delete bid</title>
</head>

<body>
<?php

				session_start();
				$info = $_SESSION['user'];
				$xmlinfo=simplexml_load_string($info) or die("Error: Cannot create object");
				$ID = $xmlinfo->custID;
				$selected = $_POST['myproduct'];
				$response= file_get_contents("http://biddingservice-150217.appspot.com/rest/bid/delete/$ID&$selected");	
						
				$condition = substr($response,0,1);
				if( $condition == "d") {
					header('Location: yourbids.php');	
				}
				else{
					echo header('Location: error.html');
				}

?>

</body>
</html>