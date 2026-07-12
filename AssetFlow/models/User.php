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

    public function getUserByEmail($email)
    {

        $sql = "SELECT users.*,
              roles.role_name

              FROM users

              JOIN roles

              ON users.role_id=roles.role_id

              WHERE email=?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$email]);

        return $stmt->fetch();
    }
}
