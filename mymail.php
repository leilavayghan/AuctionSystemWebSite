<?php

	$email=		$_GET['email'];
	$firstname=	$_GET['first'];
	$lastname=	$_GET['last'];
	$price=	    $_GET['price'];

	mail ($email, "Yoohooo you won!", "Dear $firstname $lastname,
	
	Congratulations from all of us here at Auction System!
	
	You won some stuff for $price CAD! Check the details in your profile under your wins section.
	
	Enjoy!");

?>