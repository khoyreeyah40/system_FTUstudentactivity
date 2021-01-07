<?php 
    $stmt = $session->runQuery('SELECT mainorgNo, mainorg FROM mainorg');
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $mainorgNo = $row["mainorgNo"];
        $mainorglist = $row["mainorg"];
    ?>
        <option value="<?php echo $mainorgNo ?>"> <?php echo $mainorglist ?></option>
    <?php
    }
?>