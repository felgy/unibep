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

    $post['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $post['last_name'] = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $post['phone'] = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $post['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $post['role'] = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    $post['rate'] = filter_input(INPUT_POST, 'rate', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    if (insert_employee($post)) {
        header('Location: /employee');
        die;
    } else {
        throw new Exception('Error function "insert_employee"');
    }
}

function change()
{
    require_once model();

    $post['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $post['last_name'] = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $post['phone'] = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $post['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $post['role'] = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
    $post['rate'] = filter_input(INPUT_POST, 'rate', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    if (update_employee($post)) {
        header('Location: /employee');
        die;
    } else {
        throw new Exception('Error function "update_employee"');
    }
}

function drop()
{
    require_once model();
    $post['name'] = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    if (drop_employee($post)) {
        header('Location: /employee');
        die;
    } else {
        throw new Exception('Error function "drop_employee"');
    }
}
