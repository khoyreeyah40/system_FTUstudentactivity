<?php 
    $stmt = $session->runQuery("SELECT orgzerSec FROM organizer 
                                        WHERE orgzerID = '$loginby'");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $secName = $row["orgzerSec"];
    ?>
        <option value="<?php echo $secName?>"> <?php echo $secName?></option>
  <?php
      }