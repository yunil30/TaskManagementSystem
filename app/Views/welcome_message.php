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
            <h3 style="margin: 0;">Tasks</h3>
            <button type="button" class="btn btn-primary" id="btnCreateTask">Create Task</button>
        </div>
        <div class="col-md-12 content-body">
        </div>
    </div>
</main>

<!-- Create task modal -->
<div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-hidden="true" style="width: 700px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Task</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Task Name</label>
                        <input type="text" class="form-control" id="taskTitle">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Task Description</label>
                        <textarea type="text" class="form-control" id="taskDescription"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Assign To</label>
                        <select class="form-select" id="taskAssignTo">
                            <option value="">Select an Option</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Task Deadline</label>
                        <input type="date" class="form-control" id="taskDeadline">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Task Status</label>
                        <select class="form-select">
                            <option value="">Select an Option</option>
                            <option value="1">Pending</option>
                            <option value="2">In Progress</option>
                            <option value="3">Completed</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Task Level</label>
                        <select class="form-select">
                            <option value="">Select an Option</option>
                            <option value="1">Low</option>
                            <option value="2">Medium</option>
                            <option value="3">High</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnCancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="btnSubmit">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Footer component -->
<?= show_footer(); ?>
</body>
</html>
<script>
    var host_url = '<?php echo host_url(); ?>';

    $('#btnCreateTask').click(function() {
        $('#btnCreateTask').attr({
            'data-toggle': 'modal',
            'data-target': '#createTaskModal'
        });
    });

    function GetTaskUsers() {
        axios.get(host_url + 'Home/GetTaskUsers').then(function(res) {
            res.data.forEach(function(row) {
                $('#taskAssignTo').append(`<option value="${row.UserID}">${row.FullName}</option>`);
            });
        });
    }

    $(document).ready(function() {
        GetTaskUsers();
    });
</script>
