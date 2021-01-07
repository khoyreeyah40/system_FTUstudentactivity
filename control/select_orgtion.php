<?php
    require_once '../db/dbconfig.php';
    $db = new Database();
    $stmt = $db->dbConnection()->prepare("SELECT mainorg.*, organization.* FROM organization
                                        JOIN mainorg ON mainorg.mainorgNo = organization.orgtionMainorg
                                        WHERE organization.orgtionMainorg='" . $_POST["mainorgNo"] . "' ");
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $orgtionNo = $row["orgtionNo"];
        $organizationlist = $row["organization"];
    ?>
        <option value="<?php echo $orgtionNo ?>"> <?php echo $organizationlist ?></option>
    <?php
}
?>
