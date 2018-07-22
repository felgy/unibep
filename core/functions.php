<?php

// Autoload classes.
spl_autoload_register(function ($class) {
    require_once ROOT . '/' . str_replace('\\', '/', $class) . '.php';
});

// Exception  handler.
function my_exception_handler($e)
{
    show_error($e->getMessage(), $e->getCode());
}

// Display errors.
function show_error($message, $code)
{
    http_response_code($code);
    switch ($code) {
        case 404:
            $data['msg'] = $message;
            echo view($data, 'errors', '404');
            break;
        default:
            $data['msg'] = $message;
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

// Returns controller name.
function controller()
{
    $route = router();
    return $route['controller'];
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
function render($data, $controller, $template)
{
    $data['content'] = view($data, $controller, $template);
    return view($data, 'main', BASE_LAYOUT);
}

// Prepare and return the relevant data array.
function get_data($action, $controller)
{
    $model = MODELS . '/' . $controller . '.mod.php';
    if (is_file($model)) {
        require_once $model;
        if (isset($data["$action"])) {
            return $data["$action"];
        } else {
            throw new Exception('Data for this controller not found!', 404);
        }
    } else {
        throw new Exception('Model for this controller not found!', 404);
    }

}

// Initiates the preparation of data and templates.
function run($action, $controller)
{
    $data = get_data($action, $controller);
    return render($data, $controller, $action);
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
