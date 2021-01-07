<?php
error_reporting(~E_NOTICE); // avoid notice
include("../db/dbconfig.php");
$db = new Database();
session_start();
if (isset($_SESSION['std_session'])) {
    header('location: student_homepage.php');
}else
if (isset($_SESSION['orgzer_session'])) {
    header('location: organizer_homepage.php');
}
include '../control/student_register.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| ลงทะเบียนเข้าใช้: สำหรับนักศึกษา</title>
  <?php include 'header.php'; ?>
  <link href="../assets/assets/css/main.min.css" rel="stylesheet" />
  <style>
    .breadcrumb-item {
      font-size: 16px;
    }

    .sidebar-mini {
      margin-left: 0px;
    }

    .content-wrapper {
      margin-left: 0px;
    }
  </style>
  <script>
    function getorgtion(val) {
      $.ajax({
        type: "POST",
        url: "../control/select_orgtion.php",
        data: 'mainorgNo=' + val,
        success: function(data) {
          $("#stdorgtion").html(data);
        }
      });
    }

    function gettc(val) {
      $.ajax({
        type: "POST",
        url: "../control/select_student_tc.php",
        data: 'mainorgNo=' + val,
        success: function(data) {
          $("#stdtc").html(data);
        }
      });
    }
  </script>
</head>

<body class="fixed-navbar">
  <div class="page-wrapper">
    <header class="header">
      <div class="flexbox flex-1" style="background-color:#528124;color:#FFFFFF;">
        <ul class="nav navbar-toolbar">
          <li>
            <div><a href="http://www.ftu.ac.th/2019/index.php/th/"><img src="../assets/img/head-ftu.png" width="140" height="40" /></a></div>
          </li>
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
                      includedLanguages: 'zh-CN,de,id,km,lo,ms,my,th,tl,vi,th,en',
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
        </ul>
      </div>
    </header>
    <div class="content-wrapper pb-2" style="background-color:#f4f4fc;">
      <div class="page-content fade-in-up" style="height:1654px; width:100%;padding:20px;padding-top:0px">
        <div class="page-heading" style=" font-size: 36px;text-align: center;margin: 20px 0;">
          <div>
            <p><img src="../assets/img/head-ftu.png" /></p>
          </div>
          <a href="welcome_home.php" style="color:#528124;">
            ระบบกิจกรรมนักศึกษา
          </a>
        </div>
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
        <div class="row ml-1 mr-1 justify-content-center">
          <div class="col-8 ">
            <div class="card " style="border-width:0px;border-top-width:4px;margin: 20px;">
              <div class="row justify-content-center">
                <div class="col-sm-8 ">
                  <form method="post" enctype="multipart/form-data">
                    <h1 style="text-align: center;margin: 20px 0;">ลงทะเบียนเข้าใช้</h1>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                          <select class="form-control select2_demo_1" style="width: 100%;" name="stdYear" required />
                          <option selected="selected" disabled="disabled">--ปีการศึกษา--</option>
                          <?php include '../control/function_year.php'; ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <input class="form-control" type="text" name="stdID" minlength=9 maxlength=9 placeholder="รหัสประจำตัวนักศึกษา" autocomplete="off" require />
                        </div>
                      </div>
                    </div>
                    <input class="form-control" type="hidden" name="stdStatus" value="กำลังศึกษา" require />
                    <div class="form-group">
                      <input class="form-control" type="text" name="stdName" placeholder="ชื่อ-สกุล" autocomplete="off" require />
                    </div>
                    <div class="form-group">
                      <select class="form-control select2_demo_1" style="width: 100%;" name="stdMainorg" id="stdMainorg" onChange="getorgtion(this.value);gettc(this.value);" required>
                        <option selected="selected" disabled="disabled">--คณะ--</option>
                        <?php
                        $stmt = $db->dbConnection()->prepare("SELECT * FROM mainorg
                                                  WHERE mainorgSec ='คณะ'
                                                  ");
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                          $mainorgno = $row["mainorgNo"];
                          $mainorglist = $row["mainorg"];
                        ?>
                          <option value="<?php echo $mainorgno ?>"> <?php echo $mainorglist ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <select class="form-control select2_demo_1" style="width: 100%;" name="stdOrgtion" id="stdorgtion" required />
                      <option selected="selected" disabled="disabled">--สาขา--</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <select class="form-control select2_demo_1" style="width: 100%;" name="stdTc" id="stdtc" required />
                      <option selected="selected" disabled="disabled">--อาจารย์ที่ปรึกษา--</option>

                      </select>
                    </div>
                    <div class="form-group">
                      <select class="form-control select2_demo_1" style="width: 100%;" name="stdGroup" required />
                      <option selected="selected" disabled="disabled">--เพศ--</option>
                      <option value="ชาย">ชาย</option>
                      <option value="หญิง">หญิง</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <input class="form-control" id="ex-phone" type="text" name="stdPhone" placeholder="หมายเลขโทรศัพท์" autocomplete="off" required />
                    </div>
                    <div class="form-group">
                      <input class="form-control" type="text" name="stdEmail" placeholder="email@email.com" autocomplete="off" required />
                    </div>
                    <div class="form-group">
                      <input class="form-control" type="text" name="stdFb" placeholder="Facebook" autocomplete="off"/>
                    </div>
                    <div class="form-group">
                      <input class="input-group" type="file" name="Image" accept="image/*" />
                    </div>
                    <div class="form-group">
                      <input class="form-control" id="password" type="password" name="stdPassword" minlength=8 maxlength=10 placeholder="รหัสผ่าน" autocomplete="off" require/>
                    </div>
                    <div class="form-group">
                      <button class="btn btn-info btn-block" type="submit" name="btaddstd"  onclick="return confirm('ข้อมูลทั้งหมดถูกต้องแล้วใช่หรือไม่ ?')">ลงทะเบียน</button>
                    </div>
                    <div class="text-center">ลงทะเบียนแล้ว?
                      <a class="color-blue" href="student_login.php">ลงชื่อเข้าใช้</a>
                    </div>
                    <br>
                  </form>
                </div>
              </div>
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