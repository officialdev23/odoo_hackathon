<?php

function authorize($allowedRoles)
{
    if (!isset($_SESSION['role_name'])) {
        header("Location: login.php");
        exit();
    }

    if (!in_array($_SESSION['role_name'], $allowedRoles)) {
        die("<h2>403 Access Denied</h2>");
    }
}
