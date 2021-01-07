<?php include '../control/session_organizer.php'; 
include '../control/organizer_activity_all_past_search.php';
$actYear = $_GET["actYear"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| ตารางกิจกรรม</title>
  <?php include 'header.php'; ?>

  <!-- PAGE LEVEL STYLES-->
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
  <? include '../control/function_yearthai.php';?>
  <!-- Main content -->
  <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
    <div class="page-heading">
      <h1 class="page-title" style="color:#528124;">ตารางกิจกรรมทั้งหมดในปี <?php echo $actYear ?></h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"></li>
        <li class="breadcrumb-item"><a href="organizer_home.php">หน้าแรก</a></li>
        <li class="breadcrumb-item">ตารางกิจกรรมทั้งหมดในปีที่ผ่านมา</li>
      </ol>
    </div>
    <br>
      <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
        <div class="form-group row justify-content-center text-center"><h5 style="color:#528124;margin-bottom: .0rem;margin-top: .5rem;">ค้นหากิจกรรมในปีอื่น</h5>
          <div class="col-sm-3 ">
            <select class="form-control select2_demo_1" style="width: 100%;" name="actYear" required>
              <option selected="selected" disabled="disabled">--กรุณาเลือกปีการศึกษา--</option>
              <?php include '../control/function_year.php'; ?>
            </select> </div>
          <div class="col-sm-1 ">
            <button class="btn btn-primary" name="btsearch">ค้นหา</button>
          </div>
        </div>
      </form>
      <br>
      <b>
        <hr style="margin-top: 0rem;border-color:#528124;border-width: 2px;"></b>
      <div class="row ml-1 mr-1">
        <div class="col-12">
          <div class="card" style="border-width:0px;border-top-width:4px;">
            <div class="card-body text-nowrap">
              <table id="tbactivity" class="table table-hover-sm table-striped" cellspacing="0" width="100%">
                <thead>
                  <tr style="color:#417d19;">
                    <th>วันที่</th>
                    <th>ชื่อกิจกรรม</th>
                    <th>หมวดหมู่กิจกรรม</th>
                    <th>กลุ่ม</th>
                    <th>สถานะกิจกรรม</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $stmt = $session->runQuery("SELECT activity.*,mainorg.*,organization.*,acttype.*,actyear.* FROM activity 
                                                      JOIN mainorg ON mainorg.mainorgNo = activity.actMainorg
                                                      JOIN organization ON organization.orgtionNo = activity.actOrgtion
                                                      JOIN acttype ON acttype.acttypeNo = activity.actType
                                                      JOIN actyear ON activity.actYear = actyear.actyear
                                                      WHERE actyear.actyear = '$actYear'
                                                      ORDER BY length(activity.actDateb), activity.actDateb DESC");
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <tr>
                      <td>
                        <? 
                        $dateb=$row['actDateb'];
                        $datee=$row['actDatee'];
                        echo thai_date_short(strtotime($dateb));?> ถึง
                        <?echo thai_date_short(strtotime($datee));
                      ?>
                      </td>
                      <td><a href="" data-toggle="modal" data-target="#modalmoreactinfo" data-id="<?php echo $row['actID']; ?>" id="moreactinfo"><?php echo $row['actName']; ?></a></td>
                      <td><?php echo $row['acttypeName']; ?></td>
                      <td><?php echo $row['actGroup']; ?></td>
                      <td><?php echo $row['actStatus']; ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="modal fade" id="modalmoreactinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="color:#528124;">รายละเอียดเพิ่มเติม</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div id="modal-loader1" style="text-align: center; display: none;"></div>
                    <div id="dynamic-content1"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

  <!-- CORE PLUGINS-->
  <?php include 'footer.php' ?>
  <script>
    /* View Function*/
    $(document).ready(function() {

      $(document).on('click', '#moreactinfo', function(e) {

        e.preventDefault();

        var actid = $(this).data('id'); // it will get id of clicked row

        $('#dynamic-content1').html(''); // leave it blank before ajax call
        $('#modal-loader1').show(); // load ajax loader

        $.ajax({
            url: 'moreactinfo.php',
            type: 'POST',
            data: 'id=' + actid,
            dataType: 'html'
          })
          .done(function(data) {
            console.log(data);
            $('#dynamic-content1').html('');
            $('#dynamic-content1').html(data); // load response 
            $('#modal-loader1').hide(); // hide ajax loader 
          })
          .fail(function() {
            $('#dynamic-content1').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
            $('#modal-loader1').hide();
          });

      });

    });
  </script>
</body>

</html>