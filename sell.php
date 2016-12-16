<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<p><?php
		
		session_start();
		$info = $_SESSION['user'];
		$xmlinfo=simplexml_load_string($info) or die("Error: Cannot create object");
		$ID = $xmlinfo->custID;
		
		if(isset($_POST['name']))		{ $pname = $_POST['name']; } else $pname = "null";
		if(isset($_POST['price']))  	{ $aprice = $_POST['price']; } else $aprice = "null";
		if(isset($_POST['brand']))		{ $pbrand = $_POST['brand']; } else $pbrand = "null";
		if(isset($_POST['condition']))	{ $pcondition = $_POST['condition']; } else $pcondition = "null";
		if(isset($_POST['description'])){ $pdescription = $_POST['description']; } else $pdescription = "null";
		if(isset($_POST['phone']))		{ $phone = $_POST['phone']; } else $phone = "null";
		
			$xml = '<product>'.
						'<brand>'.$pbrand.'</brand>'.
						'<custID>'.$ID.'</custID>'.
						'<description>'.$pdescription.'</description>'.
						'<itemcondition>'.$pcondition.'</itemcondition>'.
						'<name>'.$pname.'</name>'.
						'<productID></productID>'.
						'<sellDate></sellDate>'.
						'<sellPrice></sellPrice>'.
						'<startDate></startDate>'.
						'<startingPrice>'.$aprice.'</startingPrice>'.
						'<status></status>'.
						'<winnerID></winnerID>'.
					'</product>';

$url = "http://advertisementservice-149821.appspot.com/rest/ad/upload";

if ($ID != "null"){
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
			header('Location: yourstore.php');	
		}
		else{
			echo header('Location: advertisement.php');;
		}
}

?>.</p>
</body>
</html>