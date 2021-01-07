<?php
include '../control/session_student.php';
error_reporting(~E_NOTICE);
include '../control/student_profile_updateinfo.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| ข้อมูลส่วนตัว</title>
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
            <h1 class="page-title">ข้อมูลส่วนตัว</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item">ข้อมูลส่วนตัว</li>
            </ol>
        </div>
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
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="ibox">
                        <div class="ibox-body text-center">
                            <div class="m-t-20">
                                <p><img src="../assets/img/<?php echo $stdImage; ?>" height="150" width="150" /></p>
                                <input class="input-group" type="file" name="Image" accept="image/*" />
                            </div>
                            <h6 class="font-strong m-b-10 m-t-10"><?php echo $stdName; ?></h6>
                            <div class="m-b-20 text-muted"><?php echo $stdStatus; ?></div>
                            <button class="btn btn-warning" type="submit" name="btupdateprofile">แก้ไข</button>
                            <a href="student_profile.php"><button class="btn btn-danger" type="button">ยกเลิก</button></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8">
                    <div class="ibox">
                        <div class="ibox-body">
                            <div class="row justify-content-center">
                                <h1 class="m-t-10 m-b-10 font-strong">ข้อมูลส่วนตัว</h1>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <ul class="list-group list-group-full list-group-divider">
                                        <li class="list-group-item">ปีที่เข้าศึกษา
                                            <span class="pull-right ">
                                                <select class="form-control select2_demo_1" style="width: 100%;" name="stdYear" required />
                                                <option value="<?php echo $stdYear ?>"> <?php echo $stdYear ?></option>
                                                <option disabled="disabled">--ปีการศึกษา--</option>
                                                <?php include '../control/function_year.php'; ?>
                                                </select>
                                            </span>
                                        </li>
                                        <li class="list-group-item">รหัสนักศึกษา
                                            <span class="pull-right ">
                                                <a href="javascript:;"><span class="pull-right "><?php echo $stdID; ?></span></a>
                                                <input class="form-control" type="hidden" name="stdID" value="<?php echo $stdID; ?>" readonly />
                                            </span>
                                        </li>
                                        <li class="list-group-item">ชื่อ-สกุล
                                            <span class="pull-right ">
                                                <input class="form-control" type="text" name="stdName" value="<?php echo $stdName; ?>" required />
                                            </span>
                                        </li>
                                        <li class="list-group-item">สถานะ
                                            <span class="pull-right ">
                                                <select class="form-control select2_demo_1" style="width: 100%;" name="stdStatus" required />
                                                <option value="<?php echo $stdStatus ?>"> <?php echo $stdStatus ?></option>
                                                <option disabled="disabled">--สถานะ--</option>
                                                <option value="กำลังศึกษา"> กำลังศึกษา</option>
                                                <option value="จบการศึกษา"> จบการศึกษา</option>
                                                </select>
                                            </span>
                                        </li>
                                        <li class="list-group-item">กลุ่ม
                                            <span class="pull-right ">
                                                <select class="form-control select2_demo_1" style="width: 100%;" name="stdGroup" required />
                                                <option value="<?php echo $stdGroup ?>"> <?php echo $stdGroup ?></option>
                                                <option disabled="disabled">--กลุ่ม--</option>
                                                <option value="ชาย"> ชาย</option>
                                                <option value="หญิง"> หญิง</option>
                                                </select>
                                            </span>
                                        </li>
                                        <li class="list-group-item">คณะ
                                            <span class="pull-right ">
                                                <select class="form-control select2_demo_1" style="width: 100%;" name="stdMainorg" id="stdMainorg" onChange="getorgtion(this.value);gettc(this.value);" required>
                                                    <option value="<?php echo $stdMainorg ?>"> <?php echo $mainorg ?></option>
                                                    <option disabled="disabled">--คณะ--</option>
                                                    <?php include '../control/select_faculty_all.php'; ?>
                                                </select>
                                            </span>
                                        </li>
                                        <li class="list-group-item">สาขา
                                            <span class="pull-right ">
                                                <select class="form-control select2_demo_1" style="width: 100%;" name="stdOrgtion" id="stdorgtion" required />
                                                <option value="<?php echo $stdOrgtion ?>"> <?php echo $organization ?>
                                                <option disabled="disabled">--สาขา--</option>
                                                </select>
                                            </span>
                                        </li>
                                        <li class="list-group-item">อาจารย์ที่ปรึกษา
                                            <span class="pull-right ">
                                                <select class="form-control select2_demo_1" style="width: 100%;" name="stdTc" id="stdtc" required />
                                                <option value="<?php echo $stdTc ?>"> <?php echo $teacher ?></option>
                                                <option disabled="disabled">--อาจารย์ที่ปรึกษา--</option>
                                                </select>
                                            </span>
                                        </li>
                                        <li class="list-group-item">หมายเลขโทรศัพท์
                                            <span class="pull-right ">
                                                <input class="form-control" type="text" id="ex-phone" name="stdPhone" value="<?php echo $stdPhone; ?>" required />
                                            </span>
                                        </li>
                                        <li class="list-group-item">Email
                                            <span class="pull-right ">
                                                <input class="form-control" type="text" name="stdEmail" value="<?php echo $stdEmail; ?>" required />
                                            </span>
                                        </li>
                                        <li class="list-group-item">Facebook
                                            <span class="pull-right ">
                                                <input class="form-control" type="text" name="stdFb" value="<?php echo $stdFb; ?>" required />
                                            </span>
                                        </li>
                                        <li class="list-group-item">Password
                                            <span class="pull-right ">
                                                <input class="form-control" type="text" name="stdPassword" value="<?php echo $stdPassword; ?>" required />
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <style>
            .profile-social a {
                font-size: 16px;
                margin: 0 10px;
                color: #999;
            }

            .profile-social a:hover {
                color: #485b6f;
            }

            .profile-stat-count {
                font-size: 22px
            }
        </style>
    </div>
    <!-- CORE PLUGINS-->
    <?php include 'footer.php'; ?>
</body>

</html>