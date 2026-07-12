<?php

require_once "../models/Employee.php";

$model = new Employee();

header("Content-Type: application/json");

echo json_encode(

    $model->getById($_GET['id'])

);
