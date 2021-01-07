<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE);
include '../control/organizer_halaqah_teacher_updateinfo.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| แก้ไขข้อมูลที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน</title>
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
            <h1 class="page-title">จัดการที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item"><a href="organizer_halaqah_teacher.php">จัดการที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน</a></li>
                <li class="breadcrumb-item">แก้ไขข้อมูลที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน</li>
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
                    <h5>แก้ไขข้อมูลที่ปรึกษากลุ่มอัลกุรอ่าน</h5>
                </div>
            </div>
            <div class="ibox-body">
                <form method="post">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="halaqahtcYear" readonly>
                                <option value="<?php echo $halaqahtcYear ?>"> <?php echo $halaqahtcYear ?></option>
                                <?php
                                include '../control/select_activity_year.php';
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="halaqahtcID" required>
                                <option value="<?php echo $halaqahtcID ?>"> <?php echo $orgzerID ?>: <?php echo $orgzerName ?></option>
                                <option disabled="disabled">--ที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน--</option>
                                <?php
                                $stmt = $session->runQuery("SELECT orgzerSec,orgzerMainorg FROM organizer WHERE orgzerID = '$loginby'");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($row["orgzerSec"] == "Admin") {
                                    $stmt = $session->runQuery("SELECT usertype.*, organizer.* FROM organizer 
                                                                JOIN usertype ON usertype.usertypeID = organizer.orgzeruserType
                                                                WHERE usertype.userType= 'ที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน'");
                                    $stmt->execute();
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $orgzerID = $row["orgzerID"];
                                        $orgzerName = $row["orgzerName"];
                                ?>
                                        <option value="<?php echo $orgzerID ?>"> <?php echo $orgzerID ?>: <?php echo $orgzerName ?></option>
                                    <?php
                                    }
                                }
                                if ($row["orgzerSec"] == "คณะ") {
                                    $m = $row["orgzerMainorg"];
                                    $stmt = $session->runQuery("SELECT usertype.*, organizer.* FROM organizer 
                                                                JOIN usertype ON usertype.usertypeID = organizer.orgzeruserType
                                                                WHERE usertype.userType= 'ที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน' && organizer.orgzerMainorg = '$m' ");
                                    $stmt->execute();
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $orgzerID = $row["orgzerID"];
                                        $orgzerName = $row["orgzerName"];
                                    ?>
                                        <option value="<?php echo $orgzerID ?>"> <?php echo $orgzerID ?>: <?php echo $orgzerName ?></option>
                                    <?php
                                    }
                                }
                                if ($row["orgzerSec"] == "มหาวิทยาลัย") {
                                    $sec = $row["orgzerSec"];
                                    $stmt = $session->runQuery("SELECT usertype.*, organizer.* FROM organizer 
                                                                JOIN usertype ON usertype.usertypeID = organizer.orgzeruserType
                                                                WHERE usertype.userType= 'ที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน' && organizer.orgzerSec = '$sec' ");
                                    $stmt->execute();
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $orgzerID = $row["orgzerID"];
                                        $orgzerName = $row["orgzerName"];
                                    ?>
                                        <option value="<?php echo $orgzerID ?>"> <?php echo $orgzerID ?>: <?php echo $orgzerName ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="halaqahtcMainorg">
                                <option value="<?php echo $halaqahtcMainorg ?>"> <?php echo $mainorg ?></option>
                                <?php
                                $stmt = $session->runQuery("SELECT orgzerSec FROM organizer WHERE orgzerID = '$loginby'");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($row["orgzerSec"] == "Admin") {
                                ?><option disabled="disabled">--สังกัด--</option>
                                <?php
                                    include '../control/select_mainorg_all.php';
                                }
                                if ($row["orgzerSec"] == "คณะ") {
                                ?><option disabled="disabled">--สังกัด--</option>
                                <?php
                                    include '../control/select_mainorg_each.php';
                                }
                                if ($row["orgzerSec"] == "มหาวิทยาลัย") {
                                ?><option disabled="disabled">--สังกัด--</option>
                                <?php
                                    include '../control/select_mainorg_eachsec.php';
                                }
                                ?>
                            </select>
                        </div>
                        <input class="form-control" type="hidden" name="halaqahtcNo" value="<?php echo $halaqahtcNo; ?>" readonly />

                        <input class="form-control" type="hidden" name="halaqahtcAddby" value="<?php echo $halaqahtcAddby; ?>" readonly />
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-warning" type="submit" name="btupdatehalaqahtc">แก้ไข</button>
                            <a href="organizer_halaqah_teacher.php"><button class="btn btn-danger" type="button">ยกเลิก</button></a>
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