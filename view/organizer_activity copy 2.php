<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE); // avoid notice
include '../control/organizer_activity.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| จัดการกิจกรรม</title>
  <?php include 'header.php'; ?>
  <link rel="stylesheet" href="../assets/vendors/daterangepicker/daterangepicker.css">

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
      <h2 class="page-title">จัดการกิจกรรม</h2>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item">เพิ่มกิจกรรม</li>
      </ol>
    </div>
    <br>
    <a href="organizer_activity_year_each.php"><button class="btn btn-info" type="button"> &nbsp; ตารางกิจกรรมในแต่ละปี</button></a>
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
          <h5>เพิ่มกิจกรรม</h5>
        </div>
        <div class="ibox-tools">
          <a class="ibox-collapse" style="color:#484848;"><i class="fa fa-minus"></i></a>
        </div>
      </div>
      <div class="ibox-body">
        <form class="form-horizontal" enctype="multipart/form-data" id="form-sample-1" method="post" novalidate="novalidate">
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">ปีการศึกษา</label>
            <div class="col-sm-5">
              <select class="form-control" style="width: 100%;" name="actYear" required />
              <?php include '../control/select_activity_year.php'; ?>
              </select>
            </div>
            <label class="col-sm-1 col-form-label">ภาคเรียน</label>
            <div class="col-sm-5">
              <select class="form-control select2_demo_1" style="width: 100%;" name="actSem" required />
              <option selected="selected" disabled="disabled">--ภาคเรียน--</option>
              <option value="1">ภาคเรียนที่ 1</option>
              <option value="2">ภาคเรียนที่ 2</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">ชื่อกิจกรรม</label>
            <div class="col-sm-5">
              <input class="form-control" type="text" name="actName" value="<?php echo $actName; ?>" required />
            </div>
            <label class="col-sm-1 col-form-label">กลุ่ม</label>
            <div class="col-sm-5">
              <select class="form-control select2_demo_1" style="width: 100%;" name="actGroup" required />
              <option selected="selected" disabled="disabled">--กลุ่ม--</option>
              <?php include '../control/select_group_each.php'; ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">ระดับ</label>
            <div class="col-sm-5">
              <select class="form-control select2_demo_1" style="width: 100%;" name="actSec">
                <?php include '../control/select_section_each.php'; ?>
              </select>
            </div>
            <label class="col-sm-1 col-form-label">สังกัด</label>
            <div class="col-sm-5">
              <select class="form-control select2_demo_1" style="width: 100%;" name="actMainorg">
                <?php include '../control/select_mainorg_each.php'; ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">องค์กร</label>
            <div class="col-sm-5">
              <select class="form-control select2_demo_1" style="width: 100%;" name="actOrgtion" required />
              <?php include '../control/select_orgtion_each.php'; ?>
              </select>
            </div>
            <label class="col-sm-1 col-form-label">หมวดหมู่</label>
            <div class="col-sm-5">
              <select class="form-control select2_demo_1" style="width: 100%;" name="actType" required />
              <option selected="selected" disabled="disabled">--หมวดหมู่--</option>
              <?php include '../control/select_activity_type.php'; ?>
              </select>
            </div>
            <label class="col-sm-12 col-form-label">หลักการและเหตุผล</label>
            <div class="col-sm-12">
              <textarea class="form-control" rows="2" type="text" placeholder="-ถ้ามี-" name="actReason" value="<?php echo $actReason; ?>"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-12 col-form-label">วัตถุประสงค์โครงการ</label>
            <div class="col-sm-12">
              <textarea class="form-control" rows="2" type="text" placeholder="-ถ้ามี-" name="actPurpose" value="<?php echo $actPurpose; ?>"></textarea>
            </div>
            <label class="col-sm-12 col-form-label">รูปแบบหรือลักษณะการดำเนินการ</label>
            <div class="col-sm-12">
              <textarea class="form-control" rows="2" type="text" placeholder="-ถ้ามี-" name="actStyle" value="<?php echo $actStyle; ?>"></textarea>
            </div>
          </div>
          <div class="form-group row" id="date_5">
            <label class="col-sm-1 col-form-label">วันที่</label>
            <div class="col-sm-5 input-group">
              <input class="input-sm form-control" type="datetime" id = "reservationtime"name="actDate" min="2000-01-01" value="<?php echo $actDate; ?>" required />
            </div>
            <label class="col-sm-1 col-form-label">สถานที่</label>
            <div class="col-sm-5">
              <input class="form-control" type="text" name="actLocate" value="<?php echo $actLocate; ?>" required />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">ค่าลงทะเบียน</label>
            <div class="col-sm-5">
              <input class="form-control" type="text" name="actPay" value="<?php echo $actPay; ?>" placeholder="-ถ้ามี-" />
            </div>
            <label class="col-sm-1 col-form-label">ลิ้งค์ใบประเมิน</label>
            <div class="col-sm-5">
              <input class="form-control" type="text" name="actAssesslink" placeholder="-ถ้ามี-">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">ไฟล์ใบโครงการ</label>
            <div class="col-sm-5">
              <input class="input-group" type="file" name="actFile" />
            </div>
            <label class="col-sm-1 col-form-label">ลิ้งค์ใบประเมิน</label>
            <div class="col-sm-5">
              <input class="form-control" type="text" name="actAssesslink" placeholder="-ถ้ามี-">
            </div>
            <div class="col-sm-5">
              <input class="form-control" type="hidden" name="actAddby" value="<?php echo $loginby; ?>" readonly />
            </div>
            <div class="col-sm-5">
              <input class="form-control" type="hidden" name="actID" value="ID" readonly />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-12 col-form-label">หมายเหตุ</label>
            <div class="col-sm-12">
              <textarea class="form-control" rows="2" type="text" name="actNote" value="<?php echo $actNote; ?>"></textarea>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-info" type="submit" name="btaddact">เพิ่ม</button>
              <a href="organizer_activity.php"><button class="btn btn-danger" type="button" data-dismiss="ibox">ยกเลิก</button></a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
          <div class="card-header" style="background-color:#d1cbaf">
            <h5 style="color:#2c2c2c">ตารางกิจกรรมในปีนี้</h5>
          </div>
          <div class="card-body text-nowrap">
            <?php include '../control/function_yearthai.php'; ?>
            <table id="tb1" class="table table-hover-sm table-striped " cellspacing="0" width="100%">
              <thead>
                <tr style="color:#528124;">
                  <th>วันที่</th>
                  <th>รหัสกิจกรรม</th>
                  <th>ชื่อกิจกรรม</th>
                  <th>ประเภทกิจกรรม</th>
                  <th>สถานะ</th>
                  <th>แก้ไข/ลบ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt = $session->runQuery("SELECT orgzerSec,orgzerMainorg,orgzerOrgtion,orgzerGroup FROM organizer WHERE orgzerID = '$loginby'");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $sec = $row["orgzerSec"];
                $org = $row["orgzerOrgtion"];
                $m = $row["orgzerMainorg"];
                $group = $row["orgzerGroup"];
                $stmt = $session->runQuery("SELECT activity.*, acttype.*, actyear.*
                                            FROM activity 
                                            JOIN acttype ON acttype.acttypeNo = activity.actType 
                                            JOIN actyear ON actyear.actyear = activity.actYear
                                            WHERE actyear.actyearStatus = 'ดำเนินกิจกรรม' 
                                            && activity.actMainorg='$m' && activity.actOrgtion='$org' && activity.actSec='$sec'
                                            && ((activity.actGroup='$group')||(activity.actGroup='รวม'))
                                            ORDER BY activity.actDateb DESC");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                  <td>
                        <? 
                        $dateb=$row['actDateb'];
                        $datee=$row['actDatee'];
                        $actDate=$dateb.$datee;
                        echo $actDate;?>
                      </td>
                    <td><a href="" data-toggle="modal" data-target="#modalmoreinfo" data-id="<?php echo $row['actID']; ?>" id="moreinfo"><?php echo $row['actID']; ?></a></td>
                    <td><?php echo $row['actName']; ?></td>
                    <td><?php echo $row['acttypeName']; ?></td>
                    <td>
                      <?php
                      if ($row['actStatus'] == 'ลงในแผน') {
                      ?>
                        <a class="btn btn-sm btn-fix btn-default" href="?act1_id=<?php echo $row['actNo']; ?>" onclick="return confirm('ต้องการดำเนินกิจกรรมนี้ ?')"> ดำเนินกิจกรรม</a>
                      <?php
                      } else if ($row['actStatus'] == 'ดำเนินกิจกรรม') {
                      ?>
                        <a class="btn btn-sm btn-fix btn-success" href="?act2_id=<?php echo $row['actNo']; ?>" onclick="return confirm('ต้องการยกเลิกการดำเนินกิจกรรมนี้ ?')"> ดำเนินกิจกรรม</a>
                      <?php
                      } else if (($row['actStatus'] == 'เปิดการลงทะเบียน') || ($row['actStatus'] == 'ปิดการลงทะเบียน')) {
                      ?>
                        ระหว่างดำเนินกิจกรรม
                      <?php
                      } else if ($row['actStatus'] == 'กิจกรรมเสร็จสิ้น') {
                      ?>
                        <a class="btn btn-sm btn-fix btn-danger" href="?actfinish_id=<?php echo $row['actNo']; ?>" onclick="return confirm('ต้องการดำเนินกิจกรรมนี้อีกครั้ง ?')"> กิจกรรมเสร็จสิ้น</a>
                      <?php
                      }
                      ?>
                    </td>
                    <td>
                      <a href="organizer_activity_updateinfo.php?update_id=<?php echo $row['actID']; ?>" onclick="return confirm('ต้องการแก้ไขกิจกรรม ?')"><button class="btn btn-warning btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i></button></a>
                      <a href="?delete_id=<?php echo $row['actNo']; ?>"  onclick="return confirm('ต้องการลบกิจกรรม ?')"><button class="btn btn-danger btn-sm" data-toggle="tooltip"><i class="fa fa-trash font-30"></i></button></a>
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
                  <h5 class="modal-title" id="exampleModalLongTitle" style="color:#528124;">รายะเอียดเพิ่มเติม</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div id="modal-loader" style="text-align: center; display: none;">
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
  <script src="../assets/vendors/daterangepicker/daterangepicker.js"></script>
  <script>
  
  $(function () {
    $(function () {
       $('#datetimepicker6').datetimepicker();
       $('#datetimepicker7').datetimepicker({
   useCurrent: false //Important! See issue #1075
   });
       $("#datetimepicker6").on("dp.change", function (e) {
           $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
       });
       $("#datetimepicker7").on("dp.change", function (e) {
           $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
       });
   });
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePicker24Hour: true,
      timePickerIncrement: 30,
      locale: {
        language: 'th',
        format: 'YYYY/MM/DD hh:mm'
      }
    })

  })

  </script>
  <script>
    /* View Function*/
    $(document).ready(function() {

      $(document).on('click', '#moreinfo', function(e) {

        e.preventDefault();

        var actid = $(this).data('id'); // it will get id of clicked row

        $('#dynamic-content').html(''); // leave it blank before ajax call
        $('#modal-loader').show(); // load ajax loader

        $.ajax({
            url: 'moreactinfo.php',
            type: 'POST',
            data: 'id=' + actid,
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