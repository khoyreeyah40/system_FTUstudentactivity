<?php
    $stmt = $session->runQuery("SELECT actsem.*, actyear.* FROM actsem 
                                JOIN actyear ON actyear.actyear = actsem.actsemYear
                                WHERE actyear.actyearStatus='ดำเนินกิจกรรม'");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $actsem = $row["actsem"];
            $actsemNo = $row["actsemNo"];
    ?>
        <option value="<?php echo $actsemNo ?>"> ภาคเรียนที่ <?php echo $actsem ?></option>
    <?php
    }
?>