
<?php
$title = "Register - Resume Builder";
require './assets/includes/header.php';
$fn->nonAuthPage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Resume Builder</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body class="bg-light">
    <div class="theme-toggle" id="themeToggle">
        <i class="bi bi-moon-fill"></i>
    </div>

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-5">
                <div class="card shadow animate-fadeInUp">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <img src="assets/images/logo.png" alt="Resume Builder" class="mb-3" style="width: 80px;">
                            <h2 class="animate-slideIn">Create Account</h2>
                            <p class="text-muted">Build your professional resume today</p>
                        </div>

                        <?php if(isset($_GET['error'])): ?>
                        <div class="alert alert-danger animate-fadeInUp" role="alert">
                            <?=$_GET['error']?>
                        </div>
                        <?php endif; ?>

                        <form action="actions/register.action.php" method="post">
                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                                    <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email_id" class="form-control" placeholder="Email address" required>
                                </div>
                            </div>

                            <div class="mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                            </div>

                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Create Account <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>

                            <div class="text-center">
                                <span class="text-muted">Already have an account?</span>
                                <a href="login.php" class="text-decoration-none ms-1">Login here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/main.js"></script>
</body>
</html>

<?php
require './assets/includes/footer.php';
?>