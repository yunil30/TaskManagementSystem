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
            <button type="button" class="btn btn-primary" id="btnCreateTask">Create Task</button>
        </div>
        <div class="col-md-12 content-body">
        </div>
    </div>
</main>

<!-- Create task modal -->
<div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Create Task</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12 mb-2 p-0">
                    <label>Task Title</label>
                    <input type="text" class="form-control" id="taskTitle">
                </div>
                <div class="col-md-12 mb-2 p-0">
                    <label>Task Description</label>
                    <input type="text" class="form-control" id="taskDescription">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnCancel" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="btnSubmit">Submit</button>
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
</script>
