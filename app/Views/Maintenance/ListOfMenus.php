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
<body>
<!-- Header component -->
<?= show_header(); ?>

<!-- Main component -->
<main class="page-main">
    <div class="main-content">
        <div class="col-md-12 content-header">
            <h3 style="margin: 0;">List of Menus</h3>
            <button type="button" class="btnHeader" id="btnAddMenu">New Menu</button>
        </div>
        <div class="col-md-12 content-body">
            <table class="table table-hover table-bordered" id="menutListTable">
                <thead>
                    <tr>
                        <th class="text-left" style="width: 15%; text-align: left;">MenuNo.</th>
                        <th class="text-left" style="width: 30%; text-align: left;">Menu name</th>
                        <th class="text-left" style="width: 30%; text-align: left;">Menu type</th>
                        <th class="text-center" style="width: 25%;">Action</th>
                    </tr>
                </thead>
                <tbody id="loadMenus"></tbody>
            </table> 
        </div>
    </div>
</main>

<!-- Create menu modal -->
<div class="modal fade" id="createMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="addMenuName">Menu name:</label>
                        <input type="text" class="form-control" id="addMenuName" placeholder="Menu name" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addMenuPage">Menu Page:</label>
                        <input type="text" class="form-control" id="addMenuPage" placeholder="Menu page" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="addMenuType">Menu type:</label>
                        <select class="form-control" id="addMenuType">
                            <option value="">Select an Option</option>
                            <option value="parent">parent</option>
                            <option value="child">child</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="addParentMenu">Parent Menu:</label>
                        <input type="number" class="form-control" id="addParentMenu" placeholder="Parent menu" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="addMenuIndex">Menu Index:</label>
                        <input type="number" class="form-control" id="addMenuIndex" placeholder="Menu index" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="btn success" id="btnSubmitCreateMenu" onclick="CreateNewMenu()">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Show menu modal -->
<div class="modal fade" id="showMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="titleMenuModal">Edit Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12 modal-body" style="max-height: 65vh; overflow-y: auto;">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="showMenuName">Menu name:</label>
                        <input type="text" class="form-control" id="showMenuName" placeholder="Menu name" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="showMenuPage">Menu Page:</label>
                        <input type="text" class="form-control" id="showMenuPage" placeholder="Menu page" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="showMenuType">Menu type:</label>
                        <select class="form-control" id="showMenuType">
                            <option value="">Select an Option</option>
                            <option value="parent">parent</option>
                            <option value="child">child</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="showParentMenu">Parent Menu:</label>
                        <input type="number" class="form-control" id="showParentMenu" placeholder="Parent menu" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="showMenuIndex">Menu Index:</label>
                        <input type="number" class="form-control" id="showMenuIndex" placeholder="Menu index" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="btn success" id="btnSubmitEditMenu">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Remove menu modal -->
<div class="modal fade" id="removeMenuModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 400px; width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Action Verification</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="col-md-12 mb-3 p-0">
                    <label>Are you sure you want to remove this menu?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="btn success" id="btnConfirmRemoveMenu">Confirm</button>
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

    $('#btnAddMenu').click(function() {
        $('#btnAddMenu').attr({
            'data-toggle': 'modal',
            'data-target': '#createMenuModal'
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
            if (result.isConfirmed && icon !== 'error') {
                window.location.reload();
            }
        });
    }

    function ShowUserMenus() {
        axios.get(host_url + 'Menu/GetListOfMenus').then(function(res) {
            if ($.fn.DataTable.isDataTable('#menutListTable')) {
                $('#menutListTable').DataTable().destroy();
            }

            $('#loadMenus').empty();

            res.data.forEach(function(row, index) {
                $('#loadMenus').append(`
                    <tr>
                        <td style="vertical-align: middle; text-align: left;">${row.MenuID}</td>
                        <td style="vertical-align: middle; text-align: left;">${row.menu_name}</td>
                        <td style="vertical-align: middle; text-align: left;">${row.menu_type}</td>
                        <td style="vertical-align: middle; text-align: center;">
                            <div style="display: flex; justify-content: space-evenly; align-items: center; width: 100%;">
                                <button class="btn btn-transparent" id="btnShowMenu${row.MenuID}" onclick="ShowMenuModal(${row.MenuID}, 'Show')"><span class="fas fa-eye"></span></button>
                                <button class="btn btn-transparent" id="btnEditMenu${row.MenuID}" onclick="ShowMenuModal(${row.MenuID}, 'Edit')"><span class="fas fa-pencil"></span></button>
                                <button class="btn btn-transparent" id="btnRemoveMenu${row.MenuID}" onclick="ShowRemoveMenuModal(${row.MenuID})"><span class="fas fa-trash"></span></button>
                            </div>
                        </td>
                    </tr>
                `);
            });

            $('#menutListTable').DataTable({
                searching: true,
                pageLength: 5,
                lengthChange: false,
                ordering: true,
                columnDefs: [
                    { type: 'num', targets: 0 }
                ]
            });
        });
    }

    function ShowRemoveMenuModal(menuID) {
        $('#btnRemoveMenu' + menuID).attr({
            'data-toggle': 'modal',
            'data-target': '#removeMenuModal'
        });
        $('#btnConfirmRemoveMenu').attr('onclick', `RemoveMenu(${menuID})`);
    }

    function ShowMenuModal(menuID, mode) {
        $('#btn' + mode + 'Menu' + menuID).attr({
            'data-toggle': 'modal',
            'data-target': '#showMenuModal'
        });

        var data = { 
            menuID: menuID 
        };

        axios.post(host_url + 'Menu/GetMenuRecord', data)
        .then((res) => { 
            var menuDetails = res.data[0];
            
            $('#showMenuName').val(menuDetails.menu_name);
            $('#showMenuPage').val(menuDetails.menu_page);
            $('#showMenuType').val(menuDetails.menu_type);
            $('#showParentMenu').val(menuDetails.parent_menu);
            $('#showMenuIndex').val(menuDetails.menu_index);

            if (mode === 'Show') {
                $('#showMenuName, #showMenuPage, #showMenuType, #showParentMenu, #showMenuIndex').prop('disabled', true);
                $('#titleMenuModal').text('Menu');
                $('#btnSubmitEditMenu').hide();
            } else {
                $('#showMenuName, #showMenuPage, #showMenuType, #showParentMenu, #showMenuIndex').prop('disabled', false);
                $('#titleMenuModal').text('Edit Menu');
                $('#btnSubmitEditMenu').show();
                $('#btnSubmitEditMenu').attr('onclick', `EditMenu(${menuID})`);
            }
        });
    }

    function CreateNewMenu() {
        var data = {
            MenuName: $('#addMenuName').val(),
            MenuPage: $('#addMenuPage').val(),
            MenuType: $('#addMenuType').val(),
            ParentMenu: $('#addParentMenu').val(),
            MenuIndex: $('#addMenuIndex').val()
        }

        axios.post(host_url + 'Menu/CreateNewMenu', data)        
        .then((res) => {
            ShowMessage('success', 'Successful!', res.data.message);
        })
        .catch((error) => {
            ShowMessage('error', 'Failed!', error.response?.data?.error || 'An error occurred while saving data.');
        });
    }

    function EditMenu(menuID) {
        var data = {
            MenuID: menuID,
            MenuName: $('#showMenuName').val(),
            MenuPage: $('#showMenuPage').val(),
            MenuType: $('#showMenuType').val(),
            ParentMenu: $('#showParentMenu').val(),
            MenuIndex: $('#showMenuIndex').val()
        }
        
        axios.post(host_url + 'Menu/EditMenu', data)        
        .then((res) => {
            ShowMessage('success', 'Successful!', res.data.message);
        })
        .catch((error) => {
            ShowMessage('error', 'Failed!', error.response?.data?.error || 'An error occurred while editing the menu data.');
        }); 
    }

    function RemoveMenu(menuID) {
        var data = {
            MenuID: menuID,
        }

        axios.post(host_url + 'Menu/RemoveMenu', data)
        .then((res) => {
            ShowMessage('success', 'Successful!', res.data.message);
        })
        .catch((error) => {
            ShowMessage('error', 'Failed!', error.response?.data?.error || 'An error occurred while removing the menu record.');
        });
    }

    $(document).ready(function() {
        ShowUserMenus();
    });
</script>