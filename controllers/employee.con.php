<?php

function index()
{
    return render(__FUNCTION__);
}

function add()
{
    return render(__FUNCTION__);
}

function update()
{
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'POST' :
            require_once model();
            unset($_SESSION['msg']);
            $args = [
                'name' => FILTER_SANITIZE_STRING,
                'last_name' => FILTER_SANITIZE_STRING,
                'phone' => FILTER_SANITIZE_STRING,
                'email' => FILTER_VALIDATE_EMAIL,
                'role' => FILTER_SANITIZE_STRING,
                'rate' => FILTER_VALIDATE_FLOAT,
            ];
            $post = filter_input_array(INPUT_POST, $args);
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

            $post['rate'] = $post['rate'] ? $post['rate'] : 0;
            $post['email'] = $post['email'] ? $post['email'] : '';

            if (!empty($post['name'])) {
                if (update_employee($post, $id)) {
                    $_SESSION['msg'] = 'Dati mainīti!';
                }
            } else {
                $_SESSION['msg'] = 'Vārds obligāts!';
            }
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            break;
        default:
            return render(__FUNCTION__);
            break;
    }
}

function delete()
{
    return render(__FUNCTION__);
}

function insert()
{
    require_once model();
    unset($_SESSION['msg']);
    $post['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $post['last_name'] = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $post['phone'] = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $post['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $post['role'] = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    $post['rate'] = filter_input(INPUT_POST, 'rate', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) * 1;

    if (!empty($post['name'])) {
        if (insert_employee($post)) {
            $_SESSION['msg'] = 'Darbinieks pievienots!';
        }
    } else {
        $_SESSION['msg'] = 'Vārds obligāts!';
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

function drop()
{
    require_once model();
    unset($_SESSION['msg']);
    $post_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if (drop_employee($post_name, $id)) {
        $_SESSION['msg'] = 'Darbinieks dzēsts!';
    } else {
        $_SESSION['msg'] = 'Nekorekti dati!';
    }
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
