<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>your info</title>
<link href="mycss/loginstyle.css" rel="stylesheet" type="text/css">
</head>

<body>
    <a href="home.php">
		<img border="0" alt="home" src="img\home.png" width="150" height="150"></a>
        
    <div class="sellimg"  align="center" >
    <p>
        <a href="yourinfo.php">
		<img border="0" alt="info" src="img\yourinfo.png" width="200" height="200"></a>
	</p>
        
    </div>    
    <?php
		
		session_start();
		$info = $_SESSION['user'];
		$xmlinfo=simplexml_load_string($info) or die("Error: Cannot create object");
		$ID = $xmlinfo->custID;	
	?>
    	<table id="info">
        	<tr>
            	<td><b>Username:</b></td>
    			<td><?php echo $xmlinfo->username; ?></td>
            </tr>
            <tr>
            	<td><b>First Name:</b></td>
    			<td><?php echo $xmlinfo->firstname; ?></td>
            </tr>
            <tr>
            	<td><b>Username:</b></td>
    			<td><?php echo $xmlinfo->lastname; ?></td>
            </tr>
            <tr>
            	<td><b>Email Address:</b></td>
    			<td><?php echo $xmlinfo->email; ?></td>
            </tr>
            <tr>
            	<td><b>Phone:</b></td>
    			<td><?php echo $xmlinfo->phone; ?></td>
            </tr>
            <tr>
            	<td><b>Address:</b></td>
    			<td><?php echo $xmlinfo->address; ?></td>
            </tr>
            <tr>
            	<td><b>City:</b></td>
    			<td><?php echo $xmlinfo->city; ?></td>
            </tr>
            <tr>
            	<td><b>Country:</b></td>
    			<td><?php echo $xmlinfo->country; ?></td>
            </tr>
            <tr>
            	<td><b>Postal Code:</b></td>
    			<td><?php echo $xmlinfo->postalcode; ?></td>
            </tr>
            <tr>
            	<td><b>Date of Birth:</b></td>
    			<td><?php echo $xmlinfo->DOB; ?></td>
            </tr>
            <tr>
            	<td><b>Registration Date:</b></td>
    			<td><?php echo $xmlinfo->registrationDate; ?></td>
            </tr>
        </table>
        
</body>
</html>