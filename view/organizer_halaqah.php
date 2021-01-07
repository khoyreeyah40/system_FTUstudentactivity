<?php include '../control/session_organizer.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| จัดการกลุ่มศึกษาอัลกุรอ่าน</title>
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
      <h1 class="page-title">จัดการกลุ่มศึกษาอัลกุรอ่าน</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item">จัดการกลุ่มศึกษาอัลกุรอ่าน</li>
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
    <div class="row">
      <div class="col-12">
        <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
          <div class="card-header" style="background-color:#d1cbaf">
            <h5 style="color:#2c2c2c">ตารางกลุ่มศึกษาอัลกุรอ่านของฉัน</h5>
          </div>
          <div class="card-body text-nowrap">
            <table id="tb1" class="table table-hover-sm table-striped" cellspacing="0" width="100%">
              <thead>
                <tr style="color:#528124;">
                  <th>ปีการศึกษา</th>
                  <th>รหัสกลุ่ม</th>
                  <th>รายชื่อนักศึกษา</th>
                  <th>การเข้าร่วมภาคเรียนที่ 1</th>
                  <th>การเข้าร่วมภาคเรียนที่ 2</th>
                  <th>สถานะ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt = $session->runQuery("SELECT halaqahtc.*,actyear.*, organizer.* FROM halaqahtc
                                        JOIN actyear ON actyear.actyear = halaqahtc.halaqahtcYear
                                        JOIN organizer ON organizer.orgzerID = halaqahtc.halaqahtcID
                                        WHERE organizer.orgzerID = '$loginby'
                                        ORDER BY halaqahtc.halaqahtcCreateat  DESC");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                    <td><?php echo $row['halaqahtcYear']; ?></td>
                    <td><?php echo $row['halaqahtcNo']; ?></td>
                    <td>
                      <a href="organizer_halaqah_student.php?halaqah_id=<?php echo $row['halaqahtcNo']; ?>"><button class="btn btn-info btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-child font-30"></i>รายชื่อนักศึกษา</button></a>
                    </td>
                    <td>
                      <a href="organizer_halaqah_checklist_sem1.php?halaqah_id=<?php echo $row['halaqahtcNo']; ?>"><button class="btn btn-primary btn-sm m-r-5" data-toggle="tooltip"></i>การเข้าร่วมภาคเรียนที่ 1</button></a>
                    </td>
                    <td>
                      <a href="organizer_halaqah_checklist_sem2.php?halaqah_id=<?php echo $row['halaqahtcNo']; ?>"><button class="btn btn-primary btn-sm m-r-5" data-toggle="tooltip"></i>การเข้าร่วมภาคเรียนที่ 2</button></a>
                    </td>
                    <td><?php echo $row['actyearStatus']; ?></td>
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