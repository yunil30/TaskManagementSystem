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
            <button type="button" class="btn btn-primary" id="btnCreateTask">New Task</button>
        </div>
        <div class="col-md-12 content-body">
            <table class="table table-hover table-bordered" id="taskListTable">
                <thead>
                    <tr>
                        <th class="text-left" style="width: 15%">TaskNo.</th>
                        <th class="text-left" style="width: 20%">Task Name</th>
                        <th class="text-left" style="width: 20%">Assigned To</th>
                        <th class="text-left" style="width: 15%">Task Status</th>
                        <th class="text-left" style="width: 15%">Task Deadline</th>
                        <th class="text-center" style="width: 15%">Action</th>
                    </tr>
                </thead>
                <tbody id="loadTask"></tbody>
            </table>
        </div>
    </div>
</main>

<!-- Create task modal -->
<div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-hidden="true" style="width: 700px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Task</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Task Name</label>
                        <input type="text" class="form-control" id="addTaskName">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Task Description</label>
                        <textarea type="text" class="form-control" id="addTaskDescription"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Assign To</label>
                        <select class="form-select" id="addTaskAssignTo">
                            <option value="">Select an Option</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Task Deadline</label>
                        <input type="date" class="form-control" id="addTaskDeadline">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Task Status</label>
                        <select class="form-select" id="addTaskStatus">
                            <option value="">Select an Option</option>
                            <option value="1" selected>Pending</option>
                            <option value="2">In Progress</option>
                            <option value="3">Completed</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Task Level</label>
                        <select class="form-select" id="addTaskLevel">
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
                <button type="button" class="btn btn-success" id="btnSubmitCreateTask" onclick="CreateTask()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Show task modal -->
<div class="modal fade" id="showTaskModal" tabindex="-1" role="dialog" aria-hidden="true" style="width: 700px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Task</h4>
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
                        <label>Assign To</label>
                        <select class="form-select" id="showTaskAssignTo">
                            <option value="">Select an Option</option>
                        </select>
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
                <button type="button" class="btn btn-success" id="btnSubmitEditTask">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Remove task modal -->
