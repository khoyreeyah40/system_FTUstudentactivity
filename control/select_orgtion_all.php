<?php
    $stmt = $session->runQuery("SELECT orgtionNo, organization FROM organization");
    $stmt->execute();
    ?>
        <option selected="selected" disabled="disabled">--กรุณาเลือกองค์กร--</option>
    <?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $orgtionNo = $row["orgtionNo"];
        $organizationlist = $row["organization"];
    ?>
        <option value="<?php echo $orgtionNo ?>"> <?php echo $organizationlist ?></option>
    <?php
    }
?>