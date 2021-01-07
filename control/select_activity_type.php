<?php
    $stmt = $session->runQuery("SELECT acttypeNo, acttypeName FROM acttype");
    $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $acttypeNo = $row["acttypeNo"];
        $acttypelist = $row["acttypeName"];
    ?>
        <option value="<?php echo $acttypeNo ?>"> <?php echo $acttypelist ?></option>
    <?php
    }
?>