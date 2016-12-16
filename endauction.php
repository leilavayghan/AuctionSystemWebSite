<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<?php
		session_start();
		$info = $_SESSION['user'];
		$xmlinfo=simplexml_load_string($info) or die("Error: Cannot create object");
		$ID = $xmlinfo->custID;
		$selected = $_POST['myproduct'];
		$response= file_get_contents("http://advertisementservice-149821.appspot.com/rest/ad/exit/$ID&$selected");	
				
		$condition = substr($response,0,1);
  		if( $condition == "e") {
			header('Location: itemsupforauction.php');	
		}
		else{
			echo header('Location: error.html');;
		}
		
	?>

</body>
</html>