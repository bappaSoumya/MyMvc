<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFilter;
use Twig\TwigFunction;

class Controller {
    protected $twig;

    public function __construct() {
        $loader = new FilesystemLoader(VIEW_PATH);
        $this->twig = new Environment($loader, [
            'cache' => CACHE_PATH,
            'auto_reload' => true
        ]);

        // Add a dynamic function handler for PHP and custom functions
        $this->twig->addFunction(new TwigFunction('call', function ($functionName, ...$args) {
            if (function_exists($functionName)) {
                return call_user_func_array($functionName, $args);
            }
            return "Error: Function '$functionName' does not exist.";
        }));
        
        // Add CSRF token to Twig globally
        $this->twig->addGlobal('csrf_token', $this->generateCsrfToken());
        // Debug: List all registered Twig functions
        /*$functions = $this->twig->getFunctions();
        foreach ($functions as $function) {
            echo $function->getName() . "<br>";
        }*/
    }

    // Generate a CSRF token and store it in the session
    protected function generateCsrfToken() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    // Validate the CSRF token
    public function validateCsrfToken($token) {
        if (!isset($_SESSION)) {
            session_start();
        }
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

    public function model($model) {
        // Ensure base Model class is loaded
        $baseModelFile = '../app/core/Model.php';
        if (!file_exists($baseModelFile)) {
            die('Error: Base model file "' . $baseModelFile . '" not found.');
        }
        require_once $baseModelFile;
        
        // Load the specific model
        $modelFile = '../app/models/' . $model . '.php';
        if (!file_exists($modelFile)) {
            die('Error: Model file "' . $modelFile . '" not found.');
        }
        require_once $modelFile;
        
        // Verify the model class exists
        if (!class_exists($model)) {
            die('Error: Model class "' . $model . '" not found in ' . $model . '.php');
        }
        
        return new $model();
    }
    
    public function view($view, $data = []) {
        // Add BASE_URL to the data array for use in Twig templates
        $data['BASE_URL'] = BASE_URL;

        // Ensure compatibility with nested paths by directly using the provided view path
        $viewPath = str_replace('/', DIRECTORY_SEPARATOR, $view);

        // Render the Twig template
        try {
            echo $this->twig->render($viewPath . '.twig', $data);
        } catch (\Twig\Error\LoaderError $e) {
            die('Error: View file "' . $viewPath . '.twig" not found.');
        }
    }

    public function page_404() {
        // Render the 404 page
        $this->view('errors/404');
    }
}