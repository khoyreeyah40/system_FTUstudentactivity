<?php
$stmt = $session->runQuery("SELECT activity.*,acttype.* 
                            FROM activity 
                            JOIN acttype ON acttype.acttypeNo = activity.actType
                            WHERE 
                                acttype.acttypeName = 'กิยามุลลัยล์' && activity.actStatus !='ไม่ดำเนินกิจกรรม'
                                && (activity.actYear = '$year' && activity.actSem = '2') 
                                && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                                && (activity.actMainorg = '$mainorgno' || activity.actSec = 'มหาวิทยาลัย') 
                                && (activity.actStatus!='ลงในแผน')");
$stmt->execute();
$row = $stmt->rowCount();
$rowget = $stmt->fetch(PDO::FETCH_ASSOC);
?>
