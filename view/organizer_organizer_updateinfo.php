<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE);
include '../control/organizer_organizer_updateinfo.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| จัดการเจ้าหน้าที่</title>
    <?php include 'header.php'; ?>

    <style>
        .breadcrumb-item {
            font-size: 16px;
        }
    </style>
    <script>
        function getmainorg(val) {
            $.ajax({
                type: "POST",
                url: "../control/select_mainorg.php",
                data: 'secName=' + val,
                success: function(data) {
                    $("#orgzermainorg").html(data);
                }
            });
        }
    </script>
    <script>
        function getorgtion(val) {
            $.ajax({
                type: "POST",
                url: "../control/select_orgtion.php",
                data: 'mainorgNo=' + val,
                success: function(data) {
                    $("#orgzerorgtion").html(data);
                }
            });
        }
    </script>
</head>

<body class="fixed-navbar">
    <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
        <div class="page-heading">
            <h1 class="page-title">จัดการเจ้าหน้าที่</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item"><a href="organizer_organizer.php">จัดการเจ้าหน้าที่</a></li>
                <li class="breadcrumb-item">แก้ไขข้อมูลเจ้าหน้าที่</li>
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
                    <h5>แก้ไขข้อมูลเจ้าหน้าที่</h5>
                </div>
            </div>
            <div class="ibox-body">
                <form class="form-horizontal" enctype="multipart/form-data" id="form-sample-1" method="post" novalidate="novalidate" style="height:600px; width:100%">

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">รหัสผู้ใช้</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="orgzerID" value="<?php echo $orgzerID; ?>" readonly />
                        </div>
                        <label class="col-sm-1 col-form-label">ชื่อ-สกุล</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="orgzerName" value="<?php echo $orgzerName; ?>" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">สถานะ</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="orgzeruserType">
                                <option value="<?php echo $usertypeID ?>"> <?php echo $userType ?></option>
                                <?php
                                $stmt = $session->runQuery("SELECT orgzerSec FROM organizer WHERE orgzerID = '$loginby'");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <option disabled="disabled">--สถานะ--</option>
                                <?php
                                if ($row["orgzerSec"] == "Admin") {
                                    $stmt = $session->runQuery('SELECT * FROM usertype');
                                    $stmt->execute();
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $userTypeNo = $row["usertypeID"];
                                        $userTypelist = $row["userType"];
                                        $userTypeSec = $row["usertypeSec"];
                                ?>
                                        <option value="<?php echo $userTypeNo ?>"> <?php echo $userTypelist ?>(<?php echo $userTypeSec ?>)</option>
                                    <?php
                                    }
                                }
                                if (($row["orgzerSec"] == "มหาวิทยาลัย") || ($row["orgzerSec"] == "คณะ")) {
                                    $sec = $row["orgzerSec"];
                                    $stmt = $session->runQuery("SELECT * FROM usertype WHERE usertypeSec='$sec' ");
                                    $stmt->execute();
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        $userTypeNo = $row["usertypeID"];
                                        $userTypelist = $row["userType"];
                                        $userTypeSec = $row["usertypeSec"];
                                    ?>
                                        <option value="<?php echo $userTypeNo ?>"> <?php echo $userTypelist ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">กลุ่ม</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="orgzerGroup" required>
                                <option value="<?php echo $orgzerGroup ?>"> <?php echo $orgzerGroup ?></option>
                                <option value="ชาย">ชาย</option>
                                <option value="หญิง">หญิง</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">ระดับ</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="orgzerSec" id="orgzersec" onChange="getmainorg(this.value);">
                                <option value="<?php echo $orgzerSec ?>"> <?php echo $orgzerSec ?></option>
                                <?php
                                $stmt = $session->runQuery("SELECT orgzerSec FROM organizer WHERE orgzerID = '$loginby'");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($row["orgzerSec"] == "Admin") {
                                    include '../control/select_section_all.php';
                                }
                                if (($row["orgzerSec"] == "คณะ") || ($row["orgzerSec"] == "มหาวิทยาลัย")) {
                                    include '../control/select_section_each.php';
                                }
                                ?>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">สังกัด</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="orgzerMainorg" id="orgzermainorg" onChange="getorgtion(this.value);">
                                <option value="<?php echo $mainorgNo ?>"> <?php echo $mainorg ?></option>
                                <option disabled="disabled">--สังกัด--</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">องค์กร</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="orgzerOrgtion" id="orgzerorgtion" required>
                                <option value="<?php echo $orgtionNo ?>"> <?php echo $organization ?></option>
                                <option disabled="disabled">--กรุณาเลือกองค์กร--</option>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">เบอร์โทร</label>
                        <div class="col-sm-5">
                            <input class="form-control" id="ex-phone" type="text" name="orgzerPhone" value="<?php echo $orgzerPhone; ?>" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">E-mail</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="orgzerEmail" value="<?php echo $orgzerEmail; ?>" required />
                        </div>
                        <label class="col-sm-1 col-form-label">Facebook</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="orgzerFb" value="<?php echo $orgzerFb; ?>" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">รหัสผ่าน</label>
                        <div class="col-sm-5">
                            <input class="form-control" id="password" type="password" name="orgzerPassword" placeholder="password" value="<?php echo $orgzerPassword; ?>" required />
                        </div>
                        <input class="form-control" type="hidden" name="orgzerAddby" value="<?php echo $orgzerAddby; ?>" readonly />
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">รูปประจำตัว</label>
                        <div class="col-sm-5">
                            <p><img src="../assets/img/<?php echo $orgzerImage; ?>" height="150" width="150" /></p>
                            <input class="input-group" type="file" name="Image" accept="image/*" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-warning" type="submit" name="btupdateorgzer">แก้ไข</button>
                            <a href="organizer_organizer.php"><button class="btn btn-danger" type="button">ยกเลิก</button></a>
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