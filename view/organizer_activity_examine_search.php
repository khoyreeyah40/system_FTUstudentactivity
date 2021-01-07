<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE); // avoid notice
include '../control/organizer_activity_examine_search.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| ตรวจสอบการเข้าร่วมกิจกรรม</title>
  <?php include 'header.php'; ?>

  <style>
    .breadcrumb-item {
      font-size: 16px;
    }

    .modal-dialog {
      max-width: 800px;
      margin: 30px auto;
    }
  </style>
  <script>
    function getOrgtion(val) {
      $.ajax({
        type: "POST",
        url: "../control/select_orgtion.php",
        data: 'mainorgNo=' + val,
        success: function(data) {
          $("#stdOrgtion").html(data);
        }
      });
    }
  </script>
</head>

<body class="fixed-navbar">
  <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
    <div class="page-heading">
      <h1 class="page-title">ตรวจสอบการเข้าร่วมกิจกรรม</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item">ค้นหาตารางการเข้าร่วมกิจกรรม</li>
      </ol>
    </div>
    <br>
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
    <div class="row justify-content-center">
      <div class="col-sm-10 ">
        <div class="ibox">
          <div class="ibox-body">
            <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
              <div class="form-group row">
                <div class="col-sm-6">
                  <select class="form-control select2_demo_1" style="width: 100%;" name="stdMainorg" id="stdMainorg" onChange="getOrgtion(this.value);" required>
                    <?php
                    $stmt = $session->runQuery("SELECT orgzerSec FROM organizer WHERE orgzerID = '$loginby'");
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (($row["orgzerSec"] == "Admin") || ($row["orgzerSec"] == "มหาวิทยาลัย")) {
                    ?><option selected="selected" disabled="disabled">--กรุณาเลือกคณะ--</option required>
                    <?php
                      include '../control/select_faculty_all.php';
                    }
                    if ($row["orgzerSec"] == "คณะ") {
                      include '../control/select_faculty_each.php';
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-6">
                  <select class="form-control select2_demo_1" style="width: 100%;" name="stdOrgtion" id="stdOrgtion" required>
                    <option selected="selected" disabled="disabled">--กรุณาเลือกสาขา--</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <select class="form-control select2_demo_1" style="width: 100%;" name="stdYear" required>
                    <option selected="selected" disabled="disabled">--กรุณาเลือกปีการศึกษา--</option>
                    <?php include '../control/function_year.php'; ?>
                  </select>
                </div>
                <div class="col-sm-6">
                  <select class="form-control select2_demo_1" style="width: 100%;" name="stdGroup" required>
                    <option selected="selected" disabled="disabled">--กรุณาเลือกกลุ่ม--</option>
                    <option value="ชาย">ชาย</option>
                    <option value="หญิง">หญิง</option>
                  </select>
                </div>
              </div>
              <br>
              <div class="form-group ">
                <div class="col-sm-12 text-center">
                  <button class="btn btn-primary" name="btsearch">ค้นหา</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <p class="text-center">------------------- หรือค้นหาโดยรหัสนักศึกษา -------------------</p>
    <div class="row justify-content-center">
      <div class="col-sm-10 ">
        <div class="ibox">
          <div class="ibox-body">
            <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
              <div class="form-group row text-center">
                <div class="col-sm-10 ">
                  <input class="form-control" type="text" name="stdID" id="stdID" placeholder="----กรุณากรอกรหัสนักศึกษา----" required>
                </div>
                <div class="col-sm-2 ">
                  <button class="btn btn-primary" name="btsearch1">ค้นหา</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CORE PLUGINS-->
  <?php include 'footer.php'; ?>
</body>

</html>