<?php

$stmt = $session->runQuery("SELECT halaqahchecklist.*,halaqahstd.*,halaqahtc.*,acttype.*
                            FROM halaqahchecklist
                            JOIN halaqahtc ON halaqahchecklist.halaqahID = halaqahtc.halaqahtcNo
                            JOIN acttype ON acttype.acttypeNo = halaqahchecklist.halaqahacttype
                            JOIN halaqahstd ON halaqahstd.halaqahID = halaqahtc.halaqahtcNo
                            WHERE 
                                halaqahstd.halaqahstdID ='$stdUser'&& acttype.acttypeName ='กลุ่มศึกษาอัลกุรอาน'
                                && (halaqahtc.halaqahtcYear = '$year'+3 && halaqahchecklist.actSem = '1')");
$stmt->execute();
$row = $stmt->rowCount();
$rowget = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $session->runQuery("SELECT halaqahchecklist.*,halaqahstd.*,halaqahcheck.*,acttype.*,halaqahtc.*
                            FROM halaqahcheck
                            JOIN halaqahchecklist ON halaqahchecklist.halaqahchecklistNo = halaqahcheck.halaqahchecklistNo
                            JOIN acttype ON acttype.acttypeNo = halaqahchecklist.halaqahacttype
                            JOIN halaqahtc ON halaqahtc.halaqahtcNo = halaqahchecklist.halaqahID
                            JOIN halaqahstd ON halaqahstd.halaqahstdNo = halaqahcheck.halaqahcheckstdID
                            WHERE 
                                halaqahstd.halaqahstdID ='$stdUser' && acttype.acttypeName ='กลุ่มศึกษาอัลกุรอาน'
                                && (halaqahtc.halaqahtcYear = '$year'+3 && halaqahchecklist.actSem = '1')");
$stmt->execute();
$row1 = $stmt->rowCount();
$rowget1 = $stmt->fetch(PDO::FETCH_ASSOC);

if (($row1 || $row) > 0) {
    $persent = (($row1 / $row) * 100);
    if ($persent >= 80) {
        $halaqah4_1 = "ผ่าน";
    } elseif ($persent < 80) {
        $halaqah4_1 = "ไม่ผ่าน";
    }
} else { 
    $halaqah4_1 = "ไม่ผ่าน";
}

$stmt = $session->runQuery("SELECT halaqahchecklist.*,halaqahstd.*,halaqahtc.*,acttype.*
                            FROM halaqahchecklist
                            JOIN halaqahtc ON halaqahchecklist.halaqahID = halaqahtc.halaqahtcNo
                            JOIN acttype ON acttype.acttypeNo = halaqahchecklist.halaqahacttype
                            JOIN halaqahstd ON halaqahstd.halaqahID = halaqahtc.halaqahtcNo
                            WHERE 
                                halaqahstd.halaqahstdID ='$stdUser'&& acttype.acttypeName ='กลุ่มศึกษาอัลกุรอาน'
                                && (halaqahtc.halaqahtcYear = '$year'+3 && halaqahchecklist.actSem = '2')");
$stmt->execute();
$row = $stmt->rowCount();
$rowget = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $session->runQuery("SELECT halaqahchecklist.*,halaqahstd.*,halaqahcheck.*,acttype.*,halaqahtc.*
                            FROM halaqahcheck
                            JOIN halaqahchecklist ON halaqahchecklist.halaqahchecklistNo = halaqahcheck.halaqahchecklistNo
                            JOIN acttype ON acttype.acttypeNo = halaqahchecklist.halaqahacttype
                            JOIN halaqahtc ON halaqahtc.halaqahtcNo = halaqahchecklist.halaqahID
                            JOIN halaqahstd ON halaqahstd.halaqahstdNo = halaqahcheck.halaqahcheckstdID
                            WHERE 
                                halaqahstd.halaqahstdID ='$stdUser' && acttype.acttypeName ='กลุ่มศึกษาอัลกุรอาน'
                                && (halaqahtc.halaqahtcYear = '$year'+3 && halaqahchecklist.actSem = '2')");
$stmt->execute();
$row1 = $stmt->rowCount();
$rowget1 = $stmt->fetch(PDO::FETCH_ASSOC);

if (($row1 || $row) > 0) {
    $persent = (($row1 / $row) * 100);
    if ($persent >= 80) {
        $halaqah4_2 = "ผ่าน";
    } elseif ($persent < 80) {
        $halaqah4_2 = "ไม่ผ่าน";
    }
} else {
    $halaqah4_2 = "ไม่ผ่าน";
}

if ($halaqah4_1 == 'ผ่าน' && $halaqah4_2 == 'ผ่าน') {
?>
    <i class="fa fa-check text-success"></i>
<?php
} else {
?>
    <i class="fa fa-times text-danger"></i>
<?php
}
?>