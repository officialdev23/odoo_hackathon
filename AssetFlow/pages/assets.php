<?php
require_once ROOT_PATH . "/models/Asset.php";

$model = new Asset();
$filters = [
    "search" => $_GET['search'] ?? "",
    "category" => $_GET['category'] ?? "",
    "department" => $_GET['department'] ?? "",
    "status" => $_GET['status'] ?? ""
];

$assets = $model->getAll($filters);
$categories = $model->getCategories();
$departments = $model->getDepartments();
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold text-main mb-0">Asset Directory</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assetModal">
        <i class="fa-solid fa-plus me-1"></i> Add Asset
    </button>
</div>

<!-- Main Directory Card -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        
        <!-- Filter Form -->
        <form method="GET" class="mb-4">
            <input type="hidden" name="page" value="assets">

            <div class="row g-3">
                <div class="col-md-3">
                    <input class="form-control" name="search" value="<?= htmlspecialchars($filters['search']) ?>" placeholder="Search Asset Name or Code...">
                </div>

                <div class="col-md-3">
                    <select class="form-select" name="category" onchange="this.form.submit()">
                        <option value="">All Categories</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['category_id']; ?>" <?= $filters['category'] == $cat['category_id'] ? "selected" : ""; ?>>
                                <?= htmlspecialchars($cat['category_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-select" name="department" onchange="this.form.submit()">
                        <option value="">All Departments</option>
                        <?php foreach ($departments as $dept): ?>
                            <option value="<?= $dept['department_id']; ?>" <?= $filters['department'] == $dept['department_id'] ? "selected" : ""; ?>>
                                <?= htmlspecialchars($dept['department_name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <select class="form-select" name="status" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <?php
                        $statusList = ["Available", "Allocated", "Maintenance", "Retired"];
                        foreach ($statusList as $status):
                        ?>
                            <option value="<?= $status ?>" <?= $filters['status'] == $status ? "selected" : ""; ?>>
                                <?= $status ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="btn btn-primary" title="Search">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <a href="<?= BASE_URL ?>dashboard.php?page=assets" class="btn btn-outline-secondary" title="Reset Filters">
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </a>
                </div>
            </div>
        </form>

        <!-- Assets Table -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>Asset Details</th>
                        <th>Category</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($assets) > 0): ?>
                        <?php foreach ($assets as $asset): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?= BASE_URL ?>assets/uploads/assets/<?= !empty($asset['asset_image']) ? $asset['asset_image'] : 'default.png'; ?>" 
                                             class="me-3 border rounded shadow-sm" 
                                             style="width:50px; height:50px; object-fit:cover; border-color: var(--card-border) !important;">
                                        <div>
                                            <span class="d-block fw-bold text-dark"><?= htmlspecialchars($asset['asset_code']); ?></span>
                                            <small class="text-muted"><?= htmlspecialchars($asset['asset_name']); ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($asset['category_name']); ?></td>
                                <td><?= htmlspecialchars($asset['department_name']); ?></td>
                                <td>
                                    <?php
                                    $badgeColor = "secondary";
                                    switch ($asset['asset_status']) {
                                        case "Available":
                                            $badgeColor = "success";
                                            break;
                                        case "Allocated":
                                            $badgeColor = "primary";
                                            break;
                                        case "Maintenance":
                                            $badgeColor = "warning";
                                            break;
                                        case "Retired":
                                            $badgeColor = "danger";
                                            break;
                                    }
                                    ?>
                                    <span class="badge rounded-pill bg-<?= $badgeColor; ?> px-3 py-2">
                                        <?= htmlspecialchars($asset['asset_status']); ?>
                                    </span>
                                </td>
                                <td class="text-nowrap">
                                    <!-- View Details -->
                                    <button class="btn btn-sm btn-outline-primary me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#viewAssetModal" 
                                            data-code="<?= htmlspecialchars($asset['asset_code']); ?>" 
                                            data-image="<?= htmlspecialchars($asset['asset_image'] ?? ''); ?>" 
                                            data-name="<?= htmlspecialchars($asset['asset_name']); ?>" 
                                            data-category="<?= htmlspecialchars($asset['category_name']); ?>" 
                                            data-department="<?= htmlspecialchars($asset['department_name']); ?>" 
                                            data-date="<?= htmlspecialchars($asset['purchase_date'] ?? 'N/A'); ?>" 
                                            data-cost="<?= htmlspecialchars($asset['purchase_cost'] ?? '0.00'); ?>" 
                                            data-vendor="<?= htmlspecialchars($asset['vendor'] ?? 'N/A'); ?>" 
                                            data-serial="<?= htmlspecialchars($asset['serial_number'] ?? 'N/A'); ?>" 
                                            data-status="<?= htmlspecialchars($asset['asset_status']); ?>" 
                                            data-remarks="<?= htmlspecialchars($asset['remarks'] ?? ''); ?>">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                    <!-- Edit Asset -->
                                    <button class="btn btn-sm btn-outline-warning me-1 editAsset" 
                                            data-id="<?= $asset['asset_id']; ?>" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#assetModal">
                                        <i class="fa-solid fa-pen"></i>
                                    </button>

                                    <!-- Delete Asset -->
                                    <a class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Are you sure you want to delete this asset?')" 
                                       href="<?= BASE_URL ?>controllers/AssetController.php?action=delete&id=<?= $asset['asset_id']; ?>">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="fa-regular fa-folder-open d-block mb-2 fs-3"></i>
                                No assets found matching the search criteria.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

<!-- Add / Edit Asset Modal -->
<div class="modal fade" id="assetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form enctype="multipart/form-data" id="assetForm" method="POST" action="<?= BASE_URL ?>controllers/AssetController.php?action=add">
                <input type="hidden" name="asset_id" id="asset_id">
                <input type="hidden" name="old_image" id="old_image">
                
                <div class="modal-header">
                    <h5 class="modal-title" id="assetModalTitle">Register New Asset</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Asset Name</label>
                            <input type="text" class="form-control" name="asset_name" id="field_asset_name" required placeholder="e.g. Dell XPS Laptop">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Category</label>
                            <select class="form-select" name="category_id" id="field_category_id" required>
                                <option value="">Select Category</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['category_id']; ?>">
                                        <?= htmlspecialchars($cat['category_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Department</label>
                            <select class="form-select" name="department_id" id="field_department_id" required>
                                <option value="">Select Department</option>
                                <?php foreach ($departments as $dept): ?>
                                    <option value="<?= $dept['department_id']; ?>">
                                        <?= htmlspecialchars($dept['department_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Purchase Date</label>
                            <input type="date" class="form-control" name="purchase_date" id="field_purchase_date">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Purchase Cost</label>
                            <input type="number" step="0.01" class="form-control" name="purchase_cost" id="field_purchase_cost" placeholder="0.00">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Vendor</label>
                            <input type="text" class="form-control" name="vendor" id="field_vendor" placeholder="e.g. Dell Systems India">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Serial Number</label>
                            <input type="text" class="form-control" name="serial_number" id="field_serial_number" placeholder="e.g. SN-92817291">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select" name="asset_status" id="field_asset_status">
                                <option value="Available">Available</option>
                                <option value="Allocated">Allocated</option>
                                <option value="Maintenance">Maintenance</option>
                                <option value="Retired">Retired</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Remarks</label>
                            <textarea class="form-control" rows="3" name="remarks" id="field_remarks" placeholder="Any additional notes about the asset condition..."></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Asset Image</label>
                            <input type="file" class="form-control" name="asset_image" accept="image/*">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <span id="assetButtonText">Save Asset</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Asset Modal -->
<div class="modal fade" id="viewAssetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Asset Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row g-4">
                    <!-- Image and Basic Info -->
                    <div class="col-md-4 text-center">
                        <img id="vAssetImage" src="<?= BASE_URL ?>assets/uploads/assets/default.png" 
                             class="img-fluid rounded border mb-3 shadow-sm" 
                             style="width: 100%; max-width: 200px; height: 180px; object-fit: cover; border-color: var(--card-border) !important;">
                        <h5 id="vAssetName" class="fw-bold mb-1 text-dark"></h5>
                        <span id="vAssetCode" class="badge bg-secondary"></span>
                    </div>

                    <!-- Meta details table -->
                    <div class="col-md-8">
                        <table class="table table-bordered table-striped mb-0">
                            <tr>
                                <th style="width: 35%;">Category</th>
                                <td id="vCategory"></td>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <td id="vDepartment"></td>
                            </tr>
                            <tr>
                                <th>Purchase Date</th>
                                <td id="vPurchaseDate"></td>
                            </tr>
                            <tr>
                                <th>Purchase Cost</th>
                                <td id="vPurchaseCost"></td>
                            </tr>
                            <tr>
                                <th>Vendor</th>
                                <td id="vVendor"></td>
                            </tr>
                            <tr>
                                <th>Serial Number</th>
                                <td id="vSerial"></td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td id="vStatus"></td>
                            </tr>
                        </table>
                    </div>

                    <!-- Remarks block inside modal-body -->
                    <div class="col-12 mt-3">
                        <h6 class="fw-bold text-dark border-bottom pb-2">Remarks / Notes</h6>
                        <div class="p-3 rounded bg-light border" id="vRemarks" style="min-height: 60px; font-size: 13.5px; color: var(--text-main);"></div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>