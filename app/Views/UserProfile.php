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
    .userProfileDiv {
        margin: 0;
        padding: 0;
        height: 100%;
        display: grid;
        grid-template-columns: 14rem 1fr;
        grid-template-areas: "leftSide rightSide";
        padding-right: 0 !important;

        .leftSideDiv {
            font-family: "Poppins", sans-serif;
            letter-spacing: 1px;
            /* border: 1px solid black; */
            grid-area: leftSide;
            padding: 0;


            #userPictureDiv {
                display: flex;
                justify-content: center;
                padding: 0.5rem;

                img {
                    height: 150px;
                    width: 150px;
                    border-radius: 50%;
                    object-fit: cover;
                    background-color: #dfdfdf;
                }
            }
                    
            #userFullName {
                text-align: center;
                font-size: 14px
            }

            #userPosition {
                text-align: center;
                font-size: 14px;
            }
        }

        .rightSideDiv {
            /* border: 1px solid black; */
            grid-area: rightSide;
            padding: 0;
        }
    }

    .custom-file-upload, 
    .custom-file-delete{
        padding: 12px 20px;
        border-radius: 5px;
        text-align: center;
        font-size: 1rem;
        cursor: pointer;
        border: 2px solid #007bff;
        transition: all 0.3s ease;
    }

    .custom-file-upload:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .custom-file-upload i {
        margin-right: 8px;
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
            <button type="button" class="btn btn-primary" id="btnShowUserModal">Update</button>
        </div>
        <div class="col-md-12 content-body">
            <div class="col-md-12 userProfileDiv">
                <div class="col-md-12 leftSideDiv">
                    <div class="col-md-12 mb-3" id="userPictureDiv">
                        <img id="ProfilePic">
                    </div>
                    <h6 id="userFullName"></h6>
                    <h6 id="userPosition"></h6>
                </div>
                
                <div class="col-md-12 rightSideDiv">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label>First Name:</label>
                            <label>Uneal Cabrera Dungo</label>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Username:</label>
                            <label>Uneal</label>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Email:</label>
                            <label>ucdungo@gmail.com</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Show update user modal -->
<div class="modal fade" id="showUserModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px; width: 100%;">
        <div class="modal-content" style="height: auto; max-height: 80vh;">
            <div class="modal-header">
                <h4 class="modal-title" id="titleUserModal">Update User</h4>
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
                    <div class="col-md-12 mb-3">
                        <label>Email:</label>
                        <input type="text" class="form-control" id="showUserEmail">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>User role:</label>
                        <select class="form-control" id="showUserRole" disabled>
                            <option value="">Select an Option</option>
                            <option value="user">User</option>
                            <option value="leader">Leader</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnUpdateUserData" onclick="UpdateUserData()">Submit</button>
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

    $('#btnShowUserModal').click(function() {
        $('#btnShowUserModal').attr({
            'data-toggle': 'modal',
            'data-target': '#showUserModal'
        });

        ShowUserDataToUpdate();
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
            let fullName = `${userData.first_name} ${userData.middle_name} ${userData.last_name}`;
            let userName = userData.user_role.charAt(0).toUpperCase() + userData.user_role.slice(1).toLowerCase();

            $('#userFullName').text(fullName);
            $('#userPosition').text(userName);
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