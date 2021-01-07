<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE);
include '../control/organizer_profile_updateinfo.php';
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
                                <p><img src="../assets/img/<?php echo $orgzerImage; ?>" height="150" width="150" /></p>
                                <input class="input-group" type="file" name="Image" accept="image/*" />
                            </div>
                            <h6 class="font-strong m-b-10 m-t-10"><?php echo $orgzerName; ?></h6>
                            <div class="m-b-20 text-muted"><?php echo $userType; ?></div>
                            <button class="btn btn-warning" type="submit" name="btupdateprofile">แก้ไข</button>
                            <a href="organizer_profile.php"><button class="btn btn-danger" type="button">ยกเลิก</button></a>
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
                                        <li class="list-group-item">รหัสผู้ใช้
                                            <a href="javascript:;"><span class="pull-right "><?php echo $orgzerID; ?></span></a>
                                            <input class="form-control" type="hidden" name="orgzerID" value="<?php echo $orgzerID; ?>" required />
                                        </li>
                                        <li class="list-group-item">ชื่อ-สกุล
                                            <span class="pull-right ">
                                                <input class="form-control" type="text" name="orgzerName" value="<?php echo $orgzerName; ?>" required />
                                            </span>
                                        </li>
                                        <li class="list-group-item">สถานะ
                                            <a href="javascript:;"><span class="pull-right "><?php echo $userType; ?></span></a>
                                        </li>
                                        <li class="list-group-item">กลุ่ม
                                            <a href="javascript:;"><span class="pull-right "><?php echo $orgzerGroup; ?></span></a>
                                        </li>
                                        <li class="list-group-item">ระดับ
                                            <a href="javascript:;"><span class="pull-right "><?php echo $orgzerSec; ?></span></a>
                                        </li>
                                        <li class="list-group-item">สังกัด
                                            <a href="javascript:;"><span class="pull-right "><?php echo $mainorg; ?></span></a>
                                        </li>
                                        <li class="list-group-item">องค์กร
                                            <a href="javascript:;"><span class="pull-right "><?php echo $organization; ?></span></a>
                                        </li>
                                        <li class="list-group-item">หมายเลขโทรศัพท์
                                            <span class="pull-right ">
                                                <input class="form-control" type="text" id="ex-phone" name="orgzerPhone" value="<?php echo $orgzerPhone; ?>" required />
                                            </span>
                                        </li>
                                        <li class="list-group-item">Email
                                            <span class="pull-right ">
                                                <input class="form-control" type="text" name="orgzerEmail" value="<?php echo $orgzerEmail; ?>" required />
                                            </span>
                                        </li>
                                        <li class="list-group-item">Facebook
                                            <span class="pull-right ">
                                                <input class="form-control" type="text" name="orgzerFb" value="<?php echo $orgzerFb; ?>" required />
                                            </span>
                                        </li>
                                        <li class="list-group-item">Password
                                            <span class="pull-right ">
                                                <input class="form-control" type="text" name="orgzerPassword" value="<?php echo $orgzerPassword; ?>" required />
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