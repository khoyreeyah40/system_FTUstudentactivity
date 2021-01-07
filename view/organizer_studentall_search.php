<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE);
include '../control/organizer_studentall_search.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| จัดการรายชื่อนักศึกษา</title>
  <?php include 'header.php'; ?>

  <style>
    .breadcrumb-item {
      font-size: 16px;
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
  </script>
</head>

<body class="fixed-navbar">
  <!-- Main content -->
  <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
    <div class="page-heading">
      <h1 class="page-title">จัดการรายชื่อนักศึกษา</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item">จัดการรายชื่อนักศึกษา</li>
      </ol>
    </div>
    <br>
    <?php
    $stmt = $session->runQuery("SELECT orgzerSec FROM organizer WHERE orgzerID = '$loginby'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (($row["orgzerSec"] == "Admin") || ($row["orgzerSec"] == "คณะ")) {
    ?>
      <a href="organizer_teacher.php">
        <button class="btn btn-info" type="button"><span class="fa fa-pencil"></span> &nbsp; จัดการรายชื่ออาจารย์</button>
      </a>&nbsp;&nbsp;
    <?php
    } else {
    }
    ?>
    <br>
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
                  <select class="form-control select2_demo_1" style="width: 100%;" name="stdMainorg" id="stdMainorg" onChange="getorgtion(this.value);" required>
                    <?php
                    $stmt = $session->runQuery("SELECT orgzerSec FROM organizer WHERE orgzerID = '$loginby'");
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if (($row["orgzerSec"] == "Admin") || ($row["orgzerSec"] == "มหาวิทยาลัย")) {
                    ?><option selected="selected" disabled="disabled">--กรุณาเลือกคณะ--</option><?php
                                                                                                            include '../control/select_faculty_all.php';
                                                                                                          }
                                                                                                          if ($row["orgzerSec"] == "คณะ") {
                                                                                                            ?><option selected="selected" disabled="disabled">--กรุณาเลือกคณะ--</option><?php
                                                                                                            include '../control/select_faculty_each.php';
                                                                                                          }
                                                                                                            ?>
                  </select>
                </div>
                <div class="col-sm-6">
                  <select class="form-control select2_demo_1" style="width: 100%;" name="stdOrgtion" id="stdorgtion" required>
                    <option selected="selected" disabled="disabled">--กรุณาเลือกสาขา--</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-6">
                  <select class="form-control select2_demo_1" style="width: 100%;" name="stdYear" required>
                    <option selected="selected" disabled="disabled">--กรุณาเลือกปีการศึกษา--</option>
                    <?php
                    include '../control/function_year.php';
                    ?>
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
  </div>
  <!-- CORE PLUGINS-->
  <?php include 'footer.php'; ?>
</body>

</html>