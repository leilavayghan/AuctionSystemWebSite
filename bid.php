<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Bid!</title>
<link href="mycss/loginstyle.css" rel="stylesheet" type="text/css">
</head>

<body>

		<a href="home.php">
		<img border="0" alt="home" src="img\home.png" width="150" height="150"></a>
        
        <div class="sellimg"  align="center" >
    	<p>
            
            <img border="0" alt="store" src="img\bid.png" width="200" height="200">
		</p>
    
    </div>
	<?php
		
		session_start();
		$info = $_SESSION['user'];
		$xmlinfo=simplexml_load_string($info) or die("Error: Cannot create object");
		
		
		$selected = $_POST['myproduct'];
		
		$response= file_get_contents("http://advertisementservice-149821.appspot.com/rest/ad/info/$selected");
		$xml=simplexml_load_string($response) or die("Error: Cannot create object");
		
		$maxbid= file_get_contents("http://biddingservice-150217.appspot.com/rest/bid/maxbid/$selected");
		
		$num1 = $xml->startingPrice;
		$int1 = (int)$num1;
		
		$num2 = $maxbid;
		$int2 = (int)$num2;
		$minprice = max($int1,$int2);
		
		echo '<div class="explain">';				
		echo '<p align = "center">This product was put on auction with starting price of '.$xml->startingPrice.' CAD. The highest bid for this product is '.$maxbid.' CAD. What is your offer?</p>';
		echo '</div>';		
		
    ?>
    
    
	<form method="post" action="redirect-bid.php">
        
        	<div class="container">
        	<div class="explain">
        		<label><b>Your Offer</b></label>
            	
                <div class="quantity">
        			<input type="number" placeholder="your offer" name="offer" required min= <?php echo $minprice;?>>
                </div>
            	<input type="hidden" name="pid" value="<?php echo $selected;?>">
            
        		<button type="submit" class="putbtn">Put a bid</button
            ></div>
        </div>
            
	</form>
</body>
</html>