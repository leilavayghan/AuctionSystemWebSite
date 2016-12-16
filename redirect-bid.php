<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="mycss/loginstyle.css" rel="stylesheet" type="text/css">
</head>
			<span>You successfully put a bid :) go back <a href="home.php">home.</a></span>
<body>

<p><?php
			session_start();
			$info = $_SESSION['user'];
			$xmlinfo=simplexml_load_string($info) or die("Error: Cannot create object");
			$ID = $xmlinfo->custID;
			$price = $_POST['offer'];
			$product = $_POST['pid']; 
			
			$xml = '<bid>'.
						'<biddingDate></biddingDate>'.
						'<biddingTime></biddingTime>'.
						'<custID>'.$ID.'</custID>'.
						'<price>'.$price.'</price>'.
						'<productID>'.$product.'</productID>'.
					'</bid>';

			$url = "http://biddingservice-150217.appspot.com/rest/bid/upload";

			if ($ID != "null"){
			$ch = curl_init();
  			curl_setopt( $ch, CURLOPT_URL, $url );
  			curl_setopt( $ch, CURLOPT_POST, true );
  			curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
  			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  			curl_setopt( $ch, CURLOPT_POSTFIELDS, $xml );
  			$result = curl_exec($ch);
  			curl_close($ch);
			
			header('Location: yourbids.php');
  
}

?>.</p>

</body>
</html>