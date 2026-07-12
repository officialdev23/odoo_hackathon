<?php

require_once ROOT_PATH . "/models/Asset.php";

$model = new Asset();

// $assets = $model->getAll();
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

    <h2>Asset Directory</h2>

    <button
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#assetModal">

        + Add Asset

    </button>

</div>

<form method="GET">

    <input
        type="hidden"
        name="page"
        value="assets">


    <div class="row mb-4">

        <div class="col-md-4">

            <input

                class="form-control"

                name="search"

                value="<?= htmlspecialchars($filters['search']) ?>"

                placeholder="Search Asset...">

        </div>

        <div class="col-md-4">

            <select
                class="form-select"
                name="category">

                <option value="">All Categories</option>

                <?php foreach ($categories as $cat): ?>

                    <option
                        value="<?= $cat['category_id']; ?>"

                        <?= $filters['category'] == $cat['category_id'] ? "selected" : ""; ?>>

                        <?= $cat['category_name']; ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>

        <div class="col-md-3">

            <select
                class="form-select"
                name="department">

                <option value="">All Departments</option>

                <?php foreach ($departments as $dept): ?>

                    <option

                        value="<?= $dept['department_id']; ?>"

                        <?= $filters['department'] == $dept['department_id'] ? "selected" : ""; ?>>

                        <?= $dept['department_name']; ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>
        </br>

        <div class="col-md-4">

            <select
                class="form-select"
                name="status">

                <option value="">All Status</option>

                <?php

                $statusList = [
                    "Available",
                    "Allocated",
                    "Maintenance",
                    "Retired"
                ];

                foreach ($statusList as $status):

                ?>

                    <option

                        <?= $filters['status'] == $status ? "selected" : ""; ?>>

                        <?= $status ?>

                    </option>

                <?php endforeach; ?>

            </select>

        </div>

    </div>
</form>
<table class="table table-hover table-bordered">

    <thead class="table-dark">

        <tr>

            <!-- <th>Asset</th> -->

            <th>Name</th>

            <th>Category</th>

            <th>Department</th>

            <th>Status</th>

            <th>Action</th>

        </tr>

    </thead>

    <tbody>

        <?php foreach ($assets as $asset): ?>

            <tr>

                <td>

                    <div class="d-flex align-items-center">

                        <img

                            src="<?= BASE_URL ?>assets/uploads/assets/<?= !empty($asset['asset_image']) ? $asset['asset_image'] : 'default.png'; ?>"

                            class="me-3 border rounded"

                            style="width:55px;height:55px;object-fit:cover;">

                        <div>

                            <strong>

                                <?= $asset['asset_code']; ?>

                            </strong>

                            <br>

                            <small class="text-muted">

                                <?= $asset['asset_name']; ?>

                            </small>

                        </div>

                    </div>

                </td>

                <!-- <td><?= $asset['asset_name']; ?></td> -->

                <td><?= $asset['category_name']; ?></td>

                <td><?= $asset['department_name']; ?></td>

                <td>

                    <?php

                    $color = "secondary";

                    switch ($asset['asset_status']) {

                        case "Available":

                            $color = "success";

                            break;

                        case "Allocated":

                            $color = "primary";

                            break;

                        case "Maintenance":

                            $color = "warning";

                            break;

                        case "Retired":

                            $color = "danger";

                            break;
                    }

                    ?>

                    <span class="badge rounded-pill bg-<?= $color; ?> px-3 py-2">
                        <?= $asset['asset_status']; ?>

                    </span>

                </td>

                <td class="text-nowrap">

                    <!-- View -->

                    <button
                        class="btn btn-sm btn-outline-primary me-1"

                        data-bs-toggle="modal"

                        data-bs-target="#viewAssetModal"

                        data-code="<?= $asset['asset_code']; ?>"
                        data-image="<?= $asset['asset_image']; ?>"

                        data-name="<?= htmlspecialchars($asset['asset_name']); ?>"

                        data-category="<?= htmlspecialchars($asset['category_name']); ?>"

                        data-department="<?= htmlspecialchars($asset['department_name']); ?>"

                        data-date="<?= $asset['purchase_date']; ?>"

                        data-cost="<?= $asset['purchase_cost']; ?>"

                        data-vendor="<?= htmlspecialchars($asset['vendor']); ?>"

                        data-serial="<?= htmlspecialchars($asset['serial_number']); ?>"

                        data-status="<?= $asset['asset_status']; ?>"

                        data-remarks="<?= htmlspecialchars($asset['remarks']); ?>">

                        <i class="fa-solid fa-eye"></i>

                    </button>


                    <!-- Edit -->

                    <button

                        class="btn btn-sm btn-outline-warning me-1 editAsset"

                        data-id="<?= $asset['asset_id']; ?>"

                        data-bs-toggle="modal"

                        data-bs-target="#assetModal">

                        <i class="fa-solid fa-pen"></i>

                    </button>


                    <!-- Delete -->

                    <a

                        class="btn btn-sm btn-outline-danger"

                        onclick="return confirm('Delete this asset?')"

                        href="<?= BASE_URL ?>controllers/AssetController.php?action=delete&id=<?= $asset['asset_id']; ?>">

                        <i class="fa-solid fa-trash"></i>

                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

    </tbody>

