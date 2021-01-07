<?php 
$stmt = $session->runQuery("SELECT halaqahtc.*,organizer.*,halaqahstd.*
                            FROM organizer
                            JOIN halaqahtc ON halaqahtc.halaqahtcID = organizer.orgzerID
                            JOIN halaqahstd ON halaqahstd.halaqahID = halaqahtc.halaqahtcNo
                            WHERE 
                                halaqahtc.halaqahtcYear ='$year' && halaqahstd.halaqahstdID ='$stdUser'");
$stmt->execute();
$rowtcname = $stmt->fetch(PDO::FETCH_ASSOC);
    echo $rowtcname['orgzerName'];
?>