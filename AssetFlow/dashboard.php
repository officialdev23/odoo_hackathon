<?php

require_once "includes/session.php";

require_once "middleware/AuthMiddleware.php";

?>

<!DOCTYPE html>

<html>

<head>

    <title>Dashboard</title>

</head>

<body>

    <h1>

        Welcome

        <?= $_SESSION['full_name']; ?>

    </h1>

    <h3>

        Role :

        <?= $_SESSION['role_name']; ?>

    </h3>

    <a href="logout.php">

        Logout

    </a>

</body>

</html>