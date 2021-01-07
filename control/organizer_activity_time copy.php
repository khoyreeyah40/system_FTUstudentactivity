<?php
if (isset($_GET['actsem1_1_id'])) {
    $stmt = $session->runQuery('UPDATE actsem 
                                    SET actsemStatus="เปิดการแก้กิจกรรม"
                                    WHERE actsemNo=:actsemno');
    $stmt->bindParam(':actsemno', $_GET['actsem1_1_id']);
    if ($stmt->execute()) {
            $successMSG = "ทำรายการสำเร็จ";
            header("refresh:2;../view/organizer_activity_time.php");
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
if (isset($_GET['actsem1_2_id'])) {
    $stmt = $session->runQuery('UPDATE actsem 
                                    SET actsemStatus="สำเร็จกิจกรรมแล้ว"
                                    WHERE actsemNo=:actsemno');
    $stmt->bindParam(':actsemno', $_GET['actsem1_2_id']);
    if ($stmt->execute()) {
            $stmt = $session->runQuery("SELECT actyear.*,actsem.* FROM actsem 
                JOIN actyear ON actyear.actyear = actsem.actsemyear
                WHERE actsem.actsemStatus = 'สำเร็จกิจกรรมแล้ว' && actyear.actyearStatus = 'ดำเนินกิจกรรม'");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $actsem =$row["actsemNo"];
            $stmt = $session->runQuery("SELECT * FROM activity WHERE actSem = '$actsem'&& actStatus != 'ลงในแผน'");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = $session->runQuery('UPDATE activity
                                    SET actStatus="กิจกรรมเสร็จสิ้น"
                                    WHERE actSem=:actSem && actStatus != "ลงในแผน"');
            $stmt->bindParam(':actSem', $actsem);;
            if ($stmt->execute()) {
                $stmt = $session->runQuery("SELECT actyear FROM actyear WHERE actyearStatus = 'ดำเนินกิจกรรม'");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $year = $row["actyear"];
                $stmt = $session->runQuery('UPDATE actsem 
                                 SET actsemStatus="ดำเนินกิจกรรม"
                                 WHERE actsemStatus ="รอดำเนินกิจกรรม" && actsemyear=:actsemyear');
                $stmt->bindParam(':actsemyear', $year);
        if ($stmt->execute()) {
            $successMSG = "ทำรายการสำเร็จ";
            header("refresh:2;../view/organizer_activity_time.php");
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
}
if (isset($_GET['actsem2_1_id'])) {
    $stmt = $session->runQuery('UPDATE actsem 
                                    SET actsemStatus="เปิดการแก้กิจกรรม"
                                    WHERE actsemNo=:actsemno');
    $stmt->bindParam(':actsemno', $_GET['actsem2_1_id']);
    if ($stmt->execute()) {
            $successMSG = "ทำรายการสำเร็จ";
            header("refresh:2;actyear.php");
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
if (isset($_GET['actsem2_2_id'])) {

    $stmt = $session->runQuery('UPDATE actsem 
                                 SET actsemStatus="สำเร็จกิจกรรมแล้ว"
                                  WHERE actsemNo=:actsemno');
    $stmt->bindParam(':actsemno', $_GET['actsem2_2_id']);
    if ($stmt->execute()) {
            $stmt = $session->runQuery("SELECT actyear FROM actyear WHERE actyearStatus = 'ดำเนินกิจกรรม'");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $year = $row["actyear"];
            $stmt = $session->runQuery("SELECT * FROM activity WHERE actYear = '$year'&& actStatus != 'ลงในแผน'");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = $session->runQuery('UPDATE activity
                                    SET actStatus="กิจกรรมเสร็จสิ้น"
                                    WHERE actYear=:actYear && actStatus != "ลงในแผน"');
            $stmt->bindParam(':actYear', $year);
            if ($stmt->execute()) {
                $stmt = $session->runQuery("SELECT * FROM actyear  WHERE actyearStatus = 'ดำเนินกิจกรรม'");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $year = $row["actyear"];
                $stmt = $session->runQuery('UPDATE actyear
                                    SET actyearStatus="สำเร็จกิจกรรมแล้ว"
                                    WHERE actyear=:actyear');
                $stmt->bindParam(':actyear', $year);
                if ($stmt->execute()) {
                    $stmt = $session->runQuery("SELECT actyear FROM actyear ORDER BY actyear DESC limit 1");
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $year = $row["actyear"]+1;
                    $stmt = $session->runQuery('INSERT INTO actyear(actyear,actyearStatus) VALUES
                                                        (:actyear,"ดำเนินกิจกรรม")');
                    $stmt->bindParam(':actyear', $year);
                    if ($stmt->execute()) {
                        $stmt = $session->runQuery("SELECT actyear FROM actyear WHERE actyearStatus = 'ดำเนินกิจกรรม'");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $year = $row["actyear"];
                        $stmt = $session->runQuery('INSERT INTO actsem(actsemyear,actsem,actsemStatus) VALUES
                                                                (:actsemyear,"1","ดำเนินกิจกรรม")');
                        $stmt->bindParam(':actsemyear', $year);
                        if ($stmt->execute()) {
                            $stmt = $session->runQuery("SELECT actyear FROM actyear WHERE actyearStatus = 'ดำเนินกิจกรรม'");
                            $stmt->execute();
                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                            $year = $row["actyear"];
                            $stmt = $session->runQuery('INSERT INTO actsem(actsemyear,actsem,actsemStatus) VALUES
                                                                (:actsemyear,"2","รอดำเนินกิจกรรม")');
                            $stmt->bindParam(':actsemyear', $year);
                            if ($stmt->execute()) {
                                $successMSG = "ทำรายการสำเร็จ";
                                header("refresh:2;../view/organizer_activity_time.php");
                            } else {
                                $errMSG = "พบข้อผิดพลาด";
                            }
                        }
                }
            } 
        }
    }
}
?>