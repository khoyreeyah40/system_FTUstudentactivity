<?php
include '../control/session_student.php';
error_reporting(~E_NOTICE);
$acttype = $_GET['acttype'];
$actyear = $_GET['actyear'];
$actsem = $_GET['actsem'];
?>

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
            <h1 class="page-title" style="color:#528124;">กิจกรรมในแผน</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item"><a href="student_activity_participant.php">การเข้าร่วมกิจกรรม</a></li>
                <li class="breadcrumb-item">กิจกรรมในแผน</li>
            </ol>
        </div>
        <br>
        <div class="row ml-1 mr-1">
            <div class="col-12">
                <div class="card" style="border-width:0px;border-top-width:4px;">
                    <div class="card-body text-nowrap">
                        <?php
                        $stmt = $session->runQuery("SELECT *
                                                            FROM student 
                                                            WHERE stdID = '$stdUser'");
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $mainorgno = $row["stdMainorg"];
                            $orgtionno = $row["stdOrgtion"];
                            $group = $row["stdGroup"];
                        ?>
                            <table id="tb1" class="table table-striped table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr style="color:#528124;">
                                        <th>วันที่จัด</th>
                                        <th>ชื่อกิจกรรม</th>
                                        <th>สังกัด</th>
                                        <th>องค์กร</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt = $session->runQuery("SELECT acttypeName FROM acttype WHERE acttypeName='$acttype'");
                                    $stmt->execute();
                                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                    if ($row["acttypeName"] == "กิยามุลลัยล์") {

                                        $stmt = $session->runQuery("SELECT activity.*, acttype.*,organization.*,mainorg.*
                                                                        FROM activity 
                                                                        JOIN acttype ON acttype.acttypeNo = activity.actType
                                                                        JOIN mainorg ON mainorg.mainorgNo = activity.actMainorg
                                                                        JOIN organization ON organization.orgtionNo = activity.actOrgtion
                                                                        WHERE 
                                                                        acttype.acttypeName = 'กิยามุลลัยล์' 
                                                                        && (activity.actYear = '$actyear' && activity.actSem = '$actsem') 
                                                                        && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                                                                        && (activity.actMainorg = '$mainorgno' || activity.actSec = 'มหาวิทยาลัย') 
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
                                                <td><?php echo $row['mainorg'] ?></td>
                                                <td><?php echo $row['organization'] ?></td>
                                            </tr>
                                <?php }
                                    }
                                }
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