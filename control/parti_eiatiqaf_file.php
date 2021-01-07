<?php
$stmt = $session->runQuery("SELECT * FROM eiatiqaf WHERE eiatiqafstdID = '$stdUser' && eiatiqafYear = '$year' ");
$stmt->execute();
$rowfile = $stmt->rowCount();
$rowfileeia = $stmt->fetch(PDO::FETCH_ASSOC);
?>
