<?php
include '../control/session_student.php';
include '../control/student_activity_confirm.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| ยืนยันการเข้าร่วมกิจกรรม</title>
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
    <?php include '../control/function_yearthai.php'; ?>
    <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
        <div class="page-heading">
            <h1 class="page-title" style="color:#528124;">ยืนยันการเข้าร่วมกิจกรรม</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item">ยืนยันการเข้าร่วมกิจกรรม</li>
            </ol>
        </div>
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

        $stmt = $session->runQuery("SELECT halaqahstd.*,halaqahchecklist.*,halaqahtc.*,organizer.*  FROM halaqahchecklist
            JOIN halaqahtc ON halaqahchecklist.halaqahID = halaqahtc.halaqahtcNo
            JOIN organizer ON halaqahtc.halaqahtcID = organizer.orgzerID 
            JOIN halaqahstd ON halaqahstd.halaqahID = halaqahtc.halaqahtcNo
            WHERE halaqahstd.halaqahstdID ='$stdUser' && halaqahchecklist.halaqahcheckliststatus='เปิดการลงทะเบียน'
                                          ");
        $stmt->execute();
        if ($stmt->rowCount()) { ?>
            <br>
            <div class="row">
                <div class="col-12">
                    <h4 style="color:#528124;">ตารางกลุ่มศึกษาอัลกุรอ่าน</h4>
                    <b>
                        <hr style="margin-top: 0rem;border-color:#528124;border-width: 2px;"></b>
                    <div class="card" style="border-width:0px;border-top-width:4px;">
                        <div class="card-body text-nowrap">
                            <table id="tb1" class="table table-hover table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr style="color:#528124;">
                                        <th>วันที่</th>
                                        <th>ที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน</th>
                                        <th>ยืนยันการเข้าร่วม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $stmt1 = $session->runQuery("SELECT halaqahstd.*,halaqahchecklist.*,halaqahtc.*,organizer.* FROM halaqahchecklist
                                                                JOIN halaqahtc ON halaqahchecklist.halaqahID = halaqahtc.halaqahtcNo
                                                                JOIN organizer ON halaqahtc.halaqahtcID = organizer.orgzerID 
                                                                JOIN halaqahstd ON halaqahstd.halaqahID = halaqahtc.halaqahtcNo
                                                                WHERE halaqahstd.halaqahstdID ='$stdUser' && halaqahchecklist.halaqahcheckliststatus='เปิดการลงทะเบียน'
                                                                ");
                                    $stmt1->execute();
                                    while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td>
                                                <? 
                                               $dateb=$row['halaqahchecklistdate'];
                                                echo thai_date_short(strtotime($dateb));
                                            ?>
                                            </td>
                                            <td><?php echo $row['orgzerName']; ?></td>
                                            <td>
                                                <?php
                                                $halaqahchecklist_no = $row['halaqahchecklistNo'];
                                                $halaqahcheckstdID = $row['halaqahstdNo'];
                                                $stmt2 = $session->runQuery("SELECT * FROM halaqahcheck WHERE halaqahchecklistNo='$halaqahchecklist_no' && halaqahcheckstdID='$halaqahcheckstdID'");
                                                $stmt2->execute();
                                                if ($stmt2->rowCount()) { ?>ยืนยันการเข้าร่วมเรียบร้อย
                                            <?php } else { ?>
                                                <a class="btn btn-sm  btn-success" href="?halaqahcheckstd_id=<?php echo $row['halaqahstdNo']; ?>&& halaqahchecklist_no=<?php echo $row['halaqahchecklistNo']; ?>" title="ยืนยันเข้าร่วม" onclick="return confirm('ต้องการยืนยันการเข้าร่วม ?')">ยืนยัน</a>
                                            <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else {
        }
        ?>
        <br>
        <div class="row">
            <div class="col-12">
                <h4 style="color:#528124;">ตารางกิจกรรม</h4>
                <b>
                    <hr style="margin-top: 0rem;border-color:#528124;border-width: 2px;"></b>
                <div class="card" style="border-width:0px;border-top-width:4px;">
                    <div class="card-body text-nowrap">
                        <table id="tb2" class="table table-hover table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr style="color:#528124;">
                                    <th>วันที่จัด</th>
                                    <th>ชื่อกิจกรรม</th>
                                    <th>สถานะ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $session->runQuery("SELECT activity.* ,actregister.*, acttype.*, actsem.*  FROM actregister
                                        JOIN activity ON activity.actID = actregister.actregactID
                                        JOIN acttype ON acttype.acttypeNo = activity.actType
                                        JOIN actsem ON actsem.actsemNo = activity.actSem
                                        WHERE actregister.actregstdID='$stdUser' && (activity.actStatus='ดำเนินกิจกรรม'||activity.actStatus='เปิดการลงทะเบียน'||activity.actStatus='ปิดการลงทะเบียน')
                                        
                                          ");
                                $stmt->execute();
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td>
                                            <? 
                                               $dateb=$row['actDateb'];
                                               $datee=$row['actDatee'];
                                                echo thai_date_short(strtotime($dateb));?> -
                                            <?echo thai_date_short(strtotime($datee));
                                            ?>
                                        </td>
                                        <td><a href="" data-toggle="modal" data-target="#modalactmoreinfo" data-id="<?php echo $row['actID']; ?>" id="moreactinfo"><?php echo $row['actName']; ?></a></td>
                                        <td>
                                            <?php if ($row['actStatus'] == 'ดำเนินกิจกรรม') {
                                                echo $row['actregStatus'];
                                            } else if (($row['actStatus'] == 'เปิดการลงทะเบียน') && ($row['actregStatus'] == 'รอยืนยันการเข้าร่วม') && ($row['acttypeName'] != 'กิจกรรมซ่อม')) {
                                            ?>
                                                <a class="btn btn-sm  btn-success" href="?check_id=<?php echo $row['actregNo']; ?>" title="ยืนยันเข้าร่วมกิจกรรม" onclick="return confirm('ต้องการยืนยันการเข้าร่วมกิจกรรม ?')"> ยืนยัน</a>
                                            <?php
                                            } else if (($row['actStatus'] == 'เปิดการลงทะเบียน') && ($row['actregStatus'] == 'รอยืนยันการเข้าร่วม') && ($row['acttypeName'] == 'กิจกรรมซ่อม')) {
                                            ?>
                                                <a class="btn btn-sm  btn-success" href="?checksolve_id=<?php echo $row['actregNo']; ?>&&actsem=<?php echo $row['actSem']; ?>&&actmainorg=<?php echo $row['actMainorg']; ?>
                                                        &&actorgtion=<?php echo $row['actOrgtion']; ?>&&actsec=<?php echo $row['actSec']; ?>&&stdid=<?php echo $row['actregstdID']; ?>" title="ยืนยันเข้าร่วมกิจกรรม" onclick="return confirm('ต้องการยืนยันการเข้าร่วมกิจกรรม ?')"> ยืนยัน</a>
                                            <?php
                                            } else if (($row['actStatus'] == 'เปิดการลงทะเบียน') && (($row['actregStatus'] == 'ยืนยันเรียบร้อย') || ($row['actregStatus'] == 'แก้กิจกรรมเรียบร้อย'))) {
                                                echo $row['actregStatus'];
                                            } else {
                                                echo $row['actregStatus'];
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php if ($row['actregStatus'] == 'รอยืนยันการเข้าร่วม') { ?>
                                                <a class="btn btn-sm  btn-danger" href="?delete_id=<?php echo $row['actregNo']; ?>" title="ยกเลิกการเข้าร่วมกิจกรรม" onclick="return confirm('ต้องการยกเลิกการเข้าร่วมกิจกรรมนี้ ?')"> <i class="fa fa-trash"></i> ยกเลิก</a>
                                            <?php } else if ($row['actregStatus'] == 'จำนงแก้กิจกรรม') { ?>
                                                <a class="btn btn-sm  btn-danger" href="?delete_id=<?php echo $row['actregNo']; ?>" title="ยกเลิกจำนงแก้กิจกรรม" onclick="return confirm('ต้องการยกเลิกการจำนงแก้กิจกรรมนี้ ?')"> <i class="fa fa-trash"></i> ยกเลิก</a>
                                                <?php } else if ($row['actregStatus'] == 'ยืนยันเรียบร้อย') {
                                                if ($row['actAssesslink'] != null) { ?>
                                                    <a class="btn btn-sm  btn-primary" href="<?php echo $row['actAssesslink']; ?>" target="_blank"> ประเมิน</a>
                                                <?php       } else {
                                                } ?>
                                        <?php     }
                                        } ?>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
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
                        <div id="dynamic-content">
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

            $(document).on('click', '#actmoreinfo', function(e) {

                e.preventDefault();

                var actID = $(this).data('id'); // it will get id of clicked row

                $('#dynamic-content').html(''); // leave it blank before ajax call
                $('#modal-loader').show(); // load ajax loader

                $.ajax({
                        url: 'moreactinfo.php',
                        type: 'POST',
                        data: 'id=' + actID,
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