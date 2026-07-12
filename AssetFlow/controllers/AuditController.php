<?php

require_once "../config/config.php";
require_once "../includes/session.php";
require_once "../includes/functions.php";
require_once "../includes/flash.php";
require_once "../models/User.php";

$user = new User();

$action = $_GET['action'] ?? '';

switch ($action) {

    case "login":
        login($user);
        break;

    case "register":
        register($user);
        break;
}

// ==============================
// LOGIN
// ==============================

function login($user)
{
    $email = sanitize($_POST['email']);
    $password = $_POST['password'];

    $data = $user->getUserByEmail($email);

    if (!$data) {

        setFlash("danger", "Email not found");

        redirect("../login.php");
    }

    if (!password_verify($password, $data['password'])) {

        setFlash("danger", "Incorrect password");

        redirect("../login.php");
    }

    if ($data['status'] != "Active") {

        setFlash("danger", "Your account is inactive.");

        redirect("../login.php");
    }

    $_SESSION['user_id'] = $data['user_id'];
    $_SESSION['role_name'] = $data['role_name'];
    $_SESSION['full_name'] = $data['first_name'] . " " . $data['last_name'];
    $_SESSION['email'] = $data['email'];

    $user->updateLastLogin($data['user_id']);

    $user->addActivityLog(
        $data['user_id'],
        "LOGIN",
        "Authentication",
        "User logged into the system."
    );

    switch ($data['role_name']) {

        case "Admin":
            redirect("../admin/dashboard.php");
            break;

        case "Asset Manager":
            redirect("../manager/dashboard.php");
            break;

        case "Department Head":
            redirect("../department/dashboard.php");
            break;

        default:
            redirect("../employee/dashboard.php");
            break;
    }
}

// ==============================
// REGISTER
// ==============================

function register($user)
{
    $first = sanitize($_POST['first_name']);
    $last = sanitize($_POST['last_name']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);

    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password != $confirm) {

        setFlash("danger", "Passwords do not match.");

        redirect("../signup.php");
    }

    if ($user->emailExists($email)) {

        setFlash("danger", "Email already exists.");

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

    setFlash("success", "Registration Successful!");

    redirect("../login.php");
}
