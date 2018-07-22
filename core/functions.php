<?php

spl_autoload_register(function ($class) {
    require_once ROOT . '/' . str_replace('\\', '/', $class) . '.php';
});

function my_exception_handler($e)
{
    show_error($e->getMessage(), $e->getCode());
}

function show_error($message, $responce)
{
    http_response_code($responce);
    switch ($responce) {
        case 404:
            $data['msg'] = $message;
            echo view($data, 'errors', '404');
            break;
        default:
            $data['msg'] = $message;
            $data['code'] = $responce;
            echo view($data, 'errors', 'production');
            break;
    }
}

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

function get_controller()
{
    $route = router();
    return $route['controller'];
}

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

function render($data, $controller, $template)
{
    $data['content'] = view($data, $controller, $template);
    return view($data, 'main', BASE_LAYOUT);
}

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