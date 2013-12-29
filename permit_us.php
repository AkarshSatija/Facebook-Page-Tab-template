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

<a href="<?php print AppInfo::getPageTabAppUrl(); ?>" target="_top" class="btn btn-success btn-lg postit" >Continue</a>