<?php
error_reporting(~E_NOTICE);
require_once '../db/dbconfig.php';
$db = new Database();
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $stmt_view = $db->dbConnection()->prepare('SELECT * FROM news WHERE newsNo=:newsNo');
    $stmt_view->execute(array(':newsNo' => $id));
    $view_row = $stmt_view->fetch(PDO::FETCH_ASSOC);
    extract($view_row);
}
?>
<div class="card-body">
    <div class="row mt-2">
        <div class="col-sm-12">
            <div class="form-group " style="color:#417d19;">
                <label>
                    <h4>เรื่อง: </h4>
                </label>
                <span> <?php echo $newsTitle; ?></span>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <span><?php echo $newsDescribe; ?></span>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-md-12">
            <div class="form-group">
                <img src="../assets/img/<?php echo $newsImage; ?>" align="center" class="img-rounded" width="100%" height="100%" />
            </div>
        </div>
    </div>
</div>
<div class="card-footer">
    <div class="row">
        <div class="col-sm ml-auto">
            <div class="form-group" style="color:#417d19;">
                <label>เพิ่มเมื่อ:</label>
                <span><?php echo $newsCreateat; ?></span>
            </div>
        </div>
        <div class="col-sm mr-auto">
            <div class="form-group" style="color:#417d19;">
                <label>เพิ่มโดย:</label>
                <span><?php echo $newsAddby; ?></span>
            </div>
        </div>
    </div>
</div>