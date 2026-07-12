<?php

require_once "../models/Allocation.php";

$model = new Allocation();

header("Content-Type: application/json");

echo json_encode(

    $model->getById($_GET['id'])

);
