<?php
$stmt = $session->runQuery("SELECT halaqahchecklist.*,halaqahstd.*,halaqahtc.*,acttype.*
FROM halaqahchecklist
JOIN halaqahtc ON halaqahchecklist.halaqahID = halaqahtc.halaqahtcNo
JOIN acttype ON acttype.acttypeNo = halaqahchecklist.halaqahacttype
JOIN halaqahstd ON halaqahstd.halaqahID = halaqahtc.halaqahtcNo
WHERE 
    halaqahstd.halaqahstdID ='$stdUser'&& acttype.acttypeName ='กลุ่มศึกษาอัลกุรอาน'
    && (halaqahtc.halaqahtcYear = '$year' && halaqahchecklist.actSem = '1')");
$stmt->execute();
$rowrun1 = $stmt->rowCount();
$rowget = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $session->runQuery("SELECT activity.*,acttype.* 
FROM activity 
JOIN acttype ON acttype.acttypeNo = activity.actType
WHERE 
    acttype.acttypeName = 'กลุ่มศึกษาอัลกุรอาน' 
    && (activity.actYear = '$year' && activity.actSem = '1') 
    && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
    && (activity.actMainorg = '$mainorgno' || activity.actSec = 'มหาวิทยาลัย') 
    && (activity.actStatus !='ลงในแผน')");
$stmt->execute();
$row = $stmt->rowCount();
$rowget = $stmt->fetch(PDO::FETCH_ASSOC);
?>