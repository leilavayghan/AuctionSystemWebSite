<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>your store</title>
<link href="mycss/loginstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
    
    <a href="home.php">
		<img border="0" alt="sell" src="img\home.png" width="80" height="80"></a>
    <?php
		
		session_start();
		$info = $_SESSION['user'];
		$xmlinfo=simplexml_load_string($info) or die("Error: Cannot create object");
		$ID = $xmlinfo->custID;	
	?>
    <form method="post" action="startbid.php">  
 
 		<p><?php 
		
			$response= file_get_contents("http://advertisementservice-149821.appspot.com/rest/ad/yourproducts/$ID");
			$xml=simplexml_load_string($response) or die("Error: Cannot create object");
			$xmllength = count($xml);
			$counter = 0;
			
			$products = array();
			
			while( $counter < $xmllength){
				
				/*Product(custID,productID,name,brand,itemcondition,status,startingPrice,startDate,sellDate,winnerID,description,sellPrice)*/
				$current = array("".$xml->product[$counter]->custID, "".$xml->product[$counter]->productID,
				"Product Name: ".$xml->product[$counter]->name, "Product Brand: ".$xml->product[$counter]->brand,
				"Condition: ". $xml->product[$counter]->itemcondition, "Status: ". $xml->product[$counter]->status,
				"Asking Price: ".$xml->product[$counter]->startingPrice, "Added on: ".$xml->product[$counter]->startDate,
				"Sold on: ".$xml->product[$counter]->sellDate, "Winner: ".$xml->product[$counter]->winnerID,
				"Description: ".$xml->product[$counter]->description, "Sold for: ".$xml->product[$counter]->sellPrice,nl2br ("\n"));
				array_push($products, $current);					
				$counter++;
			}
		?></p>
        
  		All your products: <br>
  			
            <?php 
			
				$arraylength = $counter;
				$counter = 0;
				
				while( $counter < $xmllength){
					
					$mystring = $xml->product[$counter]->name.' with '.$xml->product[$counter]->brand.' brand, 
					Condition: '.$xml->product[$counter]->itemcondition.', is up for auction for '.$xml->product[$counter]->startingPrice.' CAD, 
					available from : '.$xml->product[$counter]->startDate;
					
								
					echo '<input type="radio" name="myproduct" value="'."".$xml->product[$counter]->productID.'">' .$mystring.'<br>';
					$counter++;
				}
			?>   
	</form>
        
</body>
</html>