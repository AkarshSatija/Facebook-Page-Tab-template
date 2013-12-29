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
  ));


$signed_request = $facebook->getSignedRequest();
$like_status = $signed_request["page"]["liked"];

if($like_status==1)
{
  $user_id = $facebook->getUser();
  if($user_id){
    $_SESSION['user_id']=$user_id;
    try {
    // Fetch the viewer's basic information
      $basic = $facebook->api('/me');
      $_SESSION['name']=he(idx($basic, 'first_name'));
    } 
    catch (FacebookApiException $e) 
    {
      include('error.php'); //echo "Something Went Wrong! ";
      session_destroy();
      die();
    }
    if((isset($_SESSION['image_url']))&&(isset($_SESSION['format']))&&(isset($_SESSION['post_it'])))
    {
      $image_url=$_SESSION['image_url'];

      try 
      {
        $facebook->setFileUploadSupport(true);
        // Upload a picture
        $photo_details = array('message'=> 'New Year Wish from the Master for me, thanks to Speaking Tree. Get yours at http://on.fb.me/19sAuvs');
        $photo_details['url'] = $image_url;
        $call = $facebook->api("/me/permissions");
        if(isset($call['data'][0]['publish_actions']))
        {
          if($call['data'][0]['publish_actions']==1)
          {
            $upload_photo = $facebook->api('/photos', 'post', $photo_details);
            if($upload_photo['id'])
            {
              echo '<!--'.$upload_photo['id'].'-->';
              include('success.php');
              if($_SESSION['format']=="cover")
              {
               print '
               <script type="text/javascript">
                 window.top.location.href = "http://www.facebook.com/profile.php?preview_cover='.$upload_photo['id'].'";
               </script>';
             }
             session_destroy();
             die();
           }
           else
           {
                    include('error.php'); //echo "Something Went Wrong! ";
                    session_destroy();
                    die();
                  }
                }
              }
              else
              {
               include("permit_us.php");
               die();
             }
           }
           catch(FacebookApiException $e) {
              include('error.php'); //echo "Something Went Wrong! ";
              session_destroy();
              die();
            } 
          }
          else
          {
           header('Location: main.php');
         }
       }
       else
       {
        if(isset($_SESSION['ask_permission']))
        {
          include('permit_us.php');
          session_destroy();
          die();
        }
        else
        {
          $_SESSION['ask_permission']=1;
          include('permit_us.php');
          print '
          <script type="text/javascript">
            window.top.location="";
          </script>';
          die();
        }
      }
    }
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
  Fan Page Images here- like page to continue.
</body>
</html>