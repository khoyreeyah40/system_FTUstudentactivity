<?php
$stmt = $session->runQuery("SELECT halaqahchecklist.*,halaqahstd.*,halaqahtc.*,acttype.*
FROM halaqahchecklist
JOIN halaqahtc ON halaqahchecklist.halaqahID = halaqahtc.halaqahtcNo
JOIN acttype ON acttype.acttypeNo = halaqahchecklist.halaqahacttype
JOIN halaqahstd ON halaqahstd.halaqahID = halaqahtc.halaqahtcNo
WHERE 
    halaqahstd.halaqahstdID ='$stdUser'&& acttype.acttypeName ='กลุ่มศึกษาอัลกุรอาน'
    && (halaqahtc.halaqahtcYear = '$year' && halaqahchecklist.actSem = '2')");
$stmt->execute();
$row = $stmt->rowCount();
$rowget = $stmt->fetch(PDO::FETCH_ASSOC);
?>