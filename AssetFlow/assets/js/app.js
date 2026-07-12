const viewModal = document.getElementById('viewAssetModal');

if (viewModal) {

    viewModal.addEventListener('show.bs.modal', function (event) {

        let button = event.relatedTarget;

        document.getElementById("vAssetName").innerHTML = button.getAttribute("data-name");

        document.getElementById("vAssetCode").innerHTML = button.getAttribute("data-code");

        document.getElementById("vCategory").innerHTML = button.getAttribute("data-category");

        document.getElementById("vDepartment").innerHTML = button.getAttribute("data-department");

        document.getElementById("vPurchaseDate").innerHTML = button.getAttribute("data-date");

        document.getElementById("vPurchaseCost").innerHTML = "₹ " + button.getAttribute("data-cost");

        document.getElementById("vVendor").innerHTML = button.getAttribute("data-vendor");

        document.getElementById("vSerial").innerHTML = button.getAttribute("data-serial");

        document.getElementById("vStatus").innerHTML = button.getAttribute("data-status");

        document.getElementById("vRemarks").innerHTML = button.getAttribute("data-remarks");

        let image = button.getAttribute("data-image");

        if (!image || image === "null") {
            image = "default.png";
        }

        document.getElementById("vAssetImage").src =
            BASE_URL + "assets/uploads/assets/" + image;

    });

}

// ================================
// Edit Asset
// ================================

document.querySelectorAll(".editAsset").forEach(button => {

    button.addEventListener("click", function () {

        let id = this.dataset.id;

        fetch(BASE_URL + "ajax/get_asset.php?id=" + id)

            .then(response => response.json())

            .then(result => {

                if (!result.success) {
                    alert(result.message);
                    return;
                }

                let asset = result.data;

                document.getElementById("assetModalTitle").innerHTML = "Edit Asset";

                document.getElementById("assetButtonText").innerHTML = "Update Asset";

                document.getElementById("assetForm").action =
                    BASE_URL + "controllers/AssetController.php?action=update";

                document.getElementById("asset_id").value = asset.asset_id;
                document.getElementById("old_image").value = asset.asset_image;

                document.querySelector("[name='asset_name']").value = asset.asset_name;

                document.querySelector("[name='category_id']").value = asset.category_id;

                document.querySelector("[name='department_id']").value = asset.department_id;

                document.querySelector("[name='purchase_date']").value = asset.purchase_date;

                document.querySelector("[name='purchase_cost']").value = asset.purchase_cost;

                document.querySelector("[name='vendor']").value = asset.vendor;

                document.querySelector("[name='serial_number']").value = asset.serial_number;

                document.querySelector("[name='asset_status']").value = asset.asset_status;

                document.querySelector("[name='remarks']").value = asset.remarks;

                if (document.getElementById("previewImage")) {

                    document.getElementById("previewImage").src =

                        BASE_URL + "assets/uploads/assets/" + asset.asset_image;

                }

            });

    });

});

// ============================
// Asset Filters
// ============================

document.querySelectorAll(

    'input[name="search"],select[name="category"],select[name="department"],select[name="status"]'

).forEach(el => {

    el.addEventListener("change", () => {

        el.form.submit();

    });

});

let timer;

let search = document.querySelector('input[name="search"]');

if (search) {

    search.addEventListener("keyup", () => {

        clearTimeout(timer);

        timer = setTimeout(() => {

            search.form.submit();

        }, 400);

    });

}