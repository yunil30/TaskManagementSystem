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
</head>
<body>
<!-- Header component -->
<?= show_header(); ?>

<!-- Main component -->
<main class="page-main">
    <div class="main-content">
        <div class="col-md-12 content-header">
            <h3 style="margin: 0;">Home</h3>
        </div>
        <div class="col-md-12 content-body">
            <div class="row" id="grid-container">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Low Priority</h5>
                        </div>
                        <div class="task-bar">
                            <div class="task-status pending" id="pendingBar1"></div>
                            <div class="task-status completed" id="completedBar1"></div>
                        </div>
                        <div class="task-labels" id="barLabels1"></div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Mid Priority</h5>
                        </div>
                        <div class="task-bar">
                            <div class="task-status pending" id="pendingBar2"></div>
                            <div class="task-status completed" id="completedBar2"></div>
                        </div>
                        <div class="task-labels" id="barLabels2"></div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">High Priority</h5>
                        </div>
                        <div class="task-bar">
                            <div class="task-status pending" id="pendingBar3"></div>
                            <div class="task-status completed" id="completedBar3"></div>
                        </div>
                        <div class="task-labels" id="barLabels3"></div>
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

    function GetLowLevelTasks() {
        var data = {
            taskPrioLevel: 1
        }

        axios.post(host_url + 'Home/GetTaskPrioLevelCount', data)
        .then((res) => {
            console.log(res.data);
            
            res.data.forEach((row) => {
                $('#countPendingTask').text(row.total);
                updatePriorityBar(1, row.total, row.pending, row.completed);
                $('#barLabels1').append(`
                    <div>
                        <label class="pending">Pending:</label>
                        <label class="pending">${row.pending}</label>
                    </div>
                    <div>
                        <label class="completed">Completed:</label>
                        <label class="completed">${row.completed}</label>
                    </div>
                `);
            });
        });
    }

    function GetMidTasks() {
        var data = {
            taskPrioLevel: 2
        }

        axios.post(host_url + 'Home/GetTaskPrioLevelCount', data)
        .then((res) => {
            res.data.forEach((row) => {
                $('#countOngoingTask').text(row.total);
                updatePriorityBar(2, row.total, row.pending, row.completed);
                $('#barLabels2').append(`
                    <div>
                        <label class="pending">Pending:</label>
                        <label class="pending">${row.pending}</label>
                    </div>
                    <div>
                        <label class="completed">Completed:</label>
                        <label class="completed">${row.completed}</label>
                    </div>
                `);
            });
        });
    }

    function GetHighTasks() {
        var data = {
            taskPrioLevel: 3
        }

        axios.post(host_url + 'Home/GetTaskPrioLevelCount', data)
        .then((res) => {
            res.data.forEach((row) => {
                $('#countCompletedTask').text(row.total);
                updatePriorityBar(3, row.total, row.pending, row.completed);
                $('#barLabels3').append(`
                    <div>
                        <label class="pending">Pending:</label>
                        <label class="pending">${row.pending}</label>
                    </div>
                    <div>
                        <label class="completed">Completed:</label>
                        <label class="completed">${row.completed}</label>
                    </div>
                `);
            });
        });
    }

    function updatePriorityBar(barNo, totalCount, pendingCount, completedCount) {
        const pendingPercentage = (pendingCount / totalCount) * 100;
        const completedPercentage = (completedCount / totalCount) * 100;

        $('#pendingBar' + barNo).css('width', `${pendingPercentage}%`);
        $('#completedBar' + barNo).css('width', `${completedPercentage}%`);
    }

    $('document').ready(function() {
        GetLowLevelTasks();
        GetMidTasks();
        GetHighTasks();
    });
</script>