<?php
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
?>