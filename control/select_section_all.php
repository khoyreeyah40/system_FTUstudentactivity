<?php
    $stmt = $session->runQuery('SELECT secName FROM section');
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $orgzerSeclist = $row["secName"];
    ?>
        <option value="<?php echo $orgzerSeclist ?>"> <?php echo $orgzerSeclist ?></option>
    <?php
    }
?>