<?php

function get_index_data()
{
    unset($_SESSION['msg']);
    $db = new \core\Db();
    $expr = "SELECT * FROM `employees`";
    $employees = $db->getAll($expr);
    return [
        'title' => 'Darbinieku saraksts',
        'employees' => $employees,
    ];
}

function get_add_data()
{
    $display = !empty($_SESSION['msg']) ? 'show' : 'hidden';
    $message = isset($_SESSION['msg']) ? $_SESSION['msg'] : null;
    return [
        'title' => 'Darbinieka pievienošana',
        'display' => $display,
        'message' => $message,
    ];
}

function get_update_data()
{
    $display = !empty($_SESSION['msg']) ? 'show' : 'hidden';
    $message = isset($_SESSION['msg']) ? $_SESSION['msg'] : null;
    $id = $_GET['id'];
    $db = new \core\Db();
    $expr = "SELECT * FROM `employees` WHERE `id` = $id";
    $employee = $db->getAll($expr);

    return [
        'title' => 'Darbinieka datu izmaiņas',
        'employee' => $employee,
        'display' => $display,
        'message' => $message,
    ];
}

function get_delete_data()
{
    $display = !empty($_SESSION['msg']) ? 'show' : 'hidden';
    $message = isset($_SESSION['msg']) ? $_SESSION['msg'] : null;
    $id = $_GET['id'];
    $db = new \core\Db();
    $expr = "SELECT `id`, `name`, `last_name` FROM `employees` WHERE `id` = $id";
    $employee = $db->getAll($expr);
    if (empty($employee)) {
        $employee = null;
    }
    return [
        'title' => 'Darbinieka dzēšana',
        'employee' => $employee,
        'display' => $display,
        'message' => $message,
    ];
}

function insert_employee($post)
{
    $db = new \core\Db();
    $values = array_values($post);
    $data = implode(', ', array_map(function ($item) use ($db) {
        return $db->quote($item);
    }, $values));
    $expr = "INSERT INTO `employees` (`name`, `last_name`, `phone`, `email`, `role`, `rate`) VALUES ($data)";
    return $db->execute($expr);
}

function update_employee($post, $id)
{
    $db = new \core\Db();
    $values = array_values($post);
    $assignment_list = '';
    $fields = ['`name`', '`last_name`', '`phone`', '`email`', '`role`', '`rate`'];
    for ($i = 0; $i < count($fields); $i++) {
        $assignment_list .= $fields[$i] . ' = ' . $db->quote($values[$i]) . ',';
    }
    $assignment_list = rtrim($assignment_list, ',');
    $expr = "UPDATE `employees` SET $assignment_list WHERE `id` = $id";
    return $db->execute($expr);
}

/**
 * Deletes employee data from database.
 * Compares the name of the confirmation form with the database.
 * @param $post_name
 * @param $id
 * @return bool|int
 */
function drop_employee($post_name, $id)
{
    $db = new \core\Db();

    $expr = "SELECT `name` FROM `employees` WHERE `id` = $id";
    $db_name = $db->getOne($expr);

    if ($post_name === $db_name) {
        $expr = "DELETE FROM `employees` WHERE `id` = $id";
        return $db->execute($expr);
    }
    return false;
}