<?php

require_once __DIR__ . "/../config/database.php";

class Allocation
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // ===========================
    // Get All Allocations
    // ===========================

    public function getAll()
    {
        $sql = "SELECT

                al.*,

                a.asset_code,
                a.asset_name,

                e.employee_code,
                CONCAT(e.first_name,' ',e.last_name) employee_name,

                d.department_name

                FROM asset_allocations al

                INNER JOIN assets a
                ON al.asset_id=a.asset_id

                INNER JOIN employees e
                ON al.employee_id=e.employee_id

                INNER JOIN departments d
                ON e.department_id=d.department_id

                ORDER BY al.allocation_id DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===========================
    // Available Assets
    // ===========================

    public function getAssets()
    {
        $stmt = $this->conn->prepare(

            "SELECT *

        FROM assets

        WHERE asset_status='Available'

        ORDER BY asset_name"

        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===========================
    // Active Employees
    // ===========================

    public function getEmployees()
    {
        $stmt = $this->conn->prepare(

            "SELECT

        employee_id,

        employee_code,

        CONCAT(first_name,' ',last_name) employee_name

        FROM employees

        WHERE status='Active'

        ORDER BY first_name"

        );

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===========================
    // Create Allocation
    // ===========================

    public function create($data)
    {
        $sql = "INSERT INTO asset_allocations(

        asset_id,

        employee_id,

        allocation_date,

        expected_return,

        remarks

        )

        VALUES(?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);

        $result = $stmt->execute([

            $data['asset_id'],

            $data['employee_id'],

            $data['allocation_date'],

            $data['expected_return'],

            $data['remarks']

        ]);

        if ($result) {

            $this->conn->prepare(

                "UPDATE assets

            SET asset_status='Allocated'

            WHERE asset_id=?"

            )->execute([$data['asset_id']]);
        }

        return $result;
    }

    // ===========================
    // Get Allocation
    // ===========================

    public function getById($id)
    {
        $sql = "SELECT

            al.*,

            a.asset_code,
            a.asset_name,

            e.employee_code,
            CONCAT(e.first_name,' ',e.last_name) employee_name,
            e.department_id,

            d.department_name

            FROM asset_allocations al

            INNER JOIN assets a
            ON al.asset_id=a.asset_id

            INNER JOIN employees e
            ON al.employee_id=e.employee_id

            INNER JOIN departments d
            ON e.department_id=d.department_id

            WHERE allocation_id=?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($data)
    {
        $sql = "UPDATE asset_allocations SET

        asset_id=?,
        employee_id=?,
        allocation_date=?,
        expected_return=?,
        allocation_status=?,
        remarks=?

        WHERE allocation_id=?";

        $stmt = $this->conn->prepare($sql);

        $result = $stmt->execute([

            $data['asset_id'],
            $data['employee_id'],
            $data['allocation_date'],
            $data['expected_return'],
            $data['allocation_status'],
            $data['remarks'],
            $data['allocation_id']

        ]);

        // Sync Asset Status
        if ($data['allocation_status'] == "Returned") {

            $this->conn->prepare(
                "UPDATE assets
             SET asset_status='Available'
             WHERE asset_id=?"
            )->execute([$data['asset_id']]);
        } else {

            $this->conn->prepare(
                "UPDATE assets
             SET asset_status='Allocated'
             WHERE asset_id=?"
            )->execute([$data['asset_id']]);
        }

        return $result;
    }

    // ===========================
    // Return Asset
    // ===========================

    public function returnAsset($id)
    {

        $stmt = $this->conn->prepare(

            "SELECT asset_id

        FROM asset_allocations

        WHERE allocation_id=?"

        );

        $stmt->execute([$id]);

        $allocation = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->conn->prepare(

            "UPDATE asset_allocations

        SET

        allocation_status='Returned',

        actual_return=CURDATE()

        WHERE allocation_id=?"

        )->execute([$id]);

        $this->conn->prepare(

            "UPDATE assets

        SET asset_status='Available'

        WHERE asset_id=?"

        )->execute([$allocation['asset_id']]);
    }

    // ===========================
    // Delete
    // ===========================

    public function delete($id)
    {
        $stmt = $this->conn->prepare(

            "DELETE FROM asset_allocations

        WHERE allocation_id=?"

        );

        return $stmt->execute([$id]);
    }
}
