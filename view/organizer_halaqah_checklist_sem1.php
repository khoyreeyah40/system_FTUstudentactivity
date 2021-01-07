<?php
include '../control/session_organizer.php';
$halaqah_id = $_GET['halaqah_id'];
error_reporting(~E_NOTICE); // avoid notice
include '../control/organizer_halaqah_checklist_sem1.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| จัดการกลุ่มศึกษาอัลกุรอ่าน: ตารางการเข้าร่วมภาคเรียนที่ 1</title>
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
      <h1 class="page-title">จัดการกลุ่มศึกษาอัลกุรอ่าน: การเข้าร่วมภาคเรียนที่ 1</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item"><a href="organizer_halaqah.php">จัดการกลุ่มศึกษาอัลกุรอ่าน</a></li>
        <li class="breadcrumb-item">การเข้าร่วมภาคเรียนที่ 1</li>
      </ol>
    </div>
    <br>
    <a href="?halaqahcheck_id=<?php echo $halaqah_id; ?>"  onclick="return confirm('ต้องการเช็คชื่อผู้เข้าร่วม ?')"><button class="btn btn-primary">เช็คชื่อ</button></a>
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
    <div class="row">
      <div class="col-12">
        <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
          <div class="card-header" style="background-color:#d1cbaf">
            <h5 style="color:#2c2c2c">ตารางการเข้าร่วมกิจกรรมกลุ่มศึกษาอัลกุรอ่าน</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body text-nowrap">
            <table id="tb1" class="table table-hover-sm table-striped" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>วันที่</th>
                  <th>รหัสเช็คชื่อ</th>
                  <th>ภาคเรียน</th>
                  <th>จำนวนผู้เข้าร่วม</th>
                  <th>สถานะ</th>
                  <th>ลบ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt = $session->runQuery("SELECT * FROM halaqahchecklist
                                            WHERE halaqahID = '$halaqah_id' && actSem ='1'
                                            ORDER BY halaqahchecklistdate  DESC");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                    <td><?php echo $row['halaqahchecklistdate']; ?></td>
                    <td><?php echo $row['halaqahchecklistNo']; ?></td>
                    <td><?php echo $row['actSem']; ?></td>
                    <td>
                      <a class="btn btn-sm btn-primary" href="organizer_halaqah_student_checklist.php?halaqahchecklist_no=<?php echo $row['halaqahchecklistNo']; ?>&& halaqah_id=<?php echo $row['halaqahID']; ?>"><span class="fa fa-child"></span> รายชื่อผู้เข้าร่วม</a>
                    </td>
                    <td>
                      <?php if ($row['halaqahcheckliststatus'] == 'เปิดการลงทะเบียน') { ?>
                        <a href="?status_id=<?php echo $row['halaqahchecklistNo']; ?>&& halaqah_id=<?php echo $row['halaqahID']; ?>" onclick="return confirm('ต้องการปิดการลงทะเบียน ?')"><button class="btn btn-success btn-sm" data-toggle="tooltip"><?php echo $row['halaqahcheckliststatus']; ?></button></a>
                      <?php }
                      if ($row['halaqahcheckliststatus'] == 'ปิดการลงทะเบียน') {
                        echo $row['halaqahcheckliststatus'];
                      } ?>
                    </td>
                    <td>
                      <a href="?delete_id=<?php echo $row['halaqahchecklistNo']; ?>&& halaqah_id=<?php echo $row['halaqahID']; ?>" onclick="return confirm('ต้องการลบ ?')"><button class="btn btn-danger btn-sm" data-toggle="tooltip"><i class="fa fa-trash font-30"></i></button></a>
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