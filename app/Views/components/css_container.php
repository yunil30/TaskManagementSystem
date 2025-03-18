<!-- This is the header section -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<!-- Add SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Add jQuery and DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<!-- Add Chosen CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" rel="stylesheet" />
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

    body.sidebar-minimize {
        grid-template-columns: 0rem 1fr;
    }

    /* Header Portion */
    .page-header {
        display: flex;
        align-items: center;
        grid-area: header;
        background-color:rgb(255, 255, 255);
        padding: 0rem 2rem;
        position: sticky;
        box-shadow: 0px 1px 5px #00000047;
        top: 0;
        z-index: 11;

        .header-container {
            display: grid;
            grid-template-columns: 3rem 1fr auto;
            align-items: center;
            width: 100%;

            .header-icon-div {
                cursor: pointer;
                display: flex;
                align-items: center;

                #menu-icon {
                    color: #1f2328;
                }

                #menu-icon:hover {
                    color: #FF5733;
                }
            }

            .header-logo-div {
                display: flex;
                justify-content: left;
                align-items: center;

                a {
                    color: #1f2328; 
                    font-family: "Poppins", sans-serif;
                    font-size: 20px;
                    font-weight: 400;
                    letter-spacing: 1px;
                    text-decoration: none; 
                    padding: 0px;
                    margin: 0px;

                    i {
                        color: #FF5733;
                        font-size: 24px; 
                        font-weight: 400;
                    }

                    span {
                        color: #FF5733; 
                        font-weight: 500;
                    }
                }

                a:hover {
                    text-decoration: none; 
                    color: inherit;   
                }
            }

            .header-fname-div {
                box-shadow: 0px 1px 5px #00000035;
                border: 1px solid rgb(215, 215, 215);
                border-radius: 50px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background-color: white;
                padding: 8px 20px 8px 20px;
                cursor: pointer;

                #header-pic {
                    padding-right: 10px;
                }

                #header-fname {
                    color: #1f2328;
                    font-family: "Poppins", sans-serif;
                    font-size: 16px;
                    font-weight: 600;
                    letter-spacing: 1px;
                    padding: 0;
                    margin: 0;
                }
            }
        }
    }

    /* Sidebar Portion */
    .page-sidebar {
        grid-area: sidebar;
        background-color:rgb(255, 255, 255);
        padding: 2rem 0rem 2rem 0rem;
        z-index: 9;
        
        .menu-header {
            color: #1f2328;
            font-family: "Poppins", sans-serif;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.1rem;
            padding: 0rem 0.5rem 0.7rem 1.5rem;
            margin: 0rem;
        }
        
        .menu-ul {
            color: #1f2328;
            cursor: pointer; 
            font-family: "Poppins", sans-serif;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 0.1rem;
            padding: 1rem 1rem 1rem 1rem;
            margin: 0rem;
            list-style-type: none;
            text-decoration: none;
            white-space: nowrap; 
            overflow: hidden;
            text-overflow: ellipsis;

            .menu-icon{
                padding: 0rem 0.5rem 0rem 0.5rem;
            }

            &:hover {
                background-color: #d5d8dc;
                font-size: 1rem;
            }

            &:active {
                font-size: 1rem;
            }
        }

        .submenu_ul {
            color: #1f2328;
            list-style-type: none;
            text-align: left;
            padding: 0rem;
            margin: 0rem;
            white-space: nowrap; 
            overflow: hidden;
            text-overflow: ellipsis;
            
            li {
                cursor: pointer;
                font-family: "Poppins", sans-serif;
                font-size: 1rem;
                font-weight: 600;
                letter-spacing: 0.1rem;
                padding: 1rem 0.5rem 1rem 2.5rem;
                margin: 0rem;

                .menu-icon{
                    padding: 0rem 0.5rem 0rem 0.5rem;
                }

                &:hover {
                    background-color: #d5d8dc;
                    font-size: 1rem;
                }

                &:active {
                    font-size: 1rem;
                }
            }
        }
    }

    /* Main Portion */
    .page-main {
        grid-area: main;
        background-color: #f8f8f8;
        border-left: 1px solid rgba(150, 150, 150, 0.35);
        border-right: 1px solid rgba(150, 150, 150, 0.35);
        padding: 2rem;
        z-index: 10;

        .main-content {
            background-color: #ffffff;
            border: 1px solid rgb(215, 215, 215);
            height: 100%;
            padding: 1rem;

            .content-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                height: 10%;

                h3 {
                    font-family: "Poppins", sans-serif;
                    font-size: 24px;
                    font-weight: 600;
                    letter-spacing: 1px;
                    color: #1f2328;
                }

                .btnHeader {
                    background-color: white;
                    border: 1px solid #0056b3;
                    color: #0056b3;
                    font-family: "Poppins", sans-serif;
                    letter-spacing: 1px;
                    font-weight: 700;
                    font-size: 16px;
                    border-radius: 50px;
                    padding: 8px 20px 8px 20px;
                    cursor: pointer;
                    display: flex;
                    align-items: center;
                }

                .btnHeader:hover {
                    background-color: #0056b3;
                    border: 1px solid #0056b3;
                    color: white;
                }
            }

            .content-body {
                padding: 0 1rem 2rem 1rem;
                height: 90%;

                .dt-layout-row {
                    font-family: "Poppins", sans-serif;
                    letter-spacing: 1px;

                    table {
                        background-color: #ffffff;
                        font-weight: 400;
                    }

                    label{
                        margin-right: 0.5rem;
                        font-weight: 500;
                        font-size: 16px;
                    }

                    input {
                        margin-bottom: 10px;
                        border: 1px solid #ccc;
                        border-radius: 3px;
                    }

                    .dt-info {
                        font-weight: 500;
                        font-size: 16px;
                    }
                }
            }
        }
    }

    /* Footer Portion */
    .page-footer {
        grid-area: footer;
        box-shadow: 0px 0px 5px #00000047;
        background-color: #ffffff;
        text-align: center;
        z-index: 10;

        .copyrights {
            padding: 16px;

            p {
                font-family: "Poppins", sans-serif;
                font-weight: 500;
                font-size: 13px;
                letter-spacing: 0.5px;
                color: #1f2328;
                padding: 0;
                margin: 0;
            }
        }
    }
    
    /* Modal Portion */
    .modal {
        font-family: "Poppins", sans-serif;
        letter-spacing: 1px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);

        .modal-content {
            border-radius: 3px;
        }

        input,
        textarea, 
        select{
            letter-spacing: 1px;
            border-radius: 1px;
        }

        .modal-header {
            padding: 15px 20px 5px 20px;

            .modal-title {
                font-weight: 600;
            }
        }

        .modal-body {
            scrollbar-width: thin;
            scrollbar-color: #888 #f1f1f1;
            padding: 15px 20px 15px 20px;

            .modal-body::-webkit-scrollbar {
                width: 8px;
            }

            .modal-body::-webkit-scrollbar-thumb {
                background-color: #888;
                border-radius: 10px;
            }

            .modal-body::-webkit-scrollbar-track {
                background-color: #f1f1f1;
            }
        }

        .modal-footer {
            padding: 5px 20px 15px 20px;

            button {
                font-family: "Poppins", sans-serif;
                font-weight: 300;
                letter-spacing: 2px;
                border-radius: 3px;
            }
        }
    }

    /* Card Dashboard Portion */
    .card {
        font-family: "Poppins", sans-serif;
        letter-spacing: 1px;
        background-color: #ffffff;
        border: 1px solid rgb(215, 215, 215);
        border-radius: 1px;
        padding: 1rem;
        text-align: center;

        .card-icon {
            font-size: 1.3rem;
        }

        h5 {
            font-size: 20px;
            font-weight: 600;
        }

        .task-bar {
            display: flex;
            height: 16px;
            border-radius: 8px;
            overflow: hidden;
            margin: 10px 0;

            .task-status {
                height: 100%;
                display: inline-block;
            }

            .task-status.pending {
                background-color: #e74c3c;
            }

            .task-status.completed {
                background-color: #2ecc71;
            }
        }

        .task-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 8px;

            label {
                font-size: 14px;
                font-weight: 500;
            }

            .pending {
                color: #e74c3c;
            }

            .completed {
                color: #2ecc71;
            }
        }
    }
</style>