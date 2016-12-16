<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome</title>
<link rel="stylesheet" type="text/css" href="mycss/loginstyle.css">
</head>
	
    <style>
    	
		.sellimg {
			display: block;
    		margin-left: auto;
    		margin-right: auto;
		}
    
    </style>

<body>
	
    

	<?php
		
		session_start();
		$info = $_SESSION['user'];
		$xmlinfo=simplexml_load_string($info) or die("Error: Cannot create object");
		$name = $xmlinfo->firstname;
		
    ?>
	<h1 align="center">Hello <?php echo $name ?> !</h1>
    <h1 align="center">What do you want to do now?</h1>
    <div class="sellimg"  align="center" >
    <p>
		<a href="yourstore.php">
		<img border="0" alt="sell" src="img\sell.png" width="200" height="200"></a>
	
		<a href="allproducts.php">
		<img border="0" alt="buy" src="img\buy.png" width="200" height="200"></a>
        
        <a href="profile.html">
		<img border="0" alt="profile" src="img\profile.png" width="200" height="200"></a>
	</p>
    
    </div>

</body>
</html>
