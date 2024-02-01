<?php
    // start the session.
    session_start();
    if(isset($_SESSION['user'])) header('location: index.php');

    $user = $_SESSION['$user'];

    // Get graph data - purchase order by status
    include('database/po_status_pie_graph.php');

    // Get graph data - supplier product count
    include('database/supplier_product_bar_graph.php');

    // Get line graph data - delivery history per day
    include('database/delivery_history.php');
?>

<DOCTYPE html>
    <html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
    
<style>
</style>
    </head>
    <body>
        <div id="dashboardMainContainer" id="dashboardMainContainer">
            <?php include('partials/app-sidebar.php') ?>
            <div class="dashboard_content_container" id="dashboard_content_container">
                <?php include('partials/app-topnav.php') ?>
                <div class="dashboard_content">
                    <div class="dashboard_content_main" id="dashboard_content_main">
                        <div class="col50">
                            <figure class="highcharts-figure">
                                <div id="container"></div> <!-- inside this div the chart will be pulled fron javascript and displayed -->
                                <p class="highcharts-description">
                                Track/Monitor your products performance via Pie Chart 
                                </p>
                            </figure>
                        </div> <br/>
                        <div class="col50">
                            <figure class="highcharts-figure">
                                <div id="containerBarChart"></div> <!-- inside this div the graph will be pulled fron javascript and displayed -->
                                <p class="highcharts-description">
                                Your Brands/Suppliers Insight
                                </p>
                            </figure>
                        </div>
                    </div>
                        <div>
                            <div id="salesHistory"></div>
                        </div>
                </div>
            </div>
        </div>

<script src="js/script.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
    var graphData = <?= json_encode($results) ?>;

    Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Products Status',
        align: 'left'
    },
    tooltip: { // leaving empty is the best.
       // pointFormat: '{series.name}: <b>{point.percentage}</b>' // this will show results and tooltips the same
        /* pointFormatter: function(){
            var point = this,
                series = point.series;

            return `<b>${series.name}</b>: ${point.y}`
        } */   // This is the other feel of the chart
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage}'
            }
        }
    },
    series: [{
        name: 'Stocks',
        colorByPoint: true,
        data: graphData
    }]
});

var barGraphData = <?= json_encode($bar_chart_data) ?>;
var barGraphCategories = <?= json_encode($categories) ?>;

Highcharts.chart('containerBarChart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Product Brands / Suppliers',
        align: 'left'
    },
    xAxis: {
        categories: barGraphCategories,
        crosshair: true,
        width: '99%' /*here we can add tags*/
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Product Count'
        }
    },
    tooltip: {
        pointFormatter: function(){
            var point = this,
                series = point.series;

            return `<b>${point.category}</b>: ${point.y}`
        }
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Brands / Suppliers',
        data: barGraphData
    }]
});

/*var lineCategories = <?= json_encode($line_categories) ?>;
var lineData = <?= json_encode($line_data) ?>;

Highcharts.chart('salesHistory', {
    chart: {
        type: 'spline'
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
                maxWidth: 500
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

});*/
</script>
    </body>
    </html>