<?php
include '../control/session_organizer.php';
include '../control/organizer_activity_time.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| จัดการช่วงเวลากิจกรรม</title>
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
            <h1 class="page-title">จัดการช่วงเวลากิจกรรม</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item">จัดการช่วงเวลากิจกรรม</li>
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
                <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
                    <div class="card-header" style="background-color:#d1cbaf">
                        <h5 style="color:#2c2c2c">ตารางการจัดการช่วงเวลากิจกรรม</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body text-nowrap">
                        <table id="tb1" class="table table-hover-sm table-striped text-center" cellspacing="0" width="100%">
                            <thead>
                                <tr style="color:#528124;">
                                    <th>ปีการศึกษา</th>
                                    <th>สถานะ</th>
                                    <th>จัดการสถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $session->runQuery("SELECT *  FROM actyear ORDER BY actyearCreateat DESC limit 2");
                                $stmt->execute();
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>

                                        <td><?php echo $row['actyear']; ?></td>
                                        <td><?php echo $row['actyearStatus']; ?></td>
                                        <td>
                                            <?php
                                            if ($row['actyearStatus'] == 'รอดำเนินกิจกรรม') {
                                            ?>
                                                <a class="btn btn-sm btn-default" href="?actyearbegin_id=<?php echo $row['actyear']; ?>"  onclick="return confirm('ต้องการเริ่มดำเนินกิจกรรมปี <?php echo $row['actyear']; ?> ?')">ดำเนินกิจกรรม</a>
                                            <?php
                                            } else if ($row['actyearStatus'] == 'ดำเนินกิจกรรม') {
                                            ?>
                                                <a class="btn btn-sm btn-danger" href="?actyearend_id=<?php echo $row['actyear']; ?>"  onclick="return confirm('ต้องการสำเร็จกิจกรรมปี <?php echo $row['actyear']; ?> ?')">สำเร็จกิจกรรม</a>
                                            <?php
                                            } else  if ($row['actyearStatus'] == 'สำเร็จกิจกรรม') {
                                                echo $row['actyearStatus'];
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
    </div>
    <!-- CORE PLUGINS-->
    <?php include 'footer.php'; ?>
</body>

</html>