<?php
class Routes{
    protected $routes = [
        '/' => ['controller' => 'HomeController', 'method' => 'index'],
        '/blog/{id}/{name}' => ['controller' => 'BlogController', 'method' => 'index'],
        '/show-read-me' => ['controller' => 'BlogController', 'method' => 'showReadMe'],
        '/contact/send' => ['controller' => 'ContactController', 'method' => 'sendEmail'],
        '/form' => ['controller' => 'FormController', 'method' => 'showForm'],
        '/form/submit' => ['controller' => 'FormController', 'method' => 'submit'],
        '/file/upload' => ['controller' => 'FileController', 'method' => 'upload'],
        // API Routes
        '/api/users' => ['controller' => 'UserController', 'method' => 'getUsers'],
        '/api/users/create' => ['controller' => 'UserController', 'method' => 'createUser'],
    ];
}