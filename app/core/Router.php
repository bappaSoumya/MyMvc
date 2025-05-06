<?php
require_once '../config/routes.php';

class Router extends Routes {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];
    

    public function __construct() {
        $url = $this->parseUrl();
       // print_r($url);
        // Get the path from the URL
        $path = isset($url[1]) ? '/' . implode('/', array_slice($url, 1)) : '/';
       // print_r($path);
        // Match the path to a route
        $route = $this->matchRoute($path);
        //exit;
        if ($route) {
            $this->controller = $route['controller'];
            $this->method = $route['method'];
            $this->params = $route['params'];
        } else {
            // Render the 404 page
            require_once '../app/core/Controller.php';
            $controller = new Controller();
            $controller->page_404();
            exit;
        }
        // Include the controller file
        $controllerFile = '../app/controllers/' . $this->controller . '.php';
        if (!file_exists($controllerFile)) {
            die('Error: Controller file "' . $controllerFile . '" not found.');
        }
        //assigning the controller to the class name
        require_once '../app/core/Controller.php';
        // Ensure the base Controller class is loaded
        require_once $controllerFile;

        // Instantiate the controller
        if (!class_exists($this->controller)) {
            die('Error: Controller class "' . $this->controller . '" not found.');
        }
        $this->controller = new $this->controller;

        // Check if the method exists
        if (!method_exists($this->controller, $this->method)) {
            die('Error: Method "' . $this->method . '" not found in controller "' . $this->controller . '".');
        }
    }

    public function parseUrl() {
        if (isset($_SERVER['REQUEST_URI'])) {
            return explode('/', filter_var(rtrim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }

    public function matchRoute($path) {
       // print_r($path);
        foreach ($this->routes as $route => $details) {
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);
            $pattern = str_replace('/', '\/', $pattern);
            if (preg_match('/^' . $pattern . '$/', $path, $matches)) {
                array_shift($matches); // Remove the full match
                $details['params'] = $matches;
                return $details;
            }
        }
        return null;
    }

    public function route() {
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
}