<?php
namespace App\Controllers;

use App\Controllers\BaseController;



use Intervention\Image\ImageManager;

use App\DBOs\Post;

use App\Models\FileUpload\BImage;

use App\Models\FileUpload\ImageUpload;

class Test extends BaseController
{
    public function getTest($request, $response){        
        
        return $this->view->render($response, 'test.twig');    

    }

    public function postTest($request, $response){

        
              
        //Get the thumnail positions
        $dim = json_decode($request->getParam('dim'));
        //Get the uploaded Image
        $uploadedImage = $request->getUploadedFiles()['image'];
               

        $bImage = new BImage($uploadedImage);
        $imagename = $bImage->getFilename(); 
        
        $thumbnail = $bImage->getThumbnail($dim);
        $image = $bImage->getImage();          
        
        return $response->withHeader('Content-Type', FILEINFO_MIME_TYPE)->write($thumbnail->response('jpg'));

        


    }

    public function uploadFile($folder, $filename, $image){
        $directory = $this->upload_directory;

        $path = $directory . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $filename;
        $image->save($path);
    }
}