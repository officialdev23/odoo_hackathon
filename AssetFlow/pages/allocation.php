<?php

require_once ROOT_PATH . "/models/Allocation.php";

$model = new Allocation();

$allocations = $model->getAll();

$assets = $model->getAssets();

$employees = $model->getEmployees();

?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Asset Allocation</h2>

    <button

        class="btn btn-primary"

        data-bs-toggle="modal"

        data-bs-target="#allocationModal">

        <i class="fa-solid fa-plus"></i>

        Allocate Asset

    </button>

</div>

<div class="card shadow-sm">

    <div class="card-body">

        <div class="row mb-3">

            <div class="col-md-3">

                <input

                    type="text"

                    id="allocationSearch"

                    class="form-control"

                    placeholder="Search...">

            </div>

            <div class="col-md-3">

                <select

                    id="statusFilter"

                    class="form-select">

                    <option value="">All Status</option>

                    <option>Allocated</option>

                    <option>Returned</option>

                    <option>Overdue</option>

                </select>

            </div>

        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="allocationTable">
                <thead>
                    <tr>
                        <th>Asset</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Allocated</th>
                        <th>Expected Return</th>
                        <th>Status</th>
                        <th style="width: 180px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($allocations as $row): ?>
                        <tr>

                        <td>

                            <strong><?= $row['asset_code']; ?></strong>

                            <br>

                            <?= $row['asset_name']; ?>

                        </td>

                        <td>

                            <?= $row['employee_name']; ?>

                        </td>

                        <td>

                            <?= $row['department_name']; ?>

                        </td>

                        <td>

                            <?= $row['allocation_date']; ?>

                        </td>

                        <td>

                            <?= $row['expected_return']; ?>

                        </td>

                        <td>

                            <?php

                            $color = "success";

                            if ($row['allocation_status'] == "Returned")

                                $color = "secondary";

                            if ($row['allocation_status'] == "Overdue")

                                $color = "danger";

                            ?>

                            <span class="badge bg-<?= $color; ?> rounded-pill">

                                <?= $row['allocation_status']; ?>

                            </span>

                        </td>

                        <td>

                            <button

                                class="btn btn-sm btn-outline-primary viewAllocation"

                                data-id="<?= $row['allocation_id']; ?>"

                                data-bs-toggle="modal"

                                data-bs-target="#viewAllocationModal">

                                <i class="fa-solid fa-eye"></i>

                            </button>

                            <button

                                class="btn btn-sm btn-outline-warning editAllocation"

                                data-id="<?= $row['allocation_id']; ?>"

                                data-bs-toggle="modal"

                                data-bs-target="#allocationModal">

                                <i class="fa-solid fa-pen"></i>

                            </button>

                            <a

                                class="btn btn-sm btn-outline-success"

                                href="<?= BASE_URL ?>controllers/AllocationController.php?action=return&id=<?= $row['allocation_id']; ?>">

                                <i class="fa fa-rotate-left"></i>

                            </a>

                            <a

                                class="btn btn-sm btn-outline-danger"

                                onclick="return confirm('Delete Allocation?')"

                                href="<?= BASE_URL ?>controllers/AllocationController.php?action=delete&id=<?= $row['allocation_id']; ?>">

                                <i class="fa fa-trash"></i>

                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>
        </div>

    </div>

</div>


<div class="modal fade" id="allocationModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <form

                method="POST"

                action="<?= BASE_URL ?>controllers/AllocationController.php?action=add">

                <input
                    type="hidden"
                    name="allocation_id"
                    id="allocation_id">

                <div class="modal-header">

                    <h5>Allocate Asset</h5>

                    <button

                        class="btn-close"

                        data-bs-dismiss="modal">

                    </button>

                </div>

                <div class="modal-body">

                    <div class="mb-3">

                        <label>Asset</label>

                        <select

                            name="asset_id"

                            class="form-select"

                            required>

                            <?php foreach ($assets as $asset): ?>

                                <option

                                    value="<?= $asset['asset_id']; ?>">

                                    <?= $asset['asset_code']; ?>

                                    -

                                    <?= $asset['asset_name']; ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>Employee</label>

                        <select

                            name="employee_id"

                            class="form-select"

                            required>

                            <?php foreach ($employees as $employee): ?>

                                <option

                                    value="<?= $employee['employee_id']; ?>">

                                    <?= $employee['employee_code']; ?>

                                    -

                                    <?= $employee['employee_name']; ?>

                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>Allocation Date</label>

                        <input

                            type="date"

                            name="allocation_date"

                            class="form-control"

                            value="<?= date('Y-m-d'); ?>">

                    </div>

                    <div class="mb-3">

                        <label>Expected Return</label>

                        <input

                            type="date"

                            name="expected_return"

                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>Allocation Status</label>

                        <select

                            name="allocation_status"

                            class="form-select"

                            id="allocation_status">

                            <option value="Allocated">Allocated</option>

                            <option value="Returned">Returned</option>

                            <option value="Overdue">Overdue</option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>Remarks</label>

                        <textarea

                            name="remarks"

                            class="form-control"></textarea>

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

                        class="btn btn-primary"

                        type="submit">

                        Allocate

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<div class="modal fade" id="viewAllocationModal">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <h5>Allocation Details</h5>

                <button
                    class="btn-close"
                    data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <p><strong>Asset</strong></p>
                <p id="vAsset"></p>

                <p><strong>Employee</strong></p>
                <p id="vEmployee"></p>

                <p><strong>Department</strong></p>
                <p id="vDepartment"></p>

                <p><strong>Allocation Date</strong></p>
                <p id="vAllocationDate"></p>

                <p><strong>Expected Return</strong></p>
                <p id="vExpectedReturn"></p>

                <p><strong>Status</strong></p>
                <p id="vAllocationStatus"></p>

                <p><strong>Remarks</strong></p>
                <p id="vRemarks"></p>

            </div>

        </div>

    </div>

</div>