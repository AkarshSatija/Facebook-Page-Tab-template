<!DOCTYPE html>
<?php 
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


?>
<p><span style="color: #7d7d7d">Something Went Wrong,</span> please try again later</p>