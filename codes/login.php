<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
ob_end_flush();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Scheduling System</title>

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");
?>

</head>

<style>
    /* General Body Styling */
    body {
        width: 100%;
        height: 100%;
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f6f9;
    }

    main#main {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* Left Section */
    #login-left {
        position: absolute;
        left: 0;
        width: 60%;
        height: 100%;
        background: #59b6ec61;
        display: flex;
        align-items: center;
        justify-content: center;
        background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>);
        background-repeat: no-repeat;
        background-size: cover;
        box-shadow: inset 0 0 0 10000px rgba(0, 0, 0, 0.6);
    }

    /* Right Section */
    #login-right {
        position: absolute;
        right: 0;
        width: 40%;
        height: 100%;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Card Styling */
    .card {
        width: 80%;
        max-width: 400px;
        padding: 2em;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 1.5em;
    }

    .card-header {
        background-color: #007bff;
        color: #ffffff;
        text-align: center;
        font-size: 1.5rem;
        padding: 1em;
        border-radius: 8px 8px 0 0;
        font-weight: 600;
    }

    .form-group {
        margin-bottom: 1.5em;
    }

    label {
        font-size: 1rem;
        color: #333;
        font-weight: 500;
    }

    input[type="text"], input[type="password"] {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-top: 5px;
        font-size: 1rem;
        color: #333;
        transition: all 0.3s ease;
    }

    input[type="text"]:focus, input[type="password"]:focus {
        border-color: #007bff;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
        outline: none;
    }

    /* Submit Button */
    .btn-primary {
        width: 100%;
        padding: 12px;
        background-color: #007bff;
        border: none;
        color: white;
        font-size: 1.1rem;
        font-weight: bold;
        border-radius: 8px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Alert */
    .alert-danger {
        color: #d9534f;
        background-color: #f2dede;
        border-color: #ebccd1;
        padding: 10px;
        border-radius: 5px;
        margin-top: 10px;
    }

    /* Logo */
    .logo {
        margin: auto;
        font-size: 6rem;
        background: white;
        padding: 1.2em;
        border-radius: 50%;
        color: #007bff;
        z-index: 10;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        #login-left {
            width: 100%;
            height: 50%;
        }

        #login-right {
            width: 100%;
            height: 50%;
        }

        .card {
            width: 90%;
            max-width: 350px;
        }
    }

</style>

<body>
  <main id="main" class="bg-dark">
    <!-- Left Section with Background Image -->
    <div id="login-left">
    </div>

    <!-- Right Section with Login Form -->
    <div id="login-right">
        <div class="card">
            <div class="card-header">
                <div class="logo">
                    <i class="fas fa-school"></i>
                </div>
                School Login
            </div>
            <div class="card-body">
                <form id="login-form">
                    <div class="form-group">
                        <label for="username" class="control-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                    <center>
                        <button type="submit" class="btn-primary">Login</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <script>
    // Handle login form submission
    $('#login-form').submit(function(e) {
        e.preventDefault();
        $('#login-form button[type="submit"]').attr('disabled', true).html('Logging in...');
        if ($(this).find('.alert-danger').length > 0)
            $(this).find('.alert-danger').remove();
        
        $.ajax({
            url: 'ajax.php?action=login',
            method: 'POST',
            data: $(this).serialize(),
            error: err => {
                console.log(err);
                $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
            },
            success: function(resp) {
                if (resp == 1) {
                    location.href = 'index.php?page=home';
                } else {
                    $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>');
                    $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
                }
            }
        });
    });
  </script>
</body>
</html>
