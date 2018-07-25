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