<header class="page-header">
    <div class="header-container">
        <div class="header-icon-div">
            <i class="material-icons" id="menu-icon">menu</i>
        </div>
        <div class="header-logo-div">
            <a href="http://localhost:8030/"><i class="fas fa-edit"></i>Task<span>MAKER</span></a>
        </div>
        <div class="header-fname-div">
            <i class="fas fa-user" id="header-pic"></i><label id="header-fname"></label>
        </div>
    </div>
</header>

<aside class="page-sidebar">
    <!-- <label class="menu-header">Menu</label> -->
</aside>

<!-- Logout user modal -->
<div class="modal fade" id="logoutUserModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <label>Are you sure you want to log out?</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnLogOut">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>
    var host_url = '<?php echo host_url(); ?>';

    $('#menu-icon').click(function() {
        $('body').toggleClass('sidebar-minimize');
    });

    function GetUserMenu() {
        axios.get(host_url + 'Login/GetUserMenu').then(function(res) {
            let menus = {};  // To store parent menus and their children

            res.data.forEach(function(row) {
                // Check if parent already exists in the menus object
                if (!menus[row.parent_id]) {
                    menus[row.parent_id] = {
                        parent_menu: row.parent_menu,
                        parent_page: row.parent_page,
                        parent_icon: row.parent_icon,
                        children: []
                    };
                }

                // If child exists, push it to the parent's children array
                if (row.child_id) {
                    menus[row.parent_id].children.push({
                        child_id: row.child_id,
                        child_menu: row.child_menu,
                        child_page: row.child_page,
                        child_index: row.child_index,
                        child_icon: row.child_icon
                    });
                }
            });

            // Now render the menus
            Object.keys(menus).forEach(function(parentId) {
                let parent = menus[parentId];

                // Sort the children by `child_index` before rendering
                parent.children.sort(function(a, b) {
                    return a.child_index - b.child_index;
                });

                // Create the parent menu item
                let parentHtml = `
                    <ul class="menu-ul" id="menu${parentId}" onclick="BtnShowPage('${parent.parent_page}', ${parentId})"><i class="fas ${parent.parent_icon} menu-icon"></i>${parent.parent_menu}</ul>
                    <ul class="submenu_ul" id="submenu${parentId}">
                `;
    
                // If there are children, add them
                if (parent.children.length > 0) {
                    parentHtml += ``;
                    parent.children.forEach(function(child) {
                        parentHtml += `
                            <li onclick="BtnShowPage('${child.child_page}', ${child.child_id})" id="child-menu${child.child_id}" data-index="${child.child_index}"><i class="fas ${child.child_icon} menu-icon"></i>${child.child_menu}</li>
                        `;
                    });
                }

                parentHtml += '</ul>';

                // Append the parent menu to the sidebar
                $('.page-sidebar').append(parentHtml);
            });
        })
    }

    function BtnShowPage(path, id) {
        if (path == '#') {
            $('#submenu' + id).slideToggle(500);
        }

        if (id == 4) {
            var $MenuButton = $('#menu4');
            var $btnLogOut = $('#btnLogOut');

            $MenuButton.attr({
                'data-toggle': 'modal',
                'data-target': '#logoutUserModal'
            });

            $btnLogOut.click(function() {
                axios.post(host_url + 'Login/Logout')
                .then(() => {
                    window.location.href = host_url;
                })
            });
        } else {
            window.location.href = host_url + path;
        }
    }

    function GetUserName() {
        axios.get(host_url + 'User/GetUserInfo')
        .then((res) => {
            var UserData = res.data[0];
            $('#header-fname').text(UserData.first_name + ' ' + UserData.last_name);
        });
    }

    $('document').ready(function() {
        GetUserName();
        GetUserMenu();
    });
</script>