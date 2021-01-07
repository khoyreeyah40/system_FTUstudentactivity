<?php
    $sec = $row["orgzerSec"];
    $stmt = $session->runQuery("SELECT * FROM mainorg
                                WHERE mainorgSec = '$sec'
                                ");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $mainorgNo = $row["mainorgNo"];
            $mainorglist = $row["mainorg"];
    ?>
        <option value="<?php echo $mainorgNo ?>"> <?php echo $mainorglist ?></option>
    <?php
    }