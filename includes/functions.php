<?php

function sanitize($data)
{
    return htmlspecialchars(trim($data));
}

function redirect($url)
{
    header("Location: " . $url);
    exit();
}

function isLoggedIn()
{
    return isset($_SESSION['user_id']);
}

function currentUserRole()
{
    return $_SESSION['role_name'] ?? null;
}

function generateEmployeeCode($id)
{
    return "EMP-" . str_pad($id, 5, "0", STR_PAD_LEFT);
}

function generateAssetCode($id)
{
    return "AF-" . str_pad($id, 5, "0", STR_PAD_LEFT);
}
