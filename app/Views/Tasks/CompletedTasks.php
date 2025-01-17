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
            <h3 style="margin: 0;">Completed Tasks</h3>
        </div>
        <div class="col-md-12 content-body">
            <table class="table table-hover table-bordered" id="taskListTable">
                <thead>
                    <tr>
                        <th class="text-left" style="width: 20%">TaskNo.</th>
                        <th class="text-left" style="width: 25%">Task Name</th>
                        <th class="text-left" style="width: 25%">Assigned By</th>
                        <th class="text-left" style="width: 20%">Date Assigned</th>
                        <th class="text-center" style="width: 10%">Action</th>
                    </tr>
                </thead>
                <tbody id="loadTask"></tbody>
            </table>
        </div>
    </div>
</main>

<!-- Show task modal -->
<div class="modal fade" id="showTaskModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px; width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titleTaskModal">Task</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Task Name</label>
                        <input type="text" class="form-control" id="showTaskName">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Task Description</label>
                        <textarea type="text" class="form-control" id="showTaskDescription"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Assign By</label>
                        <input type="text" class="form-control" id="showTaskAssignBy">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Task Deadline</label>
                        <input type="date" class="form-control" id="showTaskDeadline">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Task Status</label>
                        <select class="form-select" id="showTaskStatus">
                            <option value="">Select an Option</option>
                            <option value="1" selected>Pending</option>
                            <option value="2">In Progress</option>
                            <option value="3">Completed</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Task Level</label>
                        <select class="form-select" id="showTaskLevel">
                            <option value="">Select an Option</option>
                            <option value="1">Low</option>
                            <option value="2">Medium</option>
                            <option value="3">High</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-dismiss="modal">Close</button>
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

    function ShowMessage(icon, title, position = 'center') {
        Swal.fire({
            icon: icon,
            title: title,
            position: position, 
            timerProgressBar: true, 
            confirmButtonText: 'OK',
            heightAuto: false
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.reload();
            }
        });
    }

    function ShowCompletedTaskList() {
        axios.get(host_url + 'Task/GetCompletedTaskList').then(function(res) {
            if ($.fn.DataTable.isDataTable('#taskListTable')) {
                $('#taskListTable').DataTable().destroy();
            }

            $('#loadTask').empty();

            res.data.forEach(function(row, index) {
                $('#loadTask').append(`
                    <tr>
                        <td style="vertical-align: middle; text-align: left;">${row.TaskID}</td>
                        <td style="vertical-align: middle; text-align: left;">${row.task_name}</td>
                        <td style="vertical-align: middle; text-align: left;">${row.team_leader}</td>   
                        <td style="vertical-align: middle; text-align: left;">${row.date_created}</td>  
                        <td style="vertical-align: middle; text-align: center;">
                            <button class="btn btn-transparent" id="btnShowTask${row.TaskID}" onclick="ShowTaskModal(${row.TaskID})"><span class="fas fa-eye"></span></button>
                        </td>
                    </tr>
                `);
            });

            $('#taskListTable').DataTable({
                searching: true,
                pageLength: 10,
                lengthChange: false,
                ordering: true,
                columnDefs: [
                    { type: 'num', targets: 0 }
                ]
            });
        });
    }

    function ShowTaskModal(taskNo) {
        $('#btnShowTask' + taskNo).attr({
            'data-toggle': 'modal',
            'data-target': '#showTaskModal'
        });

        var data = { 
            taskNo: taskNo 
        };

        axios.post(host_url + 'Task/GetTaskDetails', data)
        .then((res) => {
            var taskDetails = res.data[0];
            $('#showTaskName').val(taskDetails.task_name);
            $('#showTaskDescription').val(taskDetails.task_description);
            $('#showTaskAssignBy').val(taskDetails.team_leader);
            $('#showTaskDeadline').val(taskDetails.task_deadline);
            $('#showTaskStatus').val(taskDetails.task_status);
            $('#showTaskLevel').val(taskDetails.task_level);
        });
    }

    $(document).ready(function() {
        ShowCompletedTaskList();
    });
</script>
