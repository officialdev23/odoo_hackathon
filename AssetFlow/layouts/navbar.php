<?php
require_once __DIR__ . "/../config/config.php";
require_once ROOT_PATH . "/includes/session.php";

$pageTitles = [
    "dashboard_home" => "Dashboard",
    "organization" => "Organization Setup",
    "employees" => "Employees",
    "assets" => "Assets",
    "allocation" => "Asset Allocation",
    "maintenance" => "Maintenance",
    "report_analysis" => "Report",
    "notifications" => "Notifications",
    "settings" => "Settings"
];

$currentPage = $_GET['page'] ?? "dashboard_home";
$title = $pageTitles[$currentPage] ?? "Dashboard";

// Calculate Initials for Avatar
$fullName = $_SESSION['full_name'] ?? 'Admin User';
$nameParts = explode(" ", $fullName);
$initials = '';
if (count($nameParts) > 0) {
    $initials .= strtoupper(substr($nameParts[0], 0, 1));
    if (count($nameParts) > 1 && !empty($nameParts[1])) {
        $initials .= strtoupper(substr($nameParts[1], 0, 1));
    }
}
$initials = $initials ? $initials : 'U';
$userRole = $_SESSION['role_name'] ?? 'Staff';
?>
<div class="main">

    <div class="navbar">

        <div class="nav-left">
            <h4 class="page-title"><?= $title ?></h4>
        </div>

        <div class="nav-right">
            
            <!-- Notification Bell with Badge -->
            <a href="<?= BASE_URL ?>dashboard.php?page=notifications" class="nav-notification-btn">
                <i class="fa-regular fa-bell"></i>
                <span class="notification-badge-dot"></span>
            </a>

            <!-- Divider -->
            <span class="nav-divider-vertical"></span>

            <!-- Profile Info with Initials Avatar -->
            <div class="profile-container">
                <div class="profile-avatar">
                    <?= $initials ?>
                </div>
                <div class="profile-info">
                    <span class="profile-name"><?= htmlspecialchars($fullName) ?></span>
                    <span class="profile-role"><?= htmlspecialchars($userRole) ?></span>
                </div>
            </div>

        </div>

    </div>