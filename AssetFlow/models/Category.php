<?php

require_once __DIR__ . "/../config/database.php";

class Category
{
    private $conn;

    public function __construct()
    {
        $db = new Database();

        $this->conn = $db->connect();
    }

    public function getAll()
    {
        $stmt = $this->conn->prepare("SELECT * FROM asset_categories ORDER BY category_name");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->conn->prepare("

        INSERT INTO asset_categories

        (

        category_name,

        description,

        status

        )

        VALUES

        (?,?,?)

        ");

        return $stmt->execute([

            $data['category_name'],

            $data['description'],

            $data['status']

        ]);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM asset_categories WHERE category_id=?");

        return $stmt->execute([$id]);
    }
}
