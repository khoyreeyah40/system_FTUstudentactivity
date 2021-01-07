<?php
$stmt = $session->runQuery("SELECT activity.*, acttype.*,mainorg.*,organization.* 
                            FROM activity 
                            JOIN acttype ON acttype.acttypeNo = activity.actType
                            JOIN mainorg ON mainorg.mainorgNo = activity.actMainorg
                            JOIN organization ON organization.orgtionNo = activity.actOrgtion
                            WHERE 
                            acttype.acttypeName = 'กิจกรรมองค์การบริหารนักศึกษา' 
                            && activity.actYear = '$year' 
                            && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                            && (mainorg.mainorg = 'องค์การบริหารนักศึกษา' || organization.organization = 'องค์การบริหารนักศึกษา') ");
$stmt->execute();
$rowall = $stmt->rowCount();
$rowallmore = $stmt->fetch(PDO::FETCH_ASSOC);
?>