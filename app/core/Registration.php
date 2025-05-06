<?php

class Registration
{
    private $register = [];

    public function __construct()
    {
        require_once '../config/register.php';
        $this->register = new Register();
        foreach ($this->register->register as  $loadKey => $items) {
            if($loadKey == 'library') {
               $loadPath = '../app/libraries/';
               foreach ($items as $item) {
                    $item = $loadPath . $item . '.php';
                    file_exists($item) ? require_once $item : die("File not found: " . $item);
                }
            }else if($loadKey == 'helpers') {
                $loadPath = '../app/helpers/';
                foreach ($items as $item) {
                    $item = $loadPath . $item . '.php';
                    file_exists($item) ? require_once $item : die("File not found: " . $item);
                }
            }else if($loadKey == 'middleware') {
                $loadPath = '../app/middlewares/';
                foreach ($items as $item) {
                    $item = $loadPath . $item . '.php';
                    file_exists($item) ? require_once $item : die("File not found: " . $item);
                }  
            } 
            
        }
    }
}