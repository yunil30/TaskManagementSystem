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
<style>
    .accountSettingDiv {
        font-family: "Poppins", sans-serif;
        letter-spacing: 1px;
        margin: 0;
        padding: 0;
        height: 100%;
        display: grid;
        grid-template-rows: 1fr 1fr 1fr;
        grid-template-areas: 
            "accSettingDiv1"
            "accSettingDiv2"
            "accSettingDiv3";
        padding-right: 0 !important;

        input {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            letter-spacing: 1px;
        }

        .accHeadingDiv {
            display: flex;
            justify-content: space-between;
            align-items: center;

            h5 {
                margin: 0;
            }

            .edit-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background-color: white;
                color: #1f2328;
                box-shadow: 0px 1px 5px #00000047;
                border: none;
                border-radius: 3px;
                padding: 5px 18px;
                font-size: 14px;
                font-weight: 500;
                cursor: pointer;
                transition: background-color 0.3s, color 0.3s, border-color 0.3s;
            }

            .edit-button i {
                margin-right: 12px; 
            }

            .edit-button:hover {
                background-color: #f0f8ff;
                color: #0056b3;
            }
        }

        .accHeadingDescription {
            color: #1f2328;
            font-weight: 400;
            font-size: 14px;
            margin-bottom: 2rem;
        }

        .accSettingDiv1 {
            box-shadow: 0px 1px 5px #00000047;
            grid-area: accSettingDiv1;
            padding: 1rem;
        }

        .accSettingDiv2 {
            box-shadow: 0px 1px 5px #00000047;
            grid-area: accSettingDiv2;
            padding: 1rem;
        }

        .accSettingDiv3 {
            box-shadow: 0px 1px 5px #00000047;
            grid-area: accSettingDiv3;
            padding: 1rem;
        }
    }

</style>
<body>
<!-- Header component -->
<?= show_header(); ?>

<!-- Main component -->
<main class="page-main">
    <div class="main-content">
        <div class="col-md-12 content-header">
            <h3 style="margin: 0;">User Profile</h3>
        </div>
        <div class="col-md-12 p-0 content-body">
            <div class="col-md-12 accountSettingDiv">
                <div class="col-md-12 mb-4 accSettingDiv1">
                    <div class="col-md-12 mb-0 p-0 accHeadingDiv">
                        <h5>Fullname</h5>
                        <button type="button" class="edit-button" id="btnShowUserInfoModal"><i class="fas fa-edit"></i>Edit Information</button>
                    </div>
                    <label class="accHeadingDescription">View and update your accounts name and username.</label>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>First name</label>
                            <input type="text" class="form-control" id="accFirstName" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Middle name</label>
                            <input type="text" class="form-control" id="accMiddleName" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Last name</label>
                            <input type="text" class="form-control" id="accLastName" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Username</label>
                            <input type="text" class="form-control" id="accUserName" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-4 accSettingDiv2">
                    <div class="col-md-12 mb-0 p-0 accHeadingDiv">
                        <h5>Contacts</h5>
                        <button type="button" class="edit-button" id="btnShowUserContactModal"><i class="fas fa-edit"></i>Edit Contacts</button>
                    </div>
                    <label class="accHeadingDescription">Manage your accounts email address and contact number.</label>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>Contact email</label>
                            <input type="text" class="form-control" id="accContactEmail" disabled>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Contact number</label>
                            <input type="text" class="form-control" id="accContactNumber" disabled>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-4 accSettingDiv3">
                    <div class="col-md-12 mb-0 p-0 accHeadingDiv">
                        <h5>Password</h5>
                        <button type="button" class="edit-button" id="btnShowChangePassModal"><i class="fas fa-edit"></i>Change Password</button>
                    </div>
                    <label class="accHeadingDescription">Modify your currend password</label>
                    <!-- <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Current Password</label>
                            <input type="password" class="form-control" id="accPassword">
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Show edit information modal -->
<div class="modal fade" id="showUserInfoModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 450px; width: 100%;">
        <div class="modal-content" style="height: auto; max-height: 80vh;">
            <div class="modal-header">
                <h4 class="modal-title" id="titleUserModal">Edit Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 60vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>First Name:</label>
                        <input type="text" class="form-control" id="showFirstName">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Middle Name:</label>
                        <input type="text" class="form-control" id="showMiddleName">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Last Name:</label>
                        <input type="text" class="form-control" id="showLastName">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Username:</label>
                        <input type="text" class="form-control" id="showUserName">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnUpdateUserData">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Show edit contacts modal -->
<div class="modal fade" id="showUserContactModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 400px; width: 100%;">
        <div class="modal-content" style="height: auto; max-height: 80vh;">
            <div class="modal-header">
                <h4 class="modal-title" id="titleUserModal">Edit Contacts</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 60vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Contact email:</label>
                        <input type="text" class="form-control" id="showUserContactEmail">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Contact number:</label>
                        <input type="text" class="form-control" id="showUserContactNumber">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnUpdateUserData">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Show change password modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 400px; width: 100%;">
        <div class="modal-content" style="height: auto; max-height: 80vh;">
            <div class="modal-header">
                <h4 class="modal-title" id="titleUserModal">Change Password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 60vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>New Password:</label>
                        <input type="password" class="form-control" id="NewUserPassword">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Confirm Password:</label>
                        <input type="password" class="form-control" id="ConfirmUserPassword">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnUpdateUserData">Submit</button>
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

    $('#btnShowUserInfoModal').click(function() {
        $('#btnShowUserInfoModal').attr({
            'data-toggle': 'modal',
            'data-target': '#showUserInfoModal'
        });
    });

    $('#btnShowUserContactModal').click(function() {
        $('#btnShowUserContactModal').attr({
            'data-toggle': 'modal',
            'data-target': '#showUserContactModal'
        });
    });

    $('#btnShowChangePassModal').click(function() {
        $('#btnShowChangePassModal').attr({
            'data-toggle': 'modal',
            'data-target': '#changePasswordModal'
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

    function ShowUserDataToUpdate() {
        axios.get(host_url + 'User/GetUserInfo')
        .then((res) => {
            var userData = res.data[0];
            $('#showFirstName').val(userData.first_name);
            $('#showMiddleName').val(userData.middle_name);
            $('#showLastName').val(userData.last_name);
            $('#showUserName').val(userData.user_name);
            $('#showUserEmail').val(userData.user_email);
            $('#showUserRole').val(userData.user_role);
        });
    }

    function ShowUserData() {
        axios.get(host_url + 'User/GetUserInfo')
        .then((res) => {
            var userData = res.data[0];
            $('#accFirstName').val(userData.first_name);
            $('#accMiddleName').val(userData.middle_name);
            $('#accLastName').val(userData.last_name);
            $('#accUserName').val(userData.user_name);
            $('#accContactEmail').val(userData.user_email);
            $('#accPassword').val(userData.password);
        });
    }

    function UpdateUserData() {
        var data = {
            FirstName: $('#showFirstName').val(),
            MiddleName: $('#showMiddleName').val(),
            LastName: $('#showLastName').val(),
            UserName: $('#showUserName').val(),
            UserEmail: $('#showUserEmail').val()
        }

        axios.post(host_url + 'User/UpdateUserInfo', data)
        .then((res) => {
            ShowMessage('success', 'Successful!', res.response);
        })
        .catch((error) => {
            ShowMessage('error', 'Failed!', error.response?.data?.error || 'An error occurred while updating data.');
        }); 
    }
    
    $(document).ready(function() {
        ShowUserData();
    });
</script>