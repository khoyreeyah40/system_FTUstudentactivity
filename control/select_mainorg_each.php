<?php
$stmt = $session->runQuery("SELECT organizer.*, mainorg.* FROM organizer
                            JOIN mainorg ON organizer.orgzerMainorg = mainorg.mainorgNo
                            WHERE organizer.orgzerID = '$loginby'
                            ");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $mainorgNo = $row["mainorgNo"];
        $mainorglist = $row["mainorg"];
    ?>
        <option value="<?php echo $mainorgNo ?>"> <?php echo $mainorglist ?></option>
    <?php
}
?>