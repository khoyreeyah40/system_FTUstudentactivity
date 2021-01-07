<?php
    $stmt = $session->runQuery("SELECT mainorg.*, organizer.* FROM organizer
                                JOIN mainorg ON organizer.orgzerMainorg = mainorg.mainorgNo
                                WHERE organizer.orgzerID='$loginby' ");
    $stmt->execute();
    ?>
        <option selected="selected" disabled="disabled">--กรุณาเลือกคณะ--</option required>
    <?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $mainorgno = $row["mainorgNo"];
                $mainorglist = $row["mainorg"];
    ?>
        <option value="<?php echo $mainorgno ?>"> <?php echo $mainorglist ?></option>
    <?php
    }