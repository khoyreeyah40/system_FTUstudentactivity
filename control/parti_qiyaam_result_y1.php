<?php
$stmt = $session->runQuery("SELECT activity.*,acttype.* 
FROM activity 
JOIN acttype ON acttype.acttypeNo = activity.actType
WHERE 
    acttype.acttypeName = 'กิยามุลลัยล์' && activity.actStatus !='ไม่ดำเนินกิจกรรม'
    && (activity.actYear = '$year' && activity.actSem = '1') 
    && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
    && (activity.actMainorg = '$mainorgno' || activity.actSec = 'มหาวิทยาลัย')");
$stmt->execute();
$rowall = $stmt->rowCount();

$stmt = $session->runQuery("SELECT activity.*,acttype.*,actregister.*
FROM actregister 
JOIN activity ON activity.actID = actregister.actregactID
JOIN acttype ON acttype.acttypeNo = activity.actType
WHERE 
    acttype.acttypeName = 'กิยามุลลัยล์' && actregister.actregstdID ='$stdUser' 
    && (actregister.actregStatus='ยืนยันเรียบร้อย'||actregister.actregStatus='แก้กิจกรรมเรียบร้อย')
    && (activity.actYear = '$year'&& activity.actSem = '1') 
    && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
        ");
$stmt->execute();
$row1 = $stmt->rowCount();

if (($row1 || $rowall) > 0) {
    $persent = (($row1 / $rowall) * 100);
    if ($persent >= 80) {
        $qiyaam1_1 = "ผ่าน";
    } elseif ($persent < 80) {
        $qiyaam1_1 = "ไม่ผ่าน";
    }else {
        $qiyaam1_1 = "ไม่ผ่าน";
    }
} else {
    $qiyaam1_1 = "ไม่ผ่าน";
}

$stmt = $session->runQuery("SELECT activity.*,acttype.* 
                            FROM activity 
                            JOIN acttype ON acttype.acttypeNo = activity.actType
                            WHERE 
                                acttype.acttypeName = 'กิยามุลลัยล์' 
                                && (activity.actYear = '$year' && activity.actSem = '2') 
                                && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                                && (activity.actMainorg = '$mainorgno' || activity.actSec = 'มหาวิทยาลัย')");
$stmt->execute();
$rowall = $stmt->rowCount();

$stmt = $session->runQuery("SELECT activity.*,acttype.*,actregister.*
FROM actregister 
JOIN activity ON activity.actID = actregister.actregactID
JOIN acttype ON acttype.acttypeNo = activity.actType
WHERE 
    acttype.acttypeName = 'กิยามุลลัยล์' && actregister.actregstdID ='$stdUser' 
    && (actregister.actregStatus='ยืนยันเรียบร้อย'||actregister.actregStatus='แก้กิจกรรมเรียบร้อย')
    && (activity.actYear = '$year'&& activity.actSem = '2') 
    && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
        ");
$stmt->execute();
$row1 = $stmt->rowCount();

if (($row1 || $rowall) > 0) {
    $persent = (($row1 / $rowall) * 100);
    if ($persent >= 80) {
        $qiyaam1_2 = "ผ่าน";
    } elseif ($persent < 80) {
        $qiyaam1_2 = "ไม่ผ่าน";
    } else {
        $qiyaam1_2 = "ไม่ผ่าน";
    }
} else {
    $qiyaam1_2 = "ไม่ผ่าน";
}

if ($qiyaam1_1 == 'ผ่าน' && $qiyaam1_2 == 'ผ่าน') {
?>
    <i class="fa fa-check text-success"></i>
<?php
} else {
?>
    <i class="fa fa-times text-danger"></i>
<?php
}
?>