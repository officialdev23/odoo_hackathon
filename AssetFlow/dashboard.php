<?php

require_once "layouts/header.php";

require_once "layouts/sidebar.php";

require_once "layouts/navbar.php";

?>

<div class="content">

    <div class="cards">

        <div class="card-box">

            <h2>245</h2>

            <p>Total Assets</p>

        </div>

        <div class="card-box">

            <h2>180</h2>

            <p>Allocated</p>

        </div>

        <div class="card-box">

            <h2>18</h2>

            <p>Maintenance</p>

        </div>

        <div class="card-box">

            <h2>25</h2>

            <p>Bookings</p>

        </div>

    </div>

    <canvas id="assetChart"></canvas>

</div>

<script>
    new Chart(document.getElementById('assetChart'), {

        type: 'bar',

        data: {

            labels: ['Electronics', 'Furniture', 'Vehicles', 'Equipment'],

            datasets: [{

                label: 'Assets',

                data: [120, 80, 25, 20]

            }]

        }

    });
</script>

<?php

require_once "layouts/footer.php";

?>