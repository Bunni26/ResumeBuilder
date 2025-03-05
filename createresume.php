<?php
$title = "Create Resume - Resume Builder";
require './assets/includes/header.php';
$fn->authPage();
?>

<style>
.animate-slide-in {
    opacity: 0;
    transform: translateY(20px);
    animation: slideIn 0.5s ease forwards;
}

.animate-fade-in {
    opacity: 0;
    animation: fadeIn 0.5s ease forwards;
}

.section-header {
    opacity: 0;
    transform: translateX(-20px);
    animation: slideInLeft 0.5s ease forwards;
}

.form-group {
    opacity: 0;
    transform: translateY(10px);
    animation: slideUp 0.5s ease forwards;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Add animation delay for form groups */
.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.2s; }
.form-group:nth-child(3) { animation-delay: 0.3s; }
.form-group:nth-child(4) { animation-delay: 0.4s; }
.form-group:nth-child(5) { animation-delay: 0.5s; }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow animate-fade-in">
                <div class="card-body">
                    <h3 class="card-title mb-4 section-header">
                        <i class="bi bi-file-earmark-person"></i> Create New Resume
                    </h3>

                    <form action="actions/createresume.action.php" method="post" class="row g-3 p-3">
                        <div class="col-md-6 form-group">
                            <label class="form-label">Resume Title</label>
                            <input type="text" name="resume_title" placeholder="Enter your Role" class="form-control" required>
                        </div>

                        <h5 class="mt-3 text-secondary section-header">
                            <i class="bi bi-person-badge"></i> Personal Information
                        </h5>

                        <div class="col-12 form-group">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" name="full_name" placeholder="Enter your full name" required>
                        </div>

                        <div class="col-12 form-group">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email_id" placeholder="Enter your email address" required>
                        </div>

                        <div class="col-12 form-group">
                            <label class="form-label">Career Objective</label>
                            <textarea class="form-control" name="objective" placeholder="Describe your career objectives and goals"></textarea>
                        </div>

                        <div class="col-md-6 form-group">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" name="dob" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" name="mobile_no" placeholder="Enter your mobile number" required>
                        </div>

                        <div class="col-12 form-group">
                            <label class="form-label">Hobbies</label>
                            <input type="text" class="form-control" name="hobbies" placeholder="Enter your hobbies (e.g., Reading, Photography, Traveling)" required>
                        </div>

                        <div class="col-md-6 form-group">
                            <label class="form-label">Languages Known</label>
                            <input type="text" class="form-control" name="languages" placeholder="Enter languages you know (e.g., English, Hindi, French)" required>
                        </div>

                        <div class="col-12 form-group">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" name="address" placeholder="Enter your complete address" required></textarea>
                        </div>

                        <div class="col-12 mt-4 form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Create Resume
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Add animation classes to elements as they enter viewport
document.addEventListener('DOMContentLoaded', function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    });

    // Observe all form groups and section headers
    document.querySelectorAll('.form-group, .section-header').forEach((el) => {
        el.style.animationPlayState = 'paused';
        observer.observe(el);
    });
});
</script>

<?php require './assets/includes/footer.php'; ?>