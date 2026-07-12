<?php

require_once __DIR__ . "/../config/config.php";
require_once ROOT_PATH . "/includes/session.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: " . BASE_URL . "login.php");
    exit();
}
