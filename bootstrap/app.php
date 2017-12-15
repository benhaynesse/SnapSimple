<?php

require __DIR__ . '/../vendor/autoload.php';

use Respect\Validation\Validator as v;
use App\Controllers\User\UserController;

session_start();

//Set up the database rules and the error messages. 
//Database rules used for Illuminate.
$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'snapadds',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => ''
        ]
    ],
    
]);


//Create Our Container to be accessed within controllers
$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

//Set up for Twig to access the views in the view folder
$container['view'] = function($container){
    
        $view = new \Slim\Views\Twig(__DIR__. '/../resources/views', [
            'cache' => false,
        ]);
    
        $view -> addExtension(new \Slim\Views\TwigExtension(
            $container ->router,
            $container ->request->getUri()
        ));
    
        $view->getEnvironment()->addGlobal('auth', [
            'check' => $container->auth->check(),
            'user' => $container->auth->user(),
        ]);    
    
        $view->getEnvironment()->addGlobal('flash', $container->flash);
    
        return $view;
};






//Add Global Container stuff
require_once __DIR__ . '/Inits/Globals.php';

//Add Controller Inits
require_once __DIR__ . '/Inits/Controllers.php';

//Add Middleware Inits
require_once __DIR__ . '/Inits/Middleware.php';

//Set Where Custom validation rules are
v::with('App\\Validation\\Rules\\');


//Pull in the routeing.
require __DIR__ . '/../app/Routes/routes.php';










