<?php 

if(!session_id()){
    session_start();
}

use App\Models\Auth\Facebook\FBLogin;



$fb = new FBLogin();

$accessToken = $fb->getAccessToken();


if($accessToken){

    if (isset($_SESSION['facebook_access_token'])) {
        // $fb->fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    }else{

        $_SESSION['facebook_access_token'] = (string) $accessToken;
        // $fb->fb->setDefaultAccessToken($_SESSION['facebook_access_token']);

    }

    $oAuth2Client = $fb->fb->getOAuth2Client();
    
    // Exchanges a short-lived access token for a long-lived one
    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
    $_SESSION['facebook_access_token'] = (string) $accessToken;
    // setcookie('fbauth',$longLivedAccessToken);
    

     // Getting user facebook profile info
    
}

// echo "<script>
// if (window.location.hash == '#_=_') {
//     window.location.hash = ''; // for older browsers, leaves a # behind
//     history.pushState('', document.title, window.location.pathname); // nice and clean
//     e.preventDefault(); // no page reload
// }   

// </script>"
?>






