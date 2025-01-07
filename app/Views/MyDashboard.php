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
            <h3 style="margin: 0;">Dashboard</h3>
        </div>
        <div class="col-md-12 content-body">
            <div class="row" id="grid-container">
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <i class="fas fa-clock card-icon"></i>
                        <div class="card-body">
                            <h5 class="card-title">Pending</h5>
                            <h5 class="card-text" id="countPendingTask"></h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card">
                        <i class="fas fa-sync-alt card-icon"></i>
                        <div class="card-body">
                            <h5 class="card-title">Ongoing</h5>
                            <h5 class="card-text" id="countOngoingTask"></h5>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card">
                        <i class="fas fa-check-circle card-icon"></i>
                        <div class="card-body">
                            <h5 class="card-title">Completed</h5>
                            <h5 class="card-text" id="countCompletedTask"></h5>
                        </div>
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
            $('#countPendingTask').text(res.data.count);
        })
    }

    function GetOngoingTasks() {
        var data = {
            taskStatus: 2
        }

        axios.post(host_url + 'Home/GetTaskStatusCount', data)
        .then((res) => {
            $('#countOngoingTask').text(res.data.count);
        })
    }

    function GetCompletedTasks() {
        var data = {
            taskStatus: 3
        }

        axios.post(host_url + 'Home/GetTaskStatusCount', data)
        .then((res) => {
            $('#countCompletedTask').text(res.data.count);
        })
    }

    $('document').ready(function() {
        GetPendingTasks();
        GetOngoingTasks();
        GetCompletedTasks();
    });
</script>