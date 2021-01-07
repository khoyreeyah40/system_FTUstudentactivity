<?php
    if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
        $id = $_GET['update_id'];
        $stmt_update = $session->runQuery('SELECT student.*, organization.*,mainorg.*, teacher.* FROM student 
                                                    JOIN organization ON organization.orgtionNo = student.stdOrgtion
                                                    JOIN mainorg ON mainorg.mainorgNo = student.stdMainorg
                                                    JOIN teacher ON teacher.teacherNo = student.stdTc
                                                    WHERE student.stdID=:stdid');
        $stmt_update->execute(array(':stdid' => $id));
        $update_row = $stmt_update->fetch(PDO::FETCH_ASSOC);
        extract($update_row);
    } else {
        header("Location: ../view/organizer_studentall.php");
    }
    if (isset($_POST['btupdatestudentall'])) {
        $stdYear = $_POST['stdYear'];
        $stdID = $_POST['stdID'];
        $stdName = $_POST['stdName']; // user name
        $stdMainorg = $_POST['stdMainorg'];
        $stdOrgtion = $_POST['stdOrgtion'];
        $stdTc = $_POST['stdTc'];
        $stdGroup = $_POST['stdGroup'];
        $stdPhone = $_POST['stdPhone'];
        $stdEmail = $_POST['stdEmail'];
        $stdFb = $_POST['stdFb'];
        $stdPassword = $_POST['stdPassword'];
        // if no error occured, continue ....
        if (!isset($errMSG)) {
            $stmt = $session->runQuery('UPDATE student
                                        SET 
                                        stdYear=:stdYear,
                                        stdID=:stdID,
                                        stdName=:stdName,
                                        stdMainorg=:stdMainorg,
                                        stdOrgtion=:stdOrgtion,
                                        stdTc=:stdTc,
                                        stdGroup=:stdGroup,
                                        stdPhone=:stdPhone,
                                        stdEmail=:stdEmail,
                                        stdFb=:stdFb,
                                        stdPassword=:stdPassword
                                        WHERE stdID=:stdID');
            $stmt->bindParam(':stdYear', $stdYear);
            $stmt->bindParam(':stdID', $stdID);
            $stmt->bindParam(':stdName', $stdName);
            $stmt->bindParam(':stdMainorg', $stdMainorg);
            $stmt->bindParam(':stdOrgtion', $stdOrgtion);
            $stmt->bindParam(':stdTc', $stdTc);
            $stmt->bindParam(':stdGroup', $stdGroup);
            $stmt->bindParam(':stdPhone', $stdPhone);
            $stmt->bindParam(':stdEmail', $stdEmail);
            $stmt->bindParam(':stdFb', $stdFb);
            $stmt->bindParam(':stdPassword', $stdPassword);
            if ($stmt->execute()) {
    ?>
                <script>
                    alert('ทำการแก้ไขเรียบร้อย ...');
                    window.location.href = '../view/organizer_studentall.php';
                </script>
    <?php
            } else {
                $errMSG = "พบข้อผิดพลาด";
            }
        }
    }
?>