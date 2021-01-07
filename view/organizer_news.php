<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE); // avoid notice
include '../control/organizer_news.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| จัดการข่าวประชาสัมพันธ์</title>
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
      <h1 class="page-title">จัดการข่าวประสัมพันธ์</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item"><a href="organizer_board.php">จัดการบอร์ดประชาสัมพันธ์</a></li>
        <li class="breadcrumb-item">จัดการข่าวประชาสัมพันธ์</li>
      </ol>
    </div>
    <br>
    <a href="organizer_board.php"><button class="btn btn-info" type="button"> <span class="fa fa-news"></span> &nbsp; จัดการบอร์ดประชาสัมพันธ์</button></a>
    <a href="organizer_file.php"><button class="btn btn-info" type="button"> <span class="fa fa-news"></span> &nbsp; จัดการเอกสาร</button></a>
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
          <h5>เพิ่มข่าวประชาสัมพันธ์</h5>
        </div>
        <div class="ibox-tools">
          <a class="ibox-collapse" style="color:#484848;"><i class="fa fa-minus"></i></a>
        </div>
      </div>
      <div class="ibox-body">
        <form class="form-horizontal" enctype="multipart/form-data" id="form-sample-1" method="post" novalidate="novalidate">
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">หัวข้อข่าว</label>
            <div class="col-sm-5">
              <input class="form-control" type="text" name="newsTitle" value="<?php echo $newsTitle; ?>" required />
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">คำอธิบาย</label>
            <div class="col-sm-11">
              <textarea class="form-control" rows="2" type="text" name="newsDescribe" value="<?php echo $newsDescribe; ?>" required></textarea>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-1 col-form-label">อัพโหลดรูปภาพ</label>
            <div class="col-sm-5">
              <input class="input-group" type="file" name="Image" accept="image/*" />
            </div>
            <label class="col-sm-1 col-form-label">เพิ่มโดย</label>
            <div class="col-sm-5">
              <input class="form-control" type="text" name="newsAddby" value="<?php echo $loginby; ?>" readonly />
            </div>
          </div>
          <div class="form-group row">
            <div class="col-sm-12 text-center">
              <button class="btn btn-info" type="submit" name="btaddnews">เพิ่ม</button>
              <a href="organizer_news.php"><button class="btn btn-danger" type="button" data-dismiss="ibox">ยกเลิก</button></a>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
          <div class="card-header" style="background-color:#d1cbaf">
            <h5 style="color:#2c2c2c">ตารางข่าวประชาสัมพันธ์</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body text-nowrap">
            <table id="tb1" class="table table-hover-sm table-striped text-center" cellspacing="0" width="100%">
              <thead>
                <tr style="color:#528124;">
                  <th>วันที่เพิ่ม</th>
                  <th>หัวข้อข่าว</th>
                  <th>สถานะ</th>
                  <th>รายละเอียดเพิ่มเติม</th>
                  <th>แก้ไข</th>
                  <th>ลบ</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt = $session->runQuery("SELECT * FROM news ORDER BY newsNo DESC");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                  <tr>
                    <td><?php echo $row['newsCreateat']; ?></td>
                    <td><?php echo $row['newsTitle']; ?></td>
                    <td><?php echo $row['newsStatus']; ?></td>
                    <td>
                      <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalmoreinfo" data-id="<?php echo $row['newsNo']; ?>" id="moreinfo"><i class="fa fa-eye-open"></i> รายละเอียดเพิ่มเติม</button>
                    </td>
                    <td>
                      <a class="btn btn-sm btn-warning" href="organizer_news_updateinfo.php?update_id=<?php echo $row['newsNo']; ?>"  onclick="return confirm('ต้องการแก้ไขข่าว ?')"><span class="fa fa-edit"></span> แก้ไข</a>
                    </td>
                    <td>
                      <a class="btn btn-sm  btn-danger" href="?delete_id=<?php echo $row['newsNo']; ?>" onclick="return confirm('ต้องการลบข่าว ?')"> <i class="fa fa-trash"></i> ลบ</a>
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

        var newsno = $(this).data('id'); // it will get id of clicked row

        $('#dynamic-content').html(''); // leave it blank before ajax call
        $('#modal-loader').show(); // load ajax loader

        $.ajax({
            url: 'morenewsinfo.php',
            type: 'POST',
            data: 'id=' + newsno,
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