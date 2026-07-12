<?php

require_once "../models/Asset.php";
require_once "../includes/functions.php";
require_once "../includes/flash.php";

$asset = new Asset();

$action = $_GET['action'] ?? '';

switch ($action) {

    case "add":
        addAsset();
        break;
}

function addAsset()
{
    global $asset;

    $asset->create([

        "asset_code" => $asset->generateAssetCode(),

        "asset_name" => sanitize($_POST['asset_name']),

        "category_id" => $_POST['category_id'],

        "department_id" => $_POST['department_id'],

        "purchase_date" => $_POST['purchase_date'],

        "purchase_cost" => $_POST['purchase_cost'],

        "vendor" => sanitize($_POST['vendor']),

        "serial_number" => sanitize($_POST['serial_number']),

        "asset_status" => $_POST['asset_status'],

        "remarks" => sanitize($_POST['remarks'])

    ]);

    setFlash("success", "Asset Added Successfully");

    redirect("../dashboard.php?page=assets");
}
