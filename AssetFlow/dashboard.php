<?php

require_once __DIR__ . "/config/config.php";
require_once ROOT_PATH . "/includes/session.php";
require_once ROOT_PATH . "/middleware/AuthMiddleware.php";

require_once ROOT_PATH . "/layouts/header.php";
require_once ROOT_PATH . "/layouts/sidebar.php";
require_once ROOT_PATH . "/layouts/navbar.php";

// Default page
$page = $_GET['page'] ?? "dashboard_home";

// Allowed pages
$allowedPages = [
    "dashboard_home",
    "organization",
    "assets",
    "allocation",
    "maintenance",
    "reports",
    "notifications",
    "settings"
];

if (!in_array($page, $allowedPages)) {
    $page = "dashboard_home";
}

?>

<div class="content">

    <?php

    include ROOT_PATH . "/pages/" . $page . ".php";

    ?>

</div>

<?php

require_once ROOT_PATH . "/layouts/footer.php";

?>