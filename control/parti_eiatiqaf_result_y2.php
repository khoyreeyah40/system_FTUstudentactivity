<?php

$stmt = $session->runQuery("SELECT * FROM eiatiqaf
                            WHERE 
                            eiatiqafstdID = '$stdUser' && eiatiqafYear = '$year'+1 
                            ");
$stmt->execute();
$rowfile = $stmt->rowCount();

$stmt = $session->runQuery("SELECT activity.*,acttype.* 
                            FROM activity 
                            JOIN acttype ON acttype.acttypeNo = activity.actType
                            WHERE 
                                acttype.acttypeName = 'อิอฺติก๊าฟ 10 วันสุดท้ายเดือนรอมฎอน' 
                                && activity.actYear = '$year'+1 && activity.actStatus !='ไม่ดำเนินกิจกรรม'
                                && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                                && (activity.actMainorg = '$mainorgno' || activity.actSec = 'มหาวิทยาลัย')");
$stmt->execute();
$rowall = $stmt->rowCount();

$stmt = $session->runQuery("SELECT activity.*,acttype.*,actregister.*
    FROM actregister 
    JOIN activity ON activity.actID = actregister.actregactID
    JOIN acttype ON acttype.acttypeNo = activity.actType
    WHERE 
    acttype.acttypeName = 'อิอฺติก๊าฟ 10 วันสุดท้ายเดือนรอมฎอน' && actregister.actregstdID ='$stdUser' 
    && (actregister.actregStatus='ยืนยันเรียบร้อย'||actregister.actregStatus='แก้กิจกรรมเรียบร้อย')
    && activity.actYear = '$year'+1
    && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
    ");
$stmt->execute();
$row1 = $stmt->rowCount();

if ($rowfile == 1) {
    $eiatiqaf2 = "ผ่าน";
    ?>
        <i class="fa fa-check text-success"></i>
    <?php 
} else {
    if (($row1 || $rowall) > 0) {
        if ($row1 >= 5) {
            $persent = ((5 / $rowall) * 100);
            if ($persent >= 80) {
                $eiatiqaf2 = "ผ่าน";
    ?>
                <i class="fa fa-check text-success"></i>
            <?php
            } elseif ($persent < 80) {
                $eiatiqaf2 = "ไม่ผ่าน";
            ?>
                <i class="fa fa-times text-danger"></i>
            <?php
            } else {
                $eiatiqaf2 = "ไม่ผ่าน";
            ?>
                <i class="fa fa-times text-danger"></i>
            <?php
            }
        } else {
            $persent = (($row1 / $rowall) * 100);
            if ($persent >= 80) {
                $eiatiqaf2 = "ผ่าน";
            ?>
                <i class="fa fa-check text-success"></i>
            <?php
            } elseif ($persent < 80) {
                $eiatiqaf2 = "ไม่ผ่าน";
            ?>
                <i class="fa fa-times text-danger"></i>
    <?php
            }
            else{
                $eiatiqaf2 = "ไม่ผ่าน";
            ?>
                <i class="fa fa-times text-danger"></i>
            <?php
            }
        }
    } else {
        $eiatiqaf2 = "ไม่ผ่าน";
            ?>
                <i class="fa fa-times text-danger"></i>
    <?php
    }
}
?>