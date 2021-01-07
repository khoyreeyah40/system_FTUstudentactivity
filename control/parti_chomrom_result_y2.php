<?php

$stmt_club = $session->runQuery("SELECT club.*, organization.* FROM club 
JOIN organization ON organization.orgtionNo = club.clubOrgtion
WHERE clubstdID='$stdUser' && clubYear='$year'+1");
$stmt_club->execute();
$rowclub = $stmt_club->rowCount();
$rowclubname = $stmt_club->fetch(PDO::FETCH_ASSOC);
$club = $rowclubname["clubOrgtion"];
$clubname = $rowclubname["organization"];
if ($rowclub > 0){
            $stmt = $session->runQuery("SELECT activity.*,acttype.*
                            FROM activity
                            JOIN acttype ON acttype.acttypeNo = activity.actType
                            WHERE
                            acttype.acttypeName = 'กิจกรรมชมรม' && activity.actYear = '$year'+1 && activity.actStatus !='ไม่ดำเนินกิจกรรม'
                            && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                            && activity.actSec = 'มหาวิทยาลัย' && activity.actOrgtion = '$club'");
            $stmt->execute();
            $rowall = $stmt->rowCount();

            $stmt = $session->runQuery("SELECT activity.*,acttype.*,actregister.*
                FROM actregister 
                JOIN activity ON activity.actID = actregister.actregactID
                JOIN acttype ON acttype.acttypeNo = activity.actType
                WHERE 
                acttype.acttypeName = 'กิจกรรมชมรม' && actregister.actregstdID ='$stdUser' 
                && (actregister.actregStatus='ยืนยันเรียบร้อย'||actregister.actregStatus='แก้กิจกรรมเรียบร้อย')
                && activity.actYear = '$year'+1 
                && activity.actSec = 'มหาวิทยาลัย' && activity.actOrgtion = '$club'
                && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                ");
            $stmt->execute();
            $row1 = $stmt->rowCount();
            
            if (($row1 || $rowall) > 0) {
                if ($row1 >= 5) {
                    $persent = ((5 / $rowall) * 100);
                    if ($persent >= 80) {
                        $chomrom1 = "ผ่าน";
            ?>
                        <i class="fa fa-check text-success"></i>
                    <?php
                    } elseif ($persent < 80) {
                        $chomrom2 = "ไม่ผ่าน";
                    ?>
                        <i class="fa fa-times text-danger"></i>
                    <?php
                    } else {
                        $chomrom2 = "ไม่ผ่าน";
                    ?>
                        <i class="fa fa-times text-danger"></i>
                    <?php
                    }
                } else {
                    $persent = (($row1 / $rowall) * 100);
                    if ($persent >= 80) {
                        $chomrom2 = "ผ่าน";
                    ?>
                        <i class="fa fa-check text-success"></i>
                    <?php
                    } elseif ($persent < 80) {
                        $chomrom2 = "ไม่ผ่าน";
                    ?>
                        <i class="fa fa-times text-danger"></i>
            <?php
                    }
                    else{
                        $chomrom2 = "ไม่ผ่าน";
                    ?>
                        <i class="fa fa-times text-danger"></i>
                    <?php
                    }
                }
            } else {
                $chomrom2 = "ไม่ผ่าน";
                    ?>
                        <i class="fa fa-times text-danger"></i>
            <?php
            }
}else if ($rowclub == null){
        $chomrom2 = "ไม่ผ่าน";
    ?>
        <i class="fa fa-times text-danger"></i>
<?php } ?>
