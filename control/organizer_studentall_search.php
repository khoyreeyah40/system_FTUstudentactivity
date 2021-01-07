<?php
    if (isset($_POST['btsearch'])) {
        $stdMainorg = $_POST['stdMainorg'];
        $stdOrgtion = $_POST['stdOrgtion'];
        $stdYear = $_POST['stdYear'];
        $stdGroup = $_POST['stdGroup'];
            if (empty($stdMainorg)) {
                $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
            }else if (empty($stdOrgtion)) {
                $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
            }else if (empty($stdYear)) {
                $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
            }else if (empty($stdGroup)) {
                $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
            }
        $_SESSION['stdMainorg'] = $stdMainorg;
        $_SESSION['stdOrgtion'] = $stdOrgtion;
        $_SESSION['stdYear'] = $stdYear;
        $_SESSION['stdGroup'] = $stdGroup;
    ?>
        <script type="text/javascript">
            window.location = "../view/organizer_studentall.php";
        </script>
    <?php
    }
?>