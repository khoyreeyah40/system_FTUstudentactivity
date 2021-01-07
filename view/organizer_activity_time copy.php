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
                                    <th>ภาคเรียน</th>
                                    <th>สถานะ</th>
                                    <th>สำเร็จกิจกรรม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $session->runQuery("SELECT *  FROM actsem ORDER BY actsemCreateat DESC limit 2");
                                $stmt->execute();
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>

                                        <td><?php echo $row['actsemyear']; ?></td>
                                        <td><?php echo $row['actsem']; ?></td>
                                        <td><?php echo $row['actsemStatus']; ?></td>
                                        <td>
                                            <?php
                                            if ($row['actsemStatus'] == 'ดำเนินกิจกรรม' && $row['actsem'] == '1') {
                                            ?>
                                                <a class="btn btn-sm btn-warning" href="?actsem1_1_id=<?php echo $row['actsemNo']; ?>" title="เปิดการแก้กิจกรรม" onclick="return confirm('ต้องการเปิดการแก้กิจกรรม ?')">เปิดการแก้กิจกรรม</a>
                                            <?php
                                            } else if ($row['actsemStatus'] == 'เปิดการแก้กิจกรรม' && $row['actsem'] == '1') {
                                            ?>
                                                <a class="btn btn-sm btn-danger" href="?actsem1_2_id=<?php echo $row['actsemNo']; ?>" title="สำเร็จกิจกรรมนี้" onclick="return confirm('ต้องการสำเร็จกิจกรรมนี้ ?')">สำเร็จกิจกรรม</a>
                                            <?php
                                            } else if ($row['actsemStatus'] == 'ดำเนินกิจกรรม' && $row['actsem'] == '2') {
                                            ?>
                                                <a class="btn btn-sm btn-warning" href="?actsem2_1_id=<?php echo $row['actsemNo']; ?>" title="เปิดการแก้กิจกรรม" onclick="return confirm('ต้องการเปิดการแก้กิจกรรม ?')">เปิดการแก้กิจกรรม</a>
                                            <?php
                                            } else if ($row['actsemStatus'] == 'เปิดการแก้กิจกรรม' && $row['actsem'] == '2') {
                                            ?>
                                                <a class="btn btn-sm btn-danger" href="?actsem2_2_id=<?php echo $row['actsemNo']; ?>" title="สำเร็จกิจกรรมนี้" onclick="return confirm('ต้องการสำเร็จกิจกรรมนี้ ?')">สำเร็จกิจกรรม</a>
                                            <?php
                                            } else  if (($row['actsemStatus'] == 'สำเร็จกิจกรรมแล้ว') || ($row['actsemStatus'] == 'รอดำเนินกิจกรรม')) {
                                                echo $row['actsemStatus'];
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