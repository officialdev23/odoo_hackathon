<?php
require_once ROOT_PATH . "/models/Employee.php";

$model = new Employee();
$employees = $model->getAll();
$departments = $model->getDepartments();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-main mb-0">Employee Directory</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#employeeModal">
        <i class="fa-solid fa-user-plus me-1"></i> Add Employee
    </button>
</div>

<!-- Employee Directory Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Employee Code</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Status</th>
                        <th style="width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($employees) > 0): ?>
                        <?php foreach ($employees as $employee): ?>
                            <tr>
                                <td>
                                    <span class="fw-bold text-dark"><?= htmlspecialchars($employee['employee_code']); ?></span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">
                                        <?= htmlspecialchars($employee['first_name'] . " " . $employee['last_name']); ?>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($employee['email']); ?></td>
                                <td><?= htmlspecialchars($employee['department_name']); ?></td>
                                <td><?= htmlspecialchars($employee['designation']); ?></td>
                                <td>
                                    <?php
                                    $badgeColor = ($employee['status'] == "Active") ? "success" : "danger";
                                    ?>
                                    <span class="badge rounded-pill bg-<?= $badgeColor ?> px-3 py-2">
                                        <?= htmlspecialchars($employee['status']); ?>
                                    </span>
                                </td>
                                <td class="text-nowrap">
                                    <!-- View Details -->
                                    <button class="btn btn-sm btn-outline-primary viewEmployee me-1" 
                                            data-id="<?= $employee['employee_id']; ?>" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewEmployeeModal">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                    <!-- Edit Employee -->
                                    <button class="btn btn-sm btn-outline-warning editEmployee me-1" 
                                            data-id="<?= $employee['employee_id']; ?>" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#employeeModal">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>

                                    <!-- Delete Employee -->
                                    <a class="btn btn-sm btn-outline-danger" 
                                       href="<?= BASE_URL ?>controllers/EmployeeController.php?action=delete&id=<?= $employee['employee_id']; ?>" 
                                       onclick="return confirm('Are you sure you want to delete this employee?')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fa-regular fa-user d-block mb-2 fs-3"></i>
                                No employees registered in the system.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- Employee Form Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="employeeForm" method="POST" action="<?= BASE_URL ?>controllers/EmployeeController.php?action=add">
                <input type="hidden" name="employee_id" id="employee_id">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="employeeModalTitle">Add Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">First Name</label>
                            <input type="text" class="form-control" name="first_name" required placeholder="e.g. John">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Last Name</label>
                            <input type="text" class="form-control" name="last_name" required placeholder="e.g. Doe">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="e.g. john.doe@company.com">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" class="form-control" name="phone" placeholder="e.g. +91 98765 43210">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Department</label>
                            <select class="form-select" name="department_id">
                                <?php foreach ($departments as $dept): ?>
                                    <option value="<?= $dept['department_id']; ?>">
                                        <?= htmlspecialchars($dept['department_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Designation</label>
                            <input type="text" class="form-control" name="designation" placeholder="e.g. Software Engineer">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select" name="status">
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <span id="employeeButtonText">Save Employee</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Employee Details Modal -->
<div class="modal fade" id="viewEmployeeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Employee Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped mb-0">
                    <tr>
                        <th style="width: 40%;">Employee Code</th>
                        <td id="vCode" class="fw-bold text-dark"></td>
                    </tr>
                    <tr>
                        <th>Full Name</th>
                        <td id="vName"></td>
                    </tr>
                    <tr>
                        <th>Email Address</th>
                        <td id="vEmail"></td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td id="vPhone"></td>
                    </tr>
                    <tr>
                        <th>Department</th>
                        <td id="vDepartment"></td>
                    </tr>
                    <tr>
                        <th>Designation</th>
                        <td id="vDesignation"></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td id="vStatus"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>