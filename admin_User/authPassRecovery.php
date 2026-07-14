<?php
require '../conection.php';
error_reporting(1);
unset($_SESSION['passTokenSet']);
$randToken = rand(1111, 9999).time().date('s');
$_SESSION['passTokenSet'] = md5($randToken);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="description" content="Digital Kamety || Forget Password">
    <title>Digital Kamety || Forget Password</title>
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">

    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <!-- Your Custom CSS -->
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto&display=swap");
        body {
            font-family: serif;
            background-color: white;
            color: #004040;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0a0a0;
            pointer-events: none;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon input {
            padding-left: 2.5rem;
        }

        .btn-custom {
            background-color: #004040;
            color: white;
            font-weight: 600;
        }

        .btn-custom:hover,
        .btn-custom:focus {
            background-color: #003333;
            color: white;
        }

        .second-header {
            font-family: Lato, sans-serif;
            font-size: 3.4rem;
            font-weight: 900;
            color: #044144;
        }

        .first-header {
            font-family: PTSerif, serif;
            font-size: 1.1rem;
            color: #044144;
        }

        .bg-gradient-teal {
            background: linear-gradient(90deg, #064141 0%, #2bbba1 100%);
        }

        @media (max-width: 768px) {
            .second-header {
                font-size: 2rem;
                text-align: center;
            }

            .first-header {
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <div class="row g-0 vh-100">
        <!-- Left Side -->
        <div class="col-12 col-md-6 d-flex flex-column justify-content-center px-4 py-4">
            <div class="d-flex d-md-none justify-content-center mb-3">
                <img src="assets/images/logo.png" alt="Logo" style="max-width: 150px;">
            </div>

            <main class="container" style="max-width: 700px;">
                <p class="mb-2 fs-6 first-header">No worries. We’ll get you back in.</p>
                <h1 class="fw-bold mb-4 second-header">Forgot Password</h1>

                <form method="post" action="con-login">
                    <div class="mb-3 input-with-icon">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" class="form-control" id="inputUserId" name="inputUserId" placeholder="Enter User ID" required value="<?php if (isset($_COOKIE['memberUserId'])) {
                            echo $_COOKIE['memberUserId'];
                        } ?>" />
                    </div>

                    <div class="mb-3 input-with-icon">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" class="form-control" id="inputEmailId" name="inputEmailId" placeholder="Enter Registered Email ID" required />
                    </div>

                    <button type="button" class="btn btn-custom w-100 py-2" id="passSubmit" onclick="forgotPassValidate('<?php echo $_SESSION['passTokenSet']; ?>')">
                         Reset 
                    </button>
                </form>

                <p class="text-center mt-4">
                    Remembered it? <a href="LoginAuth.php">Back to Login</a>
                </p>
            </main>
        </div>

        <!-- Right Side -->
        <div class="d-none d-md-flex col-md-6 rightside flex-column align-items-center justify-content-center px-4 py-4 bg-gradient-teal text-white">
            <img src="assets/images/logo.png" alt="Company Logo" class="img-fluid" style="max-width: 300px;" />
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="custom.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
