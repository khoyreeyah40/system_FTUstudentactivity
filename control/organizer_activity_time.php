<?php
if (isset($_GET['actyearbegin_id'])) {
    $stmt = $session->runQuery('UPDATE actyear
                                    SET actyearStatus="ดำเนินกิจกรรม"
                                    WHERE actyear=:actyear');
    $stmt->bindParam(':actyear', $_GET['actyearbegin_id']);
    if ($stmt->execute()) {
        $successMSG = "ทำรายการสำเร็จ";
        header("refresh:2;../view/organizer_activity_time.php");
    } else {
        $errMSG = "พบข้อผิดพลาด";
    }
}
if (isset($_GET['actyearend_id'])) {
    $year = $_GET['actyearend_id'];
    $stmt = $session->runQuery("SELECT * FROM activity WHERE actYear = '$year' && actStatus != 'ลงในแผน'");
    if ($stmt->execute()) {
        $stmt = $session->runQuery('UPDATE activity
                                    SET actStatus="กิจกรรมเสร็จสิ้น"
                                    WHERE actYear=:actYear && actStatus != "ลงในแผน"');
        $stmt->bindParam(':actYear', $year);
        if ($stmt->execute()) {
            $stmt = $session->runQuery("SELECT * FROM activity WHERE actYear = '$year' && actStatus = 'ลงในแผน'");
            if ($stmt->execute()) {
                $stmt = $session->runQuery('UPDATE activity
                                            SET actStatus="ไม่ดำเนินกิจกรรม"
                                            WHERE actYear=:actYear && actStatus = "ลงในแผน"');
                $stmt->bindParam(':actYear', $year);
                if ($stmt->execute()) {
                    $stmt = $session->runQuery("SELECT * FROM actyear WHERE actyearStatus = 'ดำเนินกิจกรรม'");
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $year = $row["actyear"];
                    $stmt = $session->runQuery('UPDATE actyear
                                    SET actyearStatus="สำเร็จกิจกรรม"
                                    WHERE actyear=:actyear');
                    $stmt->bindParam(':actyear', $year);
                    if ($stmt->execute()) {
                        $stmt = $session->runQuery("SELECT actyear FROM actyear ORDER BY actyear DESC limit 1");
                        $stmt->execute();
                        $row = $stmt->fetch(PDO::FETCH_ASSOC);
                        $year = $row["actyear"] + 1;
                        $stmt = $session->runQuery('INSERT INTO actyear(actyear,actyearStatus) VALUES
                                                        (:actyear,"รอดำเนินกิจกรรม")');
                        $stmt->bindParam(':actyear', $year);
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
