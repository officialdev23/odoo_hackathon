<?php

require_once "../config/config.php";

require_once "../includes/session.php";

require_once "../includes/functions.php";

require_once "../includes/flash.php";

require_once "../models/User.php";

$user = new User();

if (isset($_GET['action'])) {

    switch ($_GET['action']) {

        case "login":

            login($user);

            break;
    }
}

function login($user)
{

    $email = sanitize($_POST['email']);

    $password = $_POST['password'];

    $data = $user->getUserByEmail($email);

    if (!$data) {

        setFlash("danger", "Invalid Email");

        redirect("../login.php");
    }

    if (!password_verify($password, $data['password'])) {

        setFlash("danger", "Incorrect Password");

        redirect("../login.php");
    }

    $_SESSION['user_id'] = $data['user_id'];

    $_SESSION['role_name'] = $data['role_name'];

    $_SESSION['full_name'] = $data['first_name'] . " " . $data['last_name'];

    redirect("../dashboard.php");
}
