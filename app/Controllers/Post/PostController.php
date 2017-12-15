<?php
namespace App\Controllers\Post;

use App\Controllers\BaseController;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

use App\Models\FileUpload\ImageUpload;

use App\Models\FileUpload\BImage;

use App\DBOs\Post;



use Respect\Validation\Validator as v;



class PostController extends BaseController
{
  


    public function getAddPost(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->view->render($response, 'post/addpost.twig');

    }

    public function postAddPost(ServerRequestInterface $request, ResponseInterface $response)
    {       
         
        
        //Validate Post Data
        $validation = $this->validator->validate($request, [
            'username' => V::notEmpty()->validUsername(),
            'headline' => V::notEmpty()->alnum('!:)('),
            'looking' => V::notEmpty()->intVal(),
            'comments' => V::notEmpty()->intVal(),
            'lat' => V::optional(v::numeric()),
            'long' => V::optional(v::numeric()),
        ]);        
        
        //Validate Image
        $validation->validateImage($request, [
            'image' => v::image()
        ]);

        //If any validation fails set errors and return back to post form
        if ($validation->failed()) {
            $this->flash->addMessage('danger', "Please Correct Errors Below");
            return $response->withRedirect($this->router->pathFor('post.add'));
        }     

        $dim = json_decode($request->getParam('dim'));

        //Attempt to upload image. If something fails return to post form
        $filename = $this->handleImage($request->getUploadedFiles()['image'],$dim);

        if (!$filename) {
            $this->flash->addMessage('danger', "Error occured with your picture");
            return $response->withRedirect($this->router->pathFor('post.add'));
        }               
    
        //Grab Logged In user info And Post Info
        $user_id = $this->auth->user()->id;
        $username = $request->getParam('username');
        $headline = $request->getParam('headline');
        $looking = $request->getParam('looking');
        $comments = $request->getParam('comments');        

        
        //Add Location Coordinates to Database
        $lat = $request->getParam('lat') ? : 125;
        $long = $request->getParam('long') ? : 125;

        $post = Post::create([
            'headline' => $headline,
            'username' => $username,
            'user_id' => $user_id,
            'looking_for' => $looking,
            'commenters' => $comments,
            'thumbnail' => 'thumbs/'.$filename,
            'image_url' => 'images/'.$filename,
            'latitude' => $lat,
            'longitude' => $long,
        ]);

        if (!$post) {
            $this->flash->addMessage('danger', "Something went wrong with your request");
        }

        $this->flash->addMessage('info', "Post Added Successfully");
        return $response->withRedirect($this->router->pathFor('home'));
    }

    private function handleImage($image, $dim){
        $bImage = new BImage($image);
        $imagename = $bImage->getFilename();
        $thumbnail = $bImage->getThumbnail($dim);
        $image = $bImage->getImage();

        $res = $this->uploadImage('images', $imagename, $image);
        $res = $this->uploadImage('thumbs', $imagename, $thumbnail);

        if(!$res){
            return false;
        }

        return $imagename;
        
    }


    private function uploadImage($folder, $filename, $image){
        
        $directory = $this->upload_directory;

        $path = $directory . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $filename;
        return $image->save($path);
        
    }




}