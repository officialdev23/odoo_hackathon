<?php

require_once __DIR__ . "/../config/database.php";

class User
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // ==========================
    // GET USER BY EMAIL
    // ==========================
    public function getUserByEmail($email)
    {
        $sql = "SELECT users.*, roles.role_name
                FROM users
                INNER JOIN roles
                ON users.role_id = roles.role_id
                WHERE email=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);

        return $stmt->fetch();
    }

    // ==========================
    // CHECK EMAIL
    // ==========================
    public function emailExists($email)
    {
        $stmt = $this->conn->prepare("SELECT user_id FROM users WHERE email=?");
        $stmt->execute([$email]);

        return $stmt->rowCount() > 0;
    }

    // ==========================
    // REGISTER USER
    // ==========================
    public function register($data)
    {
        $sql = "INSERT INTO users
        (
            employee_code,
            first_name,
            last_name,
            email,
            phone,
            password,
            role_id,
            status
        )
        VALUES
        (
            ?,?,?,?,?,?,4,'Active'
        )";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $data['employee_code'],
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['phone'],
            $data['password']
        ]);
    }

    // ==========================
    // UPDATE LAST LOGIN
    // ==========================
    public function updateLastLogin($userId)
    {
        $stmt = $this->conn->prepare(
            "UPDATE users
             SET last_login = NOW()
             WHERE user_id=?"
        );

        $stmt->execute([$userId]);
    }

    // ==========================
    // ADD ACTIVITY LOG
    // ==========================
    public function addActivityLog($userId, $action, $module, $description)
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO activity_logs
            (
                user_id,
                action,
                module,
                description
            )
            VALUES
            (
                ?,?,?,?
            )"
        );

        $stmt->execute([
            $userId,
            $action,
            $module,
            $description
        ]);
    }
}
