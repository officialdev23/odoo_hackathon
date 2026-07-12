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

        case "register":

            register($user);

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

function register($user)
{

    $first = sanitize($_POST['first_name']);

    $last = sanitize($_POST['last_name']);

    $email = sanitize($_POST['email']);

    $phone = sanitize($_POST['phone']);

    $password = $_POST['password'];

    $confirm = $_POST['confirm_password'];

    if ($password != $confirm) {
        setFlash("danger", "Passwords do not match");

        redirect("../signup.php");
    }

    if ($user->emailExists($email)) {
        setFlash("danger", "Email already exists");

        redirect("../signup.php");
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $employeeCode = "EMP" . time();

    $user->register([

        'employee_code' => $employeeCode,

        'first_name' => $first,

        'last_name' => $last,

        'email' => $email,

        'phone' => $phone,

        'password' => $hash

    ]);

    setFlash("success", "Account created successfully.");

    redirect("../login.php");
}
