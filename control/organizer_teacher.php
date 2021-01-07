<?php
if (isset($_POST['btaddteacher'])) {
    $teacher = $_POST['teacher']; // user name
    $teacherMainorg = $_POST['teacherMainorg'];
    $teacherAddby = $_POST['teacherAddby'];
    if (empty($teacher)) 
    {
        $errMSG = "กรุณากรอกรายละเอียดให้ครบถ้วน";
    }
    //check username
    if ($teacher != "" && $teacherMainorg != "") {
        $stmt = $session->runQuery("SELECT teacher FROM teacher WHERE teacher='$teacher' && teacherMainorg='$teacherMainorg'");
        $checkexist = $stmt->execute();
            if ($stmt->rowCount($checkexist)) 
            {
                $errMSG = "รายชื่อนี้ได้ถูกเพิ่มแล้ว";
            }
    }
    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('INSERT INTO teacher(teacher,teacherMainorg,teacherAddby) VALUES
                                                            (:teacher,:teachermainorg,:teacherAddby)');

        $stmt->bindParam(':teacher', $teacher);
        $stmt->bindParam(':teachermainorg', $teacherMainorg);
        $stmt->bindParam(':teacherAddby', $teacherAddby);
            if ($stmt->execute()) 
            {
                $successMSG = "ทำการเพิ่มสำเร็จ";
                header("refresh; ../view/organizer_teacher.php");
            } else {
                $errMSG = "พบข้อผิดพลาด";
            }
    }
}
if (isset($_GET['delete_id'])) {
    // it will delete an actual record from db
    $stmt = $session->runQuery('DELETE FROM teacher WHERE teacherNo =:id');
    $stmt->bindParam(':id', $_GET['delete_id']);
        if ($stmt->execute()) 
        {
            $successMSG = "ทำการลบสำเร็จ";
            header("Location: ../view/organizer_teacher.php");
        } else {
            $errMSG = "ไม่สามารถทำการลบได้เนื่องข้อมูลถูกนำไปใช้แล้ว";
        }   
    }
?>