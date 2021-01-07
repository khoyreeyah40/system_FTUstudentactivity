<?php
$stmt = $session->runQuery("SELECT activity.*,acttype.*, organization.*
                            FROM activity 
                            JOIN acttype ON acttype.acttypeNo = activity.actType
                            JOIN organization ON activity.actOrgtion = organization.orgtionNo
                            WHERE 
                            acttype.acttypeName = 'กิจกรรมชุมนุม' && activity.actYear = '$year' 
                            && activity.actStatus !='ไม่ดำเนินกิจกรรม'
                            && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                            && (activity.actMainorg = '$mainorgno' && activity.actOrgtion = '$orgtionno')
                            && (activity.actStatus!='ลงในแผน')");
$stmt->execute();
$row = $stmt->rowCount();
$rowget = $stmt->fetch(PDO::FETCH_ASSOC);
?>