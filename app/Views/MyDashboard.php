<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TaskMaker</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <!-- Style component -->
    <?= css_container(); ?>
</head>

<body>
<!-- Header component -->
<?= show_header(); ?>

<!-- Main component -->
<main class="page-main">
    <div class="main-content">
        <div class="col-md-12 content-header">
            <h3 style="margin: 0;">Dashboard</h3>
        </div>
        <div class="col-md-12 content-body">
            <div class="col-md-12 mt-3" style="display: flex; justify-content: space-between;">
                <div class="col-md-6 px-4">
                    <h5 style="text-align: center;">My Created Task</h5>
                    <canvas id="MyTaskChart"></canvas>
                </div> 

                <div class="col-md-6 px-4">
                    <h5 style="text-align: center;">Pending Task Count</h5>
                    <canvas id="PendingTaskChart"></canvas>
                </div> 
            </div>

            <div class="col-md-12 mt-3" style="display: flex; justify-content: center;">
                <div class="col-md-6 px-4">
                    <h5 style="text-align: center;">Completed Task Count</h5>
                    <canvas id="CompletedTaskChart"></canvas>
                </div>
            </div>

            
        </div>
    </div>
</main>

<!-- Footer component -->
<?= show_footer(); ?>
</body>
</html>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var host_url = '<?php echo host_url(); ?>';

    function GetPendingTaskCount() {
        axios.get(host_url + 'Home/GetPendingTaskCount')
        .then((res) => {
            const data = res.data[0];
            const high = parseInt(data.high);
            const medium = parseInt(data.medium);
            const low = parseInt(data.low);

            const chartData = {
                labels: ['High Priority', 'Medium Priority', 'Low Priority'], 
                datasets: [{
                    label: 'Task Count',
                    data: [high, medium, low], 
                    backgroundColor: ['rgb(199, 0, 57, 0.9)', 'rgb(255, 87, 51, 0.9)', 'rgb(255, 195, 0, 0.9)'], 
                    hoverBackgroundColor: ['rgb(199, 0, 57)', 'rgb(255, 87, 51)', 'rgb(255, 195, 0)'], 
                }]
            };

            const ctx = document.getElementById('PendingTaskChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Task Count',
                            },
                            grid: {
                                color: '#1f2328',
                                lineWidth: 1,
                            },
                            ticks: {
                                color: '#1f2328',
                                maxTicksLimit: 5,
                                beginAtZero: true,
                                stepSize: 1,
                                font: {
                                    size: 12,
                                    weight: 'bold',
                                }
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Priority Levels'
                            },  
                            grid: {
                                color: '#1f2328',
                                lineWidth: 1,
                            },
                            ticks: {
                                color: '#1f2328',
                                maxTicksLimit: 5,
                                beginAtZero: true,
                                stepSize: 1,
                                font: {
                                    size: 12,
                                    weight: 'bold',
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }
                }
            });
        });
    }

    function GetCompletedTaskCount() {
        axios.get(host_url + 'Home/GetCompletedTaskCount')
        .then((res) => {
            const data = res.data[0];
            const high = parseInt(data.high);
            const medium = parseInt(data.medium);
            const low = parseInt(data.low);

            const chartData = {
                labels: ['High Priority', 'Medium Priority', 'Low Priority'], 
                datasets: [{
                    label: 'Task Count',
                    data: [high, medium, low], 
                    backgroundColor: ['rgb(199, 0, 57, 0.9)', 'rgb(255, 87, 51, 0.9)', 'rgb(255, 195, 0, 0.9)'], 
                    hoverBackgroundColor: ['rgb(199, 0, 57)', 'rgb(255, 87, 51)', 'rgb(255, 195, 0)'], 
                }]
            };

            const ctx = document.getElementById('CompletedTaskChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Task Count',
                            },
                            grid: {
                                color: '#1f2328',
                                lineWidth: 1,
                            },
                            ticks: {
                                color: '#1f2328',
                                maxTicksLimit: 5,
                                beginAtZero: true,
                                stepSize: 1,
                                font: {
                                    size: 12,
                                    weight: 'bold',
                                }
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Priority Levels'
                            },  
                            grid: {
                                color: '#1f2328',
                                lineWidth: 1,
                            },
                            ticks: {
                                color: '#1f2328',
                                maxTicksLimit: 5,
                                beginAtZero: true,
                                stepSize: 1,
                                font: {
                                    size: 12,
                                    weight: 'bold',
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }
                }
            });
        })
        .catch((err) => {
            console.error('Error fetching task count:', err);
        });
    }

    function GetCreatedTaskCount() {
        axios.get(host_url + 'Home/GetCreatedTaskCount')
        .then((res) => {
            const data = res.data[0];
            const high = parseInt(data.high);
            const medium = parseInt(data.medium);
            const low = parseInt(data.low);

            const chartData = {
                labels: ['High Priority', 'Medium Priority', 'Low Priority'], 
                datasets: [{
                    label: 'Task Count',
                    data: [high, medium, low], 
                    backgroundColor: ['rgb(199, 0, 57, 0.9)', 'rgb(255, 87, 51, 0.9)', 'rgb(255, 195, 0, 0.9)'], 
                    hoverBackgroundColor: ['rgb(199, 0, 57)', 'rgb(255, 87, 51)', 'rgb(255, 195, 0)'], 
                }]
            };

            const ctx = document.getElementById('MyTaskChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'bar',
                data: chartData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Task Count',
                            },
                            grid: {
                                color: '#1f2328',
                                lineWidth: 1,
                            },
                            ticks: {
                                color: '#1f2328',
                                maxTicksLimit: 5,
                                beginAtZero: true,
                                stepSize: 1,
                                font: {
                                    size: 12,
                                    weight: 'bold',
                                }
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Priority Levels'
                            },  
                            grid: {
                                color: '#1f2328',
                                lineWidth: 1,
                            },
                            ticks: {
                                color: '#1f2328',
                                maxTicksLimit: 5,
                                beginAtZero: true,
                                stepSize: 1,
                                font: {
                                    size: 12,
                                    weight: 'bold',
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false,
                        }
                    }
                }
            });
        })
        .catch((err) => {
            console.error('Error fetching task count:', err);
        });
    }

    $('document').ready(function() {
        GetPendingTaskCount();
        GetCompletedTaskCount();
        GetCreatedTaskCount();
    });
</script>