<?php
include '../control/session_organizer.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>ระบบกิจกรรมนักศึกษา| เกี่ยวกับผู้พัฒนา</title>
  <?php include 'header.php'; ?>

  <style>
    .breadcrumb-item {
      font-size: 16px;
    }

    body.fixed-navbar .header {
      top: unset;
    }

    .sidebar-mini {
      margin-left: 0px;
    }

    .content-wrapper {
      margin-left: 0px;
    }
  </style>
</head>

<body class="fixed-navbar">
  <div class="content-wrapper pb-2" style="background-color:#f4f4fc;">
    <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
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
      <div class="row ml-1 mr-1 justify-content-center">
        <div class="col-8">
          <div class="card" style="border-width:0px;border-top-width:4px;height:200px;">
            <div class="row justify-content-center">
              <div class="col-sm-12">
                <div class="card-body" style="text-align:center;">
                  <h1>Hi</h1>
                  <h3>I am <b style="color:#528124;">KHOYR</b> Khoyreeyah Tan-e-no</h3>
                  <h4>IT student of Fatoni University, This is my Final project</h4>
                  <h4 style="color:#528124;">ENJOY IT:)</h4>
                </div>
              </div>
            </div>
            <br>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- CORE PLUGINS-->
  <?php include 'footer.php'; ?>
</body>

</html>