<?php
require_once ROOT_PATH . "/models/Department.php";
require_once ROOT_PATH . "/models/Category.php";

$model = new Department();
$departments = $model->getAll();

$categoryModel = new Category();
$categories = $categoryModel->getAll();
?>

<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
    <div>
        <h2 class="fw-bold text-main mb-1">Organization Setup</h2>
        <small class="text-muted">Manage departments, asset categories, and view general statistics.</small>
    </div>
    
    <ul class="nav nav-tabs border-0 mt-3 mt-md-0" id="orgTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active px-4 py-2 fw-semibold rounded-pill me-2 border-0" 
                    id="dept-tab" data-bs-toggle="tab" data-bs-target="#departments" type="button" role="tab">
                <i class="fa-solid fa-building me-1"></i> Departments
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link px-4 py-2 fw-semibold rounded-pill me-2 border-0" 
                    id="cat-tab" data-bs-toggle="tab" data-bs-target="#categories" type="button" role="tab">
                <i class="fa-solid fa-tags me-1"></i> Categories
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link px-4 py-2 fw-semibold rounded-pill border-0" 
                    id="emp-tab" data-bs-toggle="tab" data-bs-target="#employees" type="button" role="tab">
                <i class="fa-solid fa-users me-1"></i> Summary
            </button>
        </li>
    </ul>
</div>

<div class="tab-content" id="orgTabsContent">

    <!-- Departments Tab Pane -->
    <div class="tab-pane fade show active" id="departments" role="tabpanel" aria-labelledby="dept-tab">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                    <h4 class="fw-bold text-dark mb-0">Department Listings</h4>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#departmentModal">
                        <i class="fa-solid fa-plus me-1"></i> Add Department
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Manager</th>
                                <th>Status</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($departments) > 0): ?>
                                <?php foreach ($departments as $dept): ?>
                                    <tr>
                                        <td><span class="fw-bold text-dark"><?= htmlspecialchars($dept['department_code']); ?></span></td>
                                        <td><?= htmlspecialchars($dept['department_name']); ?></td>
                                        <td><?= htmlspecialchars($dept['manager_name'] ? $dept['manager_name'] : 'Unassigned'); ?></td>
                                        <td>
                                            <span class="badge rounded-pill bg-<?= $dept['status'] == 'Active' ? 'success' : 'danger'; ?> px-3 py-2">
                                                <?= htmlspecialchars($dept['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-danger" 
                                               onclick="return confirm('Are you sure you want to delete this department?')"
                                               href="<?= BASE_URL ?>controllers/OrganizationController.php?action=delete_department&id=<?= $dept['department_id']; ?>">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No departments registered.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Categories Tab Pane -->
    <div class="tab-pane fade" id="categories" role="tabpanel" aria-labelledby="cat-tab">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                    <h4 class="fw-bold text-dark mb-0">Asset Categories</h4>
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#categoryModal">
                        <i class="fa-solid fa-plus me-1"></i> Add Category
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($categories) > 0): ?>
                                <?php foreach ($categories as $cat): ?>
                                    <tr>
                                        <td><span class="fw-bold text-dark"><?= htmlspecialchars($cat['category_name']); ?></span></td>
                                        <td><?= htmlspecialchars($cat['description'] ? $cat['description'] : 'No description provided'); ?></td>
                                        <td>
                                            <span class="badge rounded-pill bg-<?= $cat['status'] == 'Active' ? 'success' : 'danger'; ?> px-3 py-2">
                                                <?= htmlspecialchars($cat['status']); ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-outline-danger" 
                                               onclick="return confirm('Are you sure you want to delete this asset category?')"
                                               href="<?= BASE_URL ?>controllers/OrganizationController.php?action=delete_category&id=<?= $cat['category_id']; ?>">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">No asset categories registered.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- Summary / Employees Tab Pane -->
    <div class="tab-pane fade" id="employees" role="tabpanel" aria-labelledby="emp-tab">
        <?php
        require_once ROOT_PATH . "/models/Employee.php";
        $employeeModel = new Employee();
        $employees = $employeeModel->getAll();
        $totalEmployees = count($employees);
        $activeEmployees = 0;
        $inactiveEmployees = 0;

        foreach ($employees as $emp) {
            if ($emp['status'] == "Active") {
                $activeEmployees++;
            } else {
                $inactiveEmployees++;
            }
        }
        ?>

        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card dashboard-card shadow-sm border-0">
                    <div class="card-body p-4 text-center">
                        <h2 class="fw-bold text-primary mb-1"><?= $totalEmployees ?></h2>
                        <small class="text-muted">Total Registered Employees</small>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card dashboard-card shadow-sm border-0">
                    <div class="card-body p-4 text-center">
                        <h2 class="fw-bold text-success mb-1"><?= $activeEmployees ?></h2>
                        <small class="text-muted">Active Employees</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card dashboard-card shadow-sm border-0">
                    <div class="card-body p-4 text-center">
                        <h2 class="fw-bold text-danger mb-1"><?= $inactiveEmployees ?></h2>
                        <small class="text-muted">Inactive Employees</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold text-dark mb-0">Recent Registrations</h4>
                    <a href="<?= BASE_URL ?>dashboard.php?page=employees" class="btn btn-outline-primary btn-sm">
                        <i class="fa-solid fa-users me-1"></i> Manage Directory
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Employee Code</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Designation</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (array_slice($employees, 0, 5) as $emp): ?>
                                <tr>
                                    <td><span class="fw-bold text-dark"><?= htmlspecialchars($emp['employee_code']); ?></span></td>
                                    <td><?= htmlspecialchars($emp['first_name'] . " " . $emp['last_name']); ?></td>
                                    <td><?= htmlspecialchars($emp['department_name']); ?></td>
                                    <td><?= htmlspecialchars($emp['designation'] ? $emp['designation'] : 'N/A'); ?></td>
                                    <td>
                                        <span class="badge rounded-pill bg-<?= $emp['status'] == 'Active' ? 'success' : 'danger'; ?> px-3 py-2">
                                            <?= htmlspecialchars($emp['status']); ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Department Modal -->
<div class="modal fade" id="departmentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?= BASE_URL ?>controllers/DepartmentController.php?action=add">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Add Department</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Department Code</label>
                        <input class="form-control" name="department_code" placeholder="e.g. HR, IT-DEV" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Department Name</label>
                        <input class="form-control" name="department_name" placeholder="e.g. Human Resources" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Manager Name</label>
                        <input class="form-control" name="manager_name" placeholder="e.g. Jane Smith">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" name="description" placeholder="Brief description..." rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select class="form-select" name="status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Department</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="<?= BASE_URL ?>controllers/OrganizationController.php?action=add_category">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category Name</label>
                        <input class="form-control" name="category_name" placeholder="e.g. Laptops, Office Desks" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea class="form-control" name="description" placeholder="Brief description..." rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select class="form-select" name="status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>