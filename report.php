<?php
    // start the session.
    session_start();
    if(isset($_SESSION['user'])) header('location: index.php');

    // Get line graph data - delivery history per day
    include('database/delivery_history.php');

?>
<DOCTYPE html>
    <html>
    <head>
        <title>Dashboard - Admin Control Panel</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    </head>
    <body>
        <div id="dashboardMainContainer" id="dashboardMainContainer">
            <?php include('partials/app-sidebar.php') ?>
            <div class="dashboard_content_container" id="dashboard_content_container">
                <?php include('partials/app-topnav.php') ?>
                <div class="dashboard_content">
                    <div class="dashboard_content_main" id="dashboard_content_main">
                        <div id="reportsContainer">
                            <div class="reportTypeContainer">
                                <div class="reportType">
                                    <p>Export Products Report</p>
                                    <div class="alignRight">
                                        <a href="database/report_csv.php?report=product" target="_blank" class="reportExportBtn">Excel</a>
                                        <a href="database/report_pdf.php?report=product" target="_blank" class="reportExportBtn">PDF</a>
                                    </div>
                                </div>
                                <div class="reportType">
                                    <p>Export Brands / Suppliers Details</p>
                                    <div class="alignRight">
                                        <a href="database/report_csv.php?report=supplier" target="_blank" class="reportExportBtn">Excel</a>
                                        <a href="database/report_pdf.php?report=supplier" target="_blank" class="reportExportBtn">PDF</a>
                                    </div>
                                </div>
                            </div>
                            <div class="reportTypeContainer">
                                <div class="reportType2">
                                    <p>Export Sales History Report</p>
                                    <div class="alignRight">
                                        <a href="database/report_csv.php?report=delivery" target="_blank" class="reportExportBtn">Excel</a>
                                        <a href="database/report_pdf.php?report=delivery" target="_blank" class="reportExportBtn">PDF</a>
                                    </div>
                                </div>
                                <div class="reportType2">
                                    <p>Export Stocks / Supplies and Sales Report</p>
                                    <div class="alignRight">
                                        <a href="database/report_csv.php?report=purchase_orders" target="_blank" class="reportExportBtn">Excel</a>
                                        <a href="database/report_pdf.php?report=purchase_orders" target="_blank" class="reportExportBtn">PDF</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="salesHistory"></div>
                </div>
            </div>
        </div>

<script src="js/script.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
var lineCategories = <?= json_encode($line_categories) ?>;
var lineData = <?= json_encode($line_data) ?>;

Highcharts.chart('salesHistory', {
    chart: {
        type: 'spline',
        height: '25%'
    },
    title: {
        text: 'Daily Sales Stats',
        align: 'left'
    },

    yAxis: {
        title: {
            text: 'Product Sold'
        }
    },

    xAxis: {
        categories: lineCategories
    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
        }
    },

    series: [{
        name: 'Product Sold',
        data: lineData
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500,
                height: '50%'
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>
    </body>
    </html>