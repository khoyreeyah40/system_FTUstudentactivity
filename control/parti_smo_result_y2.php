<?php
$stmt = $session->runQuery("SELECT activity.*,acttype.*, organization.* 
FROM activity 
JOIN acttype ON acttype.acttypeNo = activity.actType
JOIN organization ON activity.actOrgtion = organization.orgtionNo
WHERE 
acttype.acttypeName = 'กิจกรรมสโมสรคณะ' 
&& activity.actYear = '$year'+1 && activity.actStatus !='ไม่ดำเนินกิจกรรม'
&& (activity.actGroup = '$group' || activity.actGroup = 'รวม')
&& (activity.actMainorg = '$mainorgno' && organization.organization = 'สโมสรคณะ') 
");
$stmt->execute();
$rowall = $stmt->rowCount();

$stmt = $session->runQuery("SELECT activity.*,acttype.*,actregister.*,mainorg.*,organization.* 
FROM actregister 
JOIN activity ON activity.actID = actregister.actregactID
JOIN acttype ON acttype.acttypeNo = activity.actType
JOIN mainorg ON mainorg.mainorgNo = activity.actMainorg
JOIN organization ON organization.orgtionNo = activity.actOrgtion
WHERE 
acttype.acttypeName = 'กิจกรรมสโมสรคณะ' && actregister.actregstdID ='$stdUser' 
&& (actregister.actregStatus='ยืนยันเรียบร้อย'||actregister.actregStatus='แก้กิจกรรมเรียบร้อย')
&& activity.actYear = '$year'+1 
&& (activity.actMainorg = '$mainorgno' && organization.organization = 'สโมสรคณะ') 
&& (activity.actGroup = '$group' || activity.actGroup = 'รวม')
");
$stmt->execute();
$row1 = $stmt->rowCount();

if (($row1 || $rowall) > 0) {
    if ($row1 >= 5) {
        $persent = ((5 / $rowall) * 100);
        if ($persent >= 80) {
            $smo2 = "ผ่าน";
?>
            <i class="fa fa-check text-success"></i>
        <?php
        } elseif ($persent < 80) {
            $smo2 = "ไม่ผ่าน";
        ?>
            <i class="fa fa-times text-danger"></i>
        <?php
        } else {
            $smo2 = "ไม่ผ่าน";
        ?>
            <i class="fa fa-times text-danger"></i>
        <?php
        }
    } else {
        $persent = (($row1 / $rowall) * 100);
        if ($persent >= 80) {
            $smo2 = "ผ่าน";
        ?>
            <i class="fa fa-check text-success"></i>
        <?php
        } elseif ($persent < 80) {
            $smo2 = "ไม่ผ่าน";
        ?>
            <i class="fa fa-times text-danger"></i>
<?php
        }
        else{
            $smo2= "ไม่ผ่าน";
        ?>
            <i class="fa fa-times text-danger"></i>
        <?php
        }
    }
} else {
    $smo2 = "ไม่ผ่าน";
        ?>
            <i class="fa fa-times text-danger"></i>
<?php
}

?>