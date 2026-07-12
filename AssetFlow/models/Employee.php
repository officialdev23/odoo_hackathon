<?php

require_once __DIR__ . "/../config/database.php";

class Employee
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $sql = "SELECT
                e.*,
                d.department_name
            FROM employees e
            INNER JOIN departments d
                ON e.department_id = d.department_id
            ORDER BY e.employee_id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Get all departments
    public function getDepartments()
    {
        $stmt = $this->conn->prepare("SELECT * FROM departments WHERE status='Active' ORDER BY department_name");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Generate Asset Code
    public function generateEmployeeCode()
    {
        $stmt = $this->conn->prepare(
            "SELECT MAX(employee_id) as last_id FROM employees"
        );

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $next = ($row['last_id'] ?? 0) + 1;

        return "EMP-" . str_pad($next, 4, "0", STR_PAD_LEFT);
    }

    // Create Employee
    public function create($data)
    {
        $sql = "INSERT INTO employees
    (
        employee_code,
        first_name,
        last_name,
        email,
        phone,
        department_id,
        designation,
        status
    )
    VALUES
    (?,?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([

            $data['employee_code'],
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['phone'],
            $data['department_id'],
            $data['designation'],
            $data['status']

        ]);
    }



    // Get Single Asset
    public function getById($id)
    {
        $sql = "SELECT

e.*,

d.department_name

FROM employees e

INNER JOIN departments d

ON e.department_id=d.department_id

WHERE employee_id=?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update Asset
    public function update($data)
    {
        $sql = "UPDATE employees SET

            first_name=?,
            last_name=?,
            email=?,
            phone=?,
            department_id=?,
            designation=?,
            status=?

            WHERE employee_id=?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([

            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['phone'],
            $data['department_id'],
            $data['designation'],
            $data['status'],
            $data['employee_id']

        ]);
    }

    // Delete Asset
    public function delete($id)
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM employees WHERE employee_id=?"
        );

        return $stmt->execute([$id]);
    }
}
