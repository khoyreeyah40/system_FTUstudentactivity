<?php
include '../control/session_student.php';
error_reporting(~E_NOTICE);
$acttype = $_GET['acttype'];
$actyear = $_GET['actyear'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| กิจกรรมที่ได้เข้าร่วม</title>
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
            <h1 class="page-title" style="color:#528124;">กิจกรรมที่ได้เข้าร่วม</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item"><a href="student_activity_participant.php?stdUser=<?php echo $stdUser ?>">การเข้าร่วมกิจกรรม</a></li>
                <li class="breadcrumb-item">กิจกรรมที่ได้เข้าร่วม</li>
            </ol>
        </div>
        <br>
        <div class="row ml-1 mr-1">
            <div class="col-12">
                <div class="card" style="border-width:0px;border-top-width:4px;">
                    <div class="card-body text-nowrap">
                        <?php
                        $stmt = $session->runQuery("SELECT * FROM student 
                                                                WHERE stdID = '$stdUser' ");
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $mainorgno = $row["stdMainorg"];
                            $orgtionno = $row["stdOrgtion"];
                            $year = $row["stdYear"];
                            $group = $row["stdGroup"];
                        ?>
                            <table id="tb1" class="table table-striped table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr style="color:#528124;">
                                        <th>วันที่จัด</th>
                                        <th>ชื่อกิจกรรม</th>
                                        <th>สังกัด</th>
                                        <th>องค์กร</th>
                                        <th>สถานะการเข้าร่วม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $stmt_1 = $session->runQuery("SELECT acttypeName FROM acttype WHERE acttypeName='$acttype'");
                                    $stmt_1->execute();
                                    $row = $stmt_1->fetch(PDO::FETCH_ASSOC);
                                    if (($row["acttypeName"] == "อบรมคุณธรรมจริยธรรม") || ($row["acttypeName"] == "ค่ายพัฒนานักศึกษา(ปี1)") || ($row["acttypeName"] == "ค่ายพัฒนานักศึกษา(ปี3)") || ($row["acttypeName"] == "อิอฺติก๊าฟ 10 วันสุดท้ายเดือนรอมฎอน") || ($row["acttypeName"] == "ปฐมนิเทศ") || ($row["acttypeName"] == "ปัจฉิมนิเทศ") || ($row["acttypeName"] == "กิจกรรมซ่อม")) {

                                        $stmt_1 = $session->runQuery("SELECT activity.*,acttype.*,actregister.*,mainorg.*,organization.*
                                                FROM actregister 
                                                JOIN activity ON activity.actID = actregister.actregactID
                                                JOIN acttype ON acttype.acttypeNo = activity.actType
                                                JOIN mainorg ON mainorg.mainorgNo = activity.actMainorg
                                                JOIN organization ON organization.orgtionNo = activity.actOrgtion
                                                WHERE 
                                                acttype.acttypeName = '$acttype' && actregister.actregstdID ='$stdUser' 
                                                && (actregister.actregStatus='ยืนยันเรียบร้อย' || actregister.actregStatus='แก้กิจกรรมเรียบร้อย')
                                                && activity.actYear = '$actyear' 
                                                && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                                                ");
                                        $stmt_1->execute();
                                        while ($row = $stmt_1->fetch(PDO::FETCH_ASSOC)) {
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
                                                <td><?php echo $row['actregStatus'] ?></td>
                                            </tr>
                                        <?php }
                                    }
                                    if ($row["acttypeName"] == "กิจกรรมชมรม") {

                                        $stmt_1 = $session->runQuery("SELECT activity.*,acttype.*,actregister.*,mainorg.*,organization.*
                                                FROM actregister 
                                                JOIN activity ON activity.actID = actregister.actregactID
                                                JOIN acttype ON acttype.acttypeNo = activity.actType
                                                JOIN mainorg ON mainorg.mainorgNo = activity.actMainorg
                                                JOIN organization ON organization.orgtionNo = activity.actOrgtion
                                                WHERE 
                                                acttype.acttypeName = '$acttype' && actregister.actregstdID ='$stdUser' 
                                                && (actregister.actregStatus='ยืนยันเรียบร้อย' || actregister.actregStatus='แก้กิจกรรมเรียบร้อย')
                                                && activity.actYear = '$actyear' 
                                                && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                                                && activity.actSec = 'มหาวิทยาลัย' && activity.actOrgtion = '$club'
                                                ");
                                        $stmt_1->execute();
                                        while ($row = $stmt_1->fetch(PDO::FETCH_ASSOC)) {
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
                                                <td><?php echo $row['actregStatus'] ?></td>
                                            </tr>
                                        <?php }
                                    }
                                    if ($row["acttypeName"] == "กิจกรรมชุมนุม") {
                                        $stmt_1 = $session->runQuery("SELECT club.*, organization.* FROM club 
                                                                    JOIN organization ON organization.orgtionNo = club.clubOrgtion
                                                                    WHERE clubstdID='$stdUser' && clubYear='$actyear'");
                                        $stmt_1->execute();
                                        $rowclubname = $stmt_1->fetch(PDO::FETCH_ASSOC);
                                        $club = $rowclubname["clubOrgtion"];
                                        $clubname = $rowclubname["organization"];
                                        $stmt_1 = $session->runQuery("SELECT activity.*,acttype.*,actregister.*,mainorg.*,organization.*
                                                FROM actregister 
                                                JOIN activity ON activity.actID = actregister.actregactID
                                                JOIN acttype ON acttype.acttypeNo = activity.actType
                                                JOIN mainorg ON mainorg.mainorgNo = activity.actMainorg
                                                JOIN organization ON organization.orgtionNo = activity.actOrgtion
                                                WHERE 
                                                acttype.acttypeName = '$acttype' && actregister.actregstdID ='$stdUser' 
                                                && (actregister.actregStatus='ยืนยันเรียบร้อย' || actregister.actregStatus='แก้กิจกรรมเรียบร้อย')
                                                && activity.actYear = '$actyear' 
                                                && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                                                && (activity.actMainorg = '$mainorgno' && activity.actOrgtion = '$orgtionno')
                                                ");
                                        $stmt_1->execute();
                                        while ($row = $stmt_1->fetch(PDO::FETCH_ASSOC)) {
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
                                                <td><?php echo $row['actregStatus'] ?></td>
                                            </tr>
                                        <?php }
                                    }
                                    if ($row["acttypeName"] == "กิจกรรมองค์การบริหารนักศึกษา") {
                                        $stmt_1 = $session->runQuery("SELECT activity.*,acttype.*,actregister.*,mainorg.*,organization.*
                                                FROM actregister 
                                                JOIN activity ON activity.actID = actregister.actregactID
                                                JOIN acttype ON acttype.acttypeNo = activity.actType
                                                JOIN mainorg ON mainorg.mainorgNo = activity.actMainorg
                                                JOIN organization ON organization.orgtionNo = activity.actOrgtion
                                                WHERE 
                                                acttype.acttypeName = '$acttype' && actregister.actregstdID ='$stdUser' 
                                                && (actregister.actregStatus='ยืนยันเรียบร้อย' || actregister.actregStatus='แก้กิจกรรมเรียบร้อย')
                                                && activity.actYear = '$actyear' 
                                                && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                                                && (mainorg.mainorg = 'องค์การบริหารนักศึกษา' || organization.organization = 'องค์การบริหารนักศึกษา') 
                                                ");
                                        $stmt_1->execute();
                                        while ($row = $stmt_1->fetch(PDO::FETCH_ASSOC)) {
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
                                                <td><?php echo $row['actregStatus'] ?></td>
                                            </tr>
                                        <?php }
                                    }
                                    if ($row["acttypeName"] == "กิจกรรมสโมสรคณะ") {

                                        $stmt_1 = $session->runQuery("SELECT activity.*,acttype.*,actregister.*,mainorg.*,organization.*
                                                FROM actregister 
                                                JOIN activity ON activity.actID = actregister.actregactID
                                                JOIN acttype ON acttype.acttypeNo = activity.actType
                                                JOIN mainorg ON mainorg.mainorgNo = activity.actMainorg
                                                JOIN organization ON organization.orgtionNo = activity.actOrgtion
                                                WHERE 
                                                acttype.acttypeName = '$acttype' && actregister.actregstdID ='$stdUser' 
                                                && (actregister.actregStatus='ยืนยันเรียบร้อย' || actregister.actregStatus='แก้กิจกรรมเรียบร้อย')
                                                && activity.actYear = '$actyear' 
                                                && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                                                && (activity.actMainorg = '$mainorgno' && organization.organization = 'สโมสรคณะ') 
                                                ");
                                        $stmt_1->execute();
                                        while ($row = $stmt_1->fetch(PDO::FETCH_ASSOC)) {
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
                                                <td><?php echo $row['actregStatus'] ?></td>
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