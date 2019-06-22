<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::prefix('admin', function (RouteBuilder $routes) {
  $routes->connect('/',['controller' => 'admin','action' => 'index']);
  $routes->fallbacks();
});
