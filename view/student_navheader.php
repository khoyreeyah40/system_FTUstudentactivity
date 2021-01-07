        <header class="header">
            <div class="page-brand" style="background-color:#528124;color:#FFFFFF;">
                <a class="link" href="student_homepage.php">
                    <span class="brand" style="font-size: 20px;">ระบบกิจกรรมนักศึกษา
                    </span>
                    <span class="brand-mini"><img src="../assets/img/ftu_logo.png" /></span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                    <li>
                    </li>
                </ul>
                <ul class="nav navbar-toolbar">
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
                                            includedLanguages: 'zh-CN,de,id,km,lo,ms,my,ar,th,tl,vi,th,en',
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
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown" style="color:#528124;">
                            <img src="../assets/img/<?php echo $stdRow['stdImage']; ?>" />
                            <span></span><?php echo $stdRow['stdName']; ?><i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="student_profilepage.php" style="color:#528124;"><i class="fa fa-user"></i>Profile</a>
                            <li class="dropdown-divider"></li>
                            <a class="dropdown-item" href="../control/student_logout.php?logout=true" style="color:#528124;"><i class="fa fa-sign-out"></i>Logout</a>
                        </ul>
                    </li>
                </ul>
            </div>
        </header>
        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="../assets/img/<?php echo $stdRow['stdImage']; ?>" width=" 45px" class="img-circle" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong" style="color:#528124;"><?php echo $stdRow['stdName']; ?></b></a></div><small style="color:#528124;"><?php echo $stdRow['stdStatus']; ?></small>
                    </div>
                </div>