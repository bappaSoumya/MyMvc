<?php

class Register
{
    public $register = [
       'library' => ['app/libraries/PdfLibrary.php', 'app/libraries/ApiLibrary.php'],
        'helpers' => ['app/helpers/test.php', 'app/helpers/form_helper.php'],
        'middleware' => ['app/middlewares/test.php'],
    ];
}