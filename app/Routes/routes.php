<?php

//Test Route used for debugging templates
$app->get('/test','TestController:getTest')->setName('test');
$app->post('/test','TestController:postTest');


//First Route
$app->get('/', 'HomeController:index')->setName('home');







//Add Routes that require authorization
require_once __DIR__ . '/Groups/Auth.php';

//Add Routes that guests can view
require_once __DIR__ . '/Groups/Guest.php';




