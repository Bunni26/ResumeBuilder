
<?php
$title = "Login - Resume Builder";
require './assets/includes/header.php';
$fn->nonAuthPage();
?>

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card shadow animate-fadeInUp">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <img src="assets/images/logo.png" alt="Resume Builder" class="mb-3" style="width: 80px;">
                        <h2 class="animate-slideIn">Welcome Back!</h2>
                        <p class="text-muted">Login to your account</p>
                    </div>

                    <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger animate-fadeInUp" role="alert">
                        <?=$_GET['error']?>
                    </div>
                    <?php endif; ?>

                    <form action="actions/login.action.php" method="post">
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
                                Login <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>

                        <div class="text-center">
                            <a href="forgot-password.php" class="text-decoration-none">Forgot Password?</a>
                            <div class="mt-2">
                                <span class="text-muted">Don't have an account?</span>
                                <a href="register.php" class="text-decoration-none ms-1">Register here</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require './assets/includes/footer.php'; ?>