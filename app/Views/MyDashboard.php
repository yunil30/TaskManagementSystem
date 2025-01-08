<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Task Management System</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <!-- Style component -->
    <?= css_container(); ?>
    <style>
        .priority-bar {
            display: flex;
            height: 16px;
            border-radius: 8px;
            overflow: hidden;
            margin: 10px 0;
        }

        .priority-level {
            height: 100%;
            display: inline-block;
        }

        .priority-level.low {
            background-color: #6c757d; /* Grey for Low */
        }

        .priority-level.medium {
            background-color: #ffc107; /* Yellow for Medium */
        }

        .priority-level.high {
            background-color: #dc3545; /* Red for High */
        }

        .priority-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;
        }

        .priority-labels label {
            font-size: 14px;
            font-weight: 500;

        }

        .priority-labels .low {
            color: #6c757d;
        }

        .priority-labels .medium {
            color: #ffc107;
        }

        .priority-labels .high {
            color: #dc3545;
        }
    </style>
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
            <div class="row" id="grid-container">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Pending</h5>
                        </div>
                        <div class="priority-bar">
                            <div class="priority-level low" id="lowBar1"></div>
                            <div class="priority-level medium" id="mediumBar1"></div>
                            <div class="priority-level high" id="highBar1"></div>
                        </div>
                        <div class="priority-labels" id="barLabels1"></div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Ongoing</h5>
                        </div>
                        <div class="priority-bar">
                            <div class="priority-level low" id="lowBar2"></div>
                            <div class="priority-level medium" id="mediumBar2"></div>
                            <div class="priority-level high" id="highBar2"></div>
                        </div>
                        <div class="priority-labels" id="barLabels2"></div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Completed</h5>
                        </div>
                        <div class="priority-bar">
                            <div class="priority-level low" id="lowBar3"></div>
                            <div class="priority-level medium" id="mediumBar3"></div>
                            <div class="priority-level high" id="highBar3"></div>
                        </div>
                        <div class="priority-labels" id="barLabels3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer component -->
<?= show_footer(); ?>
</body>
</html>
<script>
    var host_url = '<?php echo host_url(); ?>';

    function GetPendingTasks() {
        var data = {
            taskStatus: 1
        }

        axios.post(host_url + 'Home/GetTaskStatusCount', data)
        .then((res) => {
            res.data.forEach((row) => {
                $('#countPendingTask').text(row.total);
                updatePriorityBar(1, row.total, row.low, row.medium, row.high);
                $('#barLabels1').append(`
                    <div>
                        <label class="low">Low:</label>
                        <label class="low">${row.low}</label>
                    </div>
                    <div>
                        <label class="medium">Medium:</label>
                        <label class="medium">${row.medium}</label>
                    </div>
                    <div>
                        <label class="high">High:</label>
                        <label class="high">${row.high}</label>
                    </div>
                `);
            });
        });
    }

    function GetOngoingTasks() {
        var data = {
            taskStatus: 2
        }

        axios.post(host_url + 'Home/GetTaskStatusCount', data)
        .then((res) => {
            res.data.forEach((row) => {
                $('#countOngoingTask').text(row.total);
                updatePriorityBar(2, row.total, row.low, row.medium, row.high);
                $('#barLabels2').append(`
                    <div>
                        <label class="low">Low:</label>
                        <label class="low">${row.low}</label>
                    </div>
                    <div>
                        <label class="medium">Medium:</label>
                        <label class="medium">${row.medium}</label>
                    </div>
                    <div>
                        <label class="high">High:</label>
                        <label class="high">${row.high}</label>
                    </div>
                `);
            });
        });
    }

    function GetCompletedTasks() {
        var data = {
            taskStatus: 3
        }

        axios.post(host_url + 'Home/GetTaskStatusCount', data)
        .then((res) => {
            res.data.forEach((row) => {
                $('#countCompletedTask').text(row.total);
                updatePriorityBar(3, row.total, row.low, row.medium, row.high);
                $('#barLabels3').append(`
                    <div>
                        <label class="low">Low:</label>
                        <label class="low">${row.low}</label>
                    </div>
                    <div>
                        <label class="medium">Medium:</label>
                        <label class="medium">${row.medium}</label>
                    </div>
                    <div>
                        <label class="high">High:</label>
                        <label class="high">${row.high}</label>
                    </div>
                `);
            });
        });
    }

    function updatePriorityBar(barNo, totalCount, lowCount, mediumCount, highCount) {
        const lowPercentage = (lowCount / totalCount) * 100;
        const mediumPercentage = (mediumCount / totalCount) * 100;
        const highPercentage = (highCount / totalCount) * 100;

        $('#lowBar' + barNo).css('width', `${lowPercentage}%`);
        $('#mediumBar' + barNo).css('width', `${mediumPercentage}%`);
        $('#highBar' + barNo).css('width', `${highPercentage}%`);
    }

    $('document').ready(function() {
        GetPendingTasks();
        GetOngoingTasks();
        GetCompletedTasks();
    });
</script>