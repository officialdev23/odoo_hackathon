<div class="main">

    <div class="navbar">

        <div>

            <?php

            $pageTitles = [

                "dashboard_home" => "Dashboard",

                "organization" => "Organization Setup",
                "employees" => "Employees",

                "assets" => "Assets",

                "allocation" => "Asset Allocation",

                "maintenance" => "Maintenance",

                "reports" => "Reports",

                "notifications" => "Notifications",

                "settings" => "Settings"

            ];

            $currentPage = $_GET['page'] ?? "dashboard_home";

            ?>

            <h4><?= $pageTitles[$currentPage] ?></h4>

        </div>

        <div class="nav-right">

            <i class="fa-regular fa-bell"></i>

            <div class="profile">

                <?= $_SESSION['full_name']; ?>

            </div>

        </div>

    </div>