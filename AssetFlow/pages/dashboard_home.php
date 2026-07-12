<?php

require_once ROOT_PATH . "/models/Dashboard.php";

$model = new Dashboard();

$totalAssets = $model->count("assets");
$totalEmployees = $model->count("employees");
$totalDepartments = $model->count("departments");
$totalCategories = $model->count("asset_categories");

$availableAssets = $model->availableAssets();
$allocatedAssets = $model->allocatedAssets();

$recentAssets = $model->recentAssets();
$recentAllocations = $model->recentAllocations();

$chart = $model->assetsByCategory();

?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">

        <div>

            <h2 class="fw-bold mb-1">Dashboard</h2>

            <small class="text-muted">

                Welcome, <?= $_SESSION['full_name']; ?>

            </small>

        </div>

        <div class="d-flex gap-2 mt-2 mt-md-0">

            <a href="<?= BASE_URL ?>dashboard.php?page=assets"
                class="btn btn-primary">

                <i class="fa-solid fa-laptop"></i>

                Add Asset

            </a>

            <a href="<?= BASE_URL ?>dashboard.php?page=employees"
                class="btn btn-success">

                <i class="fa-solid fa-user-plus"></i>

                Add Employee

            </a>

            <a href="<?= BASE_URL ?>dashboard.php?page=allocation"
                class="btn btn-warning text-dark">

                <i class="fa-solid fa-right-left"></i>

                Allocate Asset

            </a>

        </div>

    </div>

    <!-- KPI Cards -->

    <div class="row g-4">

        <div class="col-lg-2 col-md-4">

            <div class="card dashboard-card shadow-sm border-0">

                <div class="card-body">

                    <h2><?= $totalAssets ?></h2>

                    <small class="text-muted">Total Assets</small>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4">

            <div class="card dashboard-card shadow-sm border-0">

                <div class="card-body">

                    <h2 class="text-success"><?= $availableAssets ?></h2>

                    <small class="text-muted">Available</small>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4">

            <div class="card dashboard-card shadow-sm border-0">

                <div class="card-body">

                    <h2 class="text-warning"><?= $allocatedAssets ?></h2>

                    <small class="text-muted">Allocated</small>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4">

            <div class="card dashboard-card shadow-sm border-0">

                <div class="card-body">

                    <h2 class="text-primary"><?= $totalEmployees ?></h2>

                    <small class="text-muted">Employees</small>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4">

            <div class="card dashboard-card shadow-sm border-0">

                <div class="card-body">

                    <h2><?= $totalDepartments ?></h2>

                    <small class="text-muted">Departments</small>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4">

            <div class="card dashboard-card shadow-sm border-0">

                <div class="card-body">

                    <h2><?= $totalCategories ?></h2>

                    <small class="text-muted">Categories</small>

                </div>

            </div>

        </div>

    </div>

    <div class="alert alert-light border shadow-sm mt-4">

        <div class="row text-center">

            <div class="col-md-3">

                <h4 class="text-primary">

                    <?= $availableAssets ?>

                </h4>

                <small>Ready for Allocation</small>

            </div>

            <div class="col-md-3">

                <h4 class="text-warning">

                    <?= $allocatedAssets ?>

                </h4>

                <small>Currently Allocated</small>

            </div>

            <div class="col-md-3">

                <h4 class="text-success">

                    <?= $totalEmployees ?>

                </h4>

                <small>Employees</small>

            </div>

            <div class="col-md-3">

                <h4 class="text-danger">

                    <?= $totalDepartments ?>

                </h4>

                <small>Departments</small>

            </div>

        </div>

    </div>

    <!-- Chart -->

    <div class="card shadow-sm mt-5">

        <div class="card-header">

            <strong>Assets by Category</strong>

        </div>

        <div class="card-body">

            <canvas id="assetChart" height="100"></canvas>

        </div>

    </div>

    <div class="row mt-4">

        <!-- Recent Assets -->

        <div class="col-lg-6">

            <div class="card shadow-sm">

                <div class="card-header">

                    <strong>Recent Assets</strong>

                </div>

                <div class="card-body p-0">

                    <table class="table table-hover mb-0">

                        <thead>

                            <tr>

                                <th>Code</th>

                                <th>Name</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($recentAssets as $asset): ?>

                                <tr>

                                    <td><?= $asset['asset_code']; ?></td>

                                    <td><?= $asset['asset_name']; ?></td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        <!-- Recent Allocations -->

        <div class="col-lg-6">

            <div class="card shadow-sm">

                <div class="card-header">

                    <strong>Recent Allocations</strong>

                </div>

                <div class="card-body p-0">

                    <table class="table table-hover mb-0">

                        <thead>

                            <tr>

                                <th>Asset</th>

                                <th>Employee</th>

                                <th>Date</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($recentAllocations as $allocation): ?>

                                <tr>

                                    <td><?= $allocation['asset_name']; ?></td>

                                    <td><?= $allocation['employee']; ?></td>

                                    <td><?= date("d M Y", strtotime($allocation['allocation_date'])); ?></td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="text-center mt-5 text-muted">

    AssetFlow Pro v<?= APP_VERSION ?>

    |

    Last Login :

    <?= date("d M Y h:i A"); ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('assetChart');

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: [

                <?php foreach ($chart as $c) { ?>

                    '<?= $c["category_name"] ?>',

                <?php } ?>

            ],

            datasets: [{

                label: 'Assets',

                data: [

                    <?php foreach ($chart as $c) { ?>

                        <?= $c["total"] ?>,

                    <?php } ?>

                ],

                backgroundColor: '#4F46E5'

            }]

        },

        options: {

            responsive: true,

            plugins: {

                legend: {
                    display: false
                }

            }

        }

    });
</script>