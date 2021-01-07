<?php 
if (isset($_GET['update_id']) && !empty($_GET['update_id'])) {
    $id = $_GET['update_id'];
    $stmt_update = $session->runQuery('SELECT   mainorg.*, organization.* FROM organization
                                        JOIN mainorg ON organization.orgtionMainorg = mainorg.mainorgNo
                                        WHERE organization.orgtionNo = :orgtionNo');
    $stmt_update->execute(array(':orgtionNo' => $id));
    $update_row = $stmt_update->fetch(PDO::FETCH_ASSOC);
    extract($update_row);
} else {
    header("Location: ../view/organizer_organization.php");
}
if (isset($_POST['btupdateorgtion'])) {
    $orgtionNo = $_POST['orgtionNo'];
    $organization = $_POST['organization'];
    $orgtionMainorg = $_POST['orgtionMainorg']; // user name
    $orgtionAddby = $_POST['orgtionAddby'];
    // if no error occured, continue ....
    if (!isset($errMSG)) {
        $stmt = $session->runQuery('UPDATE organization
                                    SET 
                                    orgtionNo=:orgtionNo,
                                    organization=:organization,
                                    orgtionMainorg=:orgtionMainorg,
                                    orgtionAddby=:orgtionAddby
                                    WHERE orgtionNo=:orgtionNo');
        $stmt->bindParam(':orgtionNo', $orgtionNo);
        $stmt->bindParam(':organization', $organization);
        $stmt->bindParam(':orgtionMainorg', $orgtionMainorg);
        $stmt->bindParam(':orgtionAddby', $orgtionAddby);
        if ($stmt->execute()) {
?>
            <script>
                alert('ทำการแก้ไขเรียบร้อย ...');
                window.location.href = '../view/organizer_organization.php';
            </script>
<?php
        } else {
            $errMSG = "พบข้อผิดพลาด";
        }
    }
}
?>