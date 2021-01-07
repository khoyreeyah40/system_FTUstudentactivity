<?php include '../control/session_student.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| ข้อมูลส่วนตัว</title>
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
        include 'student_navheader.php';
        ?>
        <ul class="side-menu metismenu">
            <li>
                <a href="student_activity_registerpage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-list-alt"></i>
                    <span class="nav-label">ลงทะเบียนกิจกรรม</span>
                </a>
            </li>
            <li>
                <a href="student_activity_confirmpage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-tasks"></i>
                    <span class="nav-label">ยืนยันการเข้าร่วมกิจกรรม</span>
                </a>
            </li>
            <li>
                <a href="student_activity_participantpage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-check-square"></i>
                    <span class="nav-label">การเข้าร่วมกิจกรรม</span>
                </a>
            </li>
            <li>
                <a href="student_contactpage.php" aria-hidden="true"><i class="sidebar-item-icon fa fa-address-book"></i>
                    <span class="nav-label">ติดต่อ</span>
                </a>
            </li>
        </ul>
    </div>
    </nav>
    <div class="content-wrapper">
        <div class="page-content fade-in-up">
            <div class="row">
                <div class="col-12">
                    <iframe height="1654px" width="100%" name="iii" src="student_profile.php" style="border:none"> </iframe>

                </div>
            </div>
        </div>
        <footer class="page-footer">
            <div class="font-13">2020 © <b><a href="student_mepage.php">TanenoHato</a></b> - IT 58 Fatoni University.</div>
            <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
        </footer>
    </div>
    </div>

    <!-- CORE PLUGINS-->
    <?php include 'footer.php'; ?>
    </script>
</body>

</html>