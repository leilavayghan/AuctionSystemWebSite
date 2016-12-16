<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://advertisementservice-149821.appspot.com/rest/ad/info"); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
$output = curl_exec($ch);   

// convert response
//$output = json_decode($output);

// handle error; error output
if(curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 200) {

  var_dump($output);
}

curl_close($ch);

echo $output;

?>