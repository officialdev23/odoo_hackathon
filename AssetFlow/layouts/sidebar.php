<?php
// Ensure session details are available for user role checking
require_once __DIR__ . "/../config/config.php";
require_once ROOT_PATH . "/includes/session.php";

$currentPage = $page ?? 'dashboard_home';
?>
<div class="sidebar">

    <div class="logo">
        <img src="<?= BASE_URL ?>assets/logo.svg" alt="AssetFlow Logo">
        <span>AssetFlow</span>
    </div>

    <ul>
        <!-- Dashboard Home -->
        <li class="nav-item">
            <a class="nav-link <?= $currentPage == "dashboard_home" ? "active" : ""; ?>"
                href="<?= BASE_URL ?>dashboard.php?page=dashboard_home">
                <i class="fa-solid fa-chart-line"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Organization -->
        <li class="nav-item">
            <a class="nav-link <?= $currentPage == "organization" ? "active" : ""; ?>"
                href="<?= BASE_URL ?>dashboard.php?page=organization">
                <i class="fa-solid fa-building"></i>
                <span>Organization</span>
            </a>
        </li>

        <!-- Employees -->
        <li class="nav-item">
            <a class="nav-link <?= $currentPage == "employees" ? "active" : ""; ?>"
                href="<?= BASE_URL ?>dashboard.php?page=employees">
                <i class="fa-solid fa-users"></i>
                <span>Employees</span>
            </a>
        </li>

        <!-- Assets -->
        <li class="nav-item">
            <a class="nav-link <?= $currentPage == "assets" ? "active" : ""; ?>"
                href="<?= BASE_URL ?>dashboard.php?page=assets">
                <i class="fa-solid fa-box"></i>
                <span>Assets</span>
            </a>
        </li>

        <!-- Allocation -->
        <li class="nav-item">
            <a class="nav-link <?= $currentPage == "allocation" ? "active" : ""; ?>"
                href="<?= BASE_URL ?>dashboard.php?page=allocation">
                <i class="fa-solid fa-right-left"></i>
                <span>Allocation</span>
            </a>
        </li>

        <!-- Maintenance
        <li class="nav-item">
            <a class="nav-link <?= $currentPage == "maintenance" ? "active" : ""; ?>" 
               href="<?= BASE_URL ?>dashboard.php?page=maintenance">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                <span>Maintenance</span>
            </a>
        </li> -->

        <!-- Reports -->
        <li>
            <a href="<?= BASE_URL ?>dashboard.php?page=report_analysis">
                <i class="fa-solid fa-chart-column"></i>
                Reports
            </a>
        </li>

        <!-- Notifications
        <li class="nav-item">
            <a class="nav-link <?= $currentPage == "notifications" ? "active" : ""; ?>"
                href="<?= BASE_URL ?>dashboard.php?page=notifications">
                <i class="fa-solid fa-bell"></i>
                <span>Notifications</span>
            </a>
        </li>

        Settings 
        <li class="nav-item">
            <a class="nav-link <?= $currentPage == "settings" ? "active" : ""; ?>"
                href="<?= BASE_URL ?>dashboard.php?page=settings">
                <i class="fa-solid fa-gear"></i>
                <span>Settings</span>
            </a>
        </li> -->

        <!-- Divider line -->
        <li class="nav-divider" style="height: 1px; background: rgba(255,255,255,0.08); margin: 15px 0;"></li>

        <!-- Logout -->
        <li class="nav-item">
            <a class="nav-link logout-link"
                href="<?= BASE_URL ?>logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Logout</span>
            </a>
        </li>
    </ul>

</div>