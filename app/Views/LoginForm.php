<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskMaker</title>
</head>
<!-- This is the header section -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<!-- Add SweetAlert2 CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Add jQuery and DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

<style>
    body {
        background-color: #f3f3f3;
        font-family: "Poppins", sans-serif;
        font-weight: 500;
        letter-spacing: 1px;
        color: #1f2328;
    }

    input {
        width: 100%;
        margin-bottom: 10px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    label {
        display: block;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    form {
        background-color: #ffffff;
        border-radius: 5px;
        box-shadow: 0px 0px 3px #00000047;
        border: 1px solid rgb(215, 215, 215);
        width: 450px;
        height: 420px; 
        padding: 30px;
        border-radius: 0px;
    }

    #card-logo {
        width: 100%;
        margin-bottom: 1rem;
        display: flex;
        justify-content: center;
        align-items: center;

        a {
            font-family: "Poppins", sans-serif;
            font-size: 24px;
            font-weight: 500;
            letter-spacing: 1px;
            text-decoration: none; 
            color: inherit; 

            span {
                font-weight: 600;
            }

            i {
                font-size: 28px; 
                font-weight: 500;
                padding-bottom: 0.5 rem;
            }

        }

        a:hover {
            text-decoration: none; 
            color: inherit;   
        }
    }

    #div-label {
        width: 100%;
        margin-bottom: 1rem;
    }

    #div-label h4{
        letter-spacing: 0.1rem;
        font-size: 20px;
    }

    #div-username {
        width: 100%;
        margin-bottom: 1rem;
    }

    #div-username label{
        letter-spacing: 0.1rem;
        font-size: 15px;
    }

    #div-password {
        width: 100%;
        margin-bottom: 1rem;
    }

    #div-password label{
        letter-spacing: 0.1rem;
        font-size: 15px;
    }

    #div-button {
        width: 100%;
        margin-bottom: 1rem;
        display: flex;
        justify-content: center;
    }

    #username {
        border-radius: 5px;
        letter-spacing: 0.1rem;
        font-size: 15px;
        color: #1f2328;
        margin-bottom: 0;
    }

    #username:hover,
    #username:focus{
        border: 0.1rem solid #e74c3c;
        border-color: #1f2328;
        letter-spacing: 0.1rem;
        color: #1f2328;
        outline: none;
        box-shadow: 0px 0px 3px rgba(23, 32, 42, 0.8);
    }

    #password {
        border-radius: 5px;
        letter-spacing: 0.1rem;
        font-size: 15px;
        color: #1f2328;
        margin-bottom: 0;
    }

    #password:hover,
    #password:focus {
        border: 0.1rem solid #e74c3c;
        border-color: #1f2328;
        letter-spacing: 0.1rem;
        color: #1f2328;
        outline: none;
        box-shadow: 0px 0px 3px rgba(23, 32, 42, 0.8);
    }

    #BtnLogInUser {
        background-color: #1f2328;
        border: none;
        border-radius: 5px;
        letter-spacing: 0.1rem;
        font-size: 15px;
        color: #d5d8dc;
        width: 50%;
        padding: .8rem;
        transition: all 0.3s ease;

        &:hover {
            background-color: #34495e;
            color: #fff;
            cursor: pointer;
        }

        &:active {
            background-color: #1c2833;
            transform: translateY(2px);
        }
    }

    .swal-title {
        font-size: 24px; 
        font-weight: bold; 
        color: #333; 
    }

    .swal-text {
        font-size: 18px; 
        font-weight: normal; 
        color: #555; 
    }
</style>

<body>
    <div class="container">
        <form action="" class="loginForm" id="loginForm" method="POST">
            <div id="card-logo">
                <a href="http://localhost:8030/"><i class="fas fa-edit"></i>Task<span>MAKER</span></a>
            </div>
            <div id="div-label">
                <h4>Login</h4>
            </div>
            <div id="div-username">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" autocomplete="username">
            </div>
            <div id="div-password">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" autocomplete="current-password">
            </div>
            <div id="div-button">
                <button id="BtnLogInUser">Login</button>
            </div>
        </form>
    </div>
</body>
<?= js_container() ?>
</html>
<script>
    var host_url = '<?php echo host_url(); ?>';

    $('#BtnLogInUser').click(function(event) {
        event.preventDefault();

        var data = {
            UserName: $('#username').val(),
            PassWord: $('#password').val()
        }

        axios.post(host_url + 'Login/Authenticate', data)
        .then((res) => {
            Swal.fire({
                icon: 'success',
                title: 'Successful!',
                text: 'You have logged in successfully.',
                customClass: {
                    title: 'swal-title',
                    text: 'swal-text'
                },
                showConfirmButton: false,
                timer: 1000
            }).then(() => {
                window.location.href = host_url + 'Home/index';
            });
        })
        .catch((error) => {
            Swal.fire({
                icon: 'error',
                title: 'Failed!',
                text: error.response?.data?.error || 'An error occurred during login. Please try again.',
                customClass: {
                    title: 'swal-title',
                    text: 'swal-text'
                },
                showConfirmButton: false,
                timer: 1000
            });
        });
    });
</script>