<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE);
include '../control/organizer_studentall_updateinfo.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| จัดการนักศึกษาทั้งหมด</title>
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
                    $("#stdorgtion").html(data);
                }
            });
        }
    </script>
    <script>
        function gettc(val) {
            $.ajax({
                type: "POST",
                url: "../control/select_student_tc.php",
                data: 'mainorgNo=' + val,
                success: function(data) {
                    $("#stdtc").html(data);
                }
            });
        }
    </script>
</head>

<body class="fixed-navbar">
    <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
        <div class="page-heading">
            <h1 class="page-title">จัดการรายชื่อนักศึกษา</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item"><a href="organizer_studentall.php">จัดการรายชื่อนักศึกษา</a></li>
                <li class="breadcrumb-item">แก้ไขข้อมูลนักศึกษา</li>
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
                    <h5>แก้ไขข้อมูลนักศึกษา</h5>
                </div>
            </div>
            <div class="ibox-body">
                <form class="form-horizontal" id="form-sample-1" method="post" enctype="multipart/form-data" novalidate="novalidate" style="height:500px; width:100%">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">ปีที่เข้าศึกษา</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="stdYear" value="<?php echo $stdYear; ?>" require>
                        </div>
                        <label class="col-sm-1 col-form-label">รหัสนักศึกษา</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="stdID" value="<?php echo $stdID; ?>" require>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">ชื่อ-สกุล</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control " name="stdName" value="<?php echo $stdName; ?>" require>
                        </div>
                        <label class="col-sm-1 col-form-label">กลุ่ม</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="stdGroup" required>
                                <option value="<?php echo $stdGroup ?>"> <?php echo $stdGroup ?></option>
                                <option value="ชาย">ชาย</option>
                                <option value="หญิง">หญิง</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">คณะ</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="stdMainorg" id="stdmainorg" onChange="getorgtion(this.value);gettc(this.value);" required>
                                <option value="<?php echo $stdMainorg ?>"> <?php echo $mainorg; ?></option>
                                <?php
                                $stmt = $session->runQuery("SELECT orgzerSec, orgzerMainorg FROM organizer WHERE orgzerID = '$loginby'");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($row["orgzerSec"] == "Admin") {
                                ?><option disabled="disabled">--กรุณาเลือกคณะ--</option><?php
                                                                                            include '../control/select_faculty_all.php';
                                                                                        }
                                                                                        if ($row["orgzerSec"] == "คณะ") {
                                                                                            ?><option disabled="disabled">--กรุณาเลือกคณะ--</option><?php
                                                                                            include '../control/select_faculty_each.php';
                                                                                        }
                                                                                            ?>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">สาขา</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="stdOrgtion" id="stdorgtion" required>
                                <option selected="selected" value="<?php echo $stdOrgtion; ?>"> <?php echo $organization; ?></option>
                                <option disabled="disabled">--กรุณาเลือกสาขา--</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">อาจารย์ที่ปรึกษา</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="stdTc" id="stdtc" required>
                                <option selected="selected" value="<?php echo $stdTc; ?>"> <?php echo $teacher; ?></option>
                                <option disabled="disabled">--กรุณาเลือกอาจารย์ที่ปรึกษา--</option>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">หมายเลขโทรศัพท์</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" id="ex-phone" name="stdPhone" value="<?php echo $stdPhone; ?>" require>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">E-mail</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="stdEmail" value="<?php echo $stdEmail; ?>" require>
                        </div>
                        <label class="col-sm-1 col-form-label">Facebook</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="stdFb" value="<?php echo $stdFb; ?>" require>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">รหัสผ่าน</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="stdPassword" value="<?php echo $stdPassword; ?>" require>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-warning" type="submit" name="btupdatestudentall">แก้ไข</button>
                            <a href="organizer_studentall.php"><button class="btn btn-danger" type="button">ยกเลิก</button></a>
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