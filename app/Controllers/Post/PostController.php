<?php
namespace App\Controllers\Post;

use App\Controllers\BaseController;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use App\Models\FileUpload\ImageUpload;

use App\DBOs\Post;



use Respect\Validation\Validator as v;



class PostController extends BaseController
{
  

    public function getAddPost(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->view->render($response, 'post/addpost.twig');
        
    }

    public function postAddPost(ServerRequestInterface $request, ResponseInterface $response){

              
        //Validate Post Data
        $validation = $this->validator->validate($request, [
            'headline' => v::notEmpty()->alnum(),  
            'looking' => v::notEmpty()->intVal(),
            'comments' => v::notEmpty()->intVal(),
            'lat' => v::optional(v::numeric()),
            'long' => v::optional(v::numeric()),
        ]);
        
        //Validate Image
        $validation->validateImage($request, [
            'image' => v::image()
        ]);

        //If any validation fails set errors and return back to post form
        if($validation->failed()){  
            $this->flash->addMessage('danger', "Please Correct Errors Below");
            return $response->withRedirect($this->router->pathFor('post.add'));            
        }
        

        //Attempt to upload image. If something fails return to post form
        $filename = $this->uploadImage($request->getUploadedFiles()['image']);

        if(!$filename){
            $this->flash->addMessage('danger', "Error occured with your picture");
            return $response->withRedirect($this->router->pathFor('post.add'));  
        }
            
             

        //Grab Logged In user info And Post Info
        $user_id = $this->auth->user()->id;
        $headline = $request->getParam('headline');
        $looking = $request->getParam('looking');
        $comments = $request->getParam('comments');        

        
        //Add Location Coordinates to Database
        $lat = $request->getParam('lat') ?: 125;
        $long = $request->getParam('long') ?: 125;

        $post = Post::create([
            'headline' => $headline,
            'user_id' => $user_id,
            'looking_for' =>$looking,
            'commenters' => $comments,
            'image_url' => $filename,
            'latitude' => $lat,
            'longitude' => $long,
        ]);

        if(!$post){
            $this->flash->addMessage('danger', "Something went wrong with your request");
        }

        $this->flash->addMessage('info', "Post Added Successfully");
        return $response->withRedirect($this->router->pathFor('home'));  

        
    }
    

    private function uploadImage($image){

        $directory = $this->upload_directory;   

        $uploadedFile = $image;
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $filename = ImageUpload::moveUploadedFile($directory, $uploadedFile);
            
            return $filename;
        }else{
            return false;
        }        

    }


    

}