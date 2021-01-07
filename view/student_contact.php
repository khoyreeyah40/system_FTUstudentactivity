<?php include '../control/session_student.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| ติดต่อ</title>
  <?php include 'header.php'; ?>

  <style>
    .breadcrumb-item {
      font-size: 16px;
    }

    .ibox {
      position: relative;
      margin-bottom: 25px;
      background-color: #fff;
      -webkit-box-shadow: 1px 1px 1px 1px rgba(1, 1, 1, .1);
      box-shadow: 1px 1px 1px 1px rgba(1, 1, 1, .1);
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
      <h1 class="page-title">ติดต่อ</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item">ติดต่อ</li>
      </ol>
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
    <br>
    <div class="ibox">
      <div class="ibox-body" style="background-color:#FFFFFF; font-size:15px;">
        <span class="fa fa-home" style="color:#528124; font-size:18px;"> :</span> สำนักพัฒนาศักยภาพนักศึกษา มหาวิทยาลัยฟาฏอนี ชั้น2 ณ อาคารเฉลิมพระเกียรติ มหาวิทยาลัยฟาฏอนี 135/8 ม.3 ต.เขาตูม อ.ยะรัง จ.ปัตตานี 94106
        <br><span class="fa fa-globe" style="color:#528124; font-size:18px;"> :</span> <a href="http://www.ftu.ac.th/2019/index.php/th/" target="_blank"> มหาวิทยาลัยฟาฏอนี</a>
        <br><span class="fa fa-facebook" style="color:#528124; font-size:18px;"> :</span> <a href="https://web.facebook.com/StudentAffairsFTU/" target="_blank"> สำนักพัฒนาศักยภาพนักศึกษา</a>
        <br><span class="fa fa-facebook" style="color:#528124; font-size:18px;"> :</span> <a href="https://web.facebook.com/StudentUnionOfFTU/" target="_blank"> องค์การบริหารนักศึกษาหญิง</a>
        <br><span class="fa fa-facebook" style="color:#528124; font-size:18px;"> :</span> <a href="https://web.facebook.com/StudentunionFTU/" target="_blank"> องค์การบริการนักศึกษาชาย</a>
        <br><span class="fa fa-phone" style="color:#528124; font-size:18px;"> :</span> 081-678-5532, 0-7341-8613
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
          <div class="card-header" style="background-color:#d1cbaf">
            <h5 style="color:#2c2c2c">ตารางรายชื่อเจ้าหน้าที่</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body text-nowrap">
            <table id="tb1" class="table table-hover-sm table-striped text-center" cellspacing="0" width="100%">
              <thead>
                <tr style="color:#528124;">
                  <th>รหัสผู้ใช้</th>
                  <th>ชื่อ-สกุล</th>
                  <th>กลุ่ม</th>
                  <th>สังกัด</th>
                  <th>องค์กร</th>
                  <th>หมายเลขโทรศัพท์</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $stmt = $session->runQuery("SELECT organizer.*, mainorg.*,organization.*, usertype.* FROM organizer
                                          JOIN usertype ON organizer.orgzeruserType = usertype.usertypeID 
                                          JOIN mainorg ON organizer.orgzerMainorg = mainorg.mainorgNo 
                                          JOIN organization ON organizer.orgzerOrgtion = organization.orgtionNo  ORDER BY orgzerID DESC");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                    <td><a href="javascript:;"><?php echo $row['orgzerID']; ?></a></td>
                    <td><?php echo $row['orgzerName']; ?></td>
                    <td><?php echo $row['orgzerGroup']; ?></td>
                    <td><?php echo $row['mainorg']; ?></td>
                    <td><?php echo $row['organization']; ?></td>
                    <td><?php echo $row['orgzerPhone']; ?></td>
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