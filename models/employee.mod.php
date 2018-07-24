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
    $sql = "SELECT `id`, `name`, last_name FROM `employees` WHERE `id` = $id";
    $employee = $db->get($sql);

    return [
        'title' => 'Darbinieka dzēšana',
        'employee' => $employee,
    ];
}

function insert_employee($post)
{
    $db = new \core\Db();
    $values = array_values($post);
    $data = implode(', ', array_map(function ($item) use ($db) {
        return $db->quote($item);
    }, $values));
    $sql = "INSERT INTO `employees` (`name`, last_name, `phone`, `email`, `role`, `rate`) VALUES ($data)";
    return $db->execute($sql);
}

function update_employee($post)
{
    $db = new \core\Db();
    $id = $db->quote(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));
    $values = array_values($post);
    $assignment_list = '';
    $fields = ['`name`', '`last_name`', '`phone`', '`email`', '`role`', '`rate`'];
    for ($i = 0; $i < count($fields); $i++) {
        $assignment_list .= $fields[$i] . ' = ' . $db->quote($values[$i]) . ',';
    }
    $assignment_list = rtrim($assignment_list, ',');
    $sql = "UPDATE `employees` SET $assignment_list WHERE `id` = $id";
    return $db->execute($sql);
}

function drop_employee($post)
{
    $db = new \core\Db();
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $sql = "SELECT `name` FROM `employees` WHERE `id` = $id";
    $employee = $db->get($sql);
    $employee = $employee[0]['name'];
    if ($post['name'] === $employee) {
        $sql = "DELETE FROM `employees` WHERE `id` = $id";
        return $db->execute($sql);
    } else {
        return false;
    }
}