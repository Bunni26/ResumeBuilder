<?php
$title = "Create Resume | Resume Builder";
require './assets/includes/header.php';
require './assets/includes/navbar.php';
$fn->authPage();
$slug=$_GET['resume']??'';
$resumes = $db->query("SELECT * FROM resumes WHERE ( slug='$slug' AND user_id=".$fn->Auth()['id'].") ");
$resume = $resumes->fetch_assoc();
if(!$resume){
    $fn->redirect('myresumes.php');
}

$exps = $db->query("SELECT * FROM experiences WHERE (resume_id=".$resume['id']." ) ");
$exps = $exps->fetch_all(1);

$edus = $db->query("SELECT * FROM educations WHERE (resume_id=".$resume['id']." ) ");
$edus = $edus->fetch_all(1);

$skills = $db->query("SELECT * FROM skills WHERE (resume_id=".$resume['id']." ) ");
$skills = $skills->fetch_all(1);
?>


    <div class="container">

        <div class="bg-white rounded shadow p-2 mt-4" style="min-height:80vh">
            <div class="d-flex justify-content-between border-bottom">
                <h5>Create Resume</h5>
                <div>
                     <a href="myresumes.php" class="text-decoration-none"><i class="bi bi-arrow-left-circle"></i> Back</a>
                </div>
            </div>

            <div>

                <form action="actions/updateresume.action.php" method="post" class="row g-3 p-3">
                        <input type="hidden" name="id" value="<?=$resume['id']?>" />
            <input type="hidden" name="slug" value="<?=$resume['slug']?>" />
                 <div class="col-md-6">
                        <label class="form-label">Resume Title</label>
                        <input type="text" name="resume_title" placeholder="Web Developer Consultant" value="<?=@$resume['resume_title']?>" class="form-control" required>
                    </div>   
                <h5 class="mt-3 text-secondary"><i class="bi bi-person-badge"></i> Personal Information</h5>
                    <div class="col-12">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="full_name" value="<?=@$resume['full_name']?>" placeholder="Enter your full name" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email_id" value="<?=@$resume['email_id']?>" placeholder="Enter your email address" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Career Objective</label>
                        <textarea class="form-control" name="objective" placeholder="Describe your career objectives and goals"><?=@$resume['objective']?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" value="<?=$resume['dob']?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" name="mobile_no" value="<?=$resume['mobile_no']?>" placeholder="Enter your mobile number" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Hobbies</label>
                        <input type="text" class="form-control" name="hobbies" value="<?=$resume['hobbies']?>" placeholder="Enter your hobbies (e.g., Reading, Photography, Traveling)" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Languages Known</label>
                        <input type="text" class="form-control" name="languages" value="<?=$resume['languages']?>" placeholder="Enter languages you know (e.g., English, Hindi, French)" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="address" placeholder="Enter your complete address" required><?=$resume['address']?></textarea>
                    </div>

                    <hr>
                    <div class="col-12">
                        <h5 class="text-secondary mb-3"><i class="bi bi-briefcase"></i> Professional Experience</h5>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Add your work experience to make your resume stand out</span>
                            <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addexperience">
                                <i class="bi bi-plus-lg"></i> Add Experience
                            </a>
                        </div>
                        <?php
                        if($exps){
                            foreach($exps as $exp){
                        ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title"><?=$exp['position']?></h5>
                                        <a href="actions/deleteexp.action.php?id=<?=$exp['id']?>&resume_id=<?=$resume['id']?>&slug=<?=$resume['slug']?>" 
                                           class="text-danger" onclick="return confirm('Are you sure you want to delete this experience?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                    <h6 class="card-subtitle mb-2 text-muted"><?=$exp['company']?></h6>
                                    <p class="card-text"><?=$exp['job_desc']?></p>
                                    <div class="text-muted small">
                                        <?=date('M Y', strtotime($exp['started']))?> - <?=date('M Y', strtotime($exp['ended']))?>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        } else {
                        ?>
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> No experience added yet. Click the "Add Experience" button to add your work history.
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="col-12 mt-4">
                        <h5 class="text-secondary mb-3"><i class="bi bi-journal-bookmark"></i> Education Background</h5>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Add your educational qualifications</span>
                            <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addeducation">
                                <i class="bi bi-plus-lg"></i> Add Education
                            </a>
                        </div>
                        <?php
                        if($edus){
                            foreach($edus as $edu){
                        ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title"><?=$edu['course']?></h5>
                                        <a href="actions/deleteedu.action.php?id=<?=$edu['id']?>&resume_id=<?=$resume['id']?>&slug=<?=$resume['slug']?>" 
                                           class="text-danger" onclick="return confirm('Are you sure you want to delete this education entry?')">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                    <h6 class="card-subtitle mb-2 text-muted"><?=$edu['institute']?></h6>
                                    <div class="text-muted small">
                                        <?=date('M Y', strtotime($edu['started']))?> - <?=date('M Y', strtotime($edu['ended']))?>
                                    </div>
                                </div>
                            </div>
                        <?php
                            }
                        } else {
                        ?>
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> No education details added yet. Click the "Add Education" button to add your educational background.
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="col-12 mt-4">
                        <h5 class="text-secondary mb-3"><i class="bi bi-boxes"></i> Professional Skills</h5>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Add your key skills and competencies</span>
                            <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addskill">
                                <i class="bi bi-plus-lg"></i> Add Skill
                            </a>
                        </div>
                        <?php
                        if($skills){
                            echo '<div class="row g-3">';
                            foreach($skills as $skill){
                        ?>
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                                    <div><i class="bi bi-check2-circle text-success"></i> <?=$skill['skill']?></div>
                                    <a href="actions/deleteskill.action.php?id=<?=$skill['id']?>&resume_id=<?=$resume['id']?>&slug=<?=$resume['slug']?>" 
                                       class="text-danger" onclick="return confirm('Are you sure you want to delete this skill?')">
                                        <i class="bi bi-x-lg"></i>
                                    </a>
                                </div>
                            </div>
                        <?php
                            }
                            echo '</div>';
                        } else {
                        ?>
                            <div class="alert alert-info">
                                <i class="bi bi-info-circle"></i> No skills added yet. Click the "Add Skill" button to showcase your expertise.
                            </div>
                        <?php
                        }
                        ?>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-floppy"></i> Update
                            Resume</button>
                    </div>
                </form>
            </div>





        </div>

    </div>

    <!-- Experience Modal -->
    <div class="modal fade" id="addexperience" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Experience</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="actions/addexperience.action.php" class="row g-3">
                        <input type="hidden" name="resume_id" value="<?=$resume['id']?>">
                        <input type="hidden" name="slug" value="<?=$resume['slug']?>">
                        <div class="col-md-12">
                            <label class="form-label">Position/Role</label>
                            <input type="text" name="position" class="form-control" placeholder="Enter your job position (e.g., Senior Web Developer)" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Company Name</label>
                            <input type="text" name="company" class="form-control" placeholder="Enter company name (e.g., Tech Solutions Inc.)" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Job Description</label>
                            <textarea name="job_desc" class="form-control" placeholder="Describe your key responsibilities and achievements" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="started" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End Date</label>
                            <input type="date" name="ended" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Experience</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Education Modal -->
    <div class="modal fade" id="addeducation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Education</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="actions/addeducation.action.php" class="row g-3">
                        <input type="hidden" name="resume_id" value="<?=$resume['id']?>">
                        <input type="hidden" name="slug" value="<?=$resume['slug']?>">
                        <div class="col-md-12">
                            <label class="form-label">Course/Degree</label>
                            <input type="text" name="course" class="form-control" placeholder="Enter your course or degree (e.g., Bachelor of Computer Science)" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Institute Name</label>
                            <input type="text" name="institute" class="form-control" placeholder="Enter institute name (e.g., University of Technology)" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Start Date</label>
                            <input type="date" name="started" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">End Date</label>
                            <input type="date" name="ended" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Education</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Skills Modal -->
    <div class="modal fade" id="addskill" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Skill</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="actions/addskill.action.php" class="row g-3">
                        <input type="hidden" name="resume_id" value="<?=$resume['id']?>">
                        <input type="hidden" name="slug" value="<?=$resume['slug']?>">
                        <div class="col-12">
                            <label class="form-label">Skill</label>
                            <input type="text" class="form-control" name="skill" 
                                placeholder="Enter a skill (e.g., JavaScript, Project Management, Adobe Photoshop)" required>
                            <div class="form-text">Add one skill at a time. You can add multiple skills separately.</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Add Skill</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

  <?php
require './assets/includes/footer.php';
?>