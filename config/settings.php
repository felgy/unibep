<?php

set_exception_handler('exception_handler');

session_start();

// Files paths.
define('ROOT', dirname(__DIR__));
define('PUBLIC', ROOT . '/public');
define('CONTROLLERS', ROOT . '/controllers');
define('MODELS', ROOT . '/models');
define('TEMPLATES', ROOT . '/templates');

// Active main HTML layout.
define('BASE_LAYOUT', 'main');

// Connection to database parameters.
define('DB_DSN', 'mysql:host=localhost;dbname=unibep;charset=utf8');
define('DB_USER', 'root');
define('DB_PASSW', '2');

//
define('POST_ARGS', [
    'name' => FILTER_SANITIZE_STRING,
    'last_name' => FILTER_SANITIZE_STRING,
    'phone' => FILTER_SANITIZE_STRING,
    'email' => FILTER_VALIDATE_EMAIL,
    'role' => FILTER_SANITIZE_STRING,
    'rate' => FILTER_VALIDATE_FLOAT,
]);

define('GET_ARGS', [
    'id' => FILTER_VALIDATE_INT,
]);

//
define('DONE', 'Darīts');
define('NOT_CORRECT', 'Kaut kas nav korekti!');
define('NAME_REQUIRED', 'Vārds obligāts!');