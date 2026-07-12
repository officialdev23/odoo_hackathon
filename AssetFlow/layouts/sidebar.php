<div class="sidebar">

    <div class="logo">
        <i class="fa-solid fa-cubes"></i>
        <span>AssetFlow</span>
    </div>

    <ul>

        <li>
            <a href="<?= BASE_URL ?>dashboard.php?page=dashboard_home">
                <i class="fa-solid fa-chart-line"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="<?= BASE_URL ?>dashboard.php?page=organization">
                <i class="fa-solid fa-building"></i>
                Organization
            </a>
        </li>

        <li class="nav-item">

            <a
                class="nav-link <?= $page == "employees" ? "active" : ""; ?>"
                href="<?= BASE_URL ?>dashboard.php?page=employees">

                <i class="fa-solid fa-users"></i>

                <span>Employees</span>

            </a>

        </li>

        <li>
            <a href="<?= BASE_URL ?>dashboard.php?page=assets">
                <i class="fa-solid fa-box"></i>
                Assets
            </a>
        </li>

        <li class="nav-item">

            <a

                class="nav-link <?= $page == "allocation" ? "active" : ""; ?>"

                href="<?= BASE_URL ?>dashboard.php?page=allocation">

                <i class="fa-solid fa-right-left"></i>

                <span>Allocation</span>

            </a>

        </li>

        <li>
            <a href="<?= BASE_URL ?>dashboard.php?page=maintenance">
                <i class="fa-solid fa-screwdriver-wrench"></i>
                Maintenance
            </a>
        </li>

        <li>
            <a href="<?= BASE_URL ?>dashboard.php?page=reports">
                <i class="fa-solid fa-chart-column"></i>
                Reports
            </a>
        </li>

        <li>
            <a href="<?= BASE_URL ?>dashboard.php?page=notifications">
                <i class="fa-solid fa-bell"></i>
                Notifications
            </a>
        </li>

        <li>
            <a href="<?= BASE_URL ?>dashboard.php?page=settings">
                <i class="fa-solid fa-gear"></i>
                Settings
            </a>
        </li>

        <li>
            <a href="<?= BASE_URL ?>logout.php">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </a>
        </li>

    </ul>

</div>