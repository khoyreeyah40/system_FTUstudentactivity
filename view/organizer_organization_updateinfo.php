<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE);
include '../control/organizer_organization_updateinfo.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| แก้ไขข้อมูลองค์กร</title>
    <?php include 'header.php'; ?>

    <style>
        .breadcrumb-item {
            font-size: 16px;
        }
    </style>
</head>

<body class="fixed-navbar">
    <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
        <div class="page-heading">
            <h1 class="page-title">จัดการรายชื่อองค์กร</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item"><a href="organizer_organizer.php">จัดการเจ้าหน้าที่</a></li>
                <li class="breadcrumb-item">แก้ไขข้อมูลองค์กร</li>
            </ol>
        </div>
        <br>
        <br>
        <?php
        if (isset($errMSG)) {
        ?>
            <div class="alert alert-danger">
                <span class="fa fa-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
            </div>
        <?php
        }
        ?>
        <div class="ibox" style="box-shadow: 0 5px 4px rgba(0,0,0,.1);">
            <div class="ibox-head" style="background-color:#d1cbaf;">
                <div class="ibox-title" style="color:#484848;">
                    <h5>แก้ไขข้อมูลองค์กร</h5>
                </div>
            </div>
            <div class="ibox-body">
                <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate" style="height:150px; width:100%">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">ชื่อองค์กร</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="organization" value="<?php echo $organization; ?>" required />
                        </div>
                        <label class="col-sm-1 col-form-label">สังกัด</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="orgtionMainorg" required>
                                <option value="<?php echo $mainorgNo ?>"> <?php echo $mainorg ?></option>
                                <option disabled="disabled">--กรุณาเลือกสังกัด--</option>
                                <?php
                                $stmt = $session->runQuery("SELECT orgzerSec FROM organizer WHERE orgzerID = '$loginby'");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($row["orgzerSec"] == "Admin") {
                                    include '../control/select_mainorg_all.php';
                                }
                                if ($row["orgzerSec"] == "คณะ") {
                                    include '../control/select_mainorg_each.php';
                                }
                                if ($row["orgzerSec"] == "มหาวิทยาลัย") {
                                    include '../control/select_mainorg_eachsec.php';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input class="form-control" type="hidden" name="orgtionAddby" value="<?php echo $orgtionAddby; ?>" readonly />
                    <input class="form-control" type="hidden" name="orgtionNo" value="<?php echo $orgtionNo; ?>" required />

                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-warning" type="submit" name="btupdateorgtion">แก้ไข</button>
                            <a href="organizer_organization.php"><button class="btn btn-danger" type="button">ยกเลิก</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CORE PLUGINS-->
    <?php include 'footer.php'; ?>
</body>

</html>