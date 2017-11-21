<?php

namespace App\Validation\Rules;

# Imports the Google Cloud client library
use Google\Cloud\Vision\VisionClient;


use Respect\Validation\Rules\AbstractRule;

class SafeImage extends AbstractRule
{

    protected $safe;
    

    public function __construct($image)
    {
        # Your Google Cloud Platform project ID
        $projectId = 'picsngifs-181612';
        # Instantiates a client
        $vision = new VisionClient([
        'projectId' => $projectId
        ]);

        // var_dump($image);
        // echo $image->file;
        # The name of the image file to annotate
        $image = file_get_contents($image->file);
        
        # Prepare the image to be annotated
        $image = $vision->image($image, [
        'SAFE_SEARCH_DETECTION'
        ]);

        # Performs label detection on the image file
        // $labels = $vision->annotate($image)->labels();

        $result = $vision->annotate($image);
        $this->safe = $result->safeSearch();
        
        
    }

    public function validate($input)
    {      
        return !$this->safe->isAdult();
    }
}
