<!-- Loading Overlay -->
<div id="loadingOverlay"
    class="position-fixed top-0 start-0 w-100 h-100 bg-white d-none justify-content-center align-items-center"
    style="z-index:9999;">
    <div class="text-center">
        <div class="spinner-border text-primary mb-3" style="width:4rem;height:4rem;"></div>
        <h5 class="fw-semibold">Generating Report...</h5>
    </div>
</div>

<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4" id="pageHeader">
        <div>
            <h2 class="fw-bold mb-1">Report Analysis Dashboard</h2>
            <p class="text-secondary mb-0">
                Analyze assets, damages and employee allocations.
            </p>
        </div>

        <div>
            <span class="badge bg-primary fs-6" id="reportDate">
                <?php echo date("d M Y"); ?>
            </span>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="row g-3 mb-4">

        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm h-100" id="cardEmployees">
                <div class="card-body">
                    <small class="text-secondary">Employees</small>
                    <h2 class="fw-bold mb-0" id="totalEmployees">
                        <?= $totalEmployees ?? 0 ?>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm h-100" id="cardAssets">
                <div class="card-body">
                    <small class="text-secondary">Assets</small>
                    <h2 class="fw-bold mb-0" id="totalAssets">
                        <?= $totalAssets ?? 0 ?>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm h-100" id="cardAllocated">
                <div class="card-body">
                    <small class="text-secondary">Allocated</small>
                    <h2 class="fw-bold mb-0" id="allocatedAssets">
                        <?= $allocatedAssets ?? 0 ?>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card shadow-sm h-100" id="cardDamaged">
                <div class="card-body">
                    <small class="text-secondary">Damaged</small>
                    <h2 class="fw-bold mb-0 text-danger" id="damagedAssets">
                        <?= $damagedAssets ?? 0 ?>
                    </h2>
                </div>
            </div>
        </div>

    </div>

    <!-- Filters -->
    <div class="card shadow-sm mb-4" id="filterCard">

        <div class="card-header fw-semibold">
            Advanced Filters
        </div>

        <div class="card-body">

            <form id="reportForm" method="POST" action="/odoo_hackathon/AssetFlow/pages/reports.php">

                <div class="row g-3">

                    <div class="col-lg-3">
                        <label class="form-label">From Date</label>
                        <input type="date" class="form-control" name="from_date" id="from_date">
                    </div>

                    <div class="col-lg-3">
                        <label class="form-label">To Date</label>
                        <input type="date" class="form-control" name="to_date" id="to_date">
                    </div>

                    <div class="col-lg-3">
                        <label class="form-label">Department</label>
                        <select class="form-select" name="department" id="department">
                            <option value="">All</option>
                            <?php foreach (($departments ?? []) as $d) { ?>
                            <option value="<?= $d['id'] ?>">
                                <?= $d['department_name'] ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-lg-3">
                        <label class="form-label">Employee</label>
                        <select class="form-select" name="employee" id="employee">
                            <option value="">All</option>
                            <?php foreach (($employees ?? []) as $e) { ?>
                            <option value="<?= $e['id'] ?>">
                                <?= $e['employee_name'] ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-lg-3">
                        <label class="form-label">Asset Type</label>
                        <select class="form-select" name="asset_type" id="asset_type">
                            <option value="">All</option>
                            <?php foreach (($assetTypes ?? []) as $a) { ?>
                            <option value="<?= $a['id'] ?>">
                                <?= $a['asset_type'] ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-lg-3">
                        <label class="form-label">Asset Status</label>
                        <select class="form-select" name="asset_status" id="asset_status">
                            <option value="">All</option>
                            <option>Allocated</option>
                            <option>Available</option>
                            <option>Damaged</option>
                            <option>Maintenance</option>
                        </select>
                    </div>

                    <div class="col-lg-3">
                        <label class="form-label">Report Type</label>
                        <select class="form-select" name="report_type" id="report_type">
                            <option>Summary</option>
                            <option>Detailed</option>
                        </select>
                    </div>

                    <div class="col-lg-3 d-grid align-self-end">
                        <button type="reset" class="btn btn-outline-secondary">
                            Reset Filters
                        </button>
                    </div>

                </div>

            </form>

        </div>

    </div>

    <!-- Employee Table -->
    <div class="card shadow-sm mb-4" id="employeeSection">

        <div class="card-header fw-semibold">
            Employee Summary
        </div>

        <div class="table-responsive">

            <table class="table table-hover table-bordered align-middle mb-0" id="employeeTable">

                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Assets</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach (($employeeData ?? []) as $emp) { ?>

                    <tr>
                        <td><?= $emp['id'] ?></td>
                        <td><?= $emp['employee_name'] ?></td>
                        <td><?= $emp['department'] ?></td>
                        <td><?= $emp['asset_count'] ?></td>
                        <td><?= $emp['status'] ?></td>
                    </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- Asset Table -->
    <div class="card shadow-sm mb-4" id="assetSection">

        <div class="card-header fw-semibold">
            Asset Summary
        </div>

        <div class="table-responsive">

            <table class="table table-striped table-bordered align-middle mb-0" id="assetTable">

                <thead class="table-light">

                    <tr>
                        <th>Asset ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Employee</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach (($assetData ?? []) as $asset) { ?>

                    <tr>
                        <td><?= $asset['asset_id'] ?></td>
                        <td><?= $asset['asset_name'] ?></td>
                        <td><?= $asset['asset_type'] ?></td>
                        <td><?= $asset['employee_name'] ?></td>
                        <td><?= $asset['status'] ?></td>
                    </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- Damage Table -->
    <div class="card shadow-sm mb-4" id="damageSection">

        <div class="card-header fw-semibold">
            Damage Report
        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle mb-0" id="damageTable">

                <thead class="table-light">

                    <tr>
                        <th>Asset</th>
                        <th>Employee</th>
                        <th>Damage</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach (($damageData ?? []) as $d) { ?>

                    <tr>
                        <td><?= $d['asset_name'] ?></td>
                        <td><?= $d['employee_name'] ?></td>
                        <td><?= $d['damage_reason'] ?></td>
                        <td><?= $d['damage_date'] ?></td>
                        <td><?= $d['status'] ?></td>
                    </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- Button -->
    <div class="text-end mb-5">
        <a href="/odoo_hackathon/AssetFlow/pages/reports.php">
            <button class="btn btn-primary btn-lg px-5" id="generateReportBtn" type="submit" form="reportForm">
                Generate Report
            </button>
        </a>
    </div>
</div>

<script>
gsap.from("#pageHeader", {
    opacity: 0,
    y: -30,
    duration: .7
});
gsap.from(".card", {
    opacity: 0,
    y: 25,
    stagger: .08,
    duration: .6
});
gsap.from("table", {
    opacity: 0,
    y: 20,
    stagger: .15,
    duration: .6
});

document.getElementById("reportForm").addEventListener("submit", function() {
    document.getElementById("loadingOverlay").classList.remove("d-none");
    document.getElementById("loadingOverlay").classList.add("d-flex");
});
</script>