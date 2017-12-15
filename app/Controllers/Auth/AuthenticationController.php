<?php
namespace App\Controllers\Auth;

use App\Controllers\BaseController;

use App\Models\Auth\Facebook\FBLogin as FBLogin;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use App\DBOs\User as UserModel;
use App\Models\Auth\AuthModel as User;

use Respect\Validation\Validator as v;



class AuthenticationController extends BaseController
{
    protected $fb;
    protected $accessToken;


    public function __construct($container)
    {
        parent::__construct($container);
        $this->fb = new FBLogin();
        $this->accessToken = $this->fb->getAccessToken();

    }

    public function getSignIn(ServerRequestInterface $request, ResponseInterface $response)
    {


        if ($this->accessToken) {

            if (isset($_SESSION['facebook_access_token'])) {
                $this->fb->setAccessToken($_SESSION['facebook_access_token']);
            } else {

                $_SESSION['facebook_access_token'] = (string)$this->accessToken;
                $this->fb->setAccessToken($_SESSION['facebook_access_token']);
            }

        }

        if (!isset($_SESSION['facebook_access_token'])) {

            $url = $this->fb->getHelper()->getLoginUrl('http://localhost:9090/designTest/testDesign/snapadds/public/auth/signin', $this->fb->getPermissions());
            return $this->view->render($response, 'auth/signin.twig', [
                'url' => $url,
            ]);

        } else {

            $fbUserProfile = $this->fb->getProfileDetails(['id', 'name'], $_SESSION['facebook_access_token']);
           
           //User Attemp Login
            $this->auth->attempt($fbUserProfile->getField('id'));

            $this->flash->addMessage('info', "Successful Sign In!");

            //Go back to index page
            return $response->withRedirect($this->router->pathFor('home'));   
        
            
        }
    }

    public function postSignIn(ServerRequestInterface $request, ResponseInterface $response)
    {

    }

    public function getRegisterUser(ServerRequestInterface $request, ResponseInterface $response)
    {    
       
        // session_destroy();  

        if ($this->accessToken) {


            if (isset($_SESSION['facebook_access_token'])) {
                // $fb->fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
            } else {

                $_SESSION['facebook_access_token'] = (string)$this->accessToken;
                // $fb->fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
            }
                    

        }

        if (!isset($_SESSION['facebook_access_token'])) {
            $url = $this->fb->getHelper()->getLoginUrl('http://localhost:9090/designTest/testDesign/snapadds/public/auth/register', $this->fb->getPermissions());
            return $this->view->render($response, 'auth/signin.twig', [
                'url' => $url,
            ]);
        } else {

            $fbUserProfile = $this->fb->getProfileDetails(['id', 'first_name', 'last_name', 'friends', 'email', 'age_range','picture', 'gender'], $_SESSION['facebook_access_token']);
           

            $id = $fbUserProfile->getField('id');
            $first_name = $fbUserProfile->getField('first_name');
            $last_name = $fbUserProfile->getField('last_name');
            $gender = $fbUserProfile->getField('gender');
            $email = $fbUserProfile->getField('email');
            $estimatedAge = $fbUserProfile->getField('age_range')['min'] ?? $fbUserProfile->getField('age_range')['max'];

            // $friendCount = $fbUserProfile->getField('friends')->getTotalCount();

            // if ($friendCount < 50) {
            //     $this->flash->addMessage('danger', 'Sorry Your Profile looks like a spam account!');
            //     return $response->withRedirect($this->router->pathFor('home'));
            // }


            return $this->view->render($response, 'auth/register.twig', [
                'fullname' => $first_name . ' ' . $last_name,
                'profile' => $fbUserProfile,
                'age' => $estimatedAge,
                'gender' => $gender,
            ]);


        };

    }



    public function postRegisterUser(ServerRequestInterface $request, ResponseInterface $response)
    {               
        
              
        $validation = $this->validator->validate($request, [
            'name' => v::notEmpty()->alnum('-'),
            'facebook_id' => v::noWhitespace()->notEmpty()->facebookidavailable(),  
            'gender' => v::notEmpty()->alpha()->checkgender(),           
            'age' => v::noWhitespace()->notEmpty()->numeric()->agecheck(),
        ]);

        if($validation->failed()){
            $errors = $validation->getErrors();           
            
            //If the validation fails redirect back to the page.
            if(!empty($errors['facebook_id'])){
                $this->flash->addMessage('info', "You already registered. We have logged you in");
                $this->auth->attempt($request->getParam('facebook_id'));
                return $response->withRedirect($this->router->pathFor('home'));    
            }     
            
            return $response->withRedirect($this->router->pathFor('auth.register'));
            
        }

        $user = UserModel::create([
            'name' => $request->getParam('name'),
            'email' => $request->getParam('email'),
            'gender' => $request->getParam('gender'),
            'age' => $request->getParam('age'),
            'facebook_id' => $request->getParam('facebook_id'),
        ]);

        if(!$post){
            $this->flash->addMessage('danger', "Something went wrong with your request");
            return $response->withRedirect($this->router->pathFor('home'));  
        }

        $this->flash->addMessage('info', 'You have signed up!');

        //User Attemp Login        
        $this->auth->attempt($request->getParam('facebook_id'));


        return $response->withRedirect($this->router->pathFor('home'));        

    }

    public function logout(ServerRequestInterface $request, ResponseInterface $response)
    {
        // Remove access token from session
        unset($_SESSION['facebook_access_token']);
        unset($_SESSION['user']);
        // Redirect to the homepage
        return $response->withRedirect($this->router->pathFor('home'));
    }

}