<?php
// COMMON ===================================================================
function exception_handler($e)
{
    show_error($e->getMessage(), $e->getCode(), $e->getFile(), $e->getLine());
}

spl_autoload_register(function ($class) {
    require_once ROOT . '/' . str_replace('\\', '/', $class) . '.php';
});

function show_error($message, $code, $file, $line)
{
    http_response_code($code);
    $data['msg'] = $message;
    $data['file'] = $file;
    $data['line'] = $line;
    $data['code'] = $code;
    switch ($code) {
        case 404:
            echo view($data, 'errors', '404');
            break;
        default:
            echo view($data, 'errors', 'production');
            break;
    }
}

/**
 * Return current controller name.
 */
function controller()
{
    $route = router();
    return $route['controller'];
}

/**
 * Return current action name.
 */
function action()
{
    $route = router();
    return $route['action'];
}

/**
 *  Returns model file path.
 */
function model()
{
    $model = MODELS . '/' . controller() . '.mod.php';
    if (is_file($model)) {
        return $model;
    } else {
        throw new Exception('Model for controller "' . controller() . '" not found!');
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

// COMMON ===================================================================

// FRONT CONTROLLER =========================================================
/**
 * Initiates the activity for generating the requested page.
 */
function get_page()
{
    $controller = CONTROLLERS . '/' . controller() . '.con.php';
    $action = action();
    if (is_file($controller)) {
        require_once $controller;
        if (function_exists($action)) {
            return $action();
        } else {
            throw new Exception('Action "' . $action . '" not found!', 404);
        }
    } else {
        throw new Exception('Controller "' . controller() . '" not found!', 404);
    }
}

/**
 * Cut GET parameters from request and return controller and model.
 */
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
// FRONT CONTROLLER =========================================================

// MODEL ====================================================================
/**
 * Prepare the function name and call to get template data from the model.
 * @param $template
 */
function get_data($template)
{
    require_once model();
    $action = 'get_' . $template . '_data';
    if (function_exists($action)) {
        return $action();
    } else {
        throw new Exception('Data for action "' . $action . '" not found!', 404);
    }
}
// MODEL ====================================================================

// VIEW =====================================================================
/**
 * Fill in the template with the data and return the result in the string.
 * @param $data 
 * @param $controller
 * @param $template
 */
function view($data, $controller, $template)
{
    $template = TEMPLATES . '/' . $controller . '/' . $template . '.tpl.php';
    $action = 'get_' . $template . '_data';
    if (is_file($template)) {
        extract($data);
        ob_start();
        require_once $template;
        return ob_get_clean();
    } else {
        throw new Exception('Template for action "' . action() . '" not found!', 404);
    }
}

/**
 * Put together prepared templates and return the finished page.
 * Array $data is data for the base template and part of the content.
 * @param $template | template for current view content part.
 */
function render($template)
{
    $data = get_data($template);
    $data['content'] = view($data, controller(), $template);
    return view($data, 'main', BASE_LAYOUT);
}
// VIEW =====================================================================