<div class="modal fade" id="removeTaskModal" tabindex="-1" role="dialog" aria-hidden="true" style="width: 400px;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Action Verification</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="col-md-12 mb-3 p-0">
                    <label>Are you sure you want to remove this task?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnConfirmRemoveTask">Confirm</button>
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

    function ShowMessage(icon, title, position = 'center') {
        Swal.fire({
            icon: icon,
            title: title,
            position: position, 
            showConfirmButton: false,
            timer: 1500, 
            timerProgressBar: true, 
            heightAuto: false, 
        }).then((result) => {
            if (result.isConfirmed && url !== '') {
                httpGet(url); 
                history.pushState({ prevUrl: window.location.href }, '', url);
            }
        });
    }

    function CreateTask() {
        if ($('#addTaskName').val() === '') {
            ShowMessage('error', 'Task name is required!');
            $('#addTaskName').trigger('chosen:activate');

            return false;
        }

        if ($('#addTaskDescription').val() === '') {
            ShowMessage('error', 'Task description is required!');
            $('#addTaskDescription').trigger('chosen:activate');

            return false;
        }

        if ($('#addTaskAssignTo').val() === '') {
            ShowMessage('error', 'Please select a member to assign the task.');
            $('#addTaskAssignTo').trigger('chosen:activate');

            return false;
        }

        if ($('#addTaskDeadline').val() === '') {
            ShowMessage('error', 'Please select a deadline for the task.');
            $('#addTaskDeadline').trigger('chosen:activate');

            return false;
        }

        if ($('#addTaskStatus').val() === '') {
            ShowMessage('error', 'Please select a task status.');
            $('#addTaskStatus').trigger('chosen:activate');

            return false;
        }

        if ($('#addTaskLevel').val() === '') {
            ShowMessage('error', 'Please select a task level.');
            $('#addTaskLevel').trigger('chosen:activate');

            return false;
        }

        var data = {
            taskName: $('#addTaskName').val(),
            taskDescription: $('#addTaskDescription').val(),
            taskAssignTo: $('#addTaskAssignTo').val(),
            taskDeadline: $('#addTaskDeadline').val(),
            taskStatus: $('#addTaskStatus').val(),
            taskLevel: $('#addTaskLevel').val()
        }

        axios.post(host_url + 'Home/CreateTask', data).then(function(res) {
            console.log(res.data);
        });
    }

    function GetTaskUsers() {
        axios.get(host_url + 'Home/GetTaskUsers').then(function(res) {
            res.data.forEach(function(row) {
                $('#addTaskAssignTo, #showTaskAssignTo').append(`<option value="${row.UserID}">${row.FullName}</option>`);
            });
        });
    }

    function ShowTaskList() {
        axios.get(host_url + 'Home/GetTaskList').then(function(res) {
            if ($.fn.DataTable.isDataTable('#taskListTable')) {
                $('#taskListTable').DataTable().destroy();
            }

            $('#loadTask').empty();

            res.data.forEach(function(row, index) {
                $('#loadTask').append(`
                    <tr>
                        <td style="vertical-align: middle; text-align: left;">${row.TaskID}</td>
                        <td style="vertical-align: middle; text-align: left;">${row.task_name}</td>
                        <td style="vertical-align: middle; text-align: left;">${row.task_member}</td>    
                        <td style="vertical-align: middle; text-align: left;">
                            ${row.task_status == 1 ? 'Pending' 
                            : row.task_status == 2 ? 'In Progress' 
                            : 'Completed'}
                        </td>
                        <td style="vertical-align: middle; text-align: left;">${row.task_deadline}</td>    
                        <td style="vertical-align: middle; text-align: center;">
                            <button class="btn btn-transparent" id="btnShowTask${row.TaskID}" onclick="ShowTaskModal(${row.TaskID}, 'Show')" ><span class="fas fa-eye"></span></button>
                            <button class="btn btn-transparent" id="btnEditTask${row.TaskID}" onclick="ShowTaskModal(${row.TaskID}, 'Edit')"><span class="fas fa-pencil"></span></button>
                            <button class="btn btn-transparent" id="btnRemoveTask${row.TaskID}" onclick="ShowRemoveTaskModal(${row.TaskID})"><span class="fas fa-trash"></span></button>
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

    function ShowTaskModal(taskNo, mode) {
        $('#btn' + mode + 'Task' + taskNo).attr({
            'data-toggle': 'modal',
            'data-target': '#showTaskModal'
        });

        var data = { 
            taskNo: taskNo 
        };

        axios.post(host_url + 'Home/GetTaskDetails', data).then(function(res) { 
            var taskDetails = res.data[0];

            $('#showTaskName').val(taskDetails.task_name);
            $('#showTaskDescription').val(taskDetails.task_description);
            $('#showTaskAssignTo').val(taskDetails.assigned_to);
            $('#showTaskDeadline').val(taskDetails.task_deadline);
            $('#showTaskStatus').val(taskDetails.task_status);
            $('#showTaskLevel').val(taskDetails.task_level);

            if (mode === 'Show') {
                $('#showTaskName, #showTaskDescription, #showTaskAssignTo, #showTaskDeadline, #showTaskStatus, #showTaskLevel').prop('disabled', true);
                $('#btnSubmitEditTask').hide();
            } else {
                $('#showTaskName, #showTaskDescription, #showTaskAssignTo, #showTaskDeadline, #showTaskStatus, #showTaskLevel').prop('disabled', false);
                $('#btnSubmitEditTask').show();
                $('#btnSubmitEditTask').attr('onclick', `EditTask(${taskNo})`);
            }
        });
    }

    function EditTask(taskNo) {
        var data = {
            taskNo: taskNo,
            taskName: $('#showTaskName').val(),
            taskDescription: $('#showTaskDescription').val(),
            taskAssignTo: $('#showTaskAssignTo').val(),
            taskDeadline: $('#showTaskDeadline').val(),
            taskStatus: $('#showTaskStatus').val(),
            taskLevel: $('#showTaskLevel').val()
        }

        axios.post(host_url + 'Home/EditTask', data).then(function(res) {
            console.log(res.data);
        });
    }
    
    function ShowRemoveTaskModal(taskNo) {
        $('#btnRemoveTask' + taskNo).attr({
            'data-toggle': 'modal',
            'data-target': '#removeTaskModal'
        });
        $('#btnConfirmRemoveTask').attr('onclick', `RemoveTask(${taskNo})`);
    }

    function RemoveTask(taskNo) {
        var data = {
            taskNo: taskNo,
        }

        axios.post(host_url + 'Home/RemoveTask', data).then(function(res) {

        });
    }

    $(document).ready(function() {
        GetTaskUsers();
        ShowTaskList();
    });
</script>
