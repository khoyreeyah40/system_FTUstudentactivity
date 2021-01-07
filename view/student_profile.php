<?php include '../control/session_student.php'; ?>

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
                            <img class="img-circle" src="../assets/img/<?php echo $stdRow['stdImage']; ?>" />
                        </div>
                        <h5 class="font-strong m-b-10 m-t-10"><?php echo $stdRow['stdName']; ?></h5>
                        <div class="m-b-20 text-muted"><?php echo $stdRow['stdStatus']; ?></div>
                        <a href="student_profile_updateinfo.php?update_id=<?php echo $stdRow['stdID']; ?>"  onclick="return confirm('ต้องการแก้ไขข้อมูลส่วนตัว ?')"><button class="btn btn-warning btn-sm m-r-5 btn-fix" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i> แก้ไขข้อมูลส่วนตัว</button></a>
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
                                        <a href="javascript:;"><span class="pull-right"><?php echo $stdRow['stdYear']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">รหัสนักศึกษา
                                        <a href="javascript:;"><span class="pull-right "><?php echo $stdRow['stdID']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">ชื่อ-สกุล
                                        <a href="javascript:;"><span class="pull-right "><?php echo $stdRow['stdName']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">สถานะ
                                        <a href="javascript:;"><span class="pull-right "><?php echo $stdRow['stdStatus']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">กลุ่ม
                                        <a href="javascript:;"><span class="pull-right "><?php echo $stdRow['stdGroup']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">คณะ
                                        <a href="javascript:;"><span class="pull-right "><?php echo $stdRow['mainorg']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">สาขา
                                        <a href="javascript:;"><span class="pull-right "><?php echo $stdRow['organization']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">อาจารย์ที่ปรึกษา
                                        <a href="javascript:;"><span class="pull-right "><?php echo $stdRow['teacher']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">หมายเลขโทรศัพท์
                                        <a href="javascript:;"><span class="pull-right "><?php echo $stdRow['stdPhone']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">Email
                                        <a href="javascript:;"><span class="pull-right "><?php echo $stdRow['stdEmail']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">Facebook
                                        <a href="javascript:;"><span class="pull-right "><?php echo $stdRow['stdFb']; ?></span></a>
                                    </li>
                                    <li class="list-group-item">Password
                                        <a href="javascript:;"><span class="pull-right "><?php echo $stdRow['stdPassword']; ?></span></a>
                                    </li>
                                </ul>
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