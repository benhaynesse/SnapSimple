<?php


namespace App\Models\Auth\Facebook;
// require_once __DIR__ . '/vendor/autoload.php';
use Facebook\Facebook;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class FBLogin{

    public $appId         = '1520687128010796'; //Facebook App ID
    public $appSecret     = 'a8815d797c8e9e6e87601ad68aff932a'; //Facebook App Secret
    public $redirectURL   = 'http://localhost:9090/designtest/testDesign/snapadds/public/auth/register'; //Callback URL
    private $fbPermissions = array('email','user_friends');  //Optional permissions

    private $fb;
    
    private $helper;
    private $accessToken;

    public function __construct(){
        
        $this->fb = new Facebook(array(
            'app_id' => $this->appId,
            'app_secret' => $this->appSecret,
            'default_graph_version' => 'v2.4',
        ));

        // Get redirect login helper
        $this->helper = $this->fb->getRedirectLoginHelper();
    }

    public function setAccessToken($accessToken){
        $this->fb->setDefaultAccessToken($accessToken);
    }

    public function getHelper(){
        return $this->helper;
    }

    public function getPermissions(){
        return $this->fbPermissions;
    }

    public function getFacebookObject(){
        return $this->fb;
    }

    public function getAccessToken(){
        try {
            if(isset($_SESSION['user'])){
                // echo "YEAH";
                $accessToken = $_SESSION['user'];
            }else{
                // echo "NAH";
                  $accessToken = $this->helper->getAccessToken();
            }
        } catch(FacebookResponseException $e) {
             echo 'Graph returned an error: ' . $e->getMessage();
              exit;
        } catch(FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
              exit;
        }

        return $accessToken;
    }

    public function getProfileDetails(array $fields, $accessToken){
        
        $url = "/me?fields=".implode(',',$fields);
        
        try {
            $profileRequest = $this->fb->get($url, $accessToken);
            $fbUserProfile = $profileRequest->getGraphNode();

        } catch (FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            session_destroy();
            // Redirect user back to app login page
            header("Location: ./");
            exit;
        } catch (FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        return $fbUserProfile;
    }

}