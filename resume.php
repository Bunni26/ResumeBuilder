<?php
require 'assets/class/database.class.php';
require 'assets/class/function.class.php';

$slug=$_GET['resume']??'';
$resumes = $db->query("SELECT * FROM resumes WHERE ( slug='$slug') ");
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat&family=Dancing+Script&family=Exo&family=Fuggles&family=Gloria+Hallelujah&family=Mooli&family=Nunito&family=Zilla+Slab&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="icon" href="./assets/images/logo.png">
    <title><?=$resume['full_name'].' | '.$resume['resume_title']?></title>
</head>

<body>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font-size: 12pt;
            background: rgb(249, 249, 249);
            background: radial-gradient(circle, rgba(249, 249, 249, 1) 0%, rgba(230, 234, 238, 1) 49%, rgba(220, 225, 230, 1) 100%);
            background-image: url(./assets/images/tiles/<?=$resume['background']?>);
            background-attachment: fixed;
        }

        .page {
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
            width: 21cm;
            min-height: 29.7cm;
        }

        .subpage {
            padding: 0;
            height: 100%;
        }

        .main-content {
            display: flex;
        }

        .left-column {
            width: 250px;
            background: #2c3e50;
            color: white;
            padding: 40px 20px;
            min-height: 29.7cm;
        }

        .right-column {
            flex: 1;
            padding: 40px 30px;
        }

        .profile-name {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: white;
        }

        .contact-info {
            margin-bottom: 30px;
            font-size: 11pt;
            color: #ecf0f1;
        }

        .contact-info div {
            margin-bottom: 8px;
        }

        .contact-info i {
            width: 20px;
            margin-right: 10px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
            position: relative;
            padding-bottom: 8px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: #3498db;
        }

        .left-section-title {
            color: #3498db;
            font-size: 16px;
            font-weight: bold;
            margin: 25px 0 15px 0;
            text-transform: uppercase;
        }

        .experience-item, .education-item {
            margin-bottom: 20px;
        }

        .experience-item .position {
            font-weight: bold;
            color: #2c3e50;
            font-size: 14px;
        }

        .experience-item .company {
            color: #3498db;
            margin: 5px 0;
        }

        .experience-item .date {
            color: #7f8c8d;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .skill-item {
            margin-bottom: 8px;
            color: #ecf0f1;
        }

        .languages-item {
            margin-bottom: 8px;
            color: #ecf0f1;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            body {
                background: none;
            }
            .page {
                box-shadow: none;
                margin: 0;
            }
            .left-column {
                background-color: #2c3e50 !important;
                color: white !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>

<?php
if($fn->Auth()!=false && $fn->Auth()['id']==$resume['user_id']){
    ?>
<div class="extra">
<div class="w-100 py-2 bg-dark d-flex justify-content-center gap-3">
    <?php
$actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    ?>
<a href="whatsapp://send?text=<?=$actual_link?>" class="btn btn-light btn-sm"><i class="bi bi-whatsapp"></i> Share</a>
<button class="btn btn-light btn-sm" id="print"><i class="bi bi-printer"></i> Print</button>
<button class="btn btn-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#background"><i class="bi bi-backpack4-fill"></i> Background</button>
<button class="btn btn-light btn-sm" data-bs-toggle="offcanvas" data-bs-target="#font"><i class="bi bi-file-earmark-font"></i> Font</button>
<button class="btn btn-light btn-sm" id="downloadpdf"><i class="bi bi-file-earmark-pdf"></i> </i> Download</button>
</div>
    </div>
    <?php
}
?>


<div class="page" style="font-family:<?=$resume['font']?>">
    <div class="subpage">
        <div class="main-content">
            <div class="left-column">
                <div class="profile-name"><?=$resume['full_name']?></div>
                
                <div class="contact-info">
                    <div><i class="bi bi-telephone"></i> <?=$resume['mobile_no']?></div>
                    <div><i class="bi bi-envelope"></i> <?=$resume['email_id']?></div>
                    <div><i class="bi bi-geo-alt"></i> <?=$resume['address']?></div>
                </div>

                <div class="left-section-title">Skills</div>
                <?php if($skills): foreach($skills as $skill): ?>
                <div class="skill-item">
                    <i class="bi bi-check2"></i> <?=$skill['skill']?>
                </div>
                <?php endforeach; endif; ?>

                <div class="left-section-title">Languages</div>
                <?php 
                $languages = explode(',', $resume['languages']);
                foreach($languages as $lang): ?>
                <div class="languages-item">
                    <i class="bi bi-chat"></i> <?=trim($lang)?>
                </div>
                <?php endforeach; ?>

                <div class="left-section-title">Personal Details</div>
                <div class="contact-info">
                    <div><i class="bi bi-calendar"></i> <?=date('d F Y', strtotime($resume['dob']))?></div>
                </div>
            </div>

            <div class="right-column">
                <div class="section">
                    <div class="section-title">Professional Summary</div>
                    <div class="mb-4"><?=$resume['objective']?></div>
                </div>

                <div class="section">
                    <div class="section-title">Work Experience</div>
                    <?php foreach($exps as $exp): ?>
                    <div class="experience-item">
                        <div class="position"><?=$exp['position']?></div>
                        <div class="company"><?=$exp['company']?></div>
                        <div class="date"><?=$exp['started']?> - <?=$exp['ended']?></div>
                        <div class="description"><?=$exp['job_desc']?></div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="section">
                    <div class="section-title">Education</div>
                    <?php foreach($edus as $edu): ?>
                    <div class="education-item">
                        <div class="position"><?=$edu['course']?></div>
                        <div class="company"><?=$edu['institute']?></div>
                        <div class="date"><?=$edu['started']?> - <?=$edu['ended']?></div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="mt-4 text-end">
                    <div class="date">Date: <?=date('d F, Y')?></div>
                    <?php if(isset($resume['signature']) && $resume['signature']): ?>
                    <div class="mt-2"><?=$resume['signature']?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="background" style="height:50vh" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title w-100" id="offcanvasBottomLabel">Change Background</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body w-100">
    <style>
.tile{
    width:100px;
    height:100px;
    background-size:cover;+
}
.tile:hover{
    cursor:pointer;
    opacity:0.7;
}
        </style>
        <div class="d-flex w-100 gap-2 flex-wrap justify-content-center">
            <?php
for($i=1;$i<22;$i++){
    ?>
 <div class="tile rounded shadow-sm border" data-background="tile<?=$i?>.png" style="background-image:url(./assets/images/tiles/tile<?=$i?>.png)"></div>
    <?php
}
            ?>

  <div class="tile rounded shadow-sm border" data-background="tile23.jpg" style="background-image:url(./assets/images/tiles/tile23.jpg)"></div>

</div>
  </div>
</div>

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="font" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Change Font</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>

  <div class="offcanvas-body">
 <select class="form-control" id="font">
    <option value='oo' <?=$resume['font']=='oo'?'selected':''?>>System Font</option>
    <option value="'Poppins', sans-serif" style="font-family:'Poppins', sans-serif" <?=$resume['font']=="'Poppins', sans-serif"?'selected':''?>>'Poppins', sans-serif</option>
    <option value="'Caveat', cursive" style="font-family:'Caveat', cursive" <?=$resume['font']=="'Caveat', cursive"?'selected':''?>>'Caveat', cursive</option>
    <option value="'Dancing Script', cursive" style="font-family:'Dancing Script', cursive" <?=$resume['font']=="'Dancing Script', cursive"?'selected':''?>>'Dancing Script', cursive</option>
    <option value="'Exo', sans-serif" style="font-family:'Exo', sans-serif" <?=$resume['font']=="'Exo', sans-serif"?'selected':''?>>'Exo', sans-serif</option>
    <option value="'Fuggles', cursive" style="font-family:'Fuggles', cursive" <?=$resume['font']=="'Fuggles', cursive"?'selected':''?>>'Fuggles', cursive</option>
    <option value="'Gloria Hallelujah', cursive" style="font-family:'Gloria Hallelujah', cursive" <?=$resume['font']=="'Gloria Hallelujah"?'selected':''?>>'Gloria Hallelujah', cursive</option>
    <option value="'Mooli', sans-serif" style="font-family:'Mooli', sans-serif" <?=$resume['font']=="'Mooli', sans-serif"?'selected':''?>>'Mooli', sans-serif</option>
    <option value="'Nunito', sans-serif" style="font-family:'Nunito', sans-serif" <?=$resume['font']=="'Nunito', sans-serif"?'selected':''?>>'Nunito', sans-serif</option>
    <option value="'Zilla Slab', serif" style="font-family:'Zilla Slab', serif" <?=$resume['font']=="'Zilla Slab', serif"?'selected':''?>>'Zilla Slab', serif</option>
 </select>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>


<script>

$("#downloadpdf").click(function(){
    window.jsPDF = window.jspdf.jsPDF
    var doc = new jsPDF();

    var page = document.querySelector('.page');

    doc.html(page,{
callback: function(doc){
doc.save('<?=$resume['full_name']?> - <?=$resume['resume_title']?>.pdf');
},
margin:[2,2,2,2],
x:0,
y:0,
width:200,
windowWidth:800
    });
})

$("#font").change(function(){
  
    let font = $(this).find(":selected").val();
    $(".page").css('font-family',font);

    $.ajax({
        url:'actions/changefont.action.php',
        method:'post',
        data:{
            resume_id: <?=@$resume['id']?> ,
            font : font
        },
        success:function(res){
console.log(res);
        },
        error:function(res){
            console.log(res);
            alert('font is not updated');
        }
    })

})

$(".tile").click(function(){
  
    let tile = $(this).data('background');;

    $("body").css('background-image','url(./assets/images/tiles/'+tile+')');

    $.ajax({
        url:'actions/changeback.action.php',
        method:'post',
        data:{
            resume_id: <?=@$resume['id']?> ,
            background : tile
        },
        success:function(res){
console.log(res);
        },
        error:function(res){
            console.log(res);
            alert('background is not updated');
        }
    })

})

$("#print").click(function(){
   $(".extra").hide();

   window.print();

   setTimeout(() => {
      $(".extra").show();
   }, 500);
 
})


</script>
</body>
</html>