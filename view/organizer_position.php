<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE); // avoid notice
include '../control/organizer_position.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| จัดการตำแหน่งนักศึกษา</title>
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
            <h1 class="page-title">จัดการตำแหน่งนักศึกษา</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item">จัดการตำแหน่งนักศึกษา</li>
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
        <div class="ibox" style="box-shadow: 0 5px 4px rgba(0,0,0,.1);">
            <div class="ibox-head" style="background-color:#d1cbaf;">
                <div class="ibox-title" style="color:#484848;">
                    <h5>เพิ่มรายชื่อ</h5>
                </div>
                <div class="ibox-tools">
                    <a class="ibox-collapse" style="color:#484848;"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                <form class="form-horizontal" id="form-sample-1" enctype="multipart/form-data" method="post" novalidate="novalidate">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">ปีการศึกษา</label>
                        <div class="col-sm-2">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="pstYear" required />
                            <?php include '../control/select_activity_year.php'; ?>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">รหัสนักศึกษา</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="text" name="pststdID" require />
                        </div>
                        <label class="col-sm-1 col-form-label">ตำแหน่ง</label>
                        <div class="col-sm-4">
                            <input class="form-control" type="text" name="pst" value="<?php echo $pst; ?>" require />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">สังกัด</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="pstMainorg" id="orgzermainorg" onChange="getorgtion(this.value);">
                                <option selected="selected" disabled="disabled">--กรุณาเลือกสังกัด--</option>
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
                            <select class="form-control select2_demo_1" style="width: 100%;" name="pstOrgtion" id="orgzerorgtion">
                                <option selected="selected" disabled="disabled">--กรุณาเลือกองค์กร--</option>
                            </select>
                        </div>
                    </div>
                    <input class="form-control" type="hidden" name="pstAddby" value="<?php echo $loginby; ?>" readonly />
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-info" type="submit" name="btaddposition">เพิ่ม</button>
                            <a href="organizer_position.php"><button class="btn btn-danger" type="button" data-dismiss="ibox">ยกเลิก</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
                    <div class="card-header" style="background-color:#d1cbaf">
                        <h5 style="color:#2c2c2c">ตารางตำแหน่งนักศึกษา</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body text-nowrap">
                        <table id="tbpst" class="table table-hover-sm table-striped text-center" cellspacing="0" width="100%">
                            <thead>
                                <tr style="color:#528124;">
                                    <th>ปีการศึกษา</th>
                                    <th>รหัสนักศึกษา</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th>ตำแหน่ง</th>
                                    <th>หมายเลขโทรศัพท์</th>
                                    <th>องค์กร</th>
                                    <th>แก้ไข/ลบ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $session->runQuery("SELECT orgzerOrgtion,orgzerSec, orgzerMainorg FROM organizer WHERE orgzerID = '$loginby'");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                if ($row["orgzerSec"] == "Admin") {
                                    $stmt = $session->runQuery("SELECT pst.*, organization.*, student.* FROM pst 
                                                                JOIN organization ON organization.orgtionNo = pst.pstOrgtion
                                                                JOIN student ON student.stdID = pst.pststdID
                                                                ");
                                    $stmt->execute();
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['pstYear']; ?></td>
                                            <td><a href="" data-toggle="modal" data-target="#modalmoreinfo" data-id="<?php echo $row['stdID']; ?>" id="moreinfo"><?php echo $row['stdID']; ?></a></td>
                                            <td><?php echo $row['stdName']; ?></td>
                                            <td><?php echo $row['pst']; ?></td>
                                            <td><?php echo $row['stdPhone']; ?></td>
                                            <td><?php echo $row['organization']; ?></td>
                                            <td>
                                                <a href="organizer_position_updateinfo.php?update_id=<?php echo $row['pstNo']; ?>"  onclick="return confirm('ต้องการแก้ไขตำแหน่งนักศึกษา ?')"><button class="btn btn-warning btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i></button></a>
                                                <a href="?delete_id=<?php echo $row['pstNo']; ?>"  onclick="return confirm('ต้องการลบรายชื่อออกจากตำแหน่งนักศึกษา ?')"><button class="btn btn-danger btn-sm" data-toggle="tooltip"><i class="fa fa-trash font-30"></i></button></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } elseif ($row["orgzerSec"] == "มหาวิทยาลัย") {
                                    $sec = $row["orgzerSec"];
                                    $stmt = $session->runQuery("SELECT pst.*, organization.*, student.*, actyear.*,mainorg.* FROM pst 
                                                                        JOIN mainorg ON mainorg.mainorgNo = pst.pstMainorg
                                                                        JOIN organization ON organization.orgtionNo = pst.pstOrgtion
                                                                        JOIN student ON student.stdID = pst.pststdID
                                                                        JOIN actyear ON pst.pstYear = actyear.actyear
                                                                        WHERE mainorg.mainorgSec='$sec' && actyear.actyearStatus = 'ดำเนินกิจกรรม'
                                                                        ");
                                    $stmt->execute();
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['pstYear']; ?></td>
                                            <td><a href="" data-toggle="modal" data-target="#modalmoreinfo" data-id="<?php echo $row['stdID']; ?>" id="moreinfo"><?php echo $row['stdID']; ?></a></td>
                                            <td><?php echo $row['stdName']; ?></td>
                                            <td><?php echo $row['pst']; ?></td>
                                            <td><?php echo $row['stdPhone']; ?></td>
                                            <td><?php echo $row['organization']; ?></td>
                                            <td>
                                                <a href="organizer_position_updateinfo.php?update_id=<?php echo $row['pstNo']; ?>"  onclick="return confirm('ต้องการแก้ไขตำแหน่งนักศึกษา ?')"><button class="btn btn-warning btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i></button></a>
                                                <a href="?delete_id=<?php echo $row['pstNo']; ?>"  onclick="return confirm('ต้องการลบรายชื่อออกจากตำแหน่งนักศึกษา ?')"><button class="btn btn-danger btn-sm" data-toggle="tooltip"><i class="fa fa-trash font-30"></i></button></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                } elseif ($row["orgzerSec"] == "คณะ") {
                                    $m = $row["orgzerMainorg"];
                                    $stmt = $session->runQuery("SELECT pst.*, organization.*, student.*, actyear.*, mainorg.* FROM pst 
                                                                        JOIN mainorg ON mainorg.mainorgNo = pst.pstMainorg
                                                                        JOIN organization ON organization.orgtionNo = pst.pstOrgtion
                                                                        JOIN student ON student.stdID = pst.pststdID
                                                                        JOIN actyear ON pst.pstYear = actyear.actyear
                                                                        WHERE pst.pstMainorg='$m' && actyear.actyearStatus = 'ดำเนินกิจกรรม'
                                                                        ");
                                    $stmt->execute();
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row['pstYear']; ?></td>
                                            <td><a href="" data-toggle="modal" data-target="#modalmoreinfo" data-id="<?php echo $row['stdID']; ?>" id="moreinfo"><?php echo $row['stdID']; ?></a></td>
                                            <td><?php echo $row['stdName']; ?></td>
                                            <td><?php echo $row['pst']; ?></td>
                                            <td><?php echo $row['stdPhone']; ?></td>
                                            <td><?php echo $row['organization']; ?></td>
                                            <td>
                                                <a href="organizer_position_updateinfo.php?update_id=<?php echo $row['pstNo']; ?>"  onclick="return confirm('ต้องการแก้ไขตำแหน่งนักศึกษา ?')"><button class="btn btn-warning btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i></button></a>
                                                <a href="?delete_id=<?php echo $row['pstNo']; ?>"  onclick="return confirm('ต้องการลบรายชื่อออกจากตำแหน่งนักศึกษา ?')"><button class="btn btn-danger btn-sm" data-toggle="tooltip"><i class="fa fa-trash font-30"></i></button></a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="modalmoreinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle" style="color:#528124;">รายละเอียดเพิ่มเติม</h5>
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
            </div>
        </div>
    </div>
    <!-- CORE PLUGINS-->
    <?php include 'footer.php'; ?>
    <script>
        /* View Function*/
        $(document).ready(function() {

            $(document).on('click', '#moreinfo', function(e) {

                e.preventDefault();

                var stdid = $(this).data('id'); // it will get id of clicked row

                $('#dynamic-content').html(''); // leave it blank before ajax call
                $('#modal-loader').show(); // load ajax loader

                $.ajax({
                        url: 'morestdinfo.php',
                        type: 'POST',
                        data: 'id=' + stdid,
                        dataType: 'html'
                    })
                    .done(function(data) {
                        console.log(data);
                        $('#dynamic-content').html('');
                        $('#dynamic-content').html(data); // load response 
                        $('#modal-loader').hide(); // hide ajax loader 
                    })
                    .fail(function() {
                        $('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                        $('#modal-loader').hide();
                    });

            });

        });
    </script>
</body>

</html>