<?php

require_once "../config/database.php";
require_once "../config/config.php";
require_once "../fpdf/fpdf.php";

$db = new Database();
$conn = $db->connect();

$where = [];

$params = [];

if (!empty($_POST['department'])) {

    $where[] = "e.department_id=?";

    $params[] = $_POST['department'];
}

if (!empty($_POST['employee'])) {

    $where[] = "e.employee_id=?";

    $params[] = $_POST['employee'];
}

if (!empty($_POST['asset_status'])) {

    $where[] = "a.asset_status=?";

    $params[] = $_POST['asset_status'];
}

if (!empty($_POST['from_date'])) {

    $where[] = "al.allocation_date>=?";

    $params[] = $_POST['from_date'];
}

if (!empty($_POST['to_date'])) {

    $where[] = "al.allocation_date<=?";

    $params[] = $_POST['to_date'];
}

$sql = "

SELECT

a.asset_code,

a.asset_name,

c.category_name,

CONCAT(e.first_name,' ',e.last_name) employee,

d.department_name,

a.asset_status,

al.allocation_date,

al.expected_return

FROM assets a

LEFT JOIN asset_categories c
ON a.category_id=c.category_id

LEFT JOIN asset_allocations al
ON a.asset_id=al.asset_id

LEFT JOIN employees e
ON al.employee_id=e.employee_id

LEFT JOIN departments d
ON e.department_id=d.department_id

";

if (count($where) > 0) {

    $sql .= " WHERE " . implode(" AND ", $where);
}

$sql .= " ORDER BY a.asset_name";

$stmt = $conn->prepare($sql);

$stmt->execute($params);

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$pdf = new FPDF("L");

$pdf->AddPage();

$pdf->SetFont("Arial", "B", 18);

$pdf->Cell(0, 12, "AssetFlow Report", 0, 1, "C");

$pdf->SetFont("Arial", "", 11);

$pdf->Cell(0, 8, "Generated : " . date("d M Y h:i A"), 0, 1, "C");

$pdf->Ln(5);

$pdf->SetFont("Arial", "B", 9);

$pdf->Cell(25, 8, "Code", 1);

$pdf->Cell(50, 8, "Asset", 1);

$pdf->Cell(40, 8, "Category", 1);

$pdf->Cell(50, 8, "Employee", 1);

$pdf->Cell(40, 8, "Department", 1);

$pdf->Cell(28, 8, "Status", 1);

$pdf->Cell(30, 8, "Allocated", 1);

$pdf->Cell(30, 8, "Return", 1);

$pdf->Ln();

$pdf->SetFont("Arial", "", 8);

foreach ($data as $r) {

    $pdf->Cell(25, 8, $r['asset_code'], 1);

    $pdf->Cell(50, 8, substr($r['asset_name'], 0, 28), 1);

    $pdf->Cell(40, 8, substr($r['category_name'], 0, 20), 1);

    $pdf->Cell(50, 8, substr($r['employee'] ?: "Not Allocated", 0, 28), 1);

    $pdf->Cell(40, 8, substr($r['department_name'] ?: "-", 0, 20), 1);

    $pdf->Cell(28, 8, $r['asset_status'], 1);

    $pdf->Cell(30, 8, $r['allocation_date'] ?: "-", 1);

    $pdf->Cell(30, 8, $r['expected_return'] ?: "-", 1);

    $pdf->Ln();
}

$pdf->Ln(10);

$pdf->SetFont("Arial", "B", 12);

$pdf->Cell(0, 8, "Summary", 0, 1);

$pdf->SetFont("Arial", "", 11);

$pdf->Cell(0, 7, "Total Assets : " . $conn->query("SELECT COUNT(*) FROM assets")->fetchColumn(), 0, 1);

$pdf->Cell(0, 7, "Allocated Assets : " . $conn->query("SELECT COUNT(*) FROM assets WHERE asset_status='Allocated'")->fetchColumn(), 0, 1);

$pdf->Cell(0, 7, "Available Assets : " . $conn->query("SELECT COUNT(*) FROM assets WHERE asset_status='Available'")->fetchColumn(), 0, 1);

$pdf->Cell(0, 7, "Employees : " . $conn->query("SELECT COUNT(*) FROM employees")->fetchColumn(), 0, 1);

$pdf->Output("D", "AssetFlow_Report.pdf");
