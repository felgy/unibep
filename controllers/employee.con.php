<?php

function index()
{
    return render(__FUNCTION__);
}

function add()
{
    return action(__FUNCTION__);
}

function update()
{
    return action(__FUNCTION__);
}

function drop()
{
    return action(__FUNCTION__);
}


function action($action_name)
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Clear SESSION message.
        unset($_SESSION['msg']);

        // Include model file.
        require_once model();

        $action = $action_name . '_' . controller();

        // Data from inputs.
        $post = filter_input_array(INPUT_POST, POST_ARGS);
        if (empty($post['rate'])) {
            $post['rate'] = 0;
        }
        if ($post['email'] === false) {
            $post['email'] = '';
        }
        $get = filter_input_array(INPUT_GET, GET_ARGS);

        if (!empty($post['name'])) {
            if ($action($post, $get)) {
                $_SESSION['msg'] = DONE;
            } else {
                $_SESSION['msg'] = NOT_CORRECT;
            }
        } else {
            $_SESSION['msg'] = NAME_REQUIRED;
        }
        // Redirect to self.
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die;
    } else {
        return render($action_name);
    }
}