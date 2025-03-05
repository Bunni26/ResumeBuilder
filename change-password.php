<?php
$title = "Change Password - Resume Builder";
require './assets/includes/header.php';
$fn->nonAuthPage();

// Verify that user has completed OTP verification
if (!isset($_SESSION['otp_verified']) || !$_SESSION['otp_verified']) {
    $fn->redirect('forgot-password.php');
}
?>

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card shadow animate-fadeInUp">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <img src="assets/images/logo.png" alt="Resume Builder" class="mb-3" style="width: 80px;">
                        <h2 class="animate-slideIn">Create New Password</h2>
                        <p class="text-muted">Choose a strong password for your account</p>
                    </div>

                    <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger animate-fadeInUp" role="alert">
                        <?=$_GET['error']?>
                    </div>
                    <?php endif; ?>

                    <form action="actions/changepassword.action.php" method="post" id="passwordForm">
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" id="password" class="form-control" 
                                       placeholder="New password" required minlength="8">
                            </div>
                            <div class="form-text">Password must be at least 8 characters long</div>
                        </div>

                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" name="confirm_password" id="confirm_password" 
                                       class="form-control" placeholder="Confirm new password" required>
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Update Password <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('passwordForm').addEventListener('submit', function(e) {
    var password = document.getElementById('password').value;
    var confirm = document.getElementById('confirm_password').value;
    
    if (password !== confirm) {
        e.preventDefault();
        alert('Passwords do not match!');
    }
});
</script>

<?php require './assets/includes/footer.php'; ?>