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
    return render(__FUNCTION__);
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

function change()
{
    require_once model();
    unset($_SESSION['msg']);
    $post['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $post['last_name'] = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $post['phone'] = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $post['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $post['role'] = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    $post['rate'] = filter_input(INPUT_POST, 'rate', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION) * 1;
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if (!empty($post['name'])) {
        if (update_employee($post, $id)) {
            $_SESSION['msg'] = 'Dati mainīti!';
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