</table>


<!-- Add Asset Modal -->

<div class="modal fade" id="assetModal" tabindex="-1">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form
                enctype="multipart/form-data"

                id="assetForm"

                method="POST"

                action="<?= BASE_URL ?>controllers/AssetController.php?action=add">
                <input
                    type="hidden"
                    name="asset_id"
                    id="asset_id">

                <input

                    type="hidden"

                    name="old_image"

                    id="old_image">
                <div class="modal-header">

                    <h5 class="modal-title" id="assetModalTitle">

                        Register New Asset

                    </h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>

                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Asset Name</label>

                            <input
                                type="text"
                                class="form-control"
                                name="asset_name"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Category</label>

                            <select
                                class="form-select"
                                name="category_id"
                                required>

                                <option value="">Select Category</option>

                                <?php foreach ($categories as $cat): ?>

                                    <option
                                        value="<?= $cat['category_id']; ?>">

                                        <?= $cat['category_name']; ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Department</label>

                            <select
                                class="form-select"
                                name="department_id"
                                required>

                                <option value="">Select Department</option>

                                <?php foreach ($departments as $dept): ?>

                                    <option
                                        value="<?= $dept['department_id']; ?>">

                                        <?= $dept['department_name']; ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Purchase Date</label>

                            <input
                                type="date"
                                class="form-control"
                                name="purchase_date">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Purchase Cost</label>

                            <input
                                type="number"
                                step="0.01"
                                class="form-control"
                                name="purchase_cost">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Vendor</label>

                            <input
                                type="text"
                                class="form-control"
                                name="vendor">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Serial Number</label>

                            <input
                                type="text"
                                class="form-control"
                                name="serial_number">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Status</label>

                            <select
                                class="form-select"
                                name="asset_status">

                                <option>Available</option>

                                <option>Allocated</option>

                                <option>Maintenance</option>

                                <option>Retired</option>

                            </select>

                        </div>

                        <div class="col-12">

                            <label>Remarks</label>

                            <textarea
                                class="form-control"
                                rows="3"
                                name="remarks"></textarea>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Asset Image</label>
                            <?php if (!empty($asset['asset_image'])): ?>

                                <div class="mt-2">

                                    <img

                                        id="previewImage"

                                        src="<?= BASE_URL ?>assets/uploads/assets/<?= $asset['asset_image']; ?>"

                                        style="width:90px;height:90px;object-fit:cover;border-radius:10px;">

                                </div>

                            <?php endif; ?>
                            <input

                                type="file"

                                class="form-control"

                                name="asset_image"

                                accept="image/*">

                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <span id="assetButtonText">

                            Save Asset

                        </span>

                    </button>

                </div>
            </form>

        </div>

    </div>

</div>


<!-- View Asset Modal -->

<div class="modal fade" id="viewAssetModal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header">

                <h4>

                    Asset Details

                </h4>

                <button
                    class="btn-close"
                    data-bs-dismiss="modal">

                </button>

            </div>

            <div class="modal-body">

                <div class="row">

                    <div class="col-md-4 text-center">

                        <img

                            id="vAssetImage"

                            src="<?= BASE_URL ?>assets/uploads/assets/default.png"

                            class="img-fluid rounded border"

                            style="width:180px;
height:140px;
object-fit:cover;
border-radius:12px;
box-shadow:0 4px 12px rgba(0,0,0,.15);">
                    </div>

                    <h5 id="vAssetName"></h5>

                    <p id="vAssetCode"></p>

                </div>

                <div class="col-md-8">

                    <table class="table table-borderless">

                        <tr>

                            <th>Category</th>

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

            </div>

            <hr>

            <h5>

                Remarks

            </h5>

            <p id="vRemarks"></p>

        </div>

        <div class="modal-footer">

            <button
                class="btn btn-secondary"

                data-bs-dismiss="modal">

                Close

            </button>

        </div>

    </div>

</div>

</div>