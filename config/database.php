<?php


define('DB_HOST', __ENV('DB_HOST'));
define('DB_USER', __ENV('DB_USER'));
define('DB_PASS', __ENV('DB_PASS'));
define('DB_NAME', __ENV('DB_NAME'));


define('DB_DSN', 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4');

