<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Your Wins</title>
<link href="mycss/loginstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
    <a href="home.php">
		<img border="0" alt="home" src="img\home.png" width="150" height="150"></a>
        
     <div class="sellimg"  align="center" >
    <p>
        <a href="yourwins.php">
		<img border="0" alt="store" src="img\wins.png" width="200" height="200"></a>
	</p>
    
    <div class="explain">
        <p align="justify">The products that you have won the auction for are shown here.</p>
    
    </div>     
    <?php
		
		session_start();
		$info = $_SESSION['user'];
		$xmlinfo=simplexml_load_string($info) or die("Error: Cannot create object");
		$ID = $xmlinfo->custID;	
	?>
    <form method="post" action="startbid.php">  
 		
        
        <div class="container">
        <ul>
        <label><b>All your wins:</b></label>
        <li>
 		<p><?php 
		
			$response= file_get_contents("http://advertisementservice-149821.appspot.com/rest/ad/yourwins/$ID");
			$xml=simplexml_load_string($response);
			$xmllength = count($xml);
			$counter = 0;
			
			$products = array();
			
			while( $counter < $xmllength){
				
				/*Product(custID,productID,name,brand,itemcondition,status,startingPrice,startDate,sellDate,winnerID,description,sellPrice)*/
				
				
					$current = array("".$xml->product[$counter]->custID, "".$xml->product[$counter]->productID,
					"Product Name: ".$xml->product[$counter]->name, "Product Brand: ".$xml->product[$counter]->brand,
					"Condition: ". $xml->product[$counter]->itemcondition, "Status: ". $xml->product[$counter]->status,
					"Asking Price: ".$xml->product[$counter]->startingPrice, "Saved on: ".$xml->product[$counter]->startDate,
					"Sold on: ".$xml->product[$counter]->sellDate, "Winner: ".$xml->product[$counter]->winnerID,
					"Description: ".$xml->product[$counter]->description, "Sold for: ".$xml->product[$counter]->sellPrice,nl2br ("\n"));
					array_push($products, $current);
				$counter++;
			}
		?></p>
  			
            <?php 
			
				$arraylength = $counter;
				$counter = 0;
				
				while( $counter < $xmllength){
					
					$stat = $xml->product[$counter]->status;
					//if ($stat == "sold"){
						$mystring = $xml->product[$counter]->name.' with '.$xml->product[$counter]->brand.' brand, 
						Condition: '.$xml->product[$counter]->itemcondition.', was up for auction for '.$xml->product[$counter]->startingPrice.' CAD, 
						and was sold on: '.$xml->product[$counter]->sellDate.', for '.$xml->product[$counter]->sellPrice.' CAD';
						
						echo '<li>';
						echo '<input type="radio" id="'.$xml->product[$counter]->productID.'" name="myproduct" value="'."".$xml->product[$counter]->productID.'">';
    					echo '<label for="'.$xml->product[$counter]->productID.'">'.$mystring.'</label>';
						echo '<div class="check"></div>';
						echo '</li>';
					//}
					$counter++;
				}
				echo '</li>';
           		echo '</ul>';
			?>
  	 	  </div> 
	</form>
    
           
</body>
</html>