<?php

date_default_timezone_set('Asia/Kolkata');

define("APP_NAME", "AssetFlow Pro");
define("APP_VERSION", "1.0.0");

$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
define("BASE_URL", $protocol . $host . "/odoo_hackathon/AssetFlow/");

define("ROOT_PATH", dirname(__DIR__));

define("UPLOAD_PATH", ROOT_PATH . "/assets/uploads/");

define("SESSION_TIMEOUT", 1800);

define("DEFAULT_PROFILE", "default.png");
