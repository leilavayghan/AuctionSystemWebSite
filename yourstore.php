<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>your store</title>
<link href="mycss/loginstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
    <a href="home.php">
		<img border="0" alt="home" src="img\home.png" width="150" height="150"></a>
        
    <div class="sellimg"  align="center" >
    <p>
        <a href="yourstore.php">
		<img border="0" alt="store" src="img\yourstore.png" width="200" height="200"></a>
	</p>
    
    <div class="explain">
        <p align="justify">The products you see here are a list of products that you have saved before but are not up for auction yet.
        To put a saved product on auction, simply choose one of the products and click on the "put for auction" button. To add a new product, click on the "add a new product" button.
         </p> 
	</div>
    
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
        <label><b>All your saved products that can be put for auction:</b></label>
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
					if ($stat == "available"){
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
					echo '<input type="submit" class="putbtn" name="action" value="Put Up For Auction" />';
					echo '<input type="submit" class="delbtn" name="action" value="Delete This Product" />';
					 
				}
				else{
					echo '<label><b>you have no available products that can be put for auction.</b></label>';
				}
			?>
  	 	   </div>
            
	</form>
    
   
    
    <form action="advertisement.php" method="post">
    	<div class="container">
    	<h2 align="center"> OR </h2>
    	<button type="submit" class="submitbtn">Add a new product</button>
        </div>
    </form>
        
</body>
</html>