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
  <title>ระบบกิจกรรมนักศึกษา| เอกสาร</title>
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

    .modal-dialog {
      max-width: 800px;
      margin: 30px auto;
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
        <h1 class="page-title" style="color:#528124;">ไฟล์เอกสารทั้งหมด</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
          </li>
          <li class="breadcrumb-item"><a href="welcome_home.php">หน้าแรก</a></li>
          <li class="breadcrumb-item">ไฟล์เอกสารทั้งหมด</li>
        </ol>
      </div>
      <br>
      <b>
        <hr style="margin-top: 0rem;border-color:#528124;border-width: 2px;"></b>

      <div class="row ml-1 mr-1">
        <div class="col-12">
          <div class="card">
            <br>
            <div class="row">
              <div class="col-sm-12">
                <table class="table table-hover table-striped ">
                  <tbody>
                    <?php
                    $stmt = $db->dbConnection()->prepare("SELECT * FROM file ORDER BY fileNo DESC");
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                      <tr>
                        <td style="font-size:14px;"><a href="../file/<?php echo $row['fileDoc']; ?>"><span class="fa fa-edit"></span>&nbsp; <?php echo $row['fileName']; ?></a></td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CORE PLUGINS-->
  <?php include 'footer.php'; ?>
</body>

</html>