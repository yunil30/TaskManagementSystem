<header class="page-header">
    <div class="header-container">
        <div class="header-icon-div">
            <i class="material-icons" id="menu-icon">menu</i>
        </div>
        <div class="header-logo-div">
            <a href="http://localhost:8030/"><i class="fas fa-edit"></i>Task<span>MAKER</span></a>
        </div>
    </div>
</header>

<aside class="page-sidebar">
    <div class="menu-list"></div>
    <div class="menu-logout">
        <div class="menu-item">
            <a href="javascript:void(0)" class="parent-menu" id="showLogoutModal"><i class="fas fa-arrow-right-from-bracket"></i>Logout<i></i></a>
        </div>
    </div>
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
                <button type="button" class="danger" id="btnClose" data-dismiss="modal">Close</button>
                <button type="button" class="success" id="btnLogOut" onclick="btnLogoutUser()">Confirm</button>
            </div>
        </div>
    </div>
</div>

<script>
    var host_url = '<?php echo host_url(); ?>';

    function GetUserMenu() {
        axios.get(host_url + 'Login/GetMenu').then(function(res) {
            var menus = res.data;
            // console.table(menus);

            let parentMenus = menus.filter(menu => menu.menu_type === 'parent');
            let childMenus = menus.filter(menu => menu.menu_type === 'child');
            
            parentMenus.forEach(parent => {
                let menuPage = parent.menu_page;

                if (!menuPage.startsWith('http') && !menuPage.startsWith('javascript:void(0)')) {
                    menuPage = window.location.origin + '/' + menuPage;
                }

                let listItem = `<div class="menu-item">
                                    <a href="${menuPage}" class="parent-menu" data-id="${parent.MenuID}">
                                        <i class="${parent.menu_icon}"></i>${parent.menu_name}`;

                if (parent.menu_page === 'javascript:void(0)') {
                    listItem += `<i class="fas fa-chevron-down menu-toggle-icon" style="margin-left: auto;"></i>`;
                } else {
                    listItem += `<i></i>`;
                }
                listItem += `</a>`;

                let children = childMenus.filter(child => child.parent_menu === parent.MenuID);
                if (children.length) {
                    listItem += `<div class="child-menu">`;
                    children.forEach(child => {
                        let childMenuPage = child.menu_page;

                        if (!childMenuPage.startsWith('http') && !childMenuPage.startsWith('javascript:void(0)')) {
                            childMenuPage = window.location.origin + '/' + childMenuPage;
                        }

                        listItem += `<a href="${childMenuPage}"><i class="${child.menu_icon}"></i>${child.menu_name}</a>`;
                    });
                    listItem += `</div>`;
                }

                listItem += `</div>`;
                $('.menu-list').append(listItem);
            });

            $(".parent-menu").on("click", function(e) {
                if ($(this).attr('href') === 'javascript:void(0)') {
                    e.preventDefault();
                    
                    let parentMenuId = $(this).data('id');
                    let childMenu = $(this).next('.child-menu');
                    let icon = $(this).find('.menu-toggle-icon');

                    if (childMenu.is(':visible')) {
                        childMenu.stop(true, true).slideUp(500);
                        icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
                    } else {
                        childMenu.stop(true, true).slideDown(500);
                        icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
                    }
                } else {
                    window.location.href = $(this).attr('href'); 
                }
            });
        }).catch(function(error) {
            console.error('Failed to load menus:', error);
        });
    }

    function btnLogoutUser() {
        axios.post(host_url + 'Login/Logout')
        .then((res) => {
            // Handle response
            console.log('success', 'Successful!', res.data.message);
            window.location.reload();
        })
        .catch((err) => {
            console.log('error', 'An error occurred.');
            window.location.reload();
        });
    }

    $('#menu-icon').click(function() {
        $('body').toggleClass(
            'sidebar-minimize'
        );
    });

    $('#showLogoutModal').click(function() {
        $('#showLogoutModal').attr({
            'data-toggle': 'modal',
            'data-target': '#logoutUserModal'
        });
    });

    $('document').ready(function() {
        GetUserMenu();
    });
</script>