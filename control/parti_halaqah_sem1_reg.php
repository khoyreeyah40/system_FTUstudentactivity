<?php
$stmt = $session->runQuery("SELECT halaqahchecklist.*,halaqahstd.*,halaqahcheck.*,acttype.*,halaqahtc.*
FROM halaqahcheck
JOIN halaqahchecklist ON halaqahchecklist.halaqahchecklistNo = halaqahcheck.halaqahchecklistNo
JOIN acttype ON acttype.acttypeNo = halaqahchecklist.halaqahacttype
JOIN halaqahtc ON halaqahtc.halaqahtcNo = halaqahchecklist.halaqahID
JOIN halaqahstd ON halaqahstd.halaqahstdNo = halaqahcheck.halaqahcheckstdID
WHERE 
    halaqahstd.halaqahstdID ='$stdUser' && acttype.acttypeName ='กลุ่มศึกษาอัลกุรอาน'
    && (halaqahtc.halaqahtcYear = '$year' && halaqahchecklist.actSem = '1')");
$stmt->execute();
$row1 = $stmt->rowCount();
$rowget1 = $stmt->fetch(PDO::FETCH_ASSOC);
?>