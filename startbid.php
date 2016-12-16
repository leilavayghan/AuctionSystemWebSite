<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="mycss/loginstyle.css" rel="stylesheet" type="text/css">
</head>

<body>

	<?php
	
		if ($_POST['action'] == 'Put Up For Auction') {
    			session_start();
				$info = $_SESSION['user'];
				$xmlinfo=simplexml_load_string($info) or die("Error: Cannot create object");
				$ID = $xmlinfo->custID;
				$selected = $_POST['myproduct'];
				$response= file_get_contents("http://advertisementservice-149821.appspot.com/rest/ad/start/$selected");	
						
				$condition = substr($response,0,1);
				if( $condition == "u") {
					header('Location: itemsupforauction.php');	
				}
				else{
					echo header('Location: error.html');
				}
		
		} else if ($_POST['action'] == 'Delete This Product') {
    			session_start();
				$info = $_SESSION['user'];
				$xmlinfo=simplexml_load_string($info) or die("Error: Cannot create object");
				$ID = $xmlinfo->custID;
				$selected = $_POST['myproduct'];
				$response= file_get_contents("http://advertisementservice-149821.appspot.com/rest/ad/delete/$ID&$selected");	
						
				$condition = substr($response,0,1);
				if( $condition == "d") {
					header('Location: yourstore.php');	
				}
				else{
					echo header('Location: error.html');
				}
		} else {
    
		}
		
		
	?>

</body>
</html>