<?php

// Autoload classes.
spl_autoload_register(function ($class) {
    require_once ROOT . '/' . str_replace('\\', '/', $class) . '.php';
});

// Exception  handler.
function exception_handler($e)
{
    show_error($e->getMessage(), $e->getCode(), $e->getFile(), $e->getLine());
}

// Display errors.
function show_error($message, $code, $file, $line)
{
    http_response_code($code);
    switch ($code) {
        case 404:
            $data['msg'] = $message;
            $data['file'] = $file;
            $data['line'] = $line;
            echo view($data, 'errors', '404');
            break;
        default:
            $data['msg'] = $message;
            $data['file'] = $file;
            $data['line'] = $line;
            $data['code'] = $code;
            echo view($data, 'errors', 'production');
            break;
    }
}

// Initiates the activity for generating the requested page.
function get_page()
{
    $route = router();
    $controller = CONTROLLERS . '/' . $route['controller'] . '.con.php';
    $action = $route['action'];
    if (is_file($controller)) {
        require_once $controller;
        if (function_exists($action)) {
            return $action();
        } else {
            throw new Exception('Action not found!', 404);
        }
    } else {
        throw new Exception('Controller not found!', 404);
    }

}

// Strike from request controller and model.
function router()
{
    $route = [
        'controller' => 'home',
        'action' => 'index',
    ];
    $uri = explode('?', $_SERVER['REQUEST_URI']);
    $segments = explode('/', trim($uri[0], '/'), 2);
    if (!empty($segments[0])) {
        $route['controller'] = $segments[0];
        if (!empty($segments[1])) {
            $route['action'] = $segments[1];
        }
    }
    return $route;
}

// Fill in the template with the data and place the result in the variable.
function view($data, $controller, $template)
{
    $template = TEMPLATES . '/' . $controller . '/' . $template . '.tpl.php';
    if (is_file($template)) {
        extract($data);
        ob_start();
        require_once $template;
        return ob_get_clean();
    } else {
        throw new Exception('Template for this action not found!', 404);
    }
}

// Put together templates and return the finished page.
function render($template)
{
    $data = get_data($template);
    $data['content'] = view($data, controller_name(), $template);
    return view($data, 'main', BASE_LAYOUT);
}

// Returns controller name.
function controller_name()
{
    $route = router();
    return $route['controller'];
}

// Returns model file path.
function model_file()
{
    $model = MODELS . '/' . controller_name() . '.mod.php';
    if (is_file($model)) {
        return $model;
    } else {
        throw new Exception('Model for controller "' . controller_name() . '" not found!');
    }
}

// Prepare and return the relevant data array.
function get_data($template)
{
    require_once model_file();
    $function = 'get_' . $template . '_data';
    if (function_exists($function)) {
        return $function();
    } else {
        throw new Exception('Data for this controller not found!', 404);
    }
}

/**
 * Formatted output. For development purposes.
 * @param $value
 * @param bool $mode | switch (print_r) to (var_dump).
 */
function debug($value, $mode = false)
{
    ob_start();
    echo '<pre style="font-size:17px">';
    if ($mode === false) {
        print_r($value);
    } else {
        var_dump($value);
    }
    echo '</pre>';
    ob_end_flush();
}
