<?php
    require_once '../db/dbconfig.php';
    $db = new Database();
    $stmt = $db->dbConnection()->prepare("SELECT mainorg.*, teacher.* FROM teacher
                                        JOIN mainorg ON mainorg.mainorgNo = teacher.teacherMainorg
                                        WHERE teacher.teacherMainorg='" . $_POST["mainorgNo"] . "' ");
    $stmt->execute();
    ?>
        <option selected="selected" disabled="disabled">--กรุณาเลือกอาจารย์ที่ปรึกษา--</option>
    <?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $teacherNo = $row["teacherNo"];
        $teacher = $row["teacher"];
    ?>
        <option value="<?php echo $teacherNo ?>"> <?php echo $teacher ?></option>
    <?php
    }
?>
