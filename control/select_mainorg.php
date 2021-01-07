<?php
include 'session_organizer.php';
$stmt = $session->runQuery("SELECT orgzerSec FROM organizer WHERE orgzerID = '$loginby'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <option  selected="selected"disabled="disabled">--กรุณาเลือกสังกัด--</option>
    <?php
      if (($row["orgzerSec"] == "Admin")||($row["orgzerSec"] == "มหาวิทยาลัย")) {
        $stmt = $session->runQuery("SELECT * FROM mainorg
                                              WHERE mainorgSec='" . $_POST["secName"] . "' ");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $mainorgNo = $row["mainorgNo"];
                    $mainorg = $row["mainorg"];
    ?>
                    <option value="<?php echo $mainorgNo ?>"> <?php echo $mainorg ?></option>
    <?php
        }
      }
      if ($row["orgzerSec"] == "คณะ") {
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
      }
    ?>