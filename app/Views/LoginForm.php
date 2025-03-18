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
        background-color: #e6e6e6;
        position: relative;
        height: 100vh;
        padding: 0px;
        margin: 0px;

        form {
            background-color: #ffffff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0px 0px 5px #00000015;
            border: 1px solid #00000035;
            width: 480px;

            .form-header {
                padding: 2rem 2rem 0rem 2rem;
                display: flex;
                justify-content: center;
                align-items: center;

                h5 {
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
                        font-weight: 500;
                        padding-bottom: 0.5rem;
                    }

                    span {
                        color: #FF5733; 
                        font-weight: 500;
                    }
                }
            }

            .form-body {
                padding: 2rem;
                
                h4 {
                    text-decoration: none;
                    color: #1f2328;
                    font-size: 18px;
                    font-weight: 500;
                    letter-spacing: 0.5px;
                }

                #BtnLogInUser {
                    background-color: #ff522d;
                    color: #ffffff;
                    font-size: 14.4px;
                    letter-spacing: 0.5px;
                    border-radius: 0px;
                    border: 1px solid #dee2e6;
                    width: 100%;
                    padding: 10px 40px;
                    margin: 0px;

                    &:hover {
                        background-color: #ff522d;
                        color: #fff;
                        cursor: pointer;
                    }

                    &:active {
                        background-color: #ff5733;
                        transform: translateY(2px);
                    }

                    &:disabled {
                        background-color: #8c8f92;
                        cursor: not-allowed;
                        border: 1px solid #dee2e6;
                    }
                }

                .form-group {
                    margin-bottom: 15px;
                    padding: 0px;
                    position: relative;

                    .input-icon {
                        position: absolute;
                        top: 59%;
                        left: 13px;
                        font-size: 15px;
                        color: #8c8f92;
                    }

                    label {
                        font-size: 14.4px;
                        letter-spacing: 0.5px;
                        text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                        margin-bottom: 5px;
                    }

                    a {
                        text-decoration-line: none;
                        color: #ff5733;
                        font-size: 14.4px;
                        letter-spacing: 0.5px;
                        text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                        margin-bottom: 5px;

                        &:hover {
                            text-decoration-line: underline;
                            color: #fa4721;
                            font-size: 14.4px;
                            letter-spacing: 0.5px;
                            text-shadow: 0px 0px 1px rgba(23, 32, 42, 0.8);
                            margin-bottom: 5px;
                        }
                    }

                    input {
                        background-color: #ffffff;
                        color: #1f2328;
                        font-size: 14.4px;
                        letter-spacing: 0.5px;
                        border-radius: 0px;
                        box-shadow: 0px 0px 15px #00000020;
                        border: 1px solid #00000035;
                        padding: 20px 40px;

                        &::placeholder {
                            font-size: 14.4px;
                            letter-spacing: 0.5px;
                            color: #8c8f92;
                        }

                        &:focus {
                            font-size: 14.4px;
                            letter-spacing: 0.5px;
                            color: #1f2328;
                            outline: none;
                            box-shadow: 0px 0px 3px rgba(255, 87, 51, 0.8);
                            border-color: #ff5733;
                        }
                    }

                    .toggle-password {
                        position: absolute;
                        right: 10px;
                        top: 50%;
                        transform: translateY(15%);
                        background: none;
                        border: none;
                        cursor: pointer;
                        font-size: 14.4px;
                        color: #8c8f92;
                    }
                }
            }
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
    <form action="" class="loginForm" id="loginForm" method="POST">
        <div class="form-header">
            <h5><i class="fas fa-edit"></i>Task<span>MAKER</span></h5>
        </div>
        <div class="form-body">
            <h4>Login</h4>

            <div class="form-group">
                <i class="fas fa-envelope input-icon"></i>
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
            </div>
        
            <div class="form-group">
                <i class="fas fa-lock input-icon"></i>
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                    <i class="fa-solid fa-eye"></i>
                </button>
            </div>

            <div class="form-group" style="text-align: end;" >
                <a href="">Forgot password?</a>
            </div>

            <div class="form-group">
                <button id="BtnLogInUser">Login</button>
            </div>

            <div class="form-group" style="text-align: center;" >
                <label for="">Don't have an account? <a href="">Register now</a></label>
            </div>
        </div>
    </form>
</body>
<?= js_container() ?>
</html>
<script>
    var host_url = '<?php echo host_url(); ?>';

    function togglePassword() {
        const $passwordField = $("#password");
        const $toggleButton = $(".toggle-password i");

        if ($passwordField.attr("type") === "password") {
            $passwordField.attr("type", "text");
            $toggleButton.removeClass("fa-eye").addClass("fa-eye-slash");
        } else {
            $passwordField.attr("type", "password");
            $toggleButton.removeClass("fa-eye-slash").addClass("fa-eye");
        }
    }

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