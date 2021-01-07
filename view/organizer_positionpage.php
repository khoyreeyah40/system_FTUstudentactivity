<?php include '../control/session_organizer.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| จัดการตำแหน่งนักศึกษา</title>
    <?php include 'header.php'; ?>

    <style>
        body.fixed-navbar .header {
            top: unset;
        }
    </style>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <?php
        include 'organizer_navheader.php';
        $stmt = $session->runQuery("SELECT organizer.*, usertype.* FROM organizer
                                        INNER JOIN usertype ON organizer.orgzeruserType = usertype.usertypeID
                                        WHERE organizer.orgzerID = '$loginby'
                                        ");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <ul class="side-menu metismenu">
            <?php
            if ($row["M_1"] == "true") {
            ?>
                <li>
                    <a href="organizer_memberpage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-user"></i>
                        <span class="nav-label">จัดการผู้ดูแล</span>
                    </a>
                </li>
            <?php
            }
            if ($row["M_2"] == "true") {
            ?>
                <li>
                    <a href="organizer_organizerpage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-user"></i>
                        <span class="nav-label">จัดการเจ้าหน้าที่</span>
                    </a>
                </li>
            <?php
            }
            if ($row["M_3"] == "true") {
            ?>
                <li>
                    <a href="organizer_studentallpage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-child"></i>
                        <span class="nav-label">จัดการนักศึกษา</span>
                    </a>
                </li>
            <?php
            }
            if ($row["M_4"] == "true") {
            ?>
                <li class="active">
                    <a href="organizer_positionpage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-map-pin"></i>
                        <span class="nav-label">จัดการตำแหน่งนักศึกษา</span>
                    </a>
                </li>
            <?php
            }
            if ($row["M_5"] == "true") {
            ?>
                <li>
                    <a href="organizer_clubpage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-odnoklassniki-square"></i>
                        <span class="nav-label">จัดการชมรม</span>
                    </a>
                </li>
            <?php
            }
            if ($row["M_6"] == "true") {
            ?>
                <li>
                    <a href="organizer_activity_timepage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-hourglass-half"></i>
                        <span class="nav-label">จัดการช่วงเวลากิจกรรม</span>
                    </a>
                </li>
            <?php
            }
            if ($row["M_7"] == "true") {
            ?>
                <li>
                    <a href="organizer_activitypage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-tasks"></i>
                        <span class="nav-label">จัดการกิจกรรม</span>
                    </a>
                </li>
            <?php
            }
            if ($row["M_8"] == "true") {
            ?>
                <li>
                    <a href="organizer_activity_activepage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-list-alt"></i>
                        <span class="nav-label">จัดการกิจกรรมที่กำลังดำเนิน</span>
                    </a>
                </li>
            <?php
            }
            if ($row["M_9"] == "true") {
            ?>
                <li>
                    <a href="organizer_activity_solvepage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-edit"></i>
                        <span class="nav-label">จำนงแก้กิจกรรม</span>
                    </a>
                </li>
            <?php
            }
            if ($row["M_10"] == "true") {
            ?>
                <li>
                    <a href="organizer_activity_examinepage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-check-square"></i>
                        <span class="nav-label">ตรวจสอบการเข้าร่วม</span>
                    </a>
                </li>
            <?php
            }
            if ($row["M_11"] == "true") {
            ?>
                <li>
                    <a href="organizer_boardpage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-bullhorn"></i>
                        <span class="nav-label">จัดการบอร์ดประชาสัมพันธ์</span>
                    </a>
                </li>
            <?php
            }
            if ($row["M_12"] == "true") {
            ?>
                <li>
                    <a href="organizer_halaqahpage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-bullseye"></i>
                        <span class="nav-label">จัดการกลุ่มศึกษาอัลกุรอ่าน</span>
                    </a>
                </li>
            <?php
            }
            if ($row["M_13"] == "true") {
            ?>
                <li>
                    <a href="organizer_contactpage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-address-book"></i>
                        <span class="nav-label">ติดต่อ</span>
                    </a>
                </li>
            <?php
            }
            if ($row["M_14"] == "true") {
            ?>
                <li>
                    <a href="organizer_historypage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-history"></i>
                        <span class="nav-label">ประวัติการเข้าใช้</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
    </nav>
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="row">
                <div class="col-12">
                    <iframe height="1654px" width="100%" name="iii" src="organizer_position.php" style="border:none"> </iframe>
                </div>
            </div>
        </div>
        <footer class="page-footer">
            <div class="font-13">2020 © <b><a href="organizer_mepage.php">TanenoHato</a></b> - IT 58 Fatoni University.</div>
            <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
        </footer>
    </div>
    </div>

    <!-- CORE PLUGINS-->
    <?php include 'footer.php'; ?>
</body>

</html>