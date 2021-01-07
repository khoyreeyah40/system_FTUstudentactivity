<?php
$stmt = $session->runQuery("SELECT activity.*,acttype.*
                            FROM activity
                            JOIN acttype ON acttype.acttypeNo = activity.actType
                            WHERE
                            acttype.acttypeName = 'กิจกรรมชมรม' && activity.actYear = '$year'
                            && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                            && activity.actSec = 'มหาวิทยาลัย' && activity.actOrgtion = '$club'");
$stmt->execute();
$rowall = $stmt->rowCount();
$rowallmore = $stmt->fetch(PDO::FETCH_ASSOC);
?>