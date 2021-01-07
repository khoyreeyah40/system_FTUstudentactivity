<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE);
include '../control/organizer_position_updateinfo.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| แก้ไขข้อมูลตำแหน่งนักศึกษา</title>
    <?php include 'header.php'; ?>

    <style>
        .breadcrumb-item {
            font-size: 16px;
        }
    </style>
    <script>
        function getorgtion(val) {
            $.ajax({
                type: "POST",
                url: "../control/select_orgtion.php",
                data: 'mainorgNo=' + val,
                success: function(data) {
                    $("#orgtion").html(data);
                }
            });
        }
    </script>
</head>

<body class="fixed-navbar">
    <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
        <div class="page-heading">
            <h1 class="page-title">จัดการตำแหน่งนักศึกษา</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item"><a href="organizer_position.php">จัดการตำแหน่งนักศึกษา</a></li>
                <li class="breadcrumb-item">แก้ไขข้อมูลตำแหน่งนักศึกษา</li>
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
                    <h5>แก้ไขข้อมูลตำแหน่งนักศึกษา</h5>
                </div>
            </div>
            <div class="ibox-body">
                <form class="form-horizontal" id="form-sample-1" enctype="multipart/form-data" method="post" novalidate="novalidate">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">ปีการศึกษา</label>
                        <div class="col-sm-2">
                            <select class="form-control" style="width: 100%;" name="pstYear" required />
                            <option value="<?php echo $pstYear ?>"> <?php echo $pstYear ?></option>
                            <option disabled="disabled">--ปีการศึกษา--</option>
                            <?php
                            include '../control/select_activity_year.php';
                            ?>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">รหัสนักศึกษา</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="text" name="pststdID" value="<?php echo $pststdID; ?>" required />
                        </div>
                        <label class="col-sm-1 col-form-label">ตำแหน่ง</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="pst" value="<?php echo $pst; ?>" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">สังกัด</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="pstMainorg" id="pstMainorg" onChange="getorgtion(this.value);">
                                <option value="<?php echo $pstMainorg ?>"> <?php echo $mainorg ?></option>
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
                        <label class="col-sm-1 col-form-label">องค์กร</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="pstOrgtion" id="orgtion" required>
                                <option value="<?php echo $pstOrgtion ?>"> <?php echo $organization ?></option>
                                <option disabled="disabled">--องค์กร--</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <input class="form-control" type="hidden" name="pstNo" value="<?php echo $pstNo; ?>" readonly />
                        </div>
                        <div class="col-sm-5">
                            <input class="form-control" type="hidden" name="pstAddby" value="<?php echo $pstAddby; ?>" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-warning" type="submit" name="btupdateposition">แก้ไข</button>
                            <a href="organizer_position.php"><button class="btn btn-danger" type="button" data-dismiss="ibox">ยกเลิก</button></a>
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