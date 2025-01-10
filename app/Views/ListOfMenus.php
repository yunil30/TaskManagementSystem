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
            <h3 style="margin: 0;">Menus</h3>
            <button type="button" class="btn btn-primary" id="btnMapMenus">Map Menus</button>
        </div>
        <div class="col-md-12 content-body">
            <table class="table table-hover table-bordered" id="menuTable">
                <thead>
                    <tr>
                        <th class="text-left">Menu Name</th>
                        <th class="text-left">Menu Type</th>
                        <th class="text-left">Visibility</th>
                    </tr>
                </thead>
                <tbody id="loadUsers"></tbody>
            </table>
        </div>
    </div>
</main>

<!-- Mapping menu modal -->
<div class="modal fade" id="menuMappingModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 500px; width: 100%;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Menu Mapping</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-md-12 modal-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>User role:</label>
                        <select class="form-control" id="userRoles">
                            <option value="">Select an Option</option>
                            <option value="user" selected>User</option>
                            <option value="leader">Leader</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>User menus:</label>
                        <select class="form-control" id="userMenus" multiple>
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

    $('#btnMapMenus').click(function() {
        $('#btnMapMenus').attr({
            'data-toggle': 'modal',
            'data-target': '#menuMappingModal'
        });
    });
</script>