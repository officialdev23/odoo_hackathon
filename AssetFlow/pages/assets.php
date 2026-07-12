<?php

require_once ROOT_PATH . "/models/Asset.php";

$model = new Asset();

$assets = $model->getAll();

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

<p><strong>Total Assets:</strong> <?= count($assets); ?></p>