<?php

class Registration
{
    private $register = [];

    public function __construct()
    {
        require_once '../config/register.php';
        $this->register = new Register();
        foreach ($this->register->register as  $items) {
            foreach ($items as $item) {
                file_exists('../'.$item) ? require_once '../'.$item : die("File not found: " . $item);
            }
        }
    }
}