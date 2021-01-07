<?php include '../control/session_student.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| หน้าแรก</title>
    <?php include 'header.php'; ?>

    <!-- PAGE LEVEL STYLES-->
    <style>
        .sidebar-mini {
            margin-left: 0px;
        }

        .content-wrapper {
            margin-left: 0px;
        }

        .carousel-inner>.item>img,
        .carousel-inner>.item>a>img {
            width: 100%;
            margin: auto;
            height: 400px;
        }

        .modal-dialog {
            max-width: 800px;
            margin: 30px auto;
        }
    </style>
</head>

<body class="fixed-navbar">
    <? include '../control/function_yearthai.php';?>
    <div class="page-content fade-in-up mt-0 pt-0">
        <div class="row">
            <div class="col-12 mb-2">
                <div class="card" style="border-width:0px;border-top-width:4px;color:#FFFFFF;">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                        </ol>
                        <div class="carousel-inner" role="listbox">
                            <?php
                            $stmt = $session->runQuery("SELECT * FROM board where boardStatus='แสดง' order by boardNo DESC limit 4");
                            $stmt->execute();
                            $num = 0;
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                $num++;
                            ?>
                                <div class="carousel-item <?php if ($num == "1") {
                                                                echo "active";
                                                            } else {
                                                            } ?> ">
                                    <?php
                                    if ($row['boardLink'] != null) {
                                    ?>
                                        <a href="<?php echo $row['boardLink']; ?>" target="_blank"><img src="../assets/img/<?php echo $row['board']; ?>" class="d-block w-100" alt="" style="height: 450px;width:100%;"></a>
                                    <?php } else { ?>
                                        <img src="../assets/img/<?php echo $row['board']; ?>" class="d-block w-100" alt="" style="height: 450px;width:100%;">
                                    <?php } ?>
                                    <div class="carousel-caption" style="color:#528124;">
                                        <br><?php echo $row['boardDiscribe']; ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <br>
        <div class="row ml-1 mr-1">
            <div class="col-8">
                <nav class="navbar navbar-light justify-content-between mb-0 pb-0 pr-0 pl-0  ">
                    <a class="navbar-brand">
                        <h3 style="color:#417d19;">ข่าวประชาสัมพันธ์</h3>
                        <a class="ml-auto" href="student_news_all.php">ดูทั้งหมด>>></a>
                </nav>
                <b>
                    <hr style="margin-top: 0rem;border-color:#528124;border-width: 2px;"></b>
                <div class="card" style="padding:0px 17.5px;border-width:0px;border-top-width:4px;">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-deck">
                                <?php
                                $stmt = $session->runQuery("SELECT * FROM news  where newsStatus='แสดง' ORDER BY newsNo DESC limit 0,8 ");
                                $stmt->execute();
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $newsStatus  = $row["newsStatus"];
                                    $newsImage   = $row['newsImage'];
                                    $newsTitle   = $row["newsTitle"];
                                ?>
                                    <div class="col-sm-3 mt-4" style="padding:0px 0px 0px 5px;">
                                        <div class="card m-2">
                                            <a type="button" data-toggle="modal" data-target="#modalnewsinfo" data-id="<?php echo $row['newsNo']; ?>" id="newsinfo"><img class="card-img-top p-2" src="../assets/img/<?php echo $row['newsImage']; ?>" style="height: 100%;width:100%;background-color:#ebf2e6;" /></a>
                                            <div class="card-body" style="background-color:#528124;color:#FFFFFF;">
                                                <div><?php echo $newsTitle ?></div>
                                            </div>
                                            <div class="modal fade" id="modalnewsinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content ">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle" style="color:#417d19;">รายละเอียดเพิ่มเติม</h5>
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
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-4">
                <nav class="navbar navbar-light justify-content-between mb-0 pb-0 pr-0 pl-0  ">
                    <a class="navbar-brand">
                        <h3 style="color:#528124;">เอกสาร</h3>
                        <a class="ml-auto" href="student_file_all.php">ดูทั้งหมด>>></a>
                </nav>
                <b>
                    <hr style="margin-top: 0rem;border-color:#528124;border-width: 2px;"></b>
                <div class="card" style="border-width:0px;border-top-width:4px;">
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-hover table-striped ">
                                <tbody>
                                    <?php
                                    $stmt = $session->runQuery("SELECT * FROM file WHERE fileStatus='แสดง' ORDER BY fileNo DESC");
                                    $stmt->execute();
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                        <tr>
                                            <td style="font-size:14px;"><a href="../file/<?php echo $row['fileDoc']; ?>"><span class="fa fa-edit"></span>&nbsp; <?php echo $row['fileName']; ?></a></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->
        <br>
        <div class="row ml-1 mr-1">
            <div class="col-12">
                <nav class="navbar navbar-light justify-content-between mb-0 pb-0 pr-0 pl-0  ">
                    <a class="navbar-brand">
                        <h3 style="color:#528124;">ตารางกิจกรรม</h3>
                        <a class="ml-auto" href="student_act_all.php">ดูทั้งหมด>>></a>
                </nav>
                <b>
                    <hr style="margin-top: 0rem;border-color:#528124;border-width: 2px;"></b>
                <div class="card" style="border-width:0px;border-top-width:4px;">
                    <div class="card-body text-nowrap">
                        <table id="tb1" class="table table-hover-sm table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>วันที่</th>
                                    <th>ชื่อกิจกรรม</th>
                                    <th>หมวดหมู่</th>
                                    <th>กลุ่ม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $session->runQuery("SELECT activity.*,mainorg.*,organization.*,acttype.* FROM activity 
                                                                JOIN mainorg ON mainorg.mainorgNo = activity.actMainorg
                                                                JOIN organization ON organization.orgtionNo = activity.actOrgtion
                                                                JOIN acttype ON acttype.acttypeNo = activity.actType
                                                                WHERE activity.actStatus='ดำเนินกิจกรรม'||activity.actStatus='เปิดการลงทะเบียน'
                                                                    ||activity.actStatus='ปิดการลงทะเบียน' 
                                                                ORDER BY activity.actStatus='actDateb' DESC");
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
                                        <td><a href="" data-toggle="modal" data-target="#modalmoreactinfo" data-id="<?php echo $row['actID']; ?>" id="moreactinfo"><?php echo $row['actName']; ?></a></td>
                                        <td><?php echo $row['acttypeName']; ?></td>
                                        <td><?php echo $row['actGroup']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal fade" id="modalmoreactinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content ">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle" style="color:#528124;">รายละเอียดเพิ่มเติม</h5>
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
    <?php include 'footer.php' ?>
    <script>
        /* View Function*/
        $(document).ready(function() {
            $(document).on('click', '#newsinfo', function(e) {
                e.preventDefault();
                var newsNo = $(this).data('id'); // it will get id of clicked row
                $('#dynamic-content').html(''); // leave it blank before ajax call
                $('#modal-loader').show(); // load ajax loader
                $.ajax({
                        url: 'morenewsinfo.php',
                        type: 'POST',
                        data: 'id=' + newsNo,
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
            $(document).on('click', '#moreactinfo', function(e) {
                e.preventDefault();
                var actid = $(this).data('id'); // it will get id of clicked row
                $('#dynamic-content1').html(''); // leave it blank before ajax call
                $('#modal-loader1').show(); // load ajax loader
                $.ajax({
                        url: 'moreactinfo.php',
                        type: 'POST',
                        data: 'id=' + actid,
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