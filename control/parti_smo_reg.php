<?php
$stmt = $session->runQuery("SELECT activity.*,acttype.*,actregister.*, organization.*
                            FROM actregister 
                            JOIN activity ON activity.actID = actregister.actregactID
                            JOIN acttype ON acttype.acttypeNo = activity.actType
                            JOIN organization ON activity.actOrgtion = organization.orgtionNo
                            WHERE 
                            acttype.acttypeName = 'กิจกรรมสโมสรคณะ' && actregister.actregstdID ='$stdUser' 
                            && (actregister.actregStatus='ยืนยันเรียบร้อย'||actregister.actregStatus='แก้กิจกรรมเรียบร้อย')
                            && activity.actYear = '$year' 
                            && (activity.actGroup = '$group' || activity.actGroup = 'รวม')
                            && (activity.actMainorg = '$mainorgno' && organization.organization = 'สโมสรคณะ') 
                            ");
$stmt->execute();
$row1 = $stmt->rowCount();
$rowget1 = $stmt->fetch(PDO::FETCH_ASSOC);
?>