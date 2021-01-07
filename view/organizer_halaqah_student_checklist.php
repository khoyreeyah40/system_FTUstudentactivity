<?php
include '../control/session_organizer.php';
$halaqahchecklist_no = $_GET['halaqahchecklist_no'];
$halaqah_id = $_GET['halaqah_id'];
error_reporting(~E_NOTICE); // avoid notice
include '../control/organizer_halaqah_student_checklist.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| | จัดการกลุ่มศึกษาอัลกุรอ่าน: รายชื่อผู้เข้าร่วม</title>
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
</head>

<body class="fixed-navbar">
  <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
    <div class="page-heading">
      <h1 class="page-title">รายชื่อผู้เข้าร่วม</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item"><a href="organizer_halaqah.php?">จัดการกลุ่มศึกษาอัลกุรอ่าน</a> </li>
        <li class="breadcrumb-item">รายชื่อผู้เข้าร่วม</li>
      </ol>
    </div>
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
    <div class="row justify-content-center">
      <div class="col-sm-6 ">
        <div class="ibox">
          <div class="ibox-body">
            <form method="post">
              <div class="form-group row" style="margin-bottom: 0rem;">
                <input class="form-control" type="hidden" name="halaqahchecklistNo" value="<?php echo $halaqahchecklist_no; ?>" readonly />
                <input class="form-control" type="hidden" name="halaqah_id" value="<?php echo $halaqah_id; ?>" readonly />
                <div class="col-sm-10">
                  <select class="form-control select2_demo_1" style="width: 100%;" name="halaqahcheckstdID" required>
                    <option selected="selected" disabled="disabled">--รายชื่อนักศึกษา--</option>
                    <?php
                    $stmt = $session->runQuery("SELECT halaqahstd.*, student.* FROM halaqahstd 
                                                  JOIN student ON student.stdID = halaqahstd.halaqahstdID
                                                  WHERE halaqahstd.halaqahID= $halaqah_id
                                                  ORDER BY halaqahstd.halaqahstdID  DESC");
                    $stmt->execute();
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      $halaqahcheckstdID = $row["halaqahstdNo"];
                      $stdID = $row["stdID"];
                      $stdName = $row["stdName"];
                    ?>
                      <option value="<?php echo $halaqahcheckstdID ?>"> <?php echo $stdID ?>: <?php echo $stdName ?></option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-1">
                  <button class="btn btn-info" type="submit" name="btaddhalaqahstd">เพิ่ม</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-12">
        <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
          <div class="card-header" style="background-color:#d1cbaf">
            <h5 style="color:#2c2c2c">ตารางรายชื่อผู้เข้าร่วม</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body text-nowrap">
            <table id="tb1" class="table table-hover-sm table-striped text-center" cellspacing="0" width="100%">
              <thead>
                <tr style="color:#528124;">
                  <th>รหัสนักศึกษา</th>
                  <th>ชื่อนักศึกษา</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt = $session->runQuery("SELECT halaqahcheck.*,halaqahstd.*,student.* FROM halaqahstd
                                        JOIN halaqahcheck ON halaqahstd.halaqahstdNo = halaqahcheck.halaqahcheckstdID
                                        JOIN student ON student.stdID = halaqahstd.halaqahstdID
                                        WHERE halaqahcheck.halaqahchecklistNo = '$halaqahchecklist_no'
                                        ORDER BY halaqahcheck.halaqahcheckNo  DESC");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                    <td><?php echo $row['halaqahstdID']; ?></td>
                    <td><?php echo $row['stdName']; ?></td>
                    <td>
                    <a class="btn btn-sm  btn-danger" href="?delete_id=<?php echo $row['halaqahcheckNo']; ?>&&halaqahchecklist_no=<?php echo $row['halaqahchecklistNo']; ?>&&halaqah_id=<?php echo $row['halaqahID']; ?>" onclick="return confirm('ต้องการลบรายชื่อนี้ ?')"> <i class="fa fa-trash"></i> ลบ</a>
                    </td>
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
  <!-- CORE PLUGINS-->
  <?php include 'footer.php'; ?>
</body>

</html>