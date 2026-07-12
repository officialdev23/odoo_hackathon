<?php

require_once ROOT_PATH . "/models/Department.php";
require_once ROOT_PATH . "/models/Category.php";

$model = new Department();

$departments = $model->getAll();
$categoryModel = new Category();

$categories = $categoryModel->getAll();

?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2 class="mb-4">Organization Setup</h2>

    <ul class="nav nav-tabs mb-4" id="orgTabs">

        <li class="nav-item">

            <button class="nav-link active"

                data-bs-toggle="tab"

                data-bs-target="#departments">

                Departments

            </button>

        </li>

        <li class="nav-item">

            <button class="nav-link"

                data-bs-toggle="tab"

                data-bs-target="#categories">

                Categories

            </button>

        </li>

        <li class="nav-item">

            <button class="nav-link"

                data-bs-toggle="tab"

                data-bs-target="#employees">

                Employees

            </button>

        </li>

    </ul>

    <!-- <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#departmentModal">

        + Add Department

    </button> -->

</div>

<div class="tab-content">

    <!-- ========================= -->
    <!-- Departments -->
    <!-- ========================= -->

    <div class="tab-pane fade show active" id="departments">

        <div class="d-flex justify-content-between mb-3">

            <h4>Departments</h4>

            <button
                class="btn btn-primary"
                data-bs-toggle="modal"
                data-bs-target="#departmentModal">

                + Add Department

            </button>

        </div>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>Code</th>

                    <th>Name</th>

                    <th>Manager</th>

                    <th>Status</th>

                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($departments as $dept): ?>

                    <tr>

                        <td><?= $dept['department_code']; ?></td>

                        <td><?= $dept['department_name']; ?></td>

                        <td><?= $dept['manager_name']; ?></td>

                        <td><?= $dept['status']; ?></td>

                        <td>

                            <a
                                class="btn btn-danger btn-sm"
                                href="<?= BASE_URL ?>controllers/OrganizationController.php?action=delete_department&id=<?= $dept['department_id']; ?>">

                                Delete

                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>


    <!-- ========================= -->
    <!-- Categories -->
    <!-- ========================= -->

    <div class="tab-pane fade" id="categories">

        <div class="d-flex justify-content-between mb-3">

            <h4>Categories</h4>

            <button
                class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#categoryModal">

                + Add Category

            </button>

        </div>

        <table class="table table-bordered table-hover">

            <thead class="table-dark">

                <tr>

                    <th>Name</th>

                    <th>Description</th>

                    <th>Status</th>

                    <th>Action</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($categories as $cat): ?>

                    <tr>

                        <td><?= $cat['category_name']; ?></td>

                        <td><?= $cat['description']; ?></td>

                        <td><?= $cat['status']; ?></td>

                        <td>

                            <a
                                class="btn btn-danger btn-sm"
                                href="<?= BASE_URL ?>controllers/OrganizationController.php?action=delete_category&id=<?= $cat['category_id']; ?>">

                                Delete

                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>


    <!-- ========================= -->
    <!-- Employees -->
    <!-- ========================= -->

    <div class="tab-pane fade" id="employees">

        <h4>Employees</h4>

        <div class="alert alert-info">

            Employee Management will be built after Categories.

        </div>

    </div>

</div>

<!-- Dept Modal  -->

<div class="modal fade" id="departmentModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST"
                action="<?= BASE_URL ?>controllers/DepartmentController.php?action=add">

                <div class="modal-header">

                    <h5>Add Department</h5>

                </div>

                <div class="modal-body">

                    <input class="form-control mb-3"
                        name="department_code"
                        placeholder="Department Code"
                        required>

                    <input class="form-control mb-3"
                        name="department_name"
                        placeholder="Department Name"
                        required>

                    <input class="form-control mb-3"
                        name="manager_name"
                        placeholder="Manager">

                    <textarea
                        class="form-control mb-3"
                        name="description"
                        placeholder="Description"></textarea>

                    <select class="form-control"
                        name="status">

                        <option>Active</option>

                        <option>Inactive</option>

                    </select>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-primary">

                        Save

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- Category model -->
<div class="modal fade" id="categoryModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <form method="POST"
                action="<?= BASE_URL ?>controllers/OrganizationController.php?action=add_category">

                <div class="modal-header">

                    <h5>Add Category</h5>

                </div>

                <div class="modal-body">

                    <input
                        class="form-control mb-3"
                        name="category_name"
                        placeholder="Category Name"
                        required>

                    <textarea
                        class="form-control mb-3"
                        name="description"
                        placeholder="Description"></textarea>

                    <select
                        class="form-control"
                        name="status">

                        <option>Active</option>

                        <option>Inactive</option>

                    </select>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-success">

                        Save

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>