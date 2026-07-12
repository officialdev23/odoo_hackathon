<?php

require_once "../config/config.php";
require_once "../models/Employee.php";
require_once "../includes/functions.php";
require_once "../includes/session.php";
require_once "../includes/flash.php";

$employee = new Employee();

$action = $_GET['action'] ?? '';

switch ($action) {

    case "add":
        addEmployee();
        break;

    case "update":
        updateEmployee();
        break;

    case "delete":
        deleteEmployee();
        break;
}

function addEmployee()
{
    global $employee;

    $employee->create([

        "employee_code" => $employee->generateEmployeeCode(),

        "first_name" => sanitize($_POST['first_name']),

        "last_name" => sanitize($_POST['last_name']),

        "email" => sanitize($_POST['email']),

        "phone" => sanitize($_POST['phone']),

        "department_id" => $_POST['department_id'],

        "designation" => sanitize($_POST['designation']),

        "status" => $_POST['status']

    ]);

    setFlash("success", "Employee Added Successfully");

    redirect("../dashboard.php?page=employees");
}

function updateEmployee()
{
    global $employee;

    $employee->update([

        "employee_id" => $_POST['employee_id'],

        "first_name" => sanitize($_POST['first_name']),

        "last_name" => sanitize($_POST['last_name']),

        "email" => sanitize($_POST['email']),

        "phone" => sanitize($_POST['phone']),

        "department_id" => $_POST['department_id'],

        "designation" => sanitize($_POST['designation']),

        "status" => $_POST['status']

    ]);

    setFlash("success", "Employee Updated Successfully");

    redirect("../dashboard.php?page=employees");
}

function deleteEmployee()
{
    global $employee;

    $employee->delete($_GET['id']);

    setFlash("success", "Employee Deleted Successfully");

    redirect("../dashboard.php?page=employees");
}
