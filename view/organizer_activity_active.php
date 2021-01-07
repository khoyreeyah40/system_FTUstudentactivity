<?php
include '../control/session_organizer.php';
include '../control/organizer_activity_active.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| จัดการกิจกรรมที่กำลังดำเนิน</title>
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
  <?php include '../control/function_yearthai.php'; ?>
  <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
    <div class="page-heading">
      <h1 class="page-title">จัดการกิจกรรมที่กำลังดำเนิน</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item"><a href="organizer_activity_active.php">จัดการกิจกรรมที่กำลังดำเนิน</a> </li>
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

    <div class="row">
      <div class="col-12">
        <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
          <div class="card-header" style="background-color:#d1cbaf">
            <h5 style="color:#2c2c2c">กิจกรรมที่กำลังดำเนิน</h5>
          </div>
          <div class="card-body text-nowrap">
            <table id="tb1" class="table table-hover-sm table-striped" cellspacing="0" width="100%">
              <thead>
                <tr style="color:#528124;">
                  <th>วันที่</th>
                  <th>รหัสกิจกรรม</th>
                  <th>ชื่อกิจกรรม</th>
                  <th>สถานะการลงทะเบียน</th>
                  <th>สำเร็จกิจกรรม</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt = $session->runQuery("SELECT orgzerSec,orgzerOrgtion,orgzerMainorg,orgzerGroup FROM organizer WHERE orgzerID = '$loginby'");
                $stmt->execute();
                // output data of each row
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($row["orgzerSec"] == "Admin") {
                  $stmt = $session->runQuery("SELECT activity.*, acttype.*  FROM activity
                                            JOIN acttype ON activity.actType = acttype.acttypeNo
                                            WHERE activity.actStatus='ดำเนินกิจกรรม' ||activity.actStatus='เปิดการลงทะเบียน'|| activity.actStatus='ปิดการลงทะเบียน'
                                            ORDER BY activity.actDateb DESC
                                              ");
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                      <td>
                        <?php 
                          $actDateb=$row['actDateb'];
                          $actDatee=$row['actDatee'];
                          if($actDatee==$actDateb){
                            echo thai_date_short(strtotime($actDateb));
                          }elseif($actDatee!=$actDateb){
                            echo thai_date_short(strtotime($actDateb));?> ถึง
                          <?php 
                            echo thai_date_short(strtotime($actDatee));
                          }
                          ?> 
                      </td>
                      <td><a href="" data-toggle="modal" data-target="#modalmoreinfo" data-id="<?php echo $row['actID']; ?>" id="moreinfo"><?php echo $row['actID']; ?></a></td>
                      <td><?php echo $row['actName']; ?></td>
                      <td>
                        <?php
                        if ($row['actStatus'] == 'ดำเนินกิจกรรม') {
                        ?>
                          <a class="btn btn-fix btn-sm btn-default" href="?actopen_id=<?php echo $row['actNo']; ?>" onclick="return confirm('ต้องการเปิดการลงทะเบียนกิจกรรมนี้ ?')"></span> ลงทะเบียน</a>
                        <?php
                        } else if ($row['actStatus'] == 'เปิดการลงทะเบียน') {
                        ?>
                          <a class="btn btn-fix btn-sm btn-success" href="?actclose_id=<?php echo $row['actNo']; ?>"onclick="return confirm('ต้องการปิดการละงทะเบียนกิจกรรมนี้ ?')"> ลงทะเบียน</a>
                        <?php
                        } else if ($row['actStatus'] == 'ปิดการลงทะเบียน') {
                        ?>
                          <a class="btn btn-fix btn-sm btn-default" href="?actopen1_id=<?php echo $row['actNo']; ?>" onclick="return confirm('ต้องการเปิดการละงทะเบียนกิจกรรมนี้ ?')"> ลงทะเบียน</a>
                        <?php
                        }
                        ?>
                      </td>
                      <td>
                        <a class="btn btn-fix btn-sm btn-danger" href="?actfinish_id=<?php echo $row['actNo']; ?>"></span> สำเร็จกิจกรรม</a>
                      </td>
                    </tr>
                  <?php
                  }
                }
                if (($row["orgzerSec"] == "คณะ") || ($row["orgzerSec"] == "มหาวิทยาลัย")) {
                  $org = $row["orgzerOrgtion"];
                  $sec = $row["orgzerSec"];
                  $m = $row["orgzerMainorg"];
                  $group = $row["orgzerGroup"];
                  $stmt = $session->runQuery("SELECT activity.*, acttype.*  FROM activity
                                            JOIN acttype ON activity.actType = acttype.acttypeNo
                                            WHERE (activity.actStatus='ดำเนินกิจกรรม'||activity.actStatus='เปิดการลงทะเบียน'||activity.actStatus='ปิดการลงทะเบียน')
                                            && activity.actOrgtion='$org'&& activity.actSec='$sec' && activity.actMainorg='$m'
                                            && ((activity.actGroup = '$group')||(activity.actgroup='รวม'))
                                            ORDER BY activity.actDateb DESC
                                              ");
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <tr>
                      <td>
                      <?php 
                          $actDateb=$row['actDateb'];
                          $actDatee=$row['actDatee'];
                          if($actDatee==$actDateb){
                            echo thai_date_short(strtotime($actDateb));
                          }elseif($actDatee!=$actDateb){
                            echo thai_date_short(strtotime($actDateb));?> ถึง
                          <?php 
                            echo thai_date_short(strtotime($actDatee));
                          }
                          ?> 
                      </td>
                      <td><a href="" data-toggle="modal" data-target="#modalmoreinfo" data-id="<?php echo $row['actID']; ?>" id="moreinfo"><?php echo $row['actID']; ?></a></td>
                      <td><?php echo $row['actName']; ?></td>
                      <td>
                        <?php
                        if ($row['actStatus'] == 'ดำเนินกิจกรรม') {
                        ?>
                          <a class="btn btn-fix btn-sm btn-default" href="?actopen_id=<?php echo $row['actNo']; ?>" onclick="return confirm('ต้องการเปิดการลงทะเบียนกิจกรรมนี้ ?')"></span> ลงทะเบียน</a>
                        <?php
                        } else if ($row['actStatus'] == 'เปิดการลงทะเบียน') {
                        ?>
                          <a class="btn btn-fix btn-sm btn-success" href="?actclose_id=<?php echo $row['actNo']; ?>"  onclick="return confirm('ต้องการปิดการละงทะเบียนกิจกรรมนี้ ?')"> ลงทะเบียน</a>
                        <?php
                        } else if (($row['actStatus'] == 'ปิดการลงทะเบียน')) {
                        ?>
                          <a class="btn btn-fix btn-sm btn-default" href="?actopen1_id=<?php echo $row['actNo']; ?>" onclick="return confirm('ต้องการเปิดการละงทะเบียนกิจกรรมนี้ ?')"> ลงทะเบียน</a>
                        <?php
                        }
                        ?>
                      </td>
                      <td>
                        <a class="btn btn-fix btn-sm btn-danger" href="?actfinish_id=<?php echo $row['actNo']; ?>"></span> สำเร็จกิจกรรม</a>
                      </td>
                    </tr>
                <?php
                  }
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