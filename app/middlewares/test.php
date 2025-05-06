<?php
    class TestMiddleware
    {
        public static function index()
        {
            // Perform some action before the request is handled
            echo "Middleware is running<br>";
            
        }
    }
?>