<?php

require_once __DIR__ . "/../config/config.php";
require_once ROOT_PATH . "/includes/session.php";

function authorize($allowedRoles)
{
    if (!isset($_SESSION['role_name'])) {
        header("Location: " . BASE_URL . "login.php");
        exit();
    }

    if (!in_array($_SESSION['role_name'], $allowedRoles)) {
        http_response_code(403);
        die("<h2>403 - Access Denied</h2>");
    }
}
