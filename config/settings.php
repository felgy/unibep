<?php

// Files paths.
define('ROOT', dirname(__DIR__));
define('PUBLIC', ROOT . '/public');
define('CONTROLLERS', ROOT . '/controllers');
define('MODELS', ROOT . '/models');
define('TEMPLATES', ROOT . '/templates');

// Active main HTML layout.
const BASE_LAYOUT = 'main';

// Connection to database parameters.
const DB_DSN = 'mysql:host=localhost;dbname=unibep;charset=utf8';
const DB_USER = 'root';
const DB_PASSW = '2';

// Exception handlers.
set_exception_handler('exception_handler');