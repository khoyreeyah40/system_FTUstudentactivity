<?php
include '../control/session_student.php';
error_reporting(~E_NOTICE); // avoid notice
include '../control/student_activity_register.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| ลงชื่อเข้าร่วมกิจกรรม</title>
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
            <h1 class="page-title" style="color:#528124;">ลงทะเบียนกิจกรรม</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item">ลงทะเบียนกิจกรรม</li>
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
        <br>
        <div class="row">
            <div class="col-12">
                <h3 style="color:#528124;">ตารางกิจกรรม</h3>
                <b>
                    <hr style="margin-top: 0rem;border-color:#528124;border-width: 2px;"></b>
                <div class="card" style="border-width:0px;border-top-width:4px;">
                    <div class="card-body text-nowrap">
                        <table id="tb1" class="table table-md table-hover table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr style="color:#528124;">
                                    <th>วันที่จัด</th>
                                    <th>ชื่อกิจกรรม</th>
                                    <th>หมวดหมู่</th>
                                    <th>กลุ่ม</th>
                                    <th>ลงชื่อเข้าร่วม</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $session->runQuery("SELECT activity.*, acttype.*, organization.*, mainorg  FROM activity
                                        JOIN acttype ON activity.actType = acttype.acttypeNo
                                        JOIN organization ON activity.actOrgtion = organization.orgtionNo
                                        JOIN mainorg ON activity.actMainorg = mainorg.mainorgNo
                                        WHERE activity.actStatus='ดำเนินกิจกรรม' ||activity.actStatus='เปิดการลงทะเบียน' ||activity.actStatus='ปิดการลงทะเบียน'
                                        ORDER BY activity.actDateb DESC
                                          ");
                                $stmt->execute();
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $actDateb = $row['actDateb'];
                                            $actDatee = $row['actDatee'];
                                            if ($actDatee == $actDateb) {
                                                echo thai_date_short(strtotime($actDateb));
                                            } elseif ($actDatee != $actDateb) {
                                                echo thai_date_short(strtotime($actDateb)); ?> ถึง
                                            <?php
                                                echo thai_date_short(strtotime($actDatee));
                                            }
                                            ?>
                                        </td>
                                        <td><a href="" data-toggle="modal" data-target="#modalactmoreinfo" data-id="<?php echo $row['actID']; ?>" id="actmoreinfo"><?php echo $row['actName']; ?></a></td>
                                        <td><?php echo $row['acttypeName']; ?></td>
                                        <td><?php echo $row['actGroup']; ?></td>
                                        <td>
                                            <?php
                                            if (($row['actStatus'] == 'ดำเนินกิจกรรม') || ($row['actStatus'] == 'เปิดการลงทะเบียน') || ($row['actStatus'] == 'ปิดการลงทะเบียน')) {
                                            ?>
                                                <a href="?actreg_id=<?php echo $row['actID']; ?>" onclick="return confirm('ต้องการลงชื่อเข้าร่วมกิจกรรมนี้ ?')"><button class="btn btn-fix btn-sm btn-info">ลงชื่อเข้าร่วม</button></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
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