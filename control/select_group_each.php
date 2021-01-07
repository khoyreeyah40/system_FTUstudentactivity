<?php
$stmt = $session->runQuery("SELECT orgzerGroup FROM organizer 
                            WHERE orgzerID = '$loginby'");
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $group = $row["orgzerGroup"];
    ?>
        <option value="รวม">รวม</option>
        <option value="<?php echo $group?>"> <?php echo $group?></option>
    <?php
}
?>