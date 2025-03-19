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
    <style>
        #roleMenus {
            height: 15rem;
        }
    </style>
</head>
<body>
<!-- Header component -->
<?= show_header(); ?>

<!-- Main component -->
<main class="page-main">
    <div class="main-content">
        <div class="col-md-12 content-header">
            <h3 style="margin: 0;">List of Menus</h3>
            <button type="button" class="btnHeader" id="btnMapMenus">Map Menus</button>
        </div>
        <div class="col-md-12 content-body">
            <table class="table table-hover table-bordered" id="menuTable">
                <thead>
                    <tr>
                        <th class="text-left">Role</th>
                        <th class="text-left">Assigned Menus</th>
                        <th class="text-left">Actions</th>
                    </tr>
                </thead>
                <tbody id="loadMenus"></tbody>
            </table>
        </div>
    </div>
</main>

<!-- Mapping menu modal -->
<div class="modal fade" id="showMenuMappingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px; width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Mapping</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>User role:</label>
                        <select class="form-control" id="userRole">
                            <option value="">Select an Option</option>
                            <option value="user">User</option>
                            <option value="leader">Leader</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>User menus:</label>
                        <select class="form-control chosen-select" id="roleMenus" multiple>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="success" id="btnSubmitMenuMapping" onclick="SaveMenuMapping()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit mapped menu modal -->
<div class="modal fade" id="editMenuMappingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px; width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Mapping</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>User role:</label>
                        <select class="form-control" id="editUserRole">
                            <option value="">Select an Option</option>
                            <option value="user">User</option>
                            <option value="leader">Leader</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>User menus:</label>
                        <select class="form-control chosen-select" id="editRoleMenus" multiple>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="success" id="btnEditMenuMapping">Submit</button>
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

    $('#btnMapMenus').click(function() {
        $('#btnMapMenus').attr({
            'data-toggle': 'modal',
            'data-target': '#showMenuMappingModal'
        });

        GetActiveMenu('roleMenus');
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

    function GetListOfMappedMenu() {
        axios.get(host_url + 'Menu/GetListOfMappedMenu').then(function(res) {
            if ($.fn.DataTable.isDataTable('#menuTable')) $('#menuTable').DataTable().destroy();

            $('#loadMenus').empty();

            const groupedData = res.data.reduce((acc, { user_role, menu_name}) => {
                acc[user_role] = [...(acc[user_role] || []), menu_name];
                return acc;
            }, {});

            Object.entries(groupedData).forEach(([role, menus]) => {
                
                $('#loadMenus').append(`
                    <tr>
                        <td style="vertical-align: middle;">${role.charAt(0).toUpperCase() + role.slice(1)}</td>
                        <td style="vertical-align: middle;">${menus.join(', ')}</td>
                        <td class="text-center" style="vertical-align: middle;">
                            <button class="btn btn-transparent" id="btnShowEditMenuMapping${role}" onclick="EditMenuMappingModal('${role}')"><span class="fas fa-pencil"></span></button>
                        </td>
                    </tr>
                `);
            });

            $('#menuTable').DataTable({
                searching: true,
                pageLength: 5,
                lengthChange: false,
                ordering: true
            });
        });
    }

    function EditMenuMappingModal(role) {
        $('#btnShowEditMenuMapping' + role).attr({
            'data-toggle': 'modal',
            'data-target': '#editMenuMappingModal'
        });

        GetMappedMenuByRole(role);
        GetActiveMenu('editRoleMenus');
        $('#btnEditMenuMapping').attr('onclick', `EditMenuMapping()`);
    }

    function GetMappedMenuByRole(userRole) {
        var data = {
            userRole: userRole
        }

        $('#editRoleMenus').empty();
   
        axios.post(host_url + 'Menu/GetMappedMenuByRole', data)
        .then((res) => {
            const consolidatedMenu = {
                RecID: res.data.map(item => item.RecID).join(", "), 
                MenuID: res.data.map(item => item.MenuID).join(", "), 
                menu_name: res.data.map(item => item.menu_name).join(", "), 
                user_role: res.data.find(item => item.user_role).user_role
            };

            const menuIDs = consolidatedMenu.MenuID.split(", ");
            $('#editUserRole').val(consolidatedMenu.user_role);
            $('#editRoleMenus').val(menuIDs).trigger("chosen:updated");
        })
    }

    function EditMenuMapping() {
        var data = {
            userRole: $('#editUserRole').val(),
            roleMenus: $('#editRoleMenus').val().join(',')
        }

        axios.post(host_url + 'Menu/EditMenuMapping', data)
        .then((res) => {
            ShowMessage('success', 'Successful!', res.data.message);
        })
        .catch((error) => {
            ShowMessage('error', 'Failed!', error.response?.data?.error || 'An error occurred while editing data.');
        });
    }

    function GetActiveMenu(selectMenus) {
        $('#'+selectMenus).empty();

        axios.get(host_url + 'Menu/GetActiveMenu')
        .then((res) => {
            res.data.forEach((row) => {
                $('#'+selectMenus).append(`<option value="${row.MenuID}">${row.menu_name}</option>`)
            });
            $('#'+selectMenus).trigger('chosen:updated');
        })
        .catch((error) => {
            ShowMessage('error', 'Failed!', error.response?.data?.error || 'An error occurred while loading data.');
        });
    }

    function SaveMenuMapping() {
        var data = {
            userRole: $('#userRole').val(),
            roleMenus: $('#roleMenus').val().join(',')
        }

        axios.post(host_url + 'Menu/SaveMenuMapping', data)
        .then((res) => {
            ShowMessage('success', 'Successful!', res.data.message);
        })
        .catch((error) => {
            ShowMessage('error', 'Failed!', error.response?.data?.error || 'An error occurred while saving data.');
        });
    }

    $(document).ready(function() {
        GetListOfMappedMenu();
    });
</script>