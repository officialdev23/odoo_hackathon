<?php

header('Content-Type: application/json');

require_once "../models/Asset.php";

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode([
        "success" => false,
        "message" => "Asset ID missing"
    ]);
    exit;
}

$model = new Asset();

$asset = $model->getById($_GET['id']);

if ($asset) {
    echo json_encode([
        "success" => true,
        "data" => $asset
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Asset not found"
    ]);
}
