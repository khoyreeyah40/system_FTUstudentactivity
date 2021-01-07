<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE); // avoid notice
include '../control/organizer_teacher.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| จัดการรายชื่ออาจารย์</title>
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
      <h1 class="page-title">จัดการรายชื่ออาจารย์</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item"><a href="organizer_studentall.php">จัดการรายชื่อนักศึกษา</a></li>
        <li class="breadcrumb-item">จัดการรายชื่ออาจารย์</li>
      </ol>
    </div>
    <br>
    <a href="organizer_studentall_search.php"><button class="btn btn-info" type="button"> <span class="fa fa-pencil"></span> &nbsp; จัดการนักศึกษา</button></a>&nbsp;&nbsp;
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
    <div class="ibox" style="box-shadow: 0 5px 4px rgba(0,0,0,.1);">
      <div class="ibox-head" style="background-color:#d1cbaf;">
        <div class="ibox-title" style="color:#484848;">
          <h5>เพิ่มรายชื่ออาจารย์</h5>
        </div>
        <div class="ibox-tools">
          <a class="ibox-collapse" style="color:#484848;"><i class="fa fa-minus"></i></a>
        </div>
      </div>
      <div class="ibox-body">
        <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
          <div class="form-group row">

            <label class="col-sm-1 col-form-label">ชื่ออาจารย์</label>
            <div class="col-sm-5">
              <input class="form-control" type="text" name="teacher" value="<?php echo $teacher; ?>" required />
            </div>
            <label class="col-sm-1 col-form-label">คณะ</label>
            <div class="col-sm-5">
              <select class="form-control select2_demo_1" style="width: 100%;" name="teacherMainorg" required />
              <?php
              $stmt = $session->runQuery("SELECT orgzerSec FROM organizer WHERE orgzerID = '$loginby'");
              $stmt->execute();
              $row = $stmt->fetch(PDO::FETCH_ASSOC);
              if ($row["orgzerSec"] == "Admin") {
              ?><option disabled="disabled">--กรุณาเลือกคณะ--</option><?php
                                                                          include '../control/select_faculty_all.php';
                                                                        }
                                                                        if ($row["orgzerSec"] == "คณะ") {
                                                                          include '../control/select_faculty_each.php';
                                                                        }
                                                                          ?>
              </select>
            </div>
          </div>
          <input class="form-control" type="hidden" name="teacherAddby" value="<?php echo $loginby; ?>" readonly />
          <div class="form-group row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-info" type="submit" name="btaddteacher">เพิ่ม</button>
              <a href="organizer_teacher.php"><button class="btn btn-danger" type="button" data-dismiss="ibox">ยกเลิก</button></a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
          <div class="card-header" style="background-color:#d1cbaf">
            <h5 style="color:#2c2c2c">ตารางรายชื่ออาจารย์</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body text-nowrap">
            <table id="tbteacher" class="table table-hover-sm table-striped text-center" cellspacing="0" width="100%">
              <thead>
                <tr style="color:#528124;">
                  <th>ชื่ออาจารย์</th>
                  <th>คณะ</th>
                  <th>เพิ่มโดย</th>
                  <th>แก้ไข/ลบ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt = $session->runQuery("SELECT orgzerSec,orgzerMainorg FROM organizer WHERE orgzerID = '$loginby'");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row["orgzerSec"] == "Admin") {
                  $stmt = $session->runQuery("SELECT mainorg.*, teacher.* FROM teacher
                                                JOIN mainorg ON mainorg.mainorgNo = teacher.teacherMainorg
                                                ORDER BY teacher.teacherNo DESC");
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                      <td><?php echo $row['teacher']; ?></td>
                      <td><?php echo $row['mainorg']; ?></td>
                      <td><?php echo $row['teacherAddby']; ?></td>
                      <td>
                        <a href="organizer_teacher_updateinfo.php?update_id=<?php echo $row['teacherNo']; ?>"  onclick="return confirm('ต้องการแก้ไขรายชื่ออาจารย์ ?')"><button class="btn btn-warning btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i></button></a>
                        <a href="?delete_id=<?php echo $row['teacherNo']; ?>" onclick="return confirm('ต้องการลบ ?')"><button class="btn btn-danger btn-sm" data-toggle="tooltip"><i class="fa fa-trash font-30"></i></button></a>
                      </td>
                    </tr>
                  <?php
                  }
                }
                if ($row["orgzerSec"] == "คณะ") {
                  $m = $row["orgzerMainorg"];
                  $stmt = $session->runQuery("SELECT mainorg.*, teacher.* FROM teacher
                                                        JOIN mainorg ON mainorg.mainorgNo = teacher.teacherMainorg
                                                        WHERE teacher.teacherMainorg ='$m'
                                                        ORDER BY teacher.teacherNo DESC");
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <tr>
                      <td><?php echo $row['teacher']; ?></td>
                      <td><?php echo $row['mainorg']; ?></td>
                      <td><?php echo $row['teacherAddby']; ?></td>
                      <td>
                        <a href="organizer_teacher_updateinfo.php?update_id=<?php echo $row['teacherNo']; ?>" onclick="return confirm('ต้องการแก้ไขรายชื่ออาจารย์ ?')"><button class="btn btn-warning btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i></button></a>
                        <a href="?delete_id=<?php echo $row['teacherNo']; ?>"  onclick="return confirm('ต้องการลบ ?')"><button class="btn btn-danger btn-sm" data-toggle="tooltip"><i class="fa fa-trash font-30"></i></button></a>
                      </td>
                    </tr>
                <?php
                  }
                }
                ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
  <!-- CORE PLUGINS-->
  <?php include 'footer.php'; ?>
</body>

</html>