<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE);
include '../control/organizer_club_updateinfo.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| แก้ไขข้อมูลสมาชิกชมรม</title>
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
            <h1 class="page-title">จัดการชมรม</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item"><a href="organizer_club.php">จัดการชมรม</a></li>
                <li class="breadcrumb-item">แก้ไขข้อมูลสมาชิกชมรม</li>
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
                    <h5>แก้ไขข้อมูลสมาชิกชมรม</h5>
                </div>
            </div>
            <div class="ibox-body">
                <form class="form-horizontal" id="form-sample-1" enctype="multipart/form-data" method="post" novalidate="novalidate">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">ปีการศึกษา</label>
                        <div class="col-sm-2">
                            <select class="form-control" style="width: 100%;" name="clubYear" required />
                            <option value="<?php echo $clubYear ?>"> <?php echo $clubYear ?></option>
                            <option disabled="disabled">--ปีการศึกษา--</option>
                            <?php
                            include '../control/function_year.php';
                            ?>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">รหัสนักศึกษา</label>
                        <div class="col-sm-3">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="clubstdID" id="clubstdID" onChange="getname(this.value);" required>
                                <option value="<?php echo $clubstdID ?>"> <?php echo $clubstdID ?>: <?php echo $stdName ?></option>
                                <?php
                                $stmt = $session->runQuery("SELECT * FROM student WHERE stdStatus = 'กำลังศึกษา'");
                                $stmt->execute();
                                ?>
                                <option disabled="disabled">--รหัสนักศึกษา--</option>
                                <?php
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $stdID = $row["stdID"];
                                    $stdName = $row["stdName"];
                                ?>
                                    <option value="<?php echo $stdID ?>"> <?php echo $stdID ?>: <?php echo $stdName ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">ตำแหน่ง</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="clubPst" value="<?php echo $clubPst; ?>" require />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">สังกัด</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="clubMainorg">
                                <option value="<?php echo $clubMainorg ?>"> <?php echo $mainorg ?></option>
                                <?php
                                $stmt = $session->runQuery("SELECT orgzerSec FROM organizer WHERE orgzerID = '$loginby'");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($row["orgzerSec"] == "Admin") {
                                ?><option selected="selected" disabled="disabled">--สังกัด--</option>
                                <?php
                                    include '../control/select_mainorg_all.php';
                                }
                                if (($row["orgzerSec"] == "คณะ") || ($row["orgzerSec"] == "มหาวิทยาลัย")) {
                                    include '../control/select_mainorg_each.php';
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">องค์กร</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="clubOrgtion" required>
                                <option value="<?php echo $clubOrgtion ?>"> <?php echo $organization ?></option>
                                <?php
                                $stmt = $session->runQuery("SELECT orgzerSec, orgzerOrgtion FROM organizer WHERE orgzerID = '$loginby'");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($row["orgzerSec"] == "Admin") {
                                ?><option selected="selected" disabled="disabled">--องค์กร--</option>
                                <?php
                                    include '../control/select_orgtion_all.php';
                                }
                                if (($row["orgzerSec"] == "คณะ") || ($row["orgzerSec"] == "มหาวิทยาลัย")) {
                                    include '../control/select_orgtion_each.php';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <input class="form-control" type="hidden" name="clubNo" value="<?php echo $clubNo; ?>" readonly />
                    <input class="form-control" type="hidden" name="clubAddby" value="<?php echo $clubAddby; ?>" readonly />

                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-warning" type="submit" name="btupdateclub">แก้ไข</button>
                            <a href="organizer_club.php"><button class="btn btn-danger" type="button" data-dismiss="ibox">ยกเลิก</button></a>
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