<?php

$stmt = $session->runQuery("SELECT activity.*,acttype.*,mainorg.*,organization.* 
                            FROM activity 
                            JOIN acttype ON acttype.acttypeNo = activity.actType
                            JOIN mainorg ON mainorg.mainorgNo = activity.actMainorg
                            JOIN organization ON organization.orgtionNo = activity.actOrgtion
                            WHERE 
                            acttype.acttypeName = 'กิจกรรมองค์การบริหารนักศึกษา' 
                            && activity.actYear = '$year' && activity.actStatus !='ไม่ดำเนินกิจกรรม'
                            && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                            && (mainorg.mainorg = 'องค์การบริหารนักศึกษา' || organization.organization = 'องค์การบริหารนักศึกษา') ");
$stmt->execute();
$rowall = $stmt->rowCount();
$rowallmore = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $session->runQuery("SELECT activity.*,acttype.*,actregister.*,mainorg.*,organization.* 
                            FROM actregister 
                            JOIN activity ON activity.actID = actregister.actregactID
                            JOIN acttype ON acttype.acttypeNo = activity.actType
                            JOIN mainorg ON mainorg.mainorgNo = activity.actMainorg
                            JOIN organization ON organization.orgtionNo = activity.actOrgtion
                            WHERE 
                            acttype.acttypeName = 'กิจกรรมองค์การบริหารนักศึกษา' && actregister.actregstdID ='$stdUser' 
                            && (actregister.actregStatus='ยืนยันเรียบร้อย'||actregister.actregStatus='แก้กิจกรรมเรียบร้อย')
                            && activity.actYear = '$year' 
                            && (mainorg.mainorg = 'องค์การบริหารนักศึกษา' || organization.organization = 'องค์การบริหารนักศึกษา') 
                            && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                            ");
$stmt->execute();
$row1 = $stmt->rowCount();
$rowget1 = $stmt->fetch(PDO::FETCH_ASSOC);

if (($row1 || $rowall) > 0) {
    if ($row1 >= 5) {
        $persent = ((5 / $rowall) * 100);
        if ($persent >= 80) {
            $abc1 = "ผ่าน";
?>
            <i class="fa fa-check text-success"></i>
        <?php
        } elseif ($persent < 80) {
            $abc1 = "ไม่ผ่าน";
        ?>
            <i class="fa fa-times text-danger"></i>
        <?php
        } else {
            $abc1 = "ไม่ผ่าน";
        ?>
            <i class="fa fa-times text-danger"></i>
        <?php
        }
    } else {
        $persent = (($row1 / $rowall) * 100);
        if ($persent >= 80) {
            $abc1 = "ผ่าน";
        ?>
            <i class="fa fa-check text-success"></i>
        <?php
        } elseif ($persent < 80) {
            $abc1 = "ไม่ผ่าน";
        ?>
            <i class="fa fa-times text-danger"></i>
<?php
        }
        else{
            $abc1= "ไม่ผ่าน";
        ?>
            <i class="fa fa-times text-danger"></i>
        <?php
        }
    }
} else {
    $abc1 = "ไม่ผ่าน";
        ?>
            <i class="fa fa-times text-danger"></i>
<?php
}

?>