<?php
$stmt = $session->runQuery("SELECT activity.*,acttype.* 
FROM activity 
JOIN acttype ON acttype.acttypeNo = activity.actType
WHERE 
acttype.acttypeName = 'ค่ายพัฒนานักศึกษา(ปี1)' && activity.actYear = '$year' 
&& (activity.actGroup = '$group' || activity.actGroup = 'รวม')
&& (activity.actMainorg = '$mainorgno' || activity.actSec = 'มหาวิทยาลัย') 
");
$stmt->execute();
$rowall = $stmt->rowCount();
$rowallmore = $stmt->fetch(PDO::FETCH_ASSOC);
?>