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
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
        background: #fefae0 !important;
        font-family: 'Poppins', sans-serif !important;
        color: #582f0e !important;
    }

    .chart-box {
        height: 320px
    }

    /* Card styling to match mild theme */
    .card.report-card {
        background-color: #ffffff !important;
        border: 1px solid #e6ccb2 !important;
        border-radius: 14px !important;
        box-shadow: 0 4px 12px rgba(212, 163, 115, 0.05) !important;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .card.report-card .card-header {
        background-color: #faedcd !important;
        border-bottom: 1px solid #e6ccb2 !important;
        color: #582f0e !important;
        font-weight: 600 !important;
        padding: 14px 20px !important;
    }

    .card.report-card .card-body {
        padding: 20px !important;
    }

    /* Headings */
    h2, h5 {
        color: #582f0e !important;
        font-weight: 700 !important;
    }

    .text-secondary {
        color: #8c6a5c !important;
    }

    /* Table styling to match main table theme */
    .table {
        border-collapse: separate !important;
        border-spacing: 0 !important;
        background-color: #ffffff !important;
        border: 1px solid #e6ccb2 !important;
        border-radius: 12px !important;
        overflow: hidden !important;
        margin-bottom: 0 !important;
    }

    .table thead th {
        background-color: #faedcd !important; /* Soft sand beige */
        color: #582f0e !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        padding: 14px 16px !important;
        border-bottom: 2px solid #e6ccb2 !important;
        border-top: none !important;
    }

    .table td {
        padding: 14px 16px !important;
        border-bottom: 1px solid #e6ccb2 !important;
        color: #582f0e !important;
        font-size: 13.5px !important;
        vertical-align: middle !important;
    }

    .table tbody tr {
        transition: all 0.2s ease !important;
    }

    .table tbody tr:hover {
        background-color: rgba(212, 163, 115, 0.06) !important;
    }

    /* Custom print button */
    .btn-outline-dark {
        border-color: #d4a373 !important;
        color: #582f0e !important;
        font-weight: 600 !important;
        border-radius: 10px !important;
        padding: 8px 16px !important;
        transition: all 0.2s ease !important;
    }

    .btn-outline-dark:hover {
        background-color: #d4a373 !important;
        color: #ffffff !important;
        border-color: #d4a373 !important;
    }

    @media print {
        .no-print {
            display: none !important;
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
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            family: 'Poppins',
                            size: 12
                        }
                    }
                }
            }
        }
    });

    const palette = ['#d4a373', '#e6ccb2', '#faedcd', '#e8a598', '#ccd5ae'];

    mk('pie1', 'pie', {
        labels: ['Laptop', 'Desktop', 'Printer', 'Monitor'],
        datasets: [{
            data: [45, 20, 15, 20],
            backgroundColor: palette,
            borderColor: '#ffffff',
            borderWidth: 2
        }]
    });
    mk('pie2', 'pie', {
        labels: ['Allocated', 'Available', 'Damaged'],
        datasets: [{
            data: [70, 20, 10],
            backgroundColor: ['#d4a373', '#ccd5ae', '#e8a598'],
            borderColor: '#ffffff',
            borderWidth: 2
        }]
    });
    mk('bar1', 'line', {
        labels: ['IT', 'HR', 'Sales', 'Accounts'],
        datasets: [{
            label: 'Assets',
            data: [120, 45, 60, 35],
            borderColor: '#d4a373',
            backgroundColor: 'rgba(212, 163, 115, 0.15)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#d4a373'
        }]
    });
    mk('bar2', 'line', {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Allocated',
            data: [15, 22, 30, 28, 35, 40],
            borderColor: '#ccd5ae',
            backgroundColor: 'rgba(204, 213, 174, 0.15)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#ccd5ae'
        }]
    });
    mk('bar3', 'line', {
        labels: ['Screen', 'Battery', 'Keyboard', 'Motherboard'],
        datasets: [{
            label: 'Damage',
            data: [5, 3, 2, 1],
            borderColor: '#e8a598',
            backgroundColor: 'rgba(232, 165, 152, 0.15)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: '#e8a598'
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