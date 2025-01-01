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
            ShowMessage('success', 'Successful!');
        })
        .catch((error) => {
            ShowMessage('error', 'Failed!');
        });
    }
</script>