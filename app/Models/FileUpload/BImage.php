<?php


namespace App\Models\FileUpload;

use Intervention\Image\ImageManager;
use \Slim\Http\UploadedFile;


class BImage{

    private $filename, $image, $thumbnail, $manager;
    

    public function __construct(UploadedFile $image){

        $this->manager = new ImageManager(array('driver' => 'gd')); 

        $this->defaultImage = $image;
        $this->image = $this->manager->make($image->file);

        $this->extension = pathinfo($image->getClientFilename(), PATHINFO_EXTENSION);
        $basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
        $this->filename = sprintf('%s.%0.8s', $basename, $this->extension);


    }

    public function getThumbnail($crop = array(0,0,300,300), $dimensions = array(300,300)){

        $xOff = $dimensions[0]; $yOff = $dimensions[1];        

        $image = $this->image;        
               
        $thumb = $this->image->crop($crop->w,$crop->h,$crop->x,$crop->y);
        // $thumb->resize(null,300, function($constraint){
        //     $constraint->aspectRatio();
        //     $constraint->upsize();
        // });
        $thumb->resize(300,300);
        

        return $thumb;

    }

    public function getImage(){
        return $this->manager->make($this->defaultImage->file);
    }

    public function getFilename(){
        return $this->filename;
    }


}
