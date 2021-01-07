<?php
if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
    $id = $_GET['update_id'];
    $stmt_update = $session->runQuery('SELECT mainorg.*, teacher.* FROM teacher
                                    JOIN mainorg ON mainorg.mainorgNo = teacher.teacherMainorg
                                    WHERE teacher.teacherNo = :teacherNo');
    $stmt_update->execute(array(':teacherNo' => $id));
    $update_row = $stmt_update->fetch(PDO::FETCH_ASSOC);
    extract($update_row);
} else {
    header("Location: ../view/organizer_teacher.php");
}
if (isset($_POST['btupdateteacher'])) {
    $teacherNo = $_POST['teacherNo']; 
    $teacher = $_POST['teacher']; // user name
    $teacherMainorg = $_POST['teacherMainorg'];
    $teacherAddby = $_POST['teacherAddby'];
    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('UPDATE teacher
                                    SET 
                                    teacherNo=:teacherNo,
                                    teacher=:teacher,
                                    teacherMainorg=:teacherMainorg,
                                    teacherAddby=:teacherAddby
                                    WHERE teacherNo=:teacherNo');
        $stmt->bindParam(':teacherNo', $teacherNo);
        $stmt->bindParam(':teacher', $teacher);
        $stmt->bindParam(':teacherMainorg', $teacherMainorg);
        $stmt->bindParam(':teacherAddby', $teacherAddby);
        if ($stmt->execute()) {
?>
            <script>
                alert('ทำการแก้ไขเรียบร้อย ...');
                window.location.href = '../view/organizer_teacher.php';
            </script>
<?php
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
?>