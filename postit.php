<!DOCTYPE html>
<?php 

require_once('AppInfo.php');
require_once('utils.php');
require_once('src/facebook.php');

//$auth code=$facebook->getAccessToken();

$facebook = new Facebook(array(
  'appId'  => AppInfo::appID(),
  'secret' => AppInfo::appSecret(),
  'cookie' => true,
  'sharedSession' => true,
  'trustForwarded' => true,
  'fileUpload' => true
  //'allowSignedRequest' => false
));

session_start();

$_SESSION['post_it']=1;

 ?>
 <script type="text/javascript">
   window.top.location="<?php print AppInfo::getPageTabAppUrl(); ?>";
 </script>