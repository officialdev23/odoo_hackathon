<?php

require_once "../config/config.php";
require_once "../models/Allocation.php";
require_once "../includes/functions.php";
require_once "../includes/flash.php";

$model = new Allocation();

$action = $_GET['action'] ?? '';

switch ($action) {

    case "add":

        $model->create([

            "asset_id" => $_POST['asset_id'],

            "employee_id" => $_POST['employee_id'],

            "allocation_date" => $_POST['allocation_date'],

            "expected_return" => $_POST['expected_return'],

            "remarks" => sanitize($_POST['remarks'])

        ]);

        setFlash("success", "Asset Allocated Successfully");

        redirect("../dashboard.php?page=allocation");

        break;

    case "return":

        $model->returnAsset($_GET['id']);

        setFlash("success", "Asset Returned Successfully");

        redirect("../dashboard.php?page=allocation");

        break;

    case "delete":

        $model->delete($_GET['id']);

        setFlash("success", "Allocation Deleted Successfully");

        redirect("../dashboard.php?page=allocation");

        break;
    case "update":

        $model->update([

            "allocation_id" => $_POST['allocation_id'],

            "asset_id" => $_POST['asset_id'],

            "employee_id" => $_POST['employee_id'],

            "allocation_date" => $_POST['allocation_date'],

            "expected_return" => $_POST['expected_return'],

            "allocation_status" => $_POST['allocation_status'],

            "remarks" => sanitize($_POST['remarks'])

        ]);

        setFlash("success", "Allocation Updated Successfully");

        redirect("../dashboard.php?page=allocation");

        break;
}
