<?php include '../control/session_organizer.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| ตารางกิจกรรมแต่ละปี</title>
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
            <h1 class="page-title">ตารางกิจกรรมแต่ละปี</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item"><a href="organizer_activity.php">จัดการกิจกรรม</a> </li>
                <li class="breadcrumb-item">ตารางกิจกรรมแต่ละปี</li>
            </ol>
        </div>
        <br>
        <a href="organizer_activity.php"><button class="btn btn-info" type="button"> &nbsp; จัดการกิจกรรม</button></a>
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
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
                    <div class="card-header" style="background-color:#d1cbaf">
                        <h5 style="color:#2c2c2c">ตารางกิจกรรมแต่ละปี</h5>
                    </div>
                    <div class="card-body text-nowrap">
                        <table id="tb1" class="table table-hover-sm table-striped text-center" cellspacing="0" width="100%">
                            <thead>
                                <tr style="color:#528124;">
                                    <th>ปีการศึกษา</th>
                                    <th>จำนวนกิจกรรม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $stmt = $session->runQuery("SELECT orgzerMainorg,orgzerOrgtion,orgzerGroup FROM organizer WHERE orgzerID = '$loginby'");
                                $stmt->execute();
                                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                $org = $row["orgzerOrgtion"];
                                $m = $row["orgzerMainorg"];
                                $group = $row["orgzerGroup"];
                                $stmt = $session->runQuery("SELECT *  FROM actyear ORDER BY actyear DESC");
                                $stmt->execute();
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row['actyear']; ?></td>
                                        <td>
                                            <?php
                                            $year = $row['actyear'];
                                            $stmt_act = $session->runQuery("SELECT * FROM activity 
                                                                            WHERE 
                                                                                    actYear = '$year'
                                                                                    && (actGroup = '$group' || actGroup = 'รวม')
                                                                                    && actMainorg = '$m' && actOrgtion = '$org'
                                                                            ");
                                            $stmt_act->execute();
                                            $row1 = $stmt_act->rowCount();
                                            $rowget1 = $stmt_act->fetch(PDO::FETCH_ASSOC);
                                            // output data of each row
                                            if ($row1 > 0) {
                                            ?>
                                                <a href="organizer_activity_year_all.php?actyear=<?php echo $year ?>"><?php echo $row1 ?></a>
                                            <?php
                                            } else if ($row1 < 0) {
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