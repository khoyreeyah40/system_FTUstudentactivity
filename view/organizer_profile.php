<?php require_once("../control/session_organizer.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| ข้อมูลส่วนตัว</title>
    <?php include 'header.php'; ?>

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
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <div class="ibox">
                    <div class="ibox-body text-center">
                        <div class="m-t-20">
                            <img class="img-circle" src="../assets/img/<?php echo $orgzerRow['orgzerImage']; ?>" />
                        </div>
                        <h6 class="font-strong m-b-10 m-t-10"><?php echo $orgzerRow['orgzerName']; ?></h6>
                        <div class="m-b-20 text-muted"><?php echo $orgzerRow['userType']; ?></div>
                        <a href="organizer_profile_updateinfo.php?update_id=<?php echo $orgzerRow['orgzerID']; ?>" onclick="return confirm('ต้องการแก้ไขข้อมูลส่วนตัว ?')"><button class="btn btn-warning btn-sm m-r-5 btn-fix" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i> แก้ไขข้อมูลส่วนตัว</button></a>
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
                                        <a href="javascript:;"><span class="pull-right "><?php echo $orgzerRow['orgzerID']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">ชื่อ-สกุล
                                        <a href="javascript:;"><span class="pull-right "><?php echo $orgzerRow['orgzerName']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">สถานะ
                                        <a href="javascript:;"><span class="pull-right "><?php echo $orgzerRow['userType']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">กลุ่ม
                                        <a href="javascript:;"><span class="pull-right "><?php echo $orgzerRow['orgzerGroup']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">ระดับ
                                        <a href="javascript:;"><span class="pull-right "><?php echo $orgzerRow['orgzerSec']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">สังกัด
                                        <a href="javascript:;"><span class="pull-right "><?php echo $orgzerRow['mainorg']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">องค์กร
                                        <a href="javascript:;"><span class="pull-right "><?php echo $orgzerRow['organization']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">หมายเลขโทรศัพท์
                                        <a href="javascript:;"><span class="pull-right "><?php echo $orgzerRow['orgzerPhone']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">Email
                                        <a href="javascript:;"><span class="pull-right "><?php echo $orgzerRow['orgzerEmail']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">Facebook
                                        <a href="javascript:;"><span class="pull-right "><?php echo $orgzerRow['orgzerFb']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">Password
                                        <a href="javascript:;"><span class="pull-right "><?php echo $orgzerRow['orgzerPassword']; ?></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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