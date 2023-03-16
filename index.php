//trigger api call
<?php

require("APIRateLimiter.php");

$apiRate = 10;
function callAPI($url){

  $ch = curl_init();

  $headers = array(
    'Accept: application/json',
    'Content-Type: application/json',

  );

  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

  curl_setopt($ch, CURLOPT_HEADER, 0);

  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); 

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  curl_setopt($ch, CURLOPT_URL, $url);

  $result = curl_exec($ch);
  
  echo "<pre>";
  print_r(json_decode($result,true));
  
}
$throtleStatus = ratelimiter($apiRate);

$url = "https://reqres.in/api/users/2";

while($throtleStatus){

  callAPI($url);
  $throtleStatus = ratelimiter();
  
}
?>