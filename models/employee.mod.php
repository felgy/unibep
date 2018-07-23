<?php

function get_index_data()
{
    $db = new \core\Db();
    $sql = "SELECT * FROM `employees`";
    $employees = $db->get($sql);

    return [
        'title' => 'Darbinieku saraksts',
        'employees' => $employees,
    ];
}

function get_add_data()
{
    return [
        'title' => 'Darbinieka pievienošana',
    ];
}

function get_update_data()
{
    $id = $_GET['id'];
    $db = new \core\Db();
    $sql = "SELECT * FROM `employees` WHERE `id` = $id";
    $employee = $db->get($sql);

    return [
        'title' => 'Darbinieka datu izmaiņas',
        'employee' => $employee,
    ];
}

function get_delete_data()
{
    $id = $_GET['id'];
    $db = new \core\Db();
    $sql = "SELECT `id`, `name`, `lastname` FROM `employees` WHERE `id` = $id";
    $employee = $db->get($sql);

    return [
        'title' => 'Darbinieka dzēšana',
        'employee' => $employee,
    ];
}

function insert_employee($post)
{
    $db = new \core\Db();
    $sql = 'INSERT INTO `employees` (
        `name`,
        `lastname`,
        `phone`,
        `email`,
        `role`,
        `rate`
    ) VALUES (
        \'' . $post['name'] . '\',
        \'' . $post['lastName'] . '\',
        \'' . $post['phone'] . '\',
        \'' . $post['email'] . '\',
        \'' . $post['role'] . '\',
        ' . $post['rate'] . '
    )';
    return $db->execute($sql);
}

function update_employee($post)
{
    $db = new \core\Db();
    $id = $_GET['id'];
    $sql = 'UPDATE `employees` 
                SET 
                    `name` = \'' . $post['name'] . '\',
                    `lastName` = \'' . $post['lastName'] . '\',
                    `phone` = \'' . $post['phone'] . '\',
                    `email` = \'' . $post['email'] . '\',
                    `role` = \'' . $post['role'] . '\',
                    `rate` = ' . $post['rate'] . '
                WHERE 
                    `id` = ' . $id;
    return $db->execute($sql);
}

function drop_employee($post)
{
    $db = new \core\Db();
    $id = $_GET['id'];

    $sql = 'SELECT `name` FROM `employees` WHERE `id` = ' . $id;
    $employee = $db->get($sql);
    $employee_name = $employee[0]['name'];
    if ($post['name'] === $employee_name) {
        $sql = 'DELETE FROM `employees` WHERE `id` = ' . $id;
        return $db->execute($sql);
    } else {
        return false;
    }
}