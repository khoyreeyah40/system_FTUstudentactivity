<?php

$stmt = $session->runQuery("SELECT activity.*,acttype.*, organization.*
                            FROM activity 
                            JOIN acttype ON acttype.acttypeNo = activity.actType
                            JOIN organization ON activity.actOrgtion = organization.orgtionNo
                            WHERE 
                            acttype.acttypeName = 'กิจกรรมชุมนุม' && activity.actYear = '$year'+2  && activity.actStatus !='ไม่ดำเนินกิจกรรม'
                            && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                            && (activity.actMainorg = '$mainorgno' && activity.actOrgtion = '$orgtionno')");
$stmt->execute();
$rowall = $stmt->rowCount();

$stmt = $session->runQuery("SELECT activity.*,acttype.*,actregister.*
                            FROM actregister 
                            JOIN activity ON activity.actID = actregister.actregactID
                            JOIN acttype ON acttype.acttypeNo = activity.actType
                            WHERE 
                                acttype.acttypeName = 'กิจกรรมชุมนุม' && actregister.actregstdID ='$stdUser' 
                                && (actregister.actregStatus='ยืนยันเรียบร้อย'||actregister.actregStatus='แก้กิจกรรมเรียบร้อย')
                                && (activity.actMainorg = '$mainorgno' && activity.actOrgtion = '$orgtionno')
                                && activity.actYear = $year+2 
                                && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                                ");
$stmt->execute();
$row1 = $stmt->rowCount();

if (($row1 || $rowall) > 0) {
    if ($row1 >= 5) {
        $persent = ((5 / $rowall) * 100);
        if ($persent >= 80) {
            $chumnum3 = "ผ่าน";
?>
            <i class="fa fa-check text-success"></i>
        <?php
        } elseif ($persent < 80) {
            $chumnum3 = "ไม่ผ่าน";
        ?>
            <i class="fa fa-times text-danger"></i>
        <?php
        } else {
            $chumnum3 = "ไม่ผ่าน";
        ?>
            <i class="fa fa-times text-danger"></i>
        <?php
        }
    } else {
        $persent = (($row1 / $rowall) * 100);
        if ($persent >= 80) {
            $chumnum3 = "ผ่าน";
        ?>
            <i class="fa fa-check text-success"></i>
        <?php
        } elseif ($persent < 80) {
            $chumnum3 = "ไม่ผ่าน";
        ?>
            <i class="fa fa-times text-danger"></i>
<?php
        }
        else{
            $chumnum3= "ไม่ผ่าน";
        ?>
            <i class="fa fa-times text-danger"></i>
        <?php
        }
    }
} else {
    $chumnum3 = "ไม่ผ่าน";
        ?>
            <i class="fa fa-times text-danger"></i>
<?php
}

?>