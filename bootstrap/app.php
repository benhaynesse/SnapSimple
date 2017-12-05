<?php

require __DIR__ . '/../vendor/autoload.php';

use Respect\Validation\Validator as v;

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

//Set up where images are uploaded 
$container['upload_directory'] = __DIR__ . '/../public/uploads';

//Set up access to Illuminate
$container['db'] = function($container) use ($capsule){
    return $capsule;
};

$container['auth'] = function($container){
    return new \App\Models\Auth\AuthModel;
};

$container['flash'] = function($container){
    return new \Slim\Flash\Messages;
};

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


//Set up the validation for the inputs. Lets us use Respect Validation
$container['validator'] = function($container){
    return new App\Validation\Validator;
};

//Set Up Our Controllers

$container['HomeController'] = function($container){
    return new \App\Controllers\HomeController($container);
};

$container['PostController'] = function($container){
    return new \App\Controllers\Post\PostController($container);
};

$container['AuthenticationController'] = function($container){
    return new \App\Controllers\Auth\AuthenticationController($container);
};


$container['csrf'] = function(){
    return new \Slim\Csrf\Guard;
};


//Add the Middlewares
$app->add(new \App\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \App\Middleware\OldInputMiddleware($container));
$app->add(new \App\Middleware\CsrfViewMiddleware($container));
// $app->add($container->csrf);


v::with('App\\Validation\\Rules\\');


//Pull in the routeing.
require __DIR__ . '/../app/Routes/routes.php';










