<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE); // avoid notice
include '../control/organizer_halaqah_teacher.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| ที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน</title>
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
      <h1 class="page-title">จัดการที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item"><a href="organizer_organizer.php">จัดการเจ้าหน้าที่</a> </li>
        <li class="breadcrumb-item">จัดการที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน</li>
      </ol>
    </div>
    <br>
    <?php
    $stmt = $session->runQuery("SELECT orgzerSec FROM organizer WHERE orgzerID = '$loginby'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row["orgzerSec"] == "Admin") {
    ?>
      <a href="organizer_organizer.php"><button class="btn btn-info" type="button"> <span class="fa fa-pencil"></span> &nbsp; จัดการเจ้าหน้าที่</button></a>&nbsp;&nbsp;
      <a href="organizer_usertype.php"><button class="btn btn-info" type="button"> <span class="fa fa-pencil"></span> &nbsp; จัดการประเภทผู้ใช้</button></a>&nbsp;&nbsp;
      <a href="organizer_organization.php"><button class="btn btn-info" type="button"> <span class="fa fa-pencil"></span> &nbsp; เพิ่มรายชื่อองค์กร</button></a>&nbsp;&nbsp;
      <a href="organizer_mainorganization.php"><button class="btn btn-info" type="button"> <span class="fa fa-pencil"></span> &nbsp; เพิ่มรายชื่อสังกัด</button></a>
    <?php
    }
    if (($row["orgzerSec"] == "คณะ") || ($row["orgzerSec"] == "มหาวิทยาลัย")) {
    ?>
      <a href="organizer_organizer.php"><button class="btn btn-info" type="button"> <span class="fa fa-pencil"></span> &nbsp; จัดการเจ้าหน้าที่</button></a>&nbsp;&nbsp;
      <a href="organizer_organization.php"><button class="btn btn-info" type="button"> <span class="fa fa-pencil"></span> &nbsp; เพิ่มรายชื่อองค์กร</button></a>&nbsp;&nbsp;
    <?php
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
    <div class="row justify-content-center">
      <div class="col-sm-12 ">
        <div class="ibox">
          <div class="ibox-body">
            <form method="post">
              <div class="form-group row" style="margin-bottom: 0rem;">
                <div class="col-sm-2">
                  <select class="form-control select2_demo_1" style="width: 100%;" name="halaqahtcYear">
                    <?php
                    include '../control/select_activity_year.php';
                    ?>
                  </select>
                </div>
                <div class="col-sm-5">
                  <select class="form-control select2_demo_1" style="width: 100%;" name="halaqahtcID" required>
                    <option selected="selected" disabled="disabled">--ที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน--</option>
                    <?php
                    $stmt = $session->runQuery("SELECT orgzerSec,orgzerMainorg FROM organizer WHERE orgzerID = '$loginby'");
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($row["orgzerSec"] == "Admin") {
                      $stmt = $session->runQuery("SELECT usertype.*, organizer.* FROM organizer 
                                                  JOIN usertype ON usertype.usertypeID = organizer.orgzeruserType
                                                  WHERE usertype.userType= 'ที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน'
                                                  ORDER BY organizer.orgzerID  DESC");
                      $stmt->execute();
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $orgzerID = $row["orgzerID"];
                        $orgzerName = $row["orgzerName"];
                    ?>
                        <option value="<?php echo $orgzerID ?>"> <?php echo $orgzerID ?>: <?php echo $orgzerName ?></option>
                      <?php
                      }
                    }
                    if ($row["orgzerSec"] == "คณะ") {
                      $mainorg = $row["orgzerMainorg"];
                      $stmt = $session->runQuery("SELECT usertype.*, organizer.* FROM organizer 
                                                  JOIN usertype ON usertype.usertypeID = organizer.orgzeruserType
                                                  WHERE usertype.userType= 'ที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน' && organizer.orgzerMainorg = '$mainorg' 
                                                  ORDER BY organizer.orgzerID  DESC");
                      $stmt->execute();
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $orgzerID = $row["orgzerID"];
                        $orgzerName = $row["orgzerName"];
                      ?>
                        <option value="<?php echo $orgzerID ?>"> <?php echo $orgzerID ?>: <?php echo $orgzerName ?></option>
                      <?php
                      }
                    }
                    if ($row["orgzerSec"] == "มหาวิทยาลัย") {
                      $sec = $row["orgzerSec"];
                      $stmt = $session->runQuery("SELECT usertype.*, organizer.* FROM organizer 
                                                            JOIN usertype ON usertype.usertypeID = organizer.orgzeruserType
                                                            WHERE usertype.userType= 'ที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน' && organizer.orgzerSec = '$sec' 
                                                            ORDER BY organizer.orgzerID  DESC");
                      $stmt->execute();
                      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $orgzerID = $row["orgzerID"];
                        $orgzerName = $row["orgzerName"];
                      ?>
                        <option value="<?php echo $orgzerID ?>"> <?php echo $orgzerID ?>: <?php echo $orgzerName ?></option>
                    <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="col-sm-4">
                  <select class="form-control select2_demo_1" style="width: 100%;" name="halaqahtcMainorg">
                    <?php
                    $stmt = $session->runQuery("SELECT orgzerSec FROM organizer WHERE orgzerID = '$loginby'");
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($row["orgzerSec"] == "Admin") {
                    ?><option selected="selected" disabled="disabled">--สังกัด--</option>
                    <?php
                      include '../control/select_mainorg_all.php';
                    }
                    if ($row["orgzerSec"] == "คณะ") {
                    ?><option selected="selected" disabled="disabled">--สังกัด--</option>
                    <?php
                      include '../control/select_mainorg_each.php';
                    }
                    if ($row["orgzerSec"] == "มหาวิทยาลัย") {
                    ?><option selected="selected" disabled="disabled">--สังกัด--</option>
                    <?php
                      include '../control/select_mainorg_eachsec.php';
                    }
                    ?>
                  </select>
                </div>
                <input class="form-control" type="hidden" name="halaqahtcAddby" value="<?php echo $loginby; ?>" readonly />
                <div class="col-sm-1 text-center">
                  <button class="btn btn-info" type="submit" name="btaddhalaqahtc">เพิ่ม</button>
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
            <h5 style="color:#2c2c2c">ตารางรายชื่อที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body text-nowrap">
            <table id="tb1" class="table table-hover-sm table-striped text-center" cellspacing="0" width="100%">
              <thead>
                <tr style="color:#528124;">
                  <th>รหัสกลุ่ม</th>
                  <th>ปีการศึกษา</th>
                  <th>ชื่อที่ปรึกษา</th>
                  <th>องค์กร/คณะ</th>
                  <th>รายชื่อนักศึกษา</th>
                  <th>สถานะ</th>
                  <th>แก้ไข/ลบ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt = $session->runQuery("SELECT orgzerSec,orgzerMainorg FROM organizer WHERE orgzerID = '$loginby'");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row["orgzerSec"] == "Admin") {
                  $stmt = $session->runQuery("SELECT halaqahtc.*, organizer.*, mainorg.*, actyear.* FROM halaqahtc 
                                          JOIN organizer ON organizer.orgzerID = halaqahtc.halaqahtcID
                                          JOIN mainorg ON mainorg.mainorgNo = halaqahtc.halaqahtcMainorg
                                          JOIN actyear ON actyear.actyear = halaqahtc.halaqahtcYear 
                                          ORDER BY halaqahtc.halaqahtcCreateat  DESC");
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                      <td><?php echo $row['halaqahtcNo']; ?></td>
                      <td><?php echo $row['halaqahtcYear']; ?></td>
                      <td><?php echo $row['orgzerID']; ?>: <?php echo $row['orgzerName']; ?></td>
                      <td><?php echo $row['mainorg']; ?></td>
                      <td>
                        <a href="organizer_halaqah_student_add.php?halaqah_id=<?php echo $row['halaqahtcNo']; ?>"><button class="btn btn-info btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-child font-30"></i>รายชื่อนักศึกษา</button></a>
                      </td>
                      <td><?php echo $row['actyearStatus']; ?></td>
                      <td>
                        <a href="organizer_halaqah_teacher_updateinfo.php?update_id=<?php echo $row['halaqahtcNo']; ?>"  onclick="return confirm('ต้องการแก้ไขข้อมูล ?')"><button class="btn btn-warning btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i></button></a>
                        <a href="?delete_id=<?php echo $row['halaqahtcNo']; ?>" onclick="return confirm('ต้องการลบ ?')"><button class="btn btn-danger btn-sm" data-toggle="tooltip"><i class="fa fa-trash font-30"></i></button></a>
                      </td>
                    </tr>
                  <?php
                  }
                }
                if ($row["orgzerSec"] == "คณะ") {
                  $main = $row["orgzerMainorg"];
                  $stmt = $session->runQuery("SELECT halaqahtc.*, organizer.*, mainorg.*, actyear.* FROM halaqahtc 
                                          JOIN organizer ON organizer.orgzerID = halaqahtc.halaqahtcID
                                          JOIN mainorg ON mainorg.mainorgNo = halaqahtc.halaqahtcMainorg
                                          JOIN actyear ON actyear.actyear = halaqahtc.halaqahtcYear 
                                          WHERE halaqahtc.halaqahtcMainorg = '$main'
                                          ORDER BY halaqahtc.halaqahtcCreateat  DESC");
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <tr>
                      <td><?php echo $row['halaqahtcNo']; ?></td>
                      <td><?php echo $row['halaqahtcYear']; ?></td>
                      <td><?php echo $row['orgzerID']; ?>: <?php echo $row['orgzerName']; ?></td>
                      <td><?php echo $row['mainorg']; ?></td>
                      <td>
                        <a href="organizer_halaqah_student_add.php?halaqah_id=<?php echo $row['halaqahtcNo']; ?>"><button class="btn btn-info btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-child font-30"></i>รายชื่อนักศึกษา</button></a>
                      </td>
                      <td><?php echo $row['actyearStatus']; ?></td>
                      <td>
                        <a href="organizer_halaqah_teacher.php?update_id=<?php echo $row['halaqahtcNo']; ?>"  onclick="return confirm('ต้องการแก้ไขข้อมูล ?')"><button class="btn btn-warning btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i></button></a>
                        <a href="?delete_id=<?php echo $row['halaqahtcNo']; ?>" onclick="return confirm('ต้องการลบ ?')"><button class="btn btn-danger btn-sm" data-toggle="tooltip"><i class="fa fa-trash font-30"></i></button></a>
                      </td>
                    </tr>
                  <?php
                  }
                }
                if ($row["orgzerSec"] == "มหาวิทยาลัย") {
                  $sec = $row["orgzerSec"];
                  $stmt = $session->runQuery("SELECT halaqahtc.*, organizer.*, mainorg.*, actyear.* FROM halaqahtc 
                                          JOIN organizer ON organizer.orgzerID = halaqahtc.halaqahtcID
                                          JOIN mainorg ON mainorg.mainorgNo = halaqahtc.halaqahtcMainorg
                                          JOIN actyear ON actyear.actyear = halaqahtc.halaqahtcYear 
                                          WHERE organizer.orgzerSec = '$sec'
                                          ORDER BY halaqahtc.halaqahtcCreateat  DESC");
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <tr>
                      <td><?php echo $row['halaqahtcNo']; ?></td>
                      <td><?php echo $row['halaqahtcYear']; ?></td>
                      <td><?php echo $row['orgzerID']; ?>: <?php echo $row['orgzerName']; ?></td>
                      <td><?php echo $row['mainorg']; ?></td>
                      <td>
                        <a href="organizer_halaqah_student_add.php?halaqah_id=<?php echo $row['halaqahtcNo']; ?>"><button class="btn btn-info btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-child font-30"></i>รายชื่อนักศึกษา</button></a>
                      </td>
                      <td><?php echo $row['actyearStatus']; ?></td>
                      <td>
                        <a href="organizer_halaqah_teacher_updateinfo.php?update_id=<?php echo $row['halaqahtcNo']; ?>" onclick="return confirm('ต้องการแก้ไขข้อมูล ?')"><button class="btn btn-warning btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i></button></a>
                        <a href="?delete_id=<?php echo $row['halaqahtcNo']; ?>"  onclick="return confirm('ต้องการลบ ?')"><button class="btn btn-danger btn-sm" data-toggle="tooltip"><i class="fa fa-trash font-30"></i></button></a>
                      </td>
                    </tr>
                <?php
                  }
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