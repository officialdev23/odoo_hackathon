<?php

require_once "../models/Department.php";
require_once "../includes/functions.php";
require_once "../includes/flash.php";

$model = new Department();

$action = $_GET['action'] ?? '';

switch ($action) {

    case "add":
        addDepartment($model);
        break;

    case "delete":
        deleteDepartment($model);
        break;
}

function addDepartment($model)
{
    $data = [

        "department_code" => sanitize($_POST['department_code']),
        "department_name" => sanitize($_POST['department_name']),
        "manager_name" => sanitize($_POST['manager_name']),
        "description" => sanitize($_POST['description']),
        "status" => sanitize($_POST['status'])

    ];

    $model->create($data);

    setFlash("success", "Department Added Successfully");

    redirect("../dashboard.php?page=organization");
}

function deleteDepartment($model)
{
    $model->delete($_GET['id']);

    setFlash("success", "Department Deleted");

    redirect("../dashboard.php?page=organization");
}
