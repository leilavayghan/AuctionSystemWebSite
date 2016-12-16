<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Your Bids!</title>
<link href="mycss/loginstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
    <a href="home.php">
		<img border="0" alt="home" src="img\home.png" width="150" height="150"></a>
        
    <div class="sellimg"  align="center" >
    <p>
        <a href="yourbids.php">
		<img border="0" alt="store" src="img\yourbids.png" width="200" height="200"></a>
	</p>
    
     <div class="explain">
        <p align="justify">The bids you have put on products through Auction System are shown here.
         </p> 
	</div>
    
    </div>    
    <?php
		
		session_start();
		$info = $_SESSION['user'];
		$xmlinfo=simplexml_load_string($info) or die("Error: Cannot create object");
		$ID = $xmlinfo->custID;	
	?>
    <form method="post" action="deletebid.php">  
 		
        <div class="container">
        <ul>
        <label><b>History of all your bids:</b></label>
        <li>
 		<p><?php 
		
			$response= file_get_contents("http://biddingservice-150217.appspot.com/rest/bid/info/user/$ID");
			$xml=simplexml_load_string($response);
			$xmllength = count($xml);
			$counter = 0;
			
			$bids = array();
			
			while( $counter < $xmllength){
				
					$current = array("".$xml->bid[$counter]->custID, "".$xml->bid[$counter]->productID,
					"bidding Date: ".$xml->bid[$counter]->biddingDate,
					"Condition: ". $xml->bid[$counter]->price,nl2br ("\n"));
					array_push($bids, $current);
				$counter++;
			}
		?></p>
          			
            <?php 
			
				$arraylength = $counter;
				$counter = 0;
				$availables = 0;
				while( $counter < $xmllength){
						
						
						$selected = $xml->bid[$counter]->productID;
		
						$response= file_get_contents("http://advertisementservice-149821.appspot.com/rest/ad/info/$selected");
						$xmlp=simplexml_load_string($response);
						
						$mystring = ' You put a bid on a product ( Name: '.$xmlp->name.' , Brand: '.$xmlp->brand.' , Starting Price: '.$xmlp->startingPrice.' CAD ) on '
						.$xml->bid[$counter]->biddingDate.', for '.$xml->bid[$counter]->price. ' CAD';
						$availables++;
						echo '<li>';
						echo '<input type="radio" id="'.$xml->bid[$counter]->productID.'" name="myproduct" value="'."".$xml->bid[$counter]->productID.'">';
    					echo '<label for="'.$xml->bid[$counter]->productID.'">'.$mystring.'</label>';
						echo '<div class="check"></div>';
						echo '</li>';
					
					$counter++;
				}
				
				echo '</li>';
           		echo '</ul>';
				
				if ($availables > 0){
					
					echo '<p>    .   <br></p>';
					echo '<input type="submit" class="delbtn" name="action" value="Delete This Bid" />';
					 
				}
				else{
					echo '<label><b>you have no bids.</b></label>';
				}
			?>
  	 	 </div>  
	</form>
        
</body>
</html>