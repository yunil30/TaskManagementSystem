<!-- This is the header section -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<!-- Add SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Add jQuery and DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<!-- Add Google Font -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<!-- JS Poppers-->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<style>
    body {
        font-family: "Poppins", sans-serif;
        font-weight: 500;
        margin: 0;
        height: 100vh;
        display: grid;
        grid-template-columns: 14rem 1fr;
        grid-template-rows: 3.5rem 1fr auto;
        grid-template-areas: 
            "header header"
            "sidebar main"
            "footer footer";
        transition: all 1s ease;
        padding-right: 0 !important;
    }

    /* Header Portion */
    .page-header {
        grid-area: header;
        background-color: rgba(247, 248, 249, 1);
        padding: .4rem 0 0;
        border-bottom: 1px solid rgba(150, 150, 150, 0.28);

        .menu {
            padding: .4rem 2rem;

            ul {
                border-bottom: 1px solid rgba(242, 242, 242, 1);
                list-style-type: none;
                margin: 0;
                overflow: hidden;
                padding: 0;
                text-align: right;
            }

            li {
                display: inline-block;

                a {
                    border-radius: 5px;
                    color: rgba(0, 0, 0, .5);
                    display: block;
                    height: 44px;
                    text-decoration: none;
                }
            }

            .logo {
                float: left;
                height: 44px;
                padding: 0rem;
            }
        }
    }

    /* Sidebar Portion */
    .page-sidebar {
        grid-area: sidebar;
        background-color:rgb(255, 255, 255);
        padding: 1rem 1rem 1rem 1rem;
        border-right: 1px solid rgba(150, 150, 150, 0.28);

        .menu-header {
            font-family: "Poppins", sans-serif;
            font-size: 1rem;
            font-weight: 500;
            letter-spacing: 0.1rem;
            padding: 0rem 0.5rem 0.5rem 0.5rem;
            margin: 0rem;
        }
        
        .menu-ul {
            cursor: pointer; 
            font-family: "Poppins", sans-serif;
            font-size: 1rem;
            font-weight: 500;
            letter-spacing: 0.1rem;
            padding: 1rem 0.5rem 1rem 0.5rem;
            margin: 0rem;
            list-style-type: none;
            text-decoration: none;
            display: flex;
            justify-content: space-between;
            align-items: center;

            &:hover {
                background-color: #ffffff;
                border-radius: 0.3rem;
                font-size: 1.01rem;
            }

            &:active {
                font-size: 1.05rem;
            }
        }

        .submenu_ul {
            list-style-type: none;
            text-align: left;
            padding: 0rem;
            margin: 0rem;
            
            li {
                cursor: pointer;
                font-family: "Poppins", sans-serif;
                font-size: 1rem;
                font-weight: 500;
                letter-spacing: 0.1rem;
                padding: 1rem 0.5rem 1rem 1.1rem;
                margin: 0rem;

                &:hover {
                    background-color: #ffffff;
                    border-radius: 0.3rem;
                    font-size: 1.01rem;
                }

                &:active {
                    font-size: 1.05rem;
                }
            }
        }
    }

    /* Main Portion */
    .page-main {
        grid-area: main;
        background-color: #f1fffd;
        padding: 2rem;

        .main-content {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 1px 10px #00000047;
            height: 100%;
            padding: 1rem;

            .content-header {
                /* border: 1px solid black; */
                display: flex;
                justify-content: space-between;
                align-items: center;
                height: 10%;

                h3 {
                    color: #17a589;
                }
            }

            .content-body {
                /* border: 1px solid black; */
                /* display: flex; */
                /* justify-content: space-between; */
                /* align-items: center; */
                padding: 0 1rem 2rem 1rem;
                height: 90%;
            }
        }
    }

    /* Footer Portion */
    .page-footer {
        grid-area: footer;
        background-color: #17a589;
        text-align: center;

        .copyrights {
            padding: 16px;

            p {
                font-family: "Poppins", sans-serif;
                font-size: 1rem;
                color: #ffffff;
                margin: 0;
            }
        }
    }
    
    /* Modal Portion */
    .modal {
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        /* width: 400px; */

        .modal-header {
            padding: 15px 20px 5px 20px;
        }

        .modal-body {
            padding: 15px 20px 15px 20px;
        }

        .modal-footer {
            padding: 5px 20px 15px 20px;
        }
    }
</style>