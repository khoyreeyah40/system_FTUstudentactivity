<?php
include '../control/session_student.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| เอกสาร</title>
  <?php include 'header.php' ?>

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

  <!-- Main content -->

  <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
    <div class="page-heading">
      <h1 class="page-title" style="color:#528124;">ไฟล์เอกสารทั้งหมด</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
        </li>
        <li class="breadcrumb-item"><a href="sudent_home.php">หน้าแรก</a></li>
        <li class="breadcrumb-item">ไฟล์เอกสารทั้งหมด</li>
      </ol>
    </div>
    <br>
    <b>
      <hr style="margin-top: 0rem;border-color:#528124;border-width: 2px;"></b>
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
    <div class="row ml-1 mr-1">
      <div class="col-12">
        <div class="card" style="border-width:0px;border-top-width:4px;color:#FFFFFF;">
          <br>
          <div class="row">
            <div class="col-sm-12">
              <table class="table table-hover table-striped ">
                <tbody>
                  <?php
                  $stmt = $session->runQuery("SELECT * FROM file ORDER BY fileNo DESC");
                  $stmt->execute();
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <tr>
                      <td style="font-size:14px;"><a href="../file/<?php echo $row['fileDoc']; ?>"><span class="fa fa-edit"></span>&nbsp; <?php echo $row['fileName']; ?></a></td>
                    </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <br>
        </div>
      </div>
    </div>
  </div>
  <!-- CORE PLUGINS-->
  <?php include 'footer.php' ?>
</body>

</html>