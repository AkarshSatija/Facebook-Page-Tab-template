<?php 

session_start();

require_once('AppInfo.php');
require_once('utils.php');
require_once('src/facebook.php');

$facebook = new Facebook(array(
	'appId'  => AppInfo::appID(),
	'secret' => AppInfo::appSecret(),
	'cookie' => true,
	'sharedSession' => true,
	'trustForwarded' => true,
	'fileUpload' => true
  //'allowSignedRequest' => false
));

$name= $_SESSION['name'];
$user_id=$_SESSION['user_id'];


?>
<html lang="en">
<head>
</head>
<body>
	
	Customized image preview will go here depending upon the data fed in previous screen with direct call to solomofy functions
	
</body>
</html>