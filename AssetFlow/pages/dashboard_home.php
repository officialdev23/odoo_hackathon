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

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">Dashboard</h2>

    </div>

    <!-- KPI Cards -->

    <div class="row g-4">

        <div class="col-lg-2 col-md-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h2><?= $totalAssets ?></h2>

                    <small class="text-muted">Total Assets</small>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h2 class="text-success"><?= $availableAssets ?></h2>

                    <small class="text-muted">Available</small>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h2 class="text-warning"><?= $allocatedAssets ?></h2>

                    <small class="text-muted">Allocated</small>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h2 class="text-primary"><?= $totalEmployees ?></h2>

                    <small class="text-muted">Employees</small>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h2><?= $totalDepartments ?></h2>

                    <small class="text-muted">Departments</small>

                </div>

            </div>

        </div>

        <div class="col-lg-2 col-md-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h2><?= $totalCategories ?></h2>

                    <small class="text-muted">Categories</small>

                </div>

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