<?php
include("../db/dbconfig.php");
$db = new Database();
session_start();
if (isset($_SESSION['std_session'])) {
    header('location: student_homepage.php');
}else
if (isset($_SESSION['orgzer_session'])) {
    header('location: organizer_homepage.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>ระบบกิจกรรมนักศึกษา| Login สำหรับนักศึกษา</title>
    <!-- GLOBAL MAINLY STYLES-->
    <?php include 'header.php'; ?>
    <link href="../assets/assets/css/main.min.css" rel="stylesheet" />

    <style>
        .breadcrumb-item {
            font-size: 16px;
        }

        .sidebar-mini {
            margin-left: 0px;
        }

        .content-wrapper {
            margin-left: 0px;
        }
    </style>
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <header class="header">
            <div class="flexbox flex-1" style="background-color:#528124;color:#FFFFFF;">
                <ul class="nav navbar-toolbar">
                    <li>
                        <div><a href="http://www.ftu.ac.th/2019/index.php/th/"><img src="../assets/img/head-ftu.png" width="140" height="40" /></a></div>
                    </li>
                    <li>
                        <h4 style="padding-left: 10px;"><a href="welcome_home.php" style="color:#FFFFFF;">ระบบกิจกรรมนักศึกษามหาวิทยาลัยฟาฏอนี</a></h4>
                    </li>
                </ul>
                <ul class="nav navbar-toolbar ml-auto">
                    <li class="dropdown dropdown-user">
                        <div class="language">
                            <div class="google">
                                <div id="google_translate_element">
                                    <div class="skiptranslate goog-te-gadget" dir="ltr">
                                        <div id=":0.targetLanguage" class="goog-te-gadget-simple" style="white-space: nowrap;">
                                        </div>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    function googleTranslateElementInit() {
                                        new google.translate.TranslateElement({
                                            pageLanguage: 'th',
                                            includedLanguages: 'zh-CN,de,id,km,lo,ms,my,th,tl,vi,th,en',
                                            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                                            multilanguagePage: true
                                        }, 'google_translate_element');
                                    }
                                </script>
                                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                            </div>
                        </div>
                    </li>
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" href="welcome_contact.php" style="font-size: 16px;color:#FFFFFF;">ติดต่อ</a>
                    </li>
                </ul>
            </div>
        </header>
        <div class="content-wrapper pb-2" style="background-color: #d1d5d8;">
            <div class="page-content fade-in-up" style="height:1654px; width:100%;padding:20px;padding-top:0px">
                <div class="page-heading" style=" font-size: 36px;text-align: center;margin: 20px 0;">
                    <div>
                        <p><img src="../assets/img/head-ftu.png" /></p>
                    </div>
                    <a href="welcome_home.php" style="color:#528124;">
                        ระบบกิจกรรมนักศึกษา
                    </a>
                </div>
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
                <div class="row ml-1 mr-1 justify-content-center">
                    <div class="col-6 ">
                        <div class="card " style="border-width:0px;border-top-width:4px;margin: 20px;">
                            <div class="row justify-content-center">
                                <div class="col-sm-10 ">
                                    <form id="login-form" action="../control/student_login.php" method="post">
                                        <h2 class="login-title">Log in</h2>
                                        <h5 class="login-title">(สำหรับนักศึกษา)</h5>
                                        <div class="form-group">
                                            <div class="input-group-icon right">
                                                <div class="input-icon"><i class="fa fa-id-card"></i></div>
                                                <input class="form-control" type="text" name="stdID" placeholder="Student ID" autocomplete="off" require/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group-icon right">
                                                <div class="input-icon"><i class="fa fa-lock font-16"></i></div>
                                                <input class="form-control" type="password" name="stdPassword" placeholder="Password" autocomplete="off" require/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-info btn-block" type="submit" name="btlogin">Login</button>
                                        </div>
                                        <div class="text-center">ยังไม่ได้ลงทะเบียน?
                                            <a class="color-blue" href="student_register.php">Register</a>
                                        </div>
                                    </form>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->
    <!-- CORE PLUGINS -->
    <?php include 'footer.php'; ?>
</body>

</html>