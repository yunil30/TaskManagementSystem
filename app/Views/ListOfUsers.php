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
            <h3 style="margin: 0;">Users</h3>
            <button type="button" class="btn btn-primary" id="btnAddUser">New User</button>
        </div>
        <div class="col-md-12 content-body">
            <table class="table table-hover table-bordered" id="userListTable">
                <thead>
                    <tr>
                        <th class="text-left" style="width: 15%">UserNo.</th>
                        <th class="text-left" style="width: 20%">Username</th>
                        <th class="text-left" style="width: 30%">Fullname</th>
                        <th class="text-left" style="width: 20%">Status</th>
                        <th class="text-center" style="width: 15%">Action</th>
                    </tr>
                </thead>
                <tbody id="loadUsers"></tbody>
            </table>
        </div>
    </div>
</main>

<!-- Create user modal -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px; width: 100%;">
        <div class="modal-content" style="height: 600px; max-height: 80vh; overflow-y: auto;">
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hi   dden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>First Name:</label>
                        <input type="text" class="form-control" id="addFirstName">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Middle Name:</label>
                        <input type="text" class="form-control" id="addMiddleName">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Last Name:   </label>
                        <input type="text" class="form-control" id="addLastName">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Username:</label>
                        <input type="text" class="form-control" id="addUserName">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Email:</label>
                        <input type="text" class="form-control" id="addUserEmail">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Password:</label>
                        <input type="password" class="form-control" id="addUserPassword">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>User role:</label>
                        <select class="form-control" id="addUserRole">
                            <option value="">Select an Option</option>
                            <option value="member" selected>Member</option>
                            <option value="leader">Leader</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnSubmitCreateUser" onclick="CreateUser()">Submit</button>
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

    $('#btnAddUser').click(function() {
        $('#btnAddUser').attr({
            'data-toggle': 'modal',
            'data-target': '#createUserModal'
        });
    });

    function ShowMessage(icon, title, text, position = 'center') {
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
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

    function ShowUserList() {
        axios.get(host_url + 'Home/GetUserList').then(function(res) {
            if ($.fn.DataTable.isDataTable('#userListTable')) {
                $('#userListTable').DataTable().destroy();
            }

            $('#loadUsers').empty();

            res.data.forEach(function(row, index) {
                $('#loadUsers').append(`
                    <tr>
                        <td class="text-left" style="vertical-align: middle;">${index + 1}</td>
                        <td style="vertical-align: middle;">${row.UserName}</td>
                        <td style="vertical-align: middle;">${row.FirstName} ${row.MiddleName} ${row.LastName}</td>    
                        <td style="vertical-align: middle;">${row.UserStatus == 1 ? 'Active' : 'Inactive'}</td>
                        <td style="vertical-align: middle; text-align: center;">
                            <button class="btn btn-transparent" onclick=""><span class="fas fa-eye"></span></button>
                            <button class="btn btn-transparent" onclick=""><span class="fas fa-pencil"></span></button>
                            <button class="btn btn-transparent" onclick=""><span class="fas fa-trash"></span></button>
                        </td>
                    </tr>
                `);
            });

            $('#userListTable').DataTable({
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

    function ShowUserModal(taskNo, mode) {
        $('#btn' + mode + 'Task' + taskNo).attr({
            'data-toggle': 'modal',
            'data-target': '#showTaskModal'
        });

        var data = { 
            taskNo: taskNo 
        };

        axios.post(host_url + 'Home/GetTaskDetails', data)
        .then((res) => { 
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

    function CreateUser() {
        var data = {
            FirstName: $('#addFirstName').val(),
            MiddleName: $('#addMiddleName').val(),
            LastName: $('#addLastName').val(),
            UserName: $('#addUserName').val(),
            UserEmail: $('#addUserEmail').val(),
            UserPassword: $('#addUserPassword').val(),
            UserRole: $('#addUserRole').val()
        }

        axios.post(host_url + 'Home/CreateUser', data)        
        .then((res) => {
            ShowMessage('success', 'Successful!', res.response);
        })
        .catch((error) => {
            ShowMessage('error', 'Failed!', error.response?.data?.error || 'An error occurred while saving data.');
        });
    }

    $(document).ready(function() {
        ShowUserList();
    });
</script>