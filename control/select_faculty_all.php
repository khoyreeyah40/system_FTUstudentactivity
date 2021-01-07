<?php 
    $stmt = $session->runQuery("SELECT * FROM mainorg WHERE mainorgSec = 'คณะ'");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $mainorgno = $row["mainorgNo"];
            $mainorglist = $row["mainorg"];
    ?>
        <option value="<?php echo $mainorgno ?>"> <?php echo $mainorglist ?></option>
    <?php
    }