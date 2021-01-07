<?php
include '../control/session_organizer.php';
$halaqah_id = $_GET['halaqah_id'];
include '../control/organizer_halaqah_student_add.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| จัดการกลุ่มศึกษาอัลกุรอ่าน:รายชื่อนักศึกษา</title>
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
      <h1 class="page-title">จัดการกลุ่มศึกษาอัลกุรอ่าน: รายชื่อนักศึกษา</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item"><a href="organizer_halaqah_teacher.php">จัดการที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน</a></li>
        <li class="breadcrumb-item">รายชื่อนักศึกษา</li>
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
    <div class="row justify-content-center">
      <div class="col-sm-8 ">
        <div class="ibox">
          <div class="ibox-body">
            <form method="post">
              <div class="form-group row" style="margin-bottom: 0rem;">
                <div class="col-sm-2">
                  <input class="form-control" type="text" name="halaqahID" value="<?php echo $halaqah_id; ?>" readonly />
                </div>
                <div class="col-sm-8">
                  <input class="form-control" type="text" name="halaqahstdID" placeholder="ป้อนรหัสนักศึกษา" require />
                </div>
                <div class="col-sm-1 text-center">
                  <button class="btn btn-info" type="submit" name="btaddhalaqahstd">เพิ่ม</button>
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
            <h5 style="color:#2c2c2c">ตารางรายชื่อนักศึกษา</h5>
          </div>
          <div class="card-body text-nowrap">
            <table id="tb1" class="table table-hover-sm table-striped text-center" cellspacing="0" width="100%">
              <thead>
                <tr style="color:#528124;">
                  <th>รหัสนักศึกษา</th>
                  <th>ชื่อนักศึกษา</th>
                  <th>สาขา</th>
                  <th>ลบ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt = $session->runQuery("SELECT halaqahstd.*,halaqahtc.*, student.*, organization.* FROM halaqahstd
                                        JOIN student ON student.stdID = halaqahstd.halaqahstdID
                                        JOIN halaqahtc ON halaqahtc.halaqahtcNo = halaqahstd.halaqahID
                                        JOIN organization ON organization.orgtionNo = student.stdOrgtion
                                        WHERE halaqahstd.halaqahID = '$halaqah_id'
                                        ORDER BY halaqahstd.halaqahstdCreateat  DESC");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                    <td><a href="" data-toggle="modal" data-target="#modalmoreinfo" data-id="<?php echo $row['stdID']; ?>" id="moreinfo"><?php echo $row['stdID']; ?></a></td>
                    <td><?php echo $row['stdName']; ?></td>
                    <td><?php echo $row['organization']; ?></td>
                    <td>
                      <a class="btn btn-sm  btn-danger" href="?delete_id=<?php echo $row['halaqahstdID']; ?>&&halaqah_id=<?php echo $row['halaqahID']; ?>" onclick="return confirm('ต้องการลบรายชื่อนี้ ?')"> <i class="fa fa-trash"></i> ลบ</a>
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