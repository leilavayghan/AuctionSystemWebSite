<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>items up for auction</title>
<link href="mycss/loginstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
    <a href="home.php">
		<img border="0" alt="home" src="img\home.png" width="150" height="150"></a>
        
        <div class="sellimg"  align="center" >
    	<p>
            <a href="itemsupforauction.php">
            <img border="0" alt="store" src="img\up.png" width="200" height="200"></a>
		</p>
        
        <div class="explain">
        <p align="justify">The products that you have put for auction are shown here.</p> 
	</div>
        
        
        </div>
    <?php
		
		session_start();
		$info = $_SESSION['user'];
		$xmlinfo=simplexml_load_string($info) or die("Error: Cannot create object");
		$ID = $xmlinfo->custID;	
	?>
    <form method="post" action="endauction.php">  
 		
        <div class="container">
        <ul>
        <label><b>Your items that are up for auction:</b></label>
        <li>
        
 		<p><?php 
		
			$response= file_get_contents("http://advertisementservice-149821.appspot.com/rest/ad/yourproducts/$ID");
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
				$availables = 0;
				while( $counter < $xmllength){
					
					$stat = $xml->product[$counter]->status;
					if ($stat == "up"){
						$mystring = $xml->product[$counter]->name.' with '.$xml->product[$counter]->brand.' brand, 
						Condition: '.$xml->product[$counter]->itemcondition.', has been up for auction for '.$xml->product[$counter]->startingPrice.' CAD, 
						from: '.$xml->product[$counter]->startDate;
						$availables++;
						echo '<li>';
						echo '<input type="radio" id="'.$xml->product[$counter]->productID.'" name="myproduct" value="'."".$xml->product[$counter]->productID.'">';
    					echo '<label for="'.$xml->product[$counter]->productID.'">'.$mystring.'</label>';
						echo '<div class="check"></div>';
						echo '</li>';
					}
					$counter++;
				}
				echo '</li>';
           		echo '</ul>';
				
				if ($availables > 0){
					
					echo '<p>    .   <br></p>';
					echo '<button type="submit" class="putbtn">End Auction For This Product</button>';
					 
				}
				else{
					echo '<label><b>you have no available products that are up for auction.</b></label>';
				}
				
			?>
  	 	  </div> 
	</form>
    
           
</body>
</html>