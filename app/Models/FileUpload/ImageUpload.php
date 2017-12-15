<?php

namespace App\Models\FileUpload;

use Slim\Http\UploadedFile;

use BImage;

class ImageUpload{

    

    public static function upload_image($directory, $filename, UploadedFile $file){
        $location = $directory . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $filename;
        $file->moveTo($location);
    }

    public static function upload_thumbnail($directory, $filename, $image){
        $location = $directory . DIRECTORY_SEPARATOR . 'thumbs' . DIRECTORY_SEPARATOR . $filename;
        $image->save($location);
        
    }


    

}