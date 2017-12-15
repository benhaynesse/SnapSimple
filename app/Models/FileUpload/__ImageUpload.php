<?php

namespace App\Models\FileUpload;

use \Slim\Http\UploadedFile;

class ImageUpload{

    private $filename;
    private $extention;

    public $file;

    public function __construct(UploadedFile $uploadedFile){   

        $this->file = $uploadedFile;        
        $this->extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
        $this->filename = sprintf('%s.%0.8s', $basename, $this->extension);
    }


    public function moveUploadedFile($directory)
    {
          
        return $this->file->moveTo($directory . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . $this->filename);       
    
        
    }

    public static function uploadThumbnail($directory, $filename, UploadedFile $uploadedFile){

    }

}