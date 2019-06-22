<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::scope('/', function (RouteBuilder $routes) {
    //Home Controller
    $routes->connect('/',['controller' => 'pages','action' => 'index']);



    //Account Controller
    $routes->connect('/register-user',['controller' => 'account','action' => 'register']);
    $routes->connect('/active-user',['controller' => 'account','action' => 'active_user']);
    $routes->connect('/logout',['controller' => 'account','action' => 'logout']);
    $routes->connect('/login',['controller' => 'account','action' => 'login']);
    $routes->connect('/lost-password',['controller' => 'account','action' => 'lostPassword']);



    $routes->fallbacks();
});
