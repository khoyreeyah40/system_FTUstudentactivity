<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE); // avoid notice
include '../control/organizer_organization.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| จัดการองค์กร</title>
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
      <h1 class="page-title">จัดการองค์กร</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item"><a href="organizer_organizer.php">จัดการผู้จัดกิจกรรม</a></li>
        <li class="breadcrumb-item">จัดการองค์กร</li>
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
      <a href="organizer_halaqah_teacher.php"><button class="btn btn-info" type="button"> <span class="fa fa-pencil"></span> &nbsp; จัดการที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน</button></a>&nbsp;&nbsp;
      <a href="organizer_mainorg.php"><button class="btn btn-info" type="button"> <span class="fa fa-pencil"></span> &nbsp; เพิ่มรายชื่อสังกัด</button></a>
    <?php
    }
    if (($row["orgzerSec"] == "คณะ") || ($row["orgzerSec"] == "มหาวิทยาลัย")) {
    ?>
      <a href="organizer_organizer.php"><button class="btn btn-info" type="button"> <span class="fa fa-pencil"></span> &nbsp; จัดการเจ้าหน้าที่</button></a>&nbsp;&nbsp;
      <a href="organizer_halaqah_teacher.php"><button class="btn btn-info" type="button"> <span class="fa fa-pencil"></span> &nbsp; จัดการที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน</button></a>&nbsp;&nbsp;
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
    <div class="ibox" style="box-shadow: 0 5px 4px rgba(0,0,0,.1);">
      <div class="ibox-head" style="background-color:#d1cbaf;">
        <div class="ibox-title" style="color:#484848;">
          <h5>เพิ่มรายชื่อองค์กร</h5>
        </div>
        <div class="ibox-tools">
          <a class="ibox-collapse" style="color:#484848;"><i class="fa fa-minus"></i></a>
        </div>
      </div>
      <div class="ibox-body">
        <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">ชื่อองค์กร</label>
            <div class="col-sm-5">
              <input class="form-control" type="text" name="organization" value="<?php echo $organization; ?>" required />
            </div>
            <label class="col-sm-1 col-form-label">สังกัด</label>
            <div class="col-sm-5">
              <select class="form-control select2_demo_1" style="width: 100%;" name="orgtionMainorg">
                <?php
                $stmt = $session->runQuery("SELECT orgzerSec FROM organizer WHERE orgzerID = '$loginby'");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row["orgzerSec"] == "Admin") {
                ?><option selected="selected" disabled="disabled">--ระดับ--</option>
                <?php
                  include '../control/select_mainorg_all.php';
                }
                if ($row["orgzerSec"] == "คณะ") {
                  include '../control/select_mainorg_each.php';
                }
                if ($row["orgzerSec"] == "มหาวิทยาลัย") {
                  include '../control/select_mainorg_each.php';
                }
                ?>
              </select>
            </div>
          </div>
          <input class="form-control" type="hidden" name="orgtionAddby" value="<?php echo $loginby; ?>" readonly />
          <div class="form-group row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-info" type="submit" name="btaddorgtion">เพิ่ม</button>
              <a href="organizer_organization.php"><button class="btn btn-danger" type="button" data-dismiss="ibox">ยกเลิก</button></a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
          <div class="card-header" style="background-color:#d1cbaf">
            <h5 style="color:#2c2c2c">ตารางรายชื่อองค์กร</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body pad table-responsive">
            <table id="tb1" class="table table-hover-sm table-striped text-center" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>ชื่อองค์กร</th>
                  <th>ชื่อสังกัด</th>
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
                  $stmt = $session->runQuery("SELECT organization.*, mainorg.*  FROM organization 
                                                    JOIN mainorg ON organization.orgtionMainorg = mainorg.mainorgNo
                                                    ORDER BY orgtionNo DESC ");
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                      <td><?php echo $row['organization']; ?></td>
                      <td><?php echo $row['mainorg']; ?></td>
                      <td><?php echo $row['orgtionAddby']; ?></td>
                      <td>
                        <a href="organizer_organization_updateinfo.php?update_id=<?php echo $row['orgtionNo']; ?>" onclick="return confirm('ต้องการแก้ไขรายชื่อองค์กร ?')"><button class="btn btn-warning btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i></button></a>
                        <a href="?delete_id=<?php echo $row['orgtionNo']; ?>" onclick="return confirm('ต้องการลบรายชื่อองค์กร ?')"><button class="btn btn-danger btn-sm" data-toggle="tooltip"><i class="fa fa-trash font-30"></i></button></a>
                      </td>
                    </tr>
                  <?php
                  }
                }
                if ($row["orgzerSec"] == "คณะ") {
                  $org = $row['orgzerMainorg'];
                  $stmt = $session->runQuery("SELECT organization.*, mainorg.*  FROM organization 
                                                    JOIN mainorg ON organization.orgtionMainorg = mainorg.mainorgNo
                                                    WHERE organization.orgtionMainorg = '$org'
                                                    ORDER BY orgtionNo DESC ");
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <tr>
                      <td><?php echo $row['organization']; ?></td>
                      <td><?php echo $row['mainorg']; ?></td>
                      <td><?php echo $row['orgtionAddby']; ?></td>
                      <td>
                        <a href="organizer_organization_updateinfo.php?update_id=<?php echo $row['orgtionNo']; ?>"  onclick="return confirm('ต้องการแก้ไขรายชื่อองค์กร ?')"><button class="btn btn-warning btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i></button></a>
                        <a href="?delete_id=<?php echo $row['orgtionNo']; ?>"  onclick="return confirm('ต้องการลบรายชื่อองค์กร ?')"><button class="btn btn-danger btn-sm" data-toggle="tooltip"><i class="fa fa-trash font-30"></i></button></a>
                      </td>
                    </tr>
                    <!-- /.แก้แสดงองค์กร -->
                  <?php
                  }
                }
                if ($row["orgzerSec"] == "มหาวิทยาลัย") {
                  $org = $row['orgzerSec'];
                  $stmt = $session->runQuery("SELECT mainorg.*, organization.* FROM mainorg  
                                                      INNER JOIN organization ON mainorg.mainorgNo = organization.orgtionMainorg
                                                      WHERE mainorg.mainorgSec = '$org' ORDER BY orgtionNo DESC ");
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <tr>
                      <td><?php echo $row['organization']; ?></td>
                      <td><?php echo $row['mainorg']; ?></td>
                      <td><?php echo $row['orgtionAddby']; ?></td>
                      <td>
                        <a href="organizer_organization_updateinfo.php?update_id=<?php echo $row['orgtionNo']; ?>" onclick="return confirm('ต้องการแก้ไขรายชื่อองค์กร ?')"><button class="btn btn-warning btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i></button></a>
                        <a href="?delete_id=<?php echo $row['orgtionNo']; ?>"  onclick="return confirm('ต้องการลบรายชื่อองค์กร ?')"><button class="btn btn-danger btn-sm" data-toggle="tooltip"><i class="fa fa-trash font-30"></i></button></a>
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