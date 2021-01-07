<?php
$stmt = $session->runQuery("SELECT activity.*,acttype.*,actregister.*
                            FROM actregister 
                            JOIN activity ON activity.actID = actregister.actregactID
                            JOIN acttype ON acttype.acttypeNo = activity.actType
                            WHERE 
                            acttype.acttypeName = 'กิจกรรมชมรม' && actregister.actregstdID ='$stdUser' 
                            && (actregister.actregStatus='ยืนยันเรียบร้อย'||actregister.actregStatus='แก้กิจกรรมเรียบร้อย')
                            && activity.actYear = '$year' 
                            && activity.actSec = 'มหาวิทยาลัย' && activity.actOrgtion = '$club'
                            && (activity.actGroup = '$group' || activity.actGroup = 'รวม')");
$stmt->execute();
$row1 = $stmt->rowCount();
$rowget1 = $stmt->fetch(PDO::FETCH_ASSOC);
?>