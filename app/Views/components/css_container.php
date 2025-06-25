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
        padding: 0rem 2rem 0rem 1.5rem;
        position: sticky;
        box-shadow: 0px 1px 5px #00000047;
        top: 0;
        z-index: 11;

        .header-container {
            display: grid;
            grid-template-columns: 2.5rem 1fr auto;
            align-items: center;
            width: 100%;

            .header-icon-div {
                cursor: pointer;
                display: flex;
                align-items: center;

                #menu-icon {
                    color: #1f2328;

                    &:hover {
                        color: #FF5733;
                    }
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

            .header-dropdown-div {
                position: relative;
                display: flex;
                align-items: center;
                cursor: pointer;
                margin-left: auto;

                #usernameToggle {
                    cursor: pointer;
                    color: #1f2328;
                    font-size: 24px;
                    text-align: right;

                    &:hover {
                        color: #FF5733;
                    }
                }

                .dropdownOptions {
                    display: none;
                    position: absolute;
                    right: 0;
                    top: 100%;
                    transform: translateY(5%);
                    background-color: #ffffff;
                    border: 1px solid rgb(215, 215, 215);
                    box-shadow: 0px 1px 5px #00000047;
                    padding: 0;
                    width: max-content;

                    #userSettings {
                        color: #1f2328;
                        font-size: 13px;
                        font-weight: 500;
                        letter-spacing: .5px;
                        border-bottom: 1.5px solid rgb(215, 215, 215);
                        padding: 1rem 1.5rem;
                        width: 100%;

                        i {
                            margin-right: 15px;
                        }
                    }

                    a {
                        color: #1f2328;
                        font-size: 13px;
                        font-weight: 500;
                        letter-spacing: .5px;
                        text-decoration: none;
                        padding: 1rem 1.5rem;
                        display: flex;
                        justify-content: flex-start;
                        align-items: center;

                        &:hover {
                            border: 1px solid #FF5733;
                            color: #FF5733;
                        }

                        &:active {
                            font-size: 13px;
                            color: #FF5733;
                        }

                        i {
                            margin-right: 15px;
                        }
                    }
                }
            }
        }
    }

    /* Sidebar Portion */
    .page-sidebar {
        font-family: "Poppins", sans-serif;
        grid-area: sidebar;
        background-color: #ffffff;
        border-right: 1px solid rgb(215, 215, 215);
        padding: 2rem 0rem;

        .menu-list {
            padding: 0;

            .menu-item {
                font-size: 13px;
                font-weight: 500;
                letter-spacing: .5px;
                position: relative;

                a {     
                    text-decoration: none;
                    color: #1f2328;
                    padding: 1rem 1.5rem 1rem 1.5rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;

                    i:first-child {
                        margin-right: 15px;
                    }

                    i:last-child {
                        margin-left: auto;
                    }

                    &:hover {
                        /* background-color: #d5d8dc;*/
                        border: 1px solid #FF5733;
                        color: #FF5733;
                    }

                    &:active {
                        font-size: 12px;
                        color: #FF5733;
                    }
                }

                .menu-toggle-icon {
                    font-size: 13px;
                    transition: transform 0.3s ease;
                }
            }

            .child-menu {
                padding: 0;
                display: none; 
                background-color: #f5f5f5;

                a {
                    display: block;
                    text-decoration: none;
                    color: #1f2328;
                    padding: 1rem 1rem 1rem 3rem;

                    i:first-child {
                        margin-right: 15px;
                    }

                    &:hover {
                        /* background-color: #d5d8dc; */
                        border: 1px solid #FF5733;
                        color: #FF5733;
                    }

                    &:active {
                        font-size: 12px;
                        color: #FF5733;
                    }
                }
            }
        }

        .menu-logout {
            padding: 0;
            
            .menu-item {
                font-size: 13px;
                font-weight: 500;
                letter-spacing: .5px;
                position: relative;

                a {     
                    text-decoration: none;
                    color: #1f2328;
                    padding: 1rem 1.5rem 1rem 1.5rem;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;

                    i:first-child {
                        margin-right: 15px;
                    }

                    i:last-child {
                        margin-left: auto;
                    }

                    &:hover {
                        border: 1px solid #FF5733;
                        color: #FF5733;
                    }

                    &:active {
                        font-size: 12px;
                        color: #FF5733;
                    }
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
                height: 7vh;
                
                h3 {
                    color: #1f2328; 
                    font-family: "Poppins", sans-serif;
                    font-size: 20px;
                    font-weight: 500;
                    letter-spacing: 1px;
                    text-decoration: none; 
                    padding: 0px;
                    margin: 0px;
                }

                button {
                    background-color: #ff5733;
                    color: #ffffff;
                    font-size: 14px;
                    letter-spacing: .5px;
                    border-radius: 0px;
                    border: 1px solid #dee2e6;
                    padding: 10px 40px;
                    margin: 0px;
                   
                    &:focus {
                        background-color: #fa4721;
                        color: #fff;
                        cursor: pointer;
                    }

                    &:active {
                        background-color: #ff5733;
                        border: 0px solid #ffffff;
                        transform: translateY(2px);
                    }
                }
            }

            .content-body {
                table {
                    th {
                        background-color: #ff522d;
                        color: #ffffff;
                        font-size: 13px;
                        font-weight: 500;
                        letter-spacing: 1px;
                    }

                    td {
                        background-color: #ffffff;
                        color: #1f2328;
                        font-size: 13px;
                        font-weight: 400;
                        letter-spacing: 0.5px;

                        button:hover {
                            border: 1px solid ffffff;
                            color: #ff522d;
                        }

                        button:active {
                            color: #ffffff;
                            font-size: 0.8rem;
                        }
                    }

                    button {
                        &:focus {
                            box-shadow: none;
                            border-color: none;
                            outline: none;
                        }

                        &:active {
                            box-shadow: none;
                            border-color: none;
                            outline: none;
                        }
                    }
                }

                .dt-layout-row {
                    letter-spacing: .5px;

                    .dt-input {
                        box-shadow: 0px 0px 1px rgba(112, 112, 112, 0.8);
                        color: #1f2328;
                        font-size: 13px;
                        letter-spacing: .5px;
                        border-radius: 0px;
                        border: 1px solid #dee2e6;
                        padding: 10px 15px;

                        &::placeholder {
                            font-size: 13px;
                            letter-spacing: .5px;
                            text-shadow: 0px 0px 3px rgba(112, 112, 112, 0.8);
                            color: #8c8f92;
                        }

                        &:focus {
                            border-color: #ff522d;
                            font-size: 13px;
                            letter-spacing: .5px;
                            color: #1f2328;
                            outline: none;
                        }
                    }

                    label{
                        margin-right: 0.5rem;
                        font-weight: 500;
                        font-size: 13px;
                        letter-spacing: 0.5px;
                    }

                    input {
                        margin-bottom: 10px;
                        border: 1px solid #ffffff;
                        border-radius: 3px;
                    }

                    .dt-info {
                        font-weight: 500;
                        font-size: 13px;
                        letter-spacing: 0.5px;
                    }

                    .dt-paging {
                        font-weight: 500;
                        font-size: 13px;
                        letter-spacing: 0.5px;
                    }
                }

                canvas {
                    font-family: "Poppins", sans-serif; 
                    letter-spacing: 0.5px;
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
        letter-spacing: .5px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);

        .modal-content {
            border-radius: 3px;
        }

        .modal-header {
            padding: 15px 20px 5px 20px;
            display: flex;
            justify-content: space-between; 
            align-items: center;

            .modal-title {
                color: #1f2328; 
                font-family: "Poppins", sans-serif;
                font-size: 20px;
                font-weight: 500;
                letter-spacing: 1px;
                text-decoration: none; 
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

            label {
                font-size: 13px;
                font-weight: 500;
                letter-spacing: .5px;
                margin: 0px 0px 5px 0px;
            }

            input {
                color: #1f2328;
                font-size: 13px;
                letter-spacing: .5px;
                border-radius: 0px;
                border: 1px solid #dee2e6;
                box-shadow: 0px 0px 3px rgba(23, 32, 42, 0.3);
                padding: 20px 15px;

                &::placeholder {
                    font-size: 13px;
                    letter-spacing: .5px;
                    text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                    color: #8c8f92;
                }

                &:focus {
                    border-color: #ff522d;
                    font-size: 13px;
                    letter-spacing: .5px;
                    color: #1f2328;
                    outline: none;
                }
            }

            textarea {
                color: #1f2328;
                font-size: 13px;
                letter-spacing: .5px;
                border-radius: 0px;
                border: 1px solid #dee2e6;
                box-shadow: 0px 0px 3px rgba(23, 32, 42, 0.3);
                padding: 10px 15px;

                &::placeholder {
                    font-size: 13px;
                    letter-spacing: .5px;
                    text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                    color: #8c8f92;
                }

                &:focus {
                    border-color: #ff522d;
                    font-size: 13px;
                    letter-spacing: .5px;
                    color: #1f2328;
                    outline: none;
                    box-shadow: 0px 0px 3px #ff522d;
                }
            }

            select {
                color: #1f2328;
                font-size: 13px;
                letter-spacing: .5px;
                border-radius: 0px;
                border: 1px solid #dee2e6;
                box-shadow: 0px 0px 3px rgba(23, 32, 42, 0.5);
                padding: 10px 15px;
                height: 42px;

                &::placeholder {
                    font-size: 13px;
                    letter-spacing: .5px;
                    text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                    color: #8c8f92;
                }

                &:focus {
                    border-color: #ff522d;
                    box-shadow: 0px 0px 3px #ff522d;
                    font-size: 13px;
                    letter-spacing: .5px;
                    color: #1f2328;
                    outline: none;
                }
            }

            #taskDocument {
                display: none;
            }

            .custom-file-upload {
                display: inline-block;
                background-color: #ff522d; 
                color: #fff;  
                padding: 10px 20px;
                font-size: 14px;
                border-radius: 4px;
                cursor: pointer;
                text-align: center;
                font-weight: bold;

                &:hover {
                    background-color: #e04d23; 
                }

                &:active {
                    box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.2);
                    transform: translateY(2px);
                }
            }

            .input-correct {
                border-color: #2ecc71 !important;
                font-size: 13px;
                letter-spacing: .5px;
                color: #1f2328;
                outline: none;
                box-shadow: 0px 0px 3px rgba(23, 32, 42, 0.8);
            }

            .input-error {
                border-color: #e74c3c !important;
                font-size: 13px;
                letter-spacing: .5px;
                color: #1f2328;
                outline: none;
                box-shadow: 0px 0px 3px rgba(23, 32, 42, 0.8);
            }

            button {
                color: #ffffff;
                font-size: 13px;
                letter-spacing: .5px;
                border-radius: 0px;
                border: 1px solid #dee2e6;
                padding: 10px 10px;
                margin: 0px;
            }

            .password-div {
                margin-bottom: 16px;
                padding: 0px;
                position: relative;

                .toggle-password {
                    position: absolute;
                    right: 10px;
                    top: 33%;
                    transform: translateY(15%);
                    background: none;
                    border: none;
                    cursor: pointer;
                    font-size: 13px;
                    color: #8c8f92;
                }
            }
        }

        .modal-footer {
            padding: 5px 20px 15px 20px;
            gap: 8px;

            button {
                color: #ffffff;
                font-size: 13px;
                letter-spacing: .5px;
                border-radius: 0px;
                border: 1px solid #dee2e6;
                padding: 10px 40px;
                margin: 0px;
            }

            .danger {
                background-color: #ffffff;
                border: 1px solid #ff522d;
                color: #ff522d;
                font-size: 13px;
                font-weight: 500;
                letter-spacing: 0.5px;

                &:hover {
                    background-color: #fde0d9;
                    border: 1px solid #ff522d;
                    color: #ff522d;
                }

                &:active {
                    border: 1px solid #ff5733;
                    transform: translateY(2px);
                }
            }

            .success {
                background-color: #ff522d;
                border: 1px solid #ff522d;
                color: #ffffff;
                font-size: 13px;
                font-weight: 400;
                letter-spacing: 0.5px;
                
                &:hover {
                    background-color: #ff5733;
                    border: 1px solid #ff5733;
                    color: #ffffff;
                    cursor: pointer;
                }

                &:active {
                    background-color: #ff522d;
                    border: 1px solid #ff522d;
                    transform: translateY(2px);
                }
            }
        }
    }
</style>