<?php
$title = "Verify OTP - Resume Builder";
require './assets/includes/header.php';
$fn->nonAuthPage();

// Check if OTP session exists and hasn't expired
if (!isset($_SESSION['otp']) || !isset($_SESSION['reset_time'])) {
    $fn->redirect('forgot-password.php');
}

// Check if OTP has expired (10 minutes)
if (time() - $_SESSION['reset_time'] > 600) {
    unset($_SESSION['otp']);
    unset($_SESSION['email']);
    unset($_SESSION['reset_time']);
    $fn->setError('Verification code has expired. Please request a new one.');
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
                        <h2 class="animate-slideIn">Verify Your Email</h2>
                        <p class="text-muted">Enter the verification code sent to<br><strong><?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?></strong></p>
                    </div>

                    <?php if(isset($_GET['error'])): ?>
                    <div class="alert alert-danger animate-fadeInUp" role="alert">
                        <?=$_GET['error']?>
                    </div>
                    <?php endif; ?>

                    <form action="actions/verifyotp.action.php" method="post">
                        <div class="mb-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                <input type="text" name="otp" class="form-control" placeholder="Enter 6-digit code" 
                                       required pattern="[0-9]{6}" maxlength="6"
                                       oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                            <div class="form-text text-center">
                                Code expires in <span id="timer">10:00</span>
                            </div>
                        </div>

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                Verify Code <i class="bi bi-arrow-right ms-2"></i>
                            </button>
                        </div>

                        <div class="text-center">
                            <span class="text-muted">Didn't receive the code?</span>
                            <a href="forgot-password.php" class="text-decoration-none ms-1">Resend Code</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Timer countdown
function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    var countdown = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            clearInterval(countdown);
            display.textContent = "Expired";
            // Redirect to forgot password page
            window.location.href = 'forgot-password.php?error=' + encodeURIComponent('Verification code has expired. Please request a new one.');
        }
    }, 1000);
}

window.onload = function () {
    var tenMinutes = 60 * 10,
        display = document.querySelector('#timer');
    startTimer(tenMinutes, display);
};
</script>

<?php require './assets/includes/footer.php'; ?>