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
  <?php include 'header.php'; ?>
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

    .ibox {
      position: relative;
      margin-bottom: 25px;
      background-color: #fff;
      -webkit-box-shadow: 1px 1px 1px 1px rgba(1, 1, 1, .1);
      box-shadow: 1px 1px 1px 1px rgba(1, 1, 1, .1);
    }
  </style>
</head>

<body class="fixed-navbar">
  <header class="header">
    <div class="flexbox flex-1" style="background-color:#528124;color:#FFFFFF;">
      <ul class="nav navbar-toolbar">
        <li>
          <div><a href="http://www.ftu.ac.th/2019/index.php/th/"><img src="../assets/img/head-ftu.png" width="140" height="40" /></a></div>
        </li>
        <li>
        <li>
          <h4 style="padding-left: 10px;"><a href="welcome_home.php" style="color:#FFFFFF;">ระบบกิจกรรมนักศึกษามหาวิทยาลัยฟาฏอนี</a></h4>
        </li>
      </ul>
      <ul class="nav navbar-toolbar ml-auto">
        <li class="dropdown dropdown-user">
          <div class="language">
            <div class="google">
              <div id="google_translate_element">
                <div class="skiptranslate goog-te-gadget" dir="ltr">
                  <div id=":0.targetLanguage" class="goog-te-gadget-simple" style="white-space: nowrap;">
                  </div>
                </div>
              </div>
              <script type="text/javascript">
                function googleTranslateElementInit() {
                  new google.translate.TranslateElement({
                    pageLanguage: 'th',
                    includedLanguages: 'zh-CN,de,id,km,lo,ms,my,ar,th,tl,vi,th,en',
                    layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                    multilanguagePage: true
                  }, 'google_translate_element');
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
    </div>
  </header>
  <div class="content-wrapper pb-2" style="background-color:#f4f4fc;">
    <div class="page-content fade-in-up" style="height:1654px; width:100%;padding:20px;padding-top:0px">
      <div class="page-heading">
        <h1 class="page-title" style="color:#528124;">ติดต่อ</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
          </li>
          <li class="breadcrumb-item"><a href="welcome_home.php">หน้าแรก</a></li>
          <li class="breadcrumb-item">ติดต่อ</li>
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
      <br>
      <div class="ibox">
        <div class="ibox-body" style="background-color:#FFFFFF; font-size:15px;">
          <span class="fa fa-home" style="color:#528124; font-size:18px;"> :</span> สำนักพัฒนาศักยภาพนักศึกษา มหาวิทยาลัยฟาฏอนี ชั้น2 ณ อาคารเฉลิมพระเกียรติ มหาวิทยาลัยฟาฏอนี 135/8 ม.3 ต.เขาตูม อ.ยะรัง จ.ปัตตานี 94106
          <br><span class="fa fa-globe" style="color:#528124; font-size:18px;"> :</span> <a href="http://www.ftu.ac.th/2019/index.php/th/"> มหาวิทยาลัยฟาฏอนี</a>
          <br><span class="fa fa-facebook" style="color:#528124; font-size:18px;"> :</span> <a href="https://web.facebook.com/StudentAffairsFTU/"> สำนักพัฒนาศักยภาพนักศึกษา</a>
          <br><span class="fa fa-facebook" style="color:#528124; font-size:18px;"> :</span> <a href="https://web.facebook.com/StudentUnionOfFTU/"> องค์การบริหารนักศึกษาหญิง</a>
          <br><span class="fa fa-facebook" style="color:#528124; font-size:18px;"> :</span> <a href="https://web.facebook.com/StudentunionFTU/"> องค์การบริการนักศึกษาชาย</a>
          <br><span class="fa fa-phone" style="color:#528124; font-size:18px;"> :</span> 081-678-5532, 0-7341-8613
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
            <div class="card-header" style="background-color:#d1cbaf">
              <h5 style="color:#2c2c2c">ตารางรายชื่อเจ้าหน้าที่</h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body text-nowrap">
              <table id="tb1" class="table table-hover-sm table-striped text-center" cellspacing="0" width="100%">
                <thead>
                  <tr style="color:#528124;">
                    <th>ชื่อ-สกุล</th>
                    <th>กลุ่ม</th>
                    <th>สังกัด</th>
                    <th>องค์กร</th>
                    <th>หมายเลขโทรศัพท์</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $stmt = $db->dbConnection()->prepare("SELECT organizer.*, mainorg.*,organization.*, usertype.* FROM organizer
                                          JOIN usertype ON organizer.orgzeruserType = usertype.usertypeID 
                                          JOIN mainorg ON organizer.orgzerMainorg = mainorg.mainorgNo 
                                          JOIN organization ON organizer.orgzerOrgtion = organization.orgtionNo  ORDER BY organizer.orgzerID DESC");
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <tr>
                      <td><a href="javascript:;"><?php echo $row['orgzerName']; ?></a></td>
                      <td><?php echo $row['orgzerGroup']; ?></td>
                      <td><?php echo $row['mainorg']; ?></td>
                      <td><?php echo $row['organization']; ?></td>
                      <td><?php echo $row['orgzerPhone']; ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CORE PLUGINS-->
  <?php include 'footer.php'; ?>
</body>

</html>