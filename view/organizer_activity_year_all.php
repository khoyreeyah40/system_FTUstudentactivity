<?php
include '../control/session_organizer.php';
$actyear = $_GET['actyear']; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| กิจกรรมในแผน</title>
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
            <h1 class="page-title" style="color:#528124;">กิจกรรมทั้งหมดในปี<?php echo $actyear?></h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item"><a href="organizer_activity_year_each.php">ตารางกิจกรรมแต่ละปี</a></li>
                <li class="breadcrumb-item">กิจกรรมทั้งหมดในปี<?php echo $actyear?></li>
            </ol>
        </div>
        <br>
        <div class="row ml-1 mr-1">
            <div class="col-12">
                <div class="card" style="border-width:0px;border-top-width:4px;">
                    <div class="card-body text-nowrap">
                        <?php

                        $stmt = $session->runQuery("SELECT orgzerMainorg,orgzerOrgtion,orgzerGroup FROM organizer WHERE orgzerID = '$loginby'");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $org = $row["orgzerOrgtion"];
                        $m = $row["orgzerMainorg"];
                        $group = $row["orgzerGroup"];
                        ?>
                        <table id="tb1" class="table table-striped table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr style="color:#528124;">
                                    <th>วันที่</th>
                                    <th>รหัสกิจกรรม</th>
                                    <th>ชื่อกิจกรรม</th>
                                    <th>ประเภท</th>
                                    <th>รายชื่อผู้เข้าร่วม</th>
                                    <th>สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $session->runQuery("SELECT activity.*,acttype.*,organization.*,mainorg.*
                                                                        FROM activity 
                                                                        JOIN acttype ON acttype.acttypeNo = activity.actType
                                                                        JOIN mainorg ON mainorg.mainorgNo = activity.actMainorg
                                                                        JOIN organization ON organization.orgtionNo = activity.actOrgtion
                                                                        WHERE 
                                                                        activity.actYear = '$actyear' 
                                                                        && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                                                                        && activity.actMainorg = '$m' && activity.actOrgtion = '$org'
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
                                        <td><?php echo $row['actID'] ?></td>
                                        <td><a href="" data-toggle="modal" data-target="#modalactmoreinfo" data-id="<?php echo $row['actID']; ?>" id="moreactinfo"><?php echo $row['actName']; ?></a></td>
                                        <td><?php echo $row['acttypeName'] ?></td>
                                        <td>
                                            <a href="" data-toggle="modal" data-target="#modalstd" data-id="<?php echo $row['actID']; ?>" id="std"><button class="btn btn-info btn-sm" type="button"> <span class="fa fa-child"></span> &nbsp; รายชื่อผู้เข้าร่วม</button></a>
                                        </td>
                                        <td><?php echo $row['actStatus'] ?></td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
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
                    <div class="modal fade" id="modalstd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="modal-loader1" style="text-align: center; display: none;">
                                        <img src="ajax-loader.gif">
                                    </div>
                                    <div id="dynamic-content1">
                                    </div>
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

            $(document).on('click', '#moreactinfo', function(e) {

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
    <script>
        /* View Function*/
        $(document).ready(function() {

            $(document).on('click', '#std', function(e) {

                e.preventDefault();

                var actID = $(this).data('id'); // it will get id of clicked row

                $('#dynamic-content1').html(''); // leave it blank before ajax call
                $('#modal-loader1').show(); // load ajax loader

                $.ajax({
                        url: 'moreparticipantnameinfo.php',
                        type: 'POST',
                        data: 'id=' + actID,
                        dataType: 'html'
                    })
                    .done(function(data) {
                        console.log(data);
                        $('#dynamic-content1').html('');
                        $('#dynamic-content1').html(data); // load response 
                        $('#modal-loader1').hide(); // hide ajax loader 
                    })
                    .fail(function() {
                        $('#dynamic-content1').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
                        $('#modal-loader1').hide();
                    });

            });

        });
    </script>
</body>

</html>