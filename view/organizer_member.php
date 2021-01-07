<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE); // avoid notice
include '../control/organizer_member.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| จัดการผู้ดูแลระบบ</title>
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
      <h1 class="page-title">จัดการผู้ดูแลระบบ</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item">จัดการผู้ดูแลระบบ</li>
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
    <div class="ibox" style="box-shadow: 0 5px 4px rgba(0,0,0,.1);">
      <div class="ibox-head" style="background-color:#d1cbaf;">
        <div class="ibox-title" style="color:#484848;">
          <h5>เพิ่มผู้ดูแลระบบ</h5>
        </div>
        <div class="ibox-tools">
          <a class="ibox-collapse" style="color:#484848;"><i class="fa fa-minus"></i></a>
        </div>
      </div>
      <div class="ibox-body">
        <form class="form-horizontal" enctype="multipart/form-data" id="form-sample-1" method="post" novalidate="novalidate">
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">ชื่อ-สกุล</label>
            <div class="col-sm-5">
              <input class="form-control" type="text" name="orgzerName" value="<?php echo $orgzerName; ?>" autocomplete="off" required />
            </div>
            <label class="col-sm-1 col-form-label">สถานะ</label>
            <div class="col-sm-5">
              <select class="form-control" style="width: 100%;" name="orgzeruserType" readonly />
              <?php
              $stmt = $session->runQuery("SELECT usertype.*, organizer.* FROM organizer
                                      JOIN usertype ON organizer.orgzeruserType = usertype.usertypeID 
                                      WHERE organizer.orgzerID='$loginby' ");
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $userTypeNo = $row["usertypeID"];
                $userTypelist = $row["userType"];
              ?>
                <option value="<?php echo $userTypeNo ?>"> <?php echo $userTypelist ?></option>
              <?php
              }
              ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">กลุ่ม</label>
            <div class="col-sm-5">
              <select class="form-control" style="width: 100%;" name="orgzerGroup" readonly />
              <?php
              $stmt = $session->runQuery("SELECT orgzerGroup FROM organizer WHERE orgzerID = '$loginby'");
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $orgzerGrouplist = $row["orgzerGroup"];
              ?>
                <option value="<?php echo $orgzerGrouplist ?>"> <?php echo $orgzerGrouplist ?></option>
              <?php
              }
              ?>
              </select>
            </div>
            <label class="col-sm-1 col-form-label">ระดับ</label>
            <div class="col-sm-5">
              <select class="form-control" style="width: 100%;" name="orgzerSec" readonly />
              <?php
              $stmt = $session->runQuery("SELECT orgzerSec FROM organizer WHERE orgzerID = '$loginby'");
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $orgzerSeclist = $row["orgzerSec"];
              ?>
                <option value="<?php echo $orgzerSeclist ?>"> <?php echo $orgzerSeclist ?></option>
              <?php
              }
              ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">สังกัด</label>
            <div class="col-sm-5">
              <select class="form-control" style="width: 100%;" name="orgzerMainorg" readonly />
              <?php
              include '../control/select_mainorg_each.php';
              ?>
              </select>
            </div>
            <label class="col-sm-1 col-form-label">องค์กร</label>
            <div class="col-sm-5">
              <select class="form-control" style="width: 100%;" name="orgzerOrgtion" readonly />
              <?php
              include '../control/select_orgtion_each.php'
              ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">หมายเลขโทรศัพท์</label>
            <div class="col-sm-5">
              <input class="form-control" id="ex-phone" type="text" name="orgzerPhone" value="<?php echo $orgzerPhone; ?>" autocomplete="off" required />
            </div>
            <label class="col-sm-1 col-form-label">E-mail</label>
            <div class="col-sm-5">
              <input class="form-control" type="email" name="orgzerEmail" value="<?php echo $orgzerEmail; ?>" placeholder="example@email.com" autocomplete="off" required />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">Facebook</label>
            <div class="col-sm-5">
              <input class="form-control" type="text" name="orgzerFb" value="<?php echo $orgzerFb; ?>" autocomplete="off" required />
            </div>
            <label class="col-sm-1 col-form-label">รหัสผ่าน</label>
            <div class="col-sm-5">
              <input class="form-control" id="password" type="password" minlength=8 maxlength=10 name="orgzerPassword" placeholder="password" value="<?php echo $orgzerPassword; ?>" autocomplete="off" required />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">รูปประจำตัว</label>
            <div class="col-sm-5">
              <input class="input-group" type="file" name="Image" accept="image/*" />
            </div>
            <label class="col-sm-1 col-form-label">เพิ่มโดย</label>
            <div class="col-sm-5">
              <input class="form-control" type="text" name="orgzerAddby" value="<?php echo $loginby; ?>" readonly />
            </div>
            <div class="col-sm-5">
              <input class="form-control" type="hidden" name="orgzerID" value="ID" readonly />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-info" type="submit" name="btaddorgzer">เพิ่ม</button>
              <a href="organizer_member.php"><button class="btn btn-danger" type="button" data-dismiss="ibox">ยกเลิก</button></a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
          <div class="card-header" style="background-color:#d1cbaf;">
            <h5 style="color:#2c2c2c;">ตารางผู้ดูแลระบบ</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body text-nowrap">
            <table id="tborganizer" class="table table-hover-sm table-striped text-center" cellspacing="0" width="100%">
              <thead>
                <tr style="color:#528124;">
                  <th>รหัสผู้ใช้</th>
                  <th>ชื่อ-สกุล</th>
                  <th>หมายเลขโทรศัพท์</th>
                  <th>รหัสผ่าน</th>
                  <th>เพิ่มโดย</th>
                  <th>แก้ไข/ลบ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt = $session->runQuery("SELECT orgzerGroup,orgzerOrgtion,orgzerMainorg,orgzeruserType FROM organizer WHERE orgzerID = '$loginby'");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $group = $row["orgzerGroup"];
                $orgtion = $row["orgzerOrgtion"];
                $mainorg = $row["orgzerMainorg"];
                $usertype = $row["orgzeruserType"];

                $stmt = $session->runQuery("SELECT organizer.*, usertype.*, mainorg.*, organization.* 
                                            FROM organizer
                                            JOIN usertype ON organizer.orgzeruserType = usertype.usertypeID
                                            JOIN mainorg ON organizer.orgzerMainorg = mainorg.mainorgNo
                                            JOIN organization ON organizer.orgzerOrgtion = organization.orgtionNo 
                                            WHERE orgzerGroup='$group' && orgzerOrgtion='$orgtion' && orgzerMainorg='$mainorg' && orgzeruserType='$usertype' && orgzerID !='$loginby' 
                                            ORDER BY organizer.orgzerID DESC");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                    <td><a href="" data-toggle="modal" data-target="#modalmoreinfo" data-id="<?php echo $row['orgzerID']; ?>" id="moreinfo"><?php echo $row['orgzerID']; ?></a></td>
                    <td><?php echo $row['orgzerName']; ?></td>
                    <td><?php echo $row['orgzerPhone']; ?></td>
                    <td><?php echo $row['orgzerPassword']; ?></td>
                    <td><?php echo $row['orgzerAddby']; ?></td>
                    <td>
                      <a href="organizer_member_updateinfo.php?update_id=<?php echo $row['orgzerID']; ?>"  onclick="return confirm('ต้องการแก้ไขข้อมูล ?')"><button class="btn btn-warning btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i></button></a>
                      <a href="?delete_id=<?php echo $row['orgzerID']; ?>"  onclick="return confirm('ต้องการลบสมาชิก ?')"><button class="btn btn-danger btn-sm" data-toggle="tooltip"><i class="fa fa-trash font-30"></i></button></a>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="modal fade" id="modalmoreinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content ">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle" style="color:#528124;">รายละเอียดเพิ่มเติม</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div id="modal-loader" style="text-align: center; display: none;">
                    <img src="ajax-loader.gif">
                  </div>
                  <div id="dynamic-content">

                  </div>
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
  <script>
    /* View Function*/
    $(document).ready(function() {

      $(document).on('click', '#moreinfo', function(e) {

        e.preventDefault();

        var orgzerid = $(this).data('id'); // it will get id of clicked row

        $('#dynamic-content').html(''); // leave it blank before ajax call
        $('#modal-loader').show(); // load ajax loader

        $.ajax({
            url: 'moreorgzerinfo.php',
            type: 'POST',
            data: 'id=' + orgzerid,
            dataType: 'html'
          })
          .done(function(data) {
            console.log(data);
            $('#dynamic-content').html('');
            $('#dynamic-content').html(data); // load response 
            $('#modal-loader').hide(); // hide ajax loader 
          })
          .fail(function() {
            $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader').hide();
          });

      });

    });
  </script>
</body>

</html>