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
<style>
    .accountSettingDiv {
        font-family: "Poppins", sans-serif;
        letter-spacing: 0.5px;
        margin: 0;
        padding: 0;
        height: 100%;
        display: grid;
        grid-template-rows: 1fr 1fr auto;
        grid-template-areas: 
            "accSettingDiv1"
            "accSettingDiv2"
            "accSettingDiv3";
        padding-right: 0 !important;

        label {
            font-family: "Poppins", sans-serif;
            font-weight: 600;
            font-size: 13px;
        }

        input {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-size: 13px;
            letter-spacing: 0.5px;
            border-radius: 1px;
        }

        .accHeadingDiv {
            display: flex;
            justify-content: space-between;
            align-items: center;

            h5 {
                color: #1f2328; 
                font-family: "Poppins", sans-serif;
                font-size: 18px;
                font-weight: 500;
                letter-spacing: 0.5px;
                text-decoration: none; 
                margin: 0;
            }

            .edit-button {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background-color: white;
                color: #1f2328;
                box-shadow: 0px 0px 1px #00000035;
                border: 1px solid rgb(215, 215, 215);
                border-radius: 50px;
                padding: 5px 18px;
                font-size: 13px;
                font-weight: 500;
                cursor: pointer;
                transition: background-color 0.3s, color 0.3s, border-color 0.3s;

                i {
                    margin-right: 0.5rem; 
                }
            }

            .edit-button:hover {
                background-color: #f0f8ff;
                border: 0.1px solid #ff5733;
                color: #ff5733;
            }
        }

        .accHeadingDescription {
            color: #1f2328;
            font-weight: 400;
            font-size: 13px;
            margin-bottom: 2rem;
        }

        .accSettingDiv1 {
            background-color: #ffffff;
            border: 1px solid rgb(215, 215, 215);
            grid-area: accSettingDiv1;
            padding: 1rem;
        }

        .accSettingDiv2 {
            background-color: #ffffff;
            border: 1px solid rgb(215, 215, 215);
            grid-area: accSettingDiv2;
            padding: 1rem;
        }

        .accSettingDiv3 {
            background-color: #ffffff;
            border: 1px solid rgb(215, 215, 215);
            grid-area: accSettingDiv3;
            padding: 1rem;
        }
    }

    .input-correct {
        border: 0.1rem solid #2ecc71;
        box-shadow: 0px 0px 7px #2ecc71;
    }

    .input-error {
        border: 0.1rem solid #e74c3c;
        box-shadow: 0px 0px 7px  #e74c3c;
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
                        <h5>Personal Information</h5>
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
                        <h5>Contact Information</h5>
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

                <div class="col-md-12 mb-3 accSettingDiv3">
                    <div class="col-md-12 mb-0 p-0 accHeadingDiv">
                        <h5>User Password</h5>
                        <button type="button" class="edit-button" id="btnShowChangePassModal"><i class="fas fa-edit"></i>Change Password</button>
                    </div>
                    <label class="accHeadingDescription">Modify your currend password</label>
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
                <button type="button" class="danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="success" id="btnEditInfo">Submit</button>
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
                <button type="button" class="danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="success" id="btnEditContacts">Submit</button>
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
                <button type="button" class="danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="success" id="btnChangePassword">Submit</button>
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

        ShowUserDataToEdit();
        $('#btnEditInfo').attr('onclick', `EditUserInfo()`);
    });

    $('#btnShowUserContactModal').click(function() {
        $('#btnShowUserContactModal').attr({
            'data-toggle': 'modal',
            'data-target': '#showUserContactModal'
        });

        ShowUserDataToEdit();
        $('#btnEditContacts').attr('onclick', `EditUserContacts()`);
    });

    $('#btnShowChangePassModal').click(function() {
        $('#btnShowChangePassModal').attr({
            'data-toggle': 'modal',
            'data-target': '#changePasswordModal'
        });

        $('#btnChangePassword').attr('onclick', `ChangePassword()`);
    });

    $('#ConfirmUserPassword').on('input', function() {
        var NewUserPassword = $('#NewUserPassword').val();
        var ConfirmUserPassword = $('#ConfirmUserPassword').val();

        $('#NewUserPassword, #ConfirmUserPassword').removeClass('input-error input-correct');

        if (NewUserPassword === ConfirmUserPassword && ConfirmUserPassword !== "") {
            $('#NewUserPassword, #ConfirmUserPassword').addClass('input-correct');
        } else if (ConfirmUserPassword !== "") {
            $('#NewUserPassword, #ConfirmUserPassword').addClass('input-error');
        }
    });

    $('#NewUserPassword').on('input', function() {
        var NewUserPassword = $('#NewUserPassword').val();
        var ConfirmUserPassword = $('#ConfirmUserPassword').val();

        $('#NewUserPassword, #ConfirmUserPassword').removeClass('input-error input-correct');

        if (NewUserPassword !== "" || NewUserPassword === "") {
            $('#NewUserPassword, #ConfirmUserPassword').removeClass('input-error input-correct');
        } else if (NewUserPassword !== ConfirmUserPassword) {
            $('#NewUserPassword, #ConfirmUserPassword').addClass('input-error');
        }
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
            if (result.isConfirmed && icon !== 'error') {
                window.location.reload();
            }
        });
    }

    function ShowUserDataToEdit() {
        axios.get(host_url + 'User/GetUserInfo')
        .then((res) => {
            var userData = res.data[0];
            $('#showFirstName').val(userData.first_name);
            $('#showMiddleName').val(userData.middle_name);
            $('#showLastName').val(userData.last_name);
            $('#showUserName').val(userData.user_name);
            $('#showUserContactEmail').val(userData.user_email);
            $('#showUserContactNumber').val(userData.contact_number);
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
            $('#accContactNumber').val(userData.contact_number);
        });
    }

    function EditUserInfo() {
        var data = {
            FirstName: $('#showFirstName').val(),
            MiddleName: $('#showMiddleName').val(),
            LastName: $('#showLastName').val(),
            UserName: $('#showUserName').val()
        }

        axios.post(host_url + 'User/EditUserInfo', data)
        .then((res) => {
            ShowMessage('success', 'Successful!', res.data.message);
        })
        .catch((error) => {
            ShowMessage('error', 'Failed!', error.response?.data?.error || 'An error occurred while updating data.');
        }); 
    }

    function EditUserContacts() {
        var data = {
            UserEmail: $('#showUserContactEmail').val(),
            UserNumber: $('#showUserContactNumber').val()
        }

        axios.post(host_url + 'User/EditUserContacts', data)
        .then((res) => {
            ShowMessage('success', 'Successful!', res.data.message);
        })
        .catch((error) => {
            ShowMessage('error', 'Failed!', error.response?.data?.error || 'An error occurred while updating data.');
        }); 
    }

    function ChangePassword() {
        if ($('#NewUserPassword').val() === '') {
            ShowMessage('error', 'Failed!', 'Please enter a new password!');
            $('#NewUserPassword').trigger('chosen:activate');

            return false;
        }

        if ($('#ConfirmUserPassword').val() === '') {
            ShowMessage('error', 'Failed!', 'Please confirm your new password!');
            $('#ConfirmUserPassword').trigger('chosen:activate');

            return false;
        }

        if ($('#NewUserPassword').val() !== $('#ConfirmUserPassword').val()) {
            ShowMessage('error', 'Failed!', 'Passwords do not match. Please try again.');
            $('#NewUserPassword').trigger('chosen:activate');

            return false;
        }

        var data = {
            NewPassword: $('#NewUserPassword').val(),
        };

        axios.post(host_url + 'User/ChangePassword', data)
        .then((res) => {
            ShowMessage('success', 'Successful!', res.data.message);
        })
        .catch((error) => {
            ShowMessage('error', 'Failed!', error.response?.data?.error || 'An error occurred while changing the password.');
        }); 
    }
    
    $(document).ready(function() {
        ShowUserData();
    });
</script>