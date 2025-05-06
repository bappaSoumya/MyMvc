<?php
class Routes{
    protected $routes = [
        '/' => ['controller' => 'HomeController', 'method' => 'index'],
        '/blog/{id}/{name}' => ['controller' => 'BlogController', 'method' => 'index'],
        '/show-read-me' => ['controller' => 'BlogController', 'method' => 'showReadMe'],
        '/contact/send' => ['controller' => 'ContactController', 'method' => 'sendEmail'],
        // API Routes
        '/api/users' => ['controller' => 'UserController', 'method' => 'getUsers'],
        '/api/users/create' => ['controller' => 'UserController', 'method' => 'createUser'],
    ];
}