<?php
include '../control/session_organizer.php';
$stdUser = $_GET['stdUser'];
error_reporting(~E_NOTICE);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| การเข้าร่วมกิจกรรม</title>
    <?php include 'header.php'; ?>

    <style>
        .breadcrumb-item {
            font-size: 16px;
        }

        .ibox {
            position: relative;
            margin-bottom: 25px;
            background-color: #fff;
            -webkit-box-shadow: 1px 1px 1px 1px rgba(1, 1, 1, .1);
            box-shadow: 1px 1px 1px 1px rgba(1, 1, 1, .1);
        }

        .ibox .ibox-body {
            padding: 1px 20px 20px 20px;
        }

        .modal-dialog {
            max-width: 800px;
            margin: 30px auto;
        }
    </style>
</head>

<body class="fixed-navbar">
    <?php
    if (isset($_GET['stdUser'])) {
        $stdUser = $_GET['stdUser'];
        $stmt_view = $session->runQuery('SELECT student.*,organization.*, teacher.*, mainorg.* 
                                                                    FROM student 
                                                                    JOIN organization ON organization.orgtionNo = student.stdOrgtion
                                                                    JOIN teacher ON teacher.teacherNo = student.stdTc
                                                                    JOIN mainorg ON mainorg.mainorgNo = student.stdMainorg
                                                                    WHERE student.stdID=:stdID');
        $stmt_view->execute(array(':stdID' => $stdUser));
        $view_row = $stmt_view->fetch(PDO::FETCH_ASSOC);
        extract($view_row);
    }
    ?>
    <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
        <div class="page-heading">
            <h1 class="page-title" style="color:#528124;">การเข้าร่วมกิจกรรม</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"></li>
                <li class="breadcrumb-item"><a href="organizer_activity_examine.php?stdMainorg=<?php echo $stdMainorg;?>&&stdOrgtion=<?php echo $stdOrgtion;?>&&stdYear=<?php echo $stdYear;?>&&stdGroup=<?php echo $stdGroup;?>">ตรวจสอบการเข้าร่วมกิจกรรม</a></li>
                <li class="breadcrumb-item">การเข้าร่วมกิจกรรม</li>
            </ol>
        </div>
        <br>
        <div class="row">
            <div class="col-12">
                <div class="card" style="border-width:0px;border-top-width:4px;">
                    <div class="card-body ">
                        <ul class="nav nav-tabs ">
                            <li class="nav-item">
                                <a class="nav-link active" href="#pill-1-1" data-toggle="tab">
                                    <h4 style="color:#528124;"><?php echo $stdUser; ?></h4>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#pill-1-2" data-toggle="tab">
                                    <h4 style="color:#528124;"> กิจกรรมของฉัน</h4>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pill-1-1">
                                <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        <div class="card" style="border:0px;">
                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-4">
                                                        <div class="ibox">
                                                            <div class="ibox-body text-center">
                                                                <div class="m-t-20">
                                                                    <img class="img-circle" src="../assets/img/<?php echo $stdImage ?>" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-9 col-md-8">
                                                        <div class="ibox">
                                                            <div class="ibox-body">
                                                                <div class="row justify-content-center">
                                                                    <h3 class="m-t-10 m-b-10 font-strong">ข้อมูลส่วนตัว</h3>
                                                                </div>
                                                                <div class="row justify-content-center">
                                                                    <div class="col-md-10">
                                                                        <ul class="list-group list-group-full list-group-divider">
                                                                            <li class="list-group-item">รหัสนักศึกษา
                                                                                <a href="javascript:;"><span class="pull-right "><?php echo $stdID ?></span></a>
                                                                            </li>
                                                                            <li class="list-group-item">ชื่อ-สกุล
                                                                                <a href="javascript:;"><span class="pull-right "><?php echo $stdName ?></span></a>
                                                                            </li>
                                                                            <li class="list-group-item">สถานะ
                                                                                <a href="javascript:;"><span class="pull-right "><?php echo $stdStatus ?></span></a>
                                                                            </li>
                                                                            <li class="list-group-item">คณะ
                                                                                <a href="javascript:;"><span class="pull-right "><?php echo $mainorg ?></span></a>
                                                                            </li>
                                                                            <li class="list-group-item">สาขา
                                                                                <a href="javascript:;"><span class="pull-right "><?php echo $organization ?></span></a>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php include 'organizer_activity_participant_result.php' ?>
                                <br>
                                <div class="row justify-content-center">
                                    <h4 class="m-t-10 m-b-10 font-strong">ตำแหน่งนักศึกษา</h4>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-10">
                                        <table id="tbact1" class="table table-condensed  text-center">
                                            <thead>
                                                <tr style="color:#528124;">
                                                    <th>ปีการศึกษา</th>
                                                    <th>ตำแหน่ง</th>
                                                    <th>สังกัด</th>
                                                    <th>องค์กร</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $stmt = $session->runQuery("SELECT pst.*, organization.*, mainorg.* 
                                                                                FROM pst 
                                                                                JOIN organization ON organization.orgtionNo = pst.pstOrgtion
                                                                                JOIN mainorg ON mainorg.mainorgNo = pst.pstMainorg
                                                                                WHERE pst.pststdID = '$stdUser'");
                                                $stmt->execute();
                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['pstYear']; ?></td>
                                                        <td><?php echo $row['pst']; ?></td>
                                                        <td><?php echo $row['mainorg']; ?></td>
                                                        <td><?php echo $row['organization']; ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="pill-1-2">
                                <div class="ibox">
                                    <div class="ibox-head">
                                        <div class="ibox-title" style="color:#528124;">
                                            <h4>ตารางกิจกรรมประจำปี</h4>
                                        </div>
                                        <ul class="nav nav-tabs tabs-line pull-right">
                                            <li class="nav-item">
                                                <a class="nav-link active" href="#tab-8-1" data-toggle="tab">ชั้นปีที่ 1</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#tab-8-2" data-toggle="tab">ชั้นปีที่ 2</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#tab-8-3" data-toggle="tab">ชั้นปีที่ 3</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#tab-8-4" data-toggle="tab">ชั้นปีที่ 4</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ibox-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="tab-8-1">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-12">
                                                        <table id="tbact1" class="table table-condensed ">
                                                            <thead>
                                                                <tr style="color:#528124;">
                                                                    <th>หมวดหมู่</th>
                                                                    <th></th>
                                                                    <th>จำนวนกิจกรรมในแผน</th>
                                                                    <th>จำนวนครั้งที่ได้จัดไปแล้ว</th>
                                                                    <th>จำนวนครั้งที่เข้าร่วม</th>
                                                                    <th>ผลการประเมิน</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php include 'organizer_activity_participant_act_y1.php'; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab-8-2">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-12">
                                                        <table id="tbact1" class="table table-condensed ">
                                                            <thead>
                                                                <tr style="color:#528124;">
                                                                    <th>หมวดหมู่</th>
                                                                    <th></th>
                                                                    <th>จำนวนกิจกรรมในแผน</th>
                                                                    <th>จำนวนครั้งที่ได้จัดไปแล้ว</th>
                                                                    <th>จำนวนครั้งที่เข้าร่วม</th>
                                                                    <th>ผลการประเมิน</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php include 'organizer_activity_participant_act_y2.php'; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab-8-3">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-12">
                                                        <table id="tbact1" class="table table-condensed ">
                                                            <thead>
                                                                <tr style="color:#528124;">
                                                                    <th>หมวดหมู่</th>
                                                                    <th></th>
                                                                    <th>จำนวนกิจกรรมในแผน</th>
                                                                    <th>จำนวนครั้งที่ได้จัดไปแล้ว</th>
                                                                    <th>จำนวนครั้งที่เข้าร่วม</th>
                                                                    <th>ผลการประเมิน</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php include 'organizer_activity_participant_act_y3.php'; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="tab-8-4">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-12">
                                                        <table id="tbact1" class="table table-condensed ">
                                                            <thead>
                                                                <tr style="color:#528124;">
                                                                    <th>หมวดหมู่</th>
                                                                    <th></th>
                                                                    <th>จำนวนกิจกรรมในแผน</th>
                                                                    <th>จำนวนครั้งที่ได้จัดไปแล้ว</th>
                                                                    <th>จำนวนครั้งที่เข้าร่วม</th>
                                                                    <th>ผลการประเมิน</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php include 'organizer_activity_participant_act_y4.php'; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalactmoreinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="modal-loader" style="text-align: center; display: none;">
                            <img src="ajax-loader.gif">
                        </div>
                        <div id="dynamic-content"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CORE PLUGINS-->
    <?php include 'footer.php'; ?>
</body>

</html>