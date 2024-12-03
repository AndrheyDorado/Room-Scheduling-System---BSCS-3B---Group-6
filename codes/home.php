<?php include 'db_connect.php' ?>
<style>
    /* General Body Styling */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f6f9;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container-fluid {
        margin-top: 20px;
    }

    /* Card Styling */
    .card {
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        background: linear-gradient(145deg, #ffffff, #f1f1f1);
        border: none;
    }

    .card-header {
        background-color: #007bff;
        color: #fff;
        padding: 15px;
        font-size: 1.2rem;
        border-radius: 15px 15px 0 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
    }

    .card-body {
        padding: 30px;
    }

    /* Welcome Section */
    .welcome-msg {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
        text-align: center;
    }

    /* Custom Button */
    .btn-custom {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
        background-color: #0056b3;
    }

    /* Floating Icon Styling */
    span.float-right.summary_icon {
        font-size: 3rem;
        position: absolute;
        right: 1rem;
        color: #ffffff96;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    span.float-right.summary_icon:hover {
        color: #ffffff;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .card-body {
            padding: 20px;
        }
        .card-header {
            font-size: 1rem;
        }
        .welcome-msg {
            font-size: 1.2rem;
        }
    }
</style>

<div class="container-fluid">
    <div class="row mt-3 ml-3 mr-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <span class="float-right summary_icon">
                        <i class="fas fa-user-circle"></i>
                    </span>
                    <span class="card-title">Welcome Back!</span>
                </div>
                <div class="card-body">
                    <!-- Welcome Message -->
                    <div class="welcome-msg">
                        <?php echo "Welcome back, " . $_SESSION['login_name'] . "!"; ?>
                    </div>
                    <hr>
                    <!-- Removed tracking ID section and carousel -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // If you no longer need any JavaScript for tracking functionality, 
    // we can remove the tracking related scripts entirely.
</script>
