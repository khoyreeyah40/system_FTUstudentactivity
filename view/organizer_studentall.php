<?php include '../control/session_organizer.php';
$stdMainorg = $_SESSION['stdMainorg'];
$stdOrgtion = $_SESSION['stdOrgtion'];
$stdYear = $_SESSION['stdYear'];
$stdGroup = $_SESSION['stdGroup'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| จัดการรายชื่อนักศึกษา</title>
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
            <h1 class="page-title">จัดการรายชื่อนักศึกษา</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item"><a href="organizer_studentall_search.php">จัดการค้นหารายชื่อนักศึกษา</a></li>
                <li class="breadcrumb-item">จัดการรายชื่อนักศึกษา</li>
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
        <div class="row ml-2">
            <div class="col-12">
                <?php
                $stmt = $session->runQuery("SELECT student.*,organization.*, teacher.*,mainorg.* FROM student 
                                            JOIN organization ON organization.orgtionNo = student.stdOrgtion
                                            JOIN teacher ON teacher.teacherNo = student.stdTc
                                            JOIN mainorg ON mainorg.mainorgNo = student.stdMainorg
                                            WHERE student.stdMainorg='$stdMainorg' && student.stdOrgtion='$stdOrgtion' 
                                            && student.stdYear='$stdYear' && student.stdGroup='$stdGroup'");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                ?>
                <h4 style="color:#528124;">รายชื่อนักศึกษา</h4>
                <p><b style="color:#528124;">คณะ:</b> <?php echo $row['mainorg']; ?></p>
                <p><b style="color:#528124;">สาขา:</b> <?php echo $row['organization']; ?></p>
                <p><b style="color:#528124;">ปีการศึกษา:</b> <?php echo $row['stdYear']; ?></p>
                <p><b style="color:#528124;">กลุ่ม:</b> <?php echo $row['stdGroup']; ?></p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
                    <div class="card-header" style="background-color:#d1cbaf">
                        <h5 style="color:#2c2c2c">ตารางรายชื่อนักศึกษา</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body text-nowrap">
                        <table id="tbstudent" class="table table-hover-sm table-striped text-center" cellspacing="0" width="100%">
                            <thead>
                                <tr style="color:#528124;">
                                    <th>ประจำปีการศึกษา</th>
                                    <th>รหัสนักศึกษา</th>
                                    <th>ชื่อ-สกุล</th>
                                    <th>สาขา</th>
                                    <th>กลุ่ม</th>
                                    <th>Email</th>
                                    <th>รหัสผ่าน</th>
                                    <th>แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $session->runQuery("SELECT student.*,organization.*, teacher.* FROM student 
                                                            JOIN organization ON organization.orgtionNo = student.stdOrgtion
                                                            JOIN teacher ON teacher.teacherNo = student.stdTc
                                                            WHERE student.stdMainorg='$stdMainorg' && student.stdOrgtion='$stdOrgtion' 
                                                            && student.stdYear='$stdYear' && student.stdGroup='$stdGroup'");
                                $stmt->execute();
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['stdYear']; ?></td>
                                        <td><a href="" data-toggle="modal" data-target="#modalmoreinfo" data-id="<?php echo $row['stdID']; ?>" id="moreinfo"><?php echo $row['stdID']; ?></a></td>
                                        <td><?php echo $row['stdName']; ?></td>
                                        <td><?php echo $row['organization']; ?></td>
                                        <td><?php echo $row['stdGroup']; ?></td>
                                        <td><?php echo $row['stdEmail']; ?></td>
                                        <td><?php echo $row['stdPassword']; ?></td>
                                        <td>
                                            <a href="organizer_studentall_updateinfo.php?update_id=<?php echo $row['stdID']; ?>" onclick="return confirm('ต้องการแก้ไขรายชื่อนักศึกษา ?')"><button class="btn btn-warning btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-pencil font-30"></i></button></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
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
                    <!-- /.modal -->
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