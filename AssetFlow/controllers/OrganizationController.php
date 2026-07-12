<?php

require_once "../models/Department.php";
require_once "../models/Category.php";

require_once "../includes/functions.php";
require_once "../includes/flash.php";

$department = new Department();
$category = new Category();

$action = $_GET['action'] ?? '';

switch ($action) {
    case "add_department":
        addDepartment();
        break;

    case "delete_department":
        deleteDepartment();
        break;

    case "add_category":
        addCategory();
        break;

    case "delete_category":
        deleteCategory();
        break;
}

function addDepartment()
{
    global $department;

    $department->create([
        "department_code" => sanitize($_POST['department_code']),
        "department_name" => sanitize($_POST['department_name']),
        "manager_name" => sanitize($_POST['manager_name']),
        "description" => sanitize($_POST['description']),
        "status" => sanitize($_POST['status'])
    ]);

    setFlash("success", "Department Added");

    redirect("../dashboard.php?page=organization");
}

function deleteDepartment()
{
    global $department;

    $department->delete($_GET['id']);

    setFlash("success", "Department Deleted");

    redirect("../dashboard.php?page=organization");
}

function addCategory()
{
    global $category;

    $category->create([
        "category_name" => sanitize($_POST['category_name']),
        "description" => sanitize($_POST['description']),
        "status" => sanitize($_POST['status'])
    ]);

    setFlash("success", "Category Added");

    redirect("../dashboard.php?page=organization");
}

function deleteCategory()
{
    global $category;

    $category->delete($_GET['id']);

    setFlash("success", "Category Deleted");

    redirect("../dashboard.php?page=organization");
}
