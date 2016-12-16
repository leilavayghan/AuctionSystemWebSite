<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php
		$base = new EventBase();
		$n = 2;
		$e = Event::timer($base, function($n) use (&$e) {
		echo "$n seconds elapsed\n";
		$e->delTimer();
		}, $n);
		$e->addTimer($n);
		$base->loop();
?>

</body>
</html>
