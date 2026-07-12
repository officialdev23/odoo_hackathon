<?php
require_once "../config/config.php";
require_once "../models/Asset.php";
require_once "../includes/functions.php";
require_once "../includes/flash.php";

$asset = new Asset();

$action = $_GET['action'] ?? '';

switch ($action) {
    case "add":
        addAsset();
        break;

    case "update":
        updateAsset();
        break;

    case "delete":
        deleteAsset();
        break;
}
function addAsset()
{
    global $asset;
    $imageName = "default.png";

    if (
        isset($_FILES['asset_image']) &&
        $_FILES['asset_image']['error'] == 0
    ) {

        $imageName = time() . "_" . basename($_FILES['asset_image']['name']);

        move_uploaded_file(

            $_FILES['asset_image']['tmp_name'],

            __DIR__ . "/../assets/uploads/assets/" . $imageName

        );
    }
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

        "remarks" => sanitize($_POST['remarks']),

        "asset_image" => $imageName

    ]);

    setFlash("success", "Asset Added Successfully");

    redirect("../dashboard.php?page=assets");
}
function updateAsset()
{
    global $asset;

    $oldImage = $_POST['old_image'];

    $imageName = $oldImage;

    if (
        isset($_FILES['asset_image']) &&
        $_FILES['asset_image']['error'] == 0
    ) {

        $imageName = time() . "_" . basename($_FILES['asset_image']['name']);

        move_uploaded_file(

            $_FILES['asset_image']['tmp_name'],

            __DIR__ . "/../assets/uploads/assets/" . $imageName

        );

        if (
            $oldImage != "default.png" &&
            file_exists(__DIR__ . "/../assets/uploads/assets/" . $oldImage)
        ) {

            unlink(__DIR__ . "/../assets/uploads/assets/" . $oldImage);
        }
    }

    $asset->update([

        "asset_id" => $_POST['asset_id'],

        "asset_name" => sanitize($_POST['asset_name']),

        "category_id" => $_POST['category_id'],

        "department_id" => $_POST['department_id'],

        "purchase_date" => $_POST['purchase_date'],

        "purchase_cost" => $_POST['purchase_cost'],

        "vendor" => sanitize($_POST['vendor']),

        "serial_number" => sanitize($_POST['serial_number']),

        "asset_status" => $_POST['asset_status'],

        "remarks" => sanitize($_POST['remarks']),

        "asset_image" => $imageName

    ]);

    setFlash("success", "Asset Updated Successfully");

    redirect("../dashboard.php?page=assets");
}

function deleteAsset()
{
    global $asset;

    $asset->delete($_GET['id']);

    setFlash("success", "Asset Deleted Successfully");

    redirect("../dashboard.php?page=assets");
}
