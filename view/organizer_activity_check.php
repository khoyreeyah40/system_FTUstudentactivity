<?php
include '../control/session_organizer.php';
$id = $_GET['act_id'];
include '../control/organizer_activity_check.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| เช็คชื่อ</title>
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
      <h1 class="page-title">เช็คชื่อ</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item"><a href="organizer_activity_active.php">กิจกรรมที่กำลังดำเนิน</a> </li>
        <li class="breadcrumb-item">เช็คชื่อ</li>
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
            <h5 style="color:#2c2c2c">ตารางรายชื่อผู้ลงทะเบียน</h5>
          </div>
          <div class="card-body text-nowrap">
            <table id="tb1" class="table table-hover-sm table-striped text-center" cellspacing="0" width="100%">
              <thead>
                <tr style="color:#528124;">
                  <th>รหัสนักศึกษา</th>
                  <th>ชื่อ-สกุล</th>
                  <th>สาขา</th>
                  <th>กลุ่ม</th>
                  <th>สถานะ</th>
                  <th>ยืนยันเข้าร่วม</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt = $session->runQuery("SELECT activity.*, actregister.*, student.*, organization.*,acttype.*  
                                            FROM actregister
                                            JOIN activity ON activity.actID = actregister.actregactID
                                            JOIN acttype ON acttype.acttypeNo = activity.actType
                                            JOIN student ON student.stdID = actregister.actregstdID
                                            JOIN organization ON organization.orgtionNo = student.stdOrgtion
                                            WHERE activity.actID='$id'
                                            ORDER BY actregister.actregNo DESC");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                    <td><?php echo $row['actregstdID']; ?></td>
                    <td><a href="" data-toggle="modal" data-target="#modalstdmoreinfo" data-id="<?php echo $row['stdID']; ?>" id="stdmoreinfo"><?php echo $row['stdName']; ?></a></td>
                    <td><?php echo $row['organization']; ?></td>
                    <td><?php echo $row['stdGroup']; ?></td>
                    <td><?php echo $row['actregStatus']; ?></td>
                    <td>
                      <?php
                      if (($row['actregStatus'] == 'รอยืนยันการเข้าร่วม') && ($row['acttypeName'] != 'กิจกรรมซ่อม')) {
                      ?>
                        <a class="btn btn-sm  btn-success" href="?check_id=<?php echo $row['actregNo']; ?>&& id=<?php echo $row['actregactID']; ?>" onclick="return confirm('ต้องการยืนยันการเข้าร่วมกิจกรรม ?')"> ยืนยัน</a>
                      <?php
                      } else if ((($row['actregStatus'] == 'รอยืนยันการเข้าร่วม') || ($row['actregStatus'] == 'จำนงแก้กิจกรรม')) && ($row['acttypeName'] == 'กิจกรรมซ่อม')) {
                      ?>
                        <a class="btn btn-sm  btn-success" href="?checksolve_id=<?php echo $row['actregNo']; ?>&&actsem=<?php echo $row['actSem']; ?>&&actmainorg=<?php echo $row['actMainorg']; ?>
                            &&actorgtion=<?php echo $row['actOrgtion']; ?>&&actsec=<?php echo $row['actSec']; ?>&&stdid=<?php echo $row['actregstdID']; ?>&&id=<?php echo $row['actregactID']; ?>" onclick="return confirm('ต้องการยืนยันการเข้าร่วมกิจกรรม ?')"> ยืนยัน</a>
                      <?php
                      } else if ($row['actregStatus'] == 'ยืนยันเรียบร้อย') {
                      ?>
                        <a class="btn btn-fix btn-sm btn-danger" href="?actcancel=<?php echo $row['actregNo']; ?>&& id=<?php echo $row['actregactID']; ?> "  onclick="return confirm('ยกเลิกการเข้าร่วมกิจกรรม ?')">ยกเลิกการเข้าร่วมกิจกรรม</a>
                      <?php
                      } else if ($row['actregStatus'] == 'แก้กิจกรรมเรียบร้อย') {
                      ?>
                        <a class="btn btn-fix btn-sm btn-danger" href="?actcancel2=<?php echo $row['actregNo']; ?>&&actsem=<?php echo $row['actSem']; ?>&&actmainorg=<?php echo $row['actMainorg']; ?>
                            &&actorgtion=<?php echo $row['actOrgtion']; ?>&&actsec=<?php echo $row['actSec']; ?>&&stdid=<?php echo $row['actregstdID']; ?>&& id=<?php echo $row['actregactID']; ?> "  onclick="return confirm('ยกเลิกการแก้กิจกรรม ?')">ยกเลิกการแก้กิจกรรม</a>
                      <?php
                      }
                      ?>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>
          </div>
          <div class="modal fade" id="modalstdmoreinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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

      $(document).on('click', '#stdmoreinfo', function(e) {

        e.preventDefault();

        var stdid = $(this).data('id'); // it will get id of clicked row

        $('#dynamic-content').html(''); // leave it blank before ajax call
        $('#modal-loader').show(); // load ajax loader

        $.ajax({
            url: 'morestdinfo.php',
            type: 'POST',
            data: 'id=' + stdid,
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