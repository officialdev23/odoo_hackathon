<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Professional Report UI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <style>
    body {
        background: #f8f9fa
    }

    .chart-box {
        height: 320px
    }

    .report-card {
        box-shadow: 0 .25rem 1rem rgba(0, 0, 0, .08)
    }

    @media print {
        .no-print {
            display: none
        }
    }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold">Asset Management Executive Report</h2>
                <div class="text-secondary">Reporting Period: Jan–Jun 2026</div>
            </div>
            <div class="no-print">
                <button class="btn btn-outline-dark me-2" onclick="window.print()">Print / Save PDF</button>
            </div>
        </div>

        <div class="card report-card mb-4">
            <div class="card-body">
                <h5>Executive Summary</h5>
                <p>This report presents an overview of asset allocation, department distribution, damages and monthly
                    trends. Charts below are sample visualizations.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card report-card">
                    <div class="card-body">
                        <h5>Asset Distribution</h5>
                        <div class="chart-box"><canvas id="pie1"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card report-card">
                    <div class="card-body">
                        <h5>Asset Status</h5>
                        <div class="chart-box"><canvas id="pie2"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card report-card">
                    <div class="card-body">
                        <h5>Department Assets</h5>
                        <div class="chart-box"><canvas id="bar1"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card report-card">
                    <div class="card-body">
                        <h5>Monthly Allocation</h5>
                        <div class="chart-box"><canvas id="bar2"></canvas></div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card report-card">
                    <div class="card-body">
                        <h5>Damage by Category</h5>
                        <div class="chart-box"><canvas id="bar3"></canvas></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card report-card mt-4">
            <div class="card-header">Employee Summary</div>
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Dept</th>
                        <th>Assets</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>101</td>
                        <td>Rahul</td>
                        <td>IT</td>
                        <td>4</td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td>102</td>
                        <td>Om</td>
                        <td>IT</td>
                        <td>3</td>
                        <td>Active</td>
                    </tr>
                    <tr>
                        <td>103</td>
                        <td>Priya</td>
                        <td>HR</td>
                        <td>2</td>
                        <td>Active</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card report-card mt-4">
            <div class="card-header">Asset Summary</div>
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Asset</th>
                        <th>Type</th>
                        <th>User</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Laptop-01</td>
                        <td>Laptop</td>
                        <td>Rahul</td>
                        <td>Allocated</td>
                    </tr>
                    <tr>
                        <td>Printer-01</td>
                        <td>Printer</td>
                        <td>Office</td>
                        <td>Available</td>
                    </tr>
                    <tr>
                        <td>Monitor-07</td>
                        <td>Monitor</td>
                        <td>Om</td>
                        <td>Allocated</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card report-card mt-4">
            <div class="card-header">Damage Report</div>
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Asset</th>
                        <th>Issue</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Laptop-09</td>
                        <td>Screen Crack</td>
                        <td>10 Jul 2026</td>
                        <td>Pending</td>
                    </tr>
                    <tr>
                        <td>Mouse-12</td>
                        <td>Not Working</td>
                        <td>09 Jul 2026</td>
                        <td>Replaced</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="card report-card mt-4">
            <div class="card-body">
                <h5>Insights & Recommendations</h5>
                <ul>
                    <li>IT department has the highest asset allocation.</li>
                    <li>Laptops form the largest share of inventory.</li>
                    <li>Damage rate remains low; preventive maintenance is recommended.</li>
                </ul>
            </div>
        </div>
    </div>
    <script>
    const mk = (id, type, data) => new Chart(document.getElementById(id), {
        type,
        data,
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
    mk('pie1', 'pie', {
        labels: ['Laptop', 'Desktop', 'Printer', 'Monitor'],
        datasets: [{
            data: [45, 20, 15, 20]
        }]
    });
    mk('pie2', 'pie', {
        labels: ['Allocated', 'Available', 'Damaged'],
        datasets: [{
            data: [70, 20, 10]
        }]
    });
    mk('bar1', 'bar', {
        labels: ['IT', 'HR', 'Sales', 'Accounts'],
        datasets: [{
            label: 'Assets',
            data: [120, 45, 60, 35]
        }]
    });
    mk('bar2', 'bar', {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Allocated',
            data: [15, 22, 30, 28, 35, 40]
        }]
    });
    mk('bar3', 'bar', {
        labels: ['Screen', 'Battery', 'Keyboard', 'Motherboard'],
        datasets: [{
            label: 'Damage',
            data: [5, 3, 2, 1]
        }]
    });
    gsap.from('.report-card', {
        opacity: 0,
        y: 30,
        stagger: .08,
        duration: .6
    });
    </script>
</body>

</html>