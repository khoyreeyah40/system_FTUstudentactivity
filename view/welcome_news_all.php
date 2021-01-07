<?php
include("../db/dbconfig.php");
$db = new Database();
session_start();
if (isset($_SESSION['std_session'])) {
    header('location: student_homepage.php');
}else
if (isset($_SESSION['orgzer_session'])) {
    header('location: organizer_homepage.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <title>ระบบกิจกรรมนักศึกษา| ข่าวประชาสัมพันธ์</title>
  <!-- GLOBAL MAINLY STYLES-->
  <?php include 'header.php';?>
  <!-- THEME STYLES-->
  <link href="../assets/assets/css/main.min.css" rel="stylesheet" />
  <!-- PAGE LEVEL STYLES-->
  <style>
    .breadcrumb-item {
      font-size: 16px;
    }

    body.fixed-navbar .header {
      top: unset;
    }

    .sidebar-mini {
      margin-left: 0px;
    }

    .content-wrapper {
      margin-left: 0px;
    }
    .modal-dialog {
            max-width: 800px;
            margin: 30px auto;
        }
        .col-sm-3{
      padding-right: 0px;
     padding-left: 0px;
    }
    .card-deck {
    margin-right: 15px;
    margin-left: 15px;
}
  </style>
</head>

<body class="fixed-navbar">

  <!-- Main content -->
  <header class="header">
    <div class="flexbox flex-1" style="background-color:#528124;color:#FFFFFF;">
      <!-- START TOP-RIGHT TOOLBAR-->
      <ul class="nav navbar-toolbar">
      <li>
                        <div><a href="http://www.ftu.ac.th/2019/index.php/th/"><img src="../assets/img/head-ftu.png" width="140" height="40"/></a></div></li>
                    <li>
        <li>
        <h4 style="padding-left: 10px;"><a href="welcome_home.php"style="color:#FFFFFF;">ระบบกิจกรรมนักศึกษามหาวิทยาลัยฟาฏอนี</a></h4>
        </li>
      </ul>
      <ul class="nav navbar-toolbar ml-auto">
        <li class="dropdown dropdown-user">
        <div class="language">
                    <div class="google">
                        <div id="google_translate_element"><div class="skiptranslate goog-te-gadget" dir="ltr" ><div id=":0.targetLanguage" class="goog-te-gadget-simple" style="white-space: nowrap;">
                        </div></div></div>
                        <script type="text/javascript">
                            function googleTranslateElementInit() {
                                new google.translate.TranslateElement({pageLanguage: 'th', includedLanguages: 'zh-CN,de,id,km,lo,ms,my,ar,th,tl,vi,th,en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');
                            }
                        </script>
                        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    </div>
                </div>
        </li>
        <li class="dropdown dropdown-user">
          <a class="nav-link dropdown-toggle link" href="welcome_contact.php" style="font-size: 16px;color:#FFFFFF;">ติดต่อ</a>
        </li>
        <li class="dropdown dropdown-user">
          <a class="nav-link dropdown-toggle link" data-toggle="dropdown" style="font-size: 16px;color:#FFFFFF;">
            <span></span>เข้าสู่ระบบ<i class="fa fa-angle-down m-l-5"></i></a>
          <ul class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="organizer_login.php" style="color:#528124;"><i class="fa fa-user"></i>เจ้าหน้าที่</a>
            <li class="dropdown-divider"></li>
            <a class="dropdown-item" href="student_login.php" style="color:#528124;"><i class="fa fa-child"></i>นักศึกษา</a>
          </ul>
        </li>
      </ul>
      <!-- END TOP-RIGHT TOOLBAR-->
    </div>
  </header>
  <div class="content-wrapper pb-2" style="background-color:#f4f4fc;">
    <div class="page-content fade-in-up" style="height:1654px; width:100%;padding:20px;padding-top:0px">
      <div class="page-heading">
        <h1 class="page-title" style="color:#528124;">ข่าวประชาสัมพันธ์ทั้งหมด</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
          </li>
          <li class="breadcrumb-item"><a href="welcome_home.php">หน้าแรก</a></li>
          <li class="breadcrumb-item">ข่าวประชาสัมพันธ์ทั้งหมด</li>
        </ol>
      </div>
      <br>
      <b>
        <hr style="margin-top: 0rem;border-color:#528124;border-width: 2px;"></b>

      <?php
      if (isset($errMSG)) {
      ?>
        <div class="alert alert-danger alert-bordered">
          <span class="fa fa-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
        </div>
      <?php
      } else if (isset($successMSG)) {
      ?>
        <div class="alert alert-success alert-bordered">
          <strong><span class="fa fa-info-sign"></span> <?php echo $successMSG; ?> </strong>
        </div>
      <?php
      }
      ?>
      <div class="row ml-1 mr-1">
        <div class="col-12">
          <nav class="navbar navbar-light justify-content-between mb-0 pb-0 pr-0 pl-0  ">
          </nav>
          <div class="card" style="border-width:0px;border-top-width:4px;">
            <div class="row">
              <div class="col-sm-12">
                <div class="card-deck">
                  <?php
                  $stmt = $db->dbConnection()->prepare("SELECT *  FROM news  ORDER BY newsNo DESC");
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $newsStatus  = $row["newsStatus"];
                    $newsImage   = $row['newsImage'];
                    $newsTitle      = $row["newsTitle"];
                  ?>

                    <div class="col-sm-3 mt-4">
                      <div class="card m-2">
                        <a type="button" data-toggle="modal" data-target="#modalnewsinfo" data-id="<?php echo $row['newsNo']; ?>" id="newsinfo"><img class="card-img-top p-2" src="../assets/img/<?php echo $row['newsImage']; ?>" style="height: 100%;width:100%;background-color:#ebf2e6;" /></a>
                        <div class="card-body" style="background-color:#528124;color:#FFFFFF;">
                          <div><?php echo $newsTitle ?></div>
                        </div>
                        <div class="modal fade" id="modalnewsinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content ">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle" style="color:#417d19;">รายละเอียดเพิ่มเติม</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div id="modal-loader" style="text-align: center; display: none;">
                                  <img src="ajax-loader.gif">
                                </div>
                                <div id="dynamic-content">

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CORE PLUGINS-->
  <?php include 'footer.php';?>
  <script>
    /* View Function*/
    $(document).ready(function() {

      $(document).on('click', '#newsinfo', function(e) {

        e.preventDefault();

        var newsNo = $(this).data('id'); // it will get id of clicked row

        $('#dynamic-content').html(''); // leave it blank before ajax call
        $('#modal-loader').show(); // load ajax loader

        $.ajax({
            url: 'morenewsinfo.php',
            type: 'POST',
            data: 'id=' + newsNo,
            dataType: 'html'
          })
          .done(function(data) {
            console.log(data);
            $('#dynamic-content').html('');
            $('#dynamic-content').html(data); // load response 
            $('#modal-loader').hide(); // hide ajax loader 
          })
          .fail(function() {
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
          });

      });

    });
  </script>
</body>

</html>