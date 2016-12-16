<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="mycss/loginstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
		<a href="home.php">
		<img border="0" alt="home" src="img\home.png" width="150" height="150"></a>
		
        <div class="sellimg"  align="center" >
    	<p>
            <a href="allproducts.php">
            <img border="0" alt="store" src="img\bid.png" width="200" height="200"></a>
		</p>
    	
        <div class="explain">
        <p align="justify">All products that have been put for auction by Auction System users are shown here. To bid on a product, you should choose one and then click on the "Put a bid" button.
         </p> 
	</div>
        
    </div>
        
        
    <?php
		
		session_start();
		$info = $_SESSION['user'];
		$xmlinfo=simplexml_load_string($info) or die("Error: Cannot create object");
		$ID = $xmlinfo->custID;	
		?>
    <form method="post" action="bid.php">  
 		
        <div class="container">
        <ul>
        <label><b>All available products that you can put a bid on:</b></label>
        <li>
 		<p><?php 
		
			$response= file_get_contents("http://auctionmanagementservice.appspot.com/rest/manage/info");
			$xml=simplexml_load_string($response);
			$xmllength = count($xml);
			$counter = 0;
			
			$products = array();
			
			while( $counter < $xmllength){
				
				/*Product(custID,productID,name,brand,itemcondition,status,startingPrice,startDate,sellDate,winnerID,description,sellPrice)*/
				$current = array("".$xml->product[$counter]->custID, "".$xml->product[$counter]->productID,
				"Product Name: ".$xml->product[$counter]->name, "Product Brand: ".$xml->product[$counter]->brand,
				"Condition: ". $xml->product[$counter]->itemcondition, "Status: ". $xml->product[$counter]->status,
				"Asking Price: ".$xml->product[$counter]->startingPrice, "Available from: ".$xml->product[$counter]->startDate,
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
					$owner = $xml->product[$counter]->custID;		
		
					if ($stat == "up" AND strcmp($owner,$ID)){
						$mystring = $xml->product[$counter]->name.' with '.$xml->product[$counter]->brand.' brand, 
						Condition: '.$xml->product[$counter]->itemcondition.', is up for auction for '.$xml->product[$counter]->startingPrice.' CAD, 
						available from : '.$xml->product[$counter]->startDate;
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
					echo '<input type="submit" class="putbtn" name="action" value="Put a bid" />';
					 
				}
				else{
					echo '<label><b>There are no products that you can bid on.</b></label>';
				}
			?>
          </div>      
	</form>
</body>
</html>