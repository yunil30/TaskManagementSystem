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

<style>
    * {
        transition: background-color 300ms ease, color 300ms ease;
    }

    *:focus {
        background-color: rgba(221, 72, 20, .2);
        outline: none;
    }

    body{
        font-family: "Poppins", sans-serif;
        font-weight: 500;
        margin: 0;
        height: 100vh;
        display: grid;
        grid-template-columns: 14rem 1fr;
        grid-template-rows: 3.5rem 1fr auto;
        grid-template-areas: 
            "header header"
            "main main"
            "footer footer";
        transition: all 1s ease;
        padding-right: 0 !important;
    }

    /* .page-header {
        grid-area: header;
        background-color: rgba(247, 248, 249, 1);
        position: sticky;
        top: 0;
        z-index: 1000;
        padding: .4rem 0 0;
    } */

    header {
        grid-area: header;
        background-color: rgba(247, 248, 249, 1);
        padding: .4rem 0 0;

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

                .menu-item a {
                    border-radius: 5px;
                    margin: 5px 0;
                    height: 38px;
                    line-height: 36px;
                    padding: .4rem .65rem;
                    text-align: center;
                }

                .menu-item a:hover,
                .menu-item a:focus {
                    background-color: rgba(221, 72, 20, .2);
                    color: rgba(221, 72, 20, 1);
                }
            }

            .logo {
                float: left;
                height: 44px;
                padding: 0rem;
            }

            .menu-toggle {
                display: none;
                float: right;
                font-size: 2rem;
                font-weight: bold;
            }

            .menu-toggle button {
                background-color: rgba(221, 72, 20, .6);
                border: none;
                border-radius: 3px;
                color: rgba(255, 255, 255, 1);
                cursor: pointer;
                font: inherit;
                font-size: 1.3rem;
                height: 36px;
                padding: 0;
                margin: 11px 0;
                overflow: visible;
                width: 40px;
            }

            .menu-toggle button:hover,
            .menu-toggle button:focus {
                background-color: rgba(221, 72, 20, .8);
                color: rgba(255, 255, 255, .8);
            }
        }

        /* header 

        header 

        header li

        header li

        header li
        header li
        header 

        header 

        header 

        header .menu-toggle button:hover,
        header .menu-toggle button:focus {
            background-color: rgba(221, 72, 20, .8);
            color: rgba(255, 255, 255, .8);
        } */
    }

    .page-main {
        grid-area: main;
        background-color:rgb(212, 109, 109);
    }

    .page-footer {
        grid-area: footer;
        background-color: rgba(62, 62, 62, 1);
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

    @media (max-width: 629px) {
        header ul {
            padding: 0;
        }

        header .menu-toggle {
            padding: 0 1rem;
        }

        header .menu-item {
            background-color: rgba(244, 245, 246, 1);
            border-top: 1px solid rgba(242, 242, 242, 1);
            margin: 0 15px;
            width: calc(100% - 30px);
        }

        header .menu-toggle {
            display: block;
        }

        header .hidden {
            display: none;
        }

        header li.menu-item a {
            background-color: rgba(221, 72, 20, .1);
        }

        header li.menu-item a:hover,
        header li.menu-item a:focus {
            background-color: rgba(221, 72, 20, .7);
            color: rgba(255, 255, 255, .8);
        }
    }
</style>