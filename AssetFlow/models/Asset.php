<?php

require_once __DIR__ . "/../config/database.php";

class Asset
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
    }

    // Get all assets
    public function getAll()
    {
        $sql = "SELECT
                    a.*,
                    c.category_name,
                    d.department_name
                FROM assets a
                INNER JOIN asset_categories c
                    ON a.category_id = c.category_id
                INNER JOIN departments d
                    ON a.department_id = d.department_id
                ORDER BY a.asset_id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get all categories
    public function getCategories()
    {
        $stmt = $this->conn->prepare("SELECT * FROM asset_categories WHERE status='Active' ORDER BY category_name");
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
    public function generateAssetCode()
    {
        $stmt = $this->conn->prepare("SELECT MAX(asset_id) as last_id FROM assets");
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $next = ($row['last_id'] ?? 0) + 1;

        return "AST-" . str_pad($next, 6, "0", STR_PAD_LEFT);
    }

    // Create Asset
    public function create($data)
    {
        $sql = "INSERT INTO assets
        (
            asset_code,
            asset_name,
            category_id,
            department_id,
            purchase_date,
            purchase_cost,
            vendor,
            serial_number,
            asset_status,
            remarks
        )
        VALUES
        (?,?,?,?,?,?,?,?,?,?)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $data['asset_code'],
            $data['asset_name'],
            $data['category_id'],
            $data['department_id'],
            $data['purchase_date'],
            $data['purchase_cost'],
            $data['vendor'],
            $data['serial_number'],
            $data['asset_status'],
            $data['remarks']
        ]);
    }
}
