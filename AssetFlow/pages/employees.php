<?php

require_once ROOT_PATH . "/models/Employee.php";

$model = new Employee();

$employees = $model->getAll();
$departments = $model->getDepartments();

?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Employee Directory</h2>

    <button
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#employeeModal">

        <i class="fa-solid fa-user-plus"></i>
        Add Employee

    </button>

</div>

<table class="table table-hover table-bordered">

    <thead class="table-dark">

        <tr>

            <th>Employee Code</th>

            <th>Name</th>

            <th>Email</th>

            <th>Department</th>

            <th>Designation</th>

            <th>Status</th>

            <th width="150">Action</th>

        </tr>

    </thead>

    <tbody>

        <?php foreach ($employees as $employee): ?>

            <tr>

                <td>

                    <?= $employee['employee_code']; ?>

                </td>

                <td>

                    <?= $employee['first_name'] . " " . $employee['last_name']; ?>

                </td>

                <td>

                    <?= $employee['email']; ?>

                </td>

                <td>

                    <?= $employee['department_name']; ?>

                </td>

                <td>

                    <?= $employee['designation']; ?>

                </td>

                <td>

                    <?php

                    $color = $employee['status'] == "Active"

                        ? "success"

                        : "danger";

                    ?>

                    <span class="badge rounded-pill bg-<?= $color ?>">

                        <?= $employee['status']; ?>

                    </span>

                </td>

                <td>

                    <button

                        class="btn btn-sm btn-outline-primary viewEmployee"

                        data-id="<?= $employee['employee_id']; ?>"

                        data-bs-toggle="modal"

                        data-bs-target="#viewEmployeeModal">

                        <i class="fa-solid fa-eye"></i>

                    </button>

                    <button

                        class="btn btn-sm btn-outline-warning editEmployee"

                        data-id="<?= $employee['employee_id']; ?>"

                        data-bs-toggle="modal"

                        data-bs-target="#employeeModal">

                        <i class="fa-solid fa-pen"></i>

                    </button>

                    <a

                        class="btn btn-sm btn-outline-danger"

                        href="<?= BASE_URL ?>controllers/EmployeeController.php?action=delete&id=<?= $employee['employee_id']; ?>"

                        onclick="return confirm('Delete Employee?')">

                        <i class="fa-solid fa-trash"></i>

                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

    </tbody>

</table>

<!-- ========================= -->

<!-- Employee Modal -->

<!-- ========================= -->

<div class="modal fade" id="employeeModal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form

                id="employeeForm"

                method="POST"

                action="<?= BASE_URL ?>controllers/EmployeeController.php?action=add">

                <input
                    type="hidden"
                    name="employee_id"
                    id="employee_id">

                <div class="modal-header">

                    <h5
                        class="modal-title"
                        id="employeeModalTitle">

                        Add Employee

                    </h5>

                    <button
                        class="btn-close"
                        data-bs-dismiss="modal">

                    </button>

                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>First Name</label>

                            <input

                                type="text"

                                class="form-control"

                                name="first_name"

                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Last Name</label>

                            <input

                                type="text"

                                class="form-control"

                                name="last_name"

                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Email</label>

                            <input

                                type="email"

                                class="form-control"

                                name="email">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Phone</label>

                            <input

                                type="text"

                                class="form-control"

                                name="phone">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Department</label>

                            <select

                                class="form-select"

                                name="department_id">

                                <?php foreach ($departments as $dept): ?>

                                    <option
                                        value="<?= $dept['department_id']; ?>">

                                        <?= $dept['department_name']; ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Designation</label>

                            <input

                                type="text"

                                class="form-control"

                                name="designation">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Status</label>

                            <select

                                class="form-select"

                                name="status">

                                <option>Active</option>

                                <option>Inactive</option>

                            </select>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button

                        class="btn btn-secondary"

                        data-bs-dismiss="modal"

                        type="button">

                        Cancel

                    </button>

                    <button

                        type="submit"

                        class="btn btn-primary">

                        <span id="employeeButtonText">

                            Save Employee

                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<div class="modal fade" id="viewEmployeeModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5>Employee Details</h5>

                <button class="btn-close" data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <p><strong>Code:</strong> <span id="vCode"></span></p>

                <p><strong>Name:</strong> <span id="vName"></span></p>

                <p><strong>Email:</strong> <span id="vEmail"></span></p>

                <p><strong>Phone:</strong> <span id="vPhone"></span></p>

                <p><strong>Department:</strong> <span id="vDepartment"></span></p>

                <p><strong>Designation:</strong> <span id="vDesignation"></span></p>

                <p><strong>Status:</strong> <span id="vStatus"></span></p>

            </div>

        </div>

    </div>

</div>