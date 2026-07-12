<?php

require_once __DIR__ . "/../config/database.php";

class Dashboard
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function count($table)
    {
        return $this->conn
            ->query("SELECT COUNT(*) FROM {$table}")
            ->fetchColumn();
    }

    public function availableAssets()
    {
        return $this->conn
            ->query("SELECT COUNT(*) FROM assets WHERE asset_status='Available'")
            ->fetchColumn();
    }

    public function allocatedAssets()
    {
        return $this->conn
            ->query("SELECT COUNT(*) FROM assets WHERE asset_status='Allocated'")
            ->fetchColumn();
    }

    public function activeEmployees()
    {
        return $this->conn
            ->query("SELECT COUNT(*) FROM employees WHERE status='Active'")
            ->fetchColumn();
    }

    public function recentAssets()
    {
        $stmt = $this->conn->query(

            "SELECT asset_code,asset_name

        FROM assets

        ORDER BY asset_id DESC

        LIMIT 5"

        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function recentAllocations()
    {
        $stmt = $this->conn->query(

            "SELECT

        a.asset_name,

        CONCAT(e.first_name,' ',e.last_name) employee,

        al.allocation_date

        FROM asset_allocations al

        INNER JOIN assets a

        ON al.asset_id=a.asset_id

        INNER JOIN employees e

        ON al.employee_id=e.employee_id

        ORDER BY al.allocation_id DESC

        LIMIT 5"

        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function assetsByCategory()
    {
        $stmt = $this->conn->query(

            "SELECT

        c.category_name,

        COUNT(*) total

        FROM assets a

        INNER JOIN asset_categories c

        ON a.category_id=c.category_id

        GROUP BY c.category_name"

        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
