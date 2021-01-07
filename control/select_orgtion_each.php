<?php 
    $stmt = $session->runQuery("SELECT organization.*, organizer.* FROM organizer
                                            JOIN organization ON organizer.orgzerOrgtion = organization.orgtionNo
                                            WHERE organizer.orgzerID='$loginby' ");
              $stmt->execute();
              while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  $orgtionNo = $row["orgtionNo"];
                  $organizationlist = $row["organization"];
              ?>
                  <option value="<?php echo $orgtionNo ?>"> <?php echo $organizationlist ?></option>
              <?php
                }
                ?>