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


// ================= Employee Edit =================

document.querySelectorAll(".editEmployee").forEach(btn => {

    btn.onclick = function () {

        fetch(BASE_URL + "ajax/get_employee.php?id=" + this.dataset.id)

            .then(r => r.json())

            .then(emp => {

                document.getElementById("employeeForm").action =
                    BASE_URL + "controllers/EmployeeController.php?action=update";

                document.getElementById("employeeModalTitle").innerHTML = "Edit Employee";

                document.getElementById("employeeButtonText").innerHTML = "Update Employee";

                document.getElementById("employee_id").value = emp.employee_id;

                document.querySelector("[name=first_name]").value = emp.first_name;

                document.querySelector("[name=last_name]").value = emp.last_name;

                document.querySelector("[name=email]").value = emp.email;

                document.querySelector("[name=phone]").value = emp.phone;

                document.querySelector("[name=department_id]").value = emp.department_id;

                document.querySelector("[name=designation]").value = emp.designation;

                document.querySelector("[name=status]").value = emp.status;

            });

    }

});

// ================= Employee View =================

document.querySelectorAll(".viewEmployee").forEach(btn => {

    btn.onclick = function () {

        fetch(BASE_URL + "ajax/get_employee.php?id=" + this.dataset.id)

            .then(r => r.json())

            .then(emp => {

                document.getElementById("vCode").innerHTML = emp.employee_code;

                document.getElementById("vName").innerHTML = emp.first_name + " " + emp.last_name;

                document.getElementById("vEmail").innerHTML = emp.email;

                document.getElementById("vPhone").innerHTML = emp.phone;

                document.getElementById("vDepartment").innerHTML = emp.department_name;

                document.getElementById("vDesignation").innerHTML = emp.designation;

                document.getElementById("vStatus").innerHTML = emp.status;

            });

    }

});


const allocationSearch = document.getElementById("allocationSearch");

if (allocationSearch) {

    allocationSearch.addEventListener("keyup", function () {

        let value = this.value.toLowerCase();

        document.querySelectorAll("#allocationTable tbody tr").forEach(row => {

            row.style.display = row.innerText.toLowerCase().includes(value)

                ? ""

                : "none";

        });

    });

}

const statusFilter = document.getElementById("statusFilter");

if (statusFilter) {

    statusFilter.addEventListener("change", function () {

        let value = this.value.toLowerCase();

        document.querySelectorAll("#allocationTable tbody tr").forEach(row => {

            if (value == "" || row.innerText.toLowerCase().includes(value))

                row.style.display = "";

            else

                row.style.display = "none";

        });

    });

}

// ================= Allocation View =================

document.querySelectorAll(".viewAllocation").forEach(btn => {

    btn.onclick = function () {

        fetch(BASE_URL + "ajax/get_allocation.php?id=" + this.dataset.id)

            .then(r => r.json())

            .then(a => {

                document.getElementById("vAsset").innerHTML =
                    a.asset_code + " - " + a.asset_name;

                document.getElementById("vEmployee").innerHTML =
                    a.employee_name;

                document.getElementById("vDepartment").innerHTML =
                    a.department_name;

                document.getElementById("vAllocationDate").innerHTML =
                    a.allocation_date;

                document.getElementById("vExpectedReturn").innerHTML =
                    a.expected_return;

                let badge = "success";

                if (a.allocation_status == "Returned")
                    badge = "secondary";

                if (a.allocation_status == "Overdue")
                    badge = "danger";

                document.getElementById("vAllocationStatus").innerHTML =
                    `<span class="badge bg-${badge} rounded-pill">${a.allocation_status}</span>`;

                document.getElementById("vRemarks").innerHTML =
                    a.remarks;

            });

    }

});

// ================= Allocation Edit =================

document.querySelectorAll(".editAllocation").forEach(btn => {

    btn.onclick = function () {

        fetch(BASE_URL + "ajax/get_allocation.php?id=" + this.dataset.id)

            .then(r => r.json())

            .then(a => {

                document.getElementById("allocation_id").value = a.allocation_id;

                document.querySelector("[name=asset_id]").value = a.asset_id;

                document.querySelector("[name=employee_id]").value = a.employee_id;

                document.querySelector("[name=allocation_date]").value = a.allocation_date;

                document.querySelector("[name=expected_return]").value = a.expected_return;

                document.getElementById("allocation_status").value =
                    a.allocation_status;

                document.querySelector("[name=remarks]").value = a.remarks;

                document.querySelector("#allocationModal form").action =
                    BASE_URL + "controllers/AllocationController.php?action=update";

            });

    }

});