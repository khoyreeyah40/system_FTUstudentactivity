<?php
if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
    $id = $_GET['update_id'];
    $stmt_update = $session->runQuery('SELECT mainorgNo,mainorg,mainorgSec,mainorgAddby FROM mainorg WHERE mainorgNo=:mainorgNo');
    $stmt_update->execute(array(':mainorgNo' => $id));
    $update_row = $stmt_update->fetch(PDO::FETCH_ASSOC);
    extract($update_row);
} else {
    header("Location: ../view/organizer_mainorganization.php");
}
if (isset($_POST['btupdatemainorg'])) {
    $mainorgNo = $_POST['mainorgNo'];
    $mainorg = $_POST['mainorg'];
    $mainorgSec = $_POST['mainorgSec']; // user name
    $mainorgAddby = $_POST['mainorgAddby'];
    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('UPDATE mainorg
                                    SET 
                                    mainorgNo=:mainorgNo,
                                    mainorg=:mainorg,
                                    mainorgSec=:mainorgSec,
                                    mainorgAddby=:mainorgAddby
                                    WHERE mainorgNo=:mainorgNo');
        $stmt->bindParam(':mainorgNo', $mainorgNo);
        $stmt->bindParam(':mainorg', $mainorg);
        $stmt->bindParam(':mainorgSec', $mainorgSec);
        $stmt->bindParam(':mainorgAddby', $mainorgAddby);
        if ($stmt->execute()) {
?>
            <script>
                alert('ทำการแก้ไขเรียบร้อย ...');
                window.location.href = '../view/organizer_mainorganization.php';
            </script>
<?php
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
?>