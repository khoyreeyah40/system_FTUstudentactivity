<?php
    $stmt = $session->runQuery("SELECT * FROM actyear WHERE actyearStatus='ดำเนินกิจกรรม'");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $actyear = $row["actyear"];
    ?>
        <option value="<?php echo $actyear ?>"> <?php echo $actyear ?></option>
    <?php
    }
?>