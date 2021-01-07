<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE);
include '../control/organizer_board_updateinfo.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| จัดการบอร์ดประชาสัมพันธ์</title>
    <?php include 'header.php'; ?>

    <style>
        .breadcrumb-item {
            font-size: 16px;
        }
    </style>
</head>

<body class="fixed-navbar">
    <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
        <div class="page-heading">
            <h1 class="page-title">จัดการบอร์ดประชาสัมพันธ์</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item"><a href="organizer_board.php">จัดการบอร์ดประชาสัมพันธ์</a></li>
                <li class="breadcrumb-item">แก้ไขข้อมูลบอร์ดประชาสัมพันธ์</li>
            </ol>
        </div>
        <br>
        <br>
        <?php
        if (isset($errMSG)) {
        ?>
            <div class="alert alert-danger">
                <span class="fa fa-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
            </div>
        <?php
        }
        ?>
        <div class="ibox" style="box-shadow: 0 5px 4px rgba(0,0,0,.1);">
            <div class="ibox-head" style="background-color:#d1cbaf;">
                <div class="ibox-title" style="color:#484848;">
                    <h5>แก้ไขข้อมูลบอร์ประชาสัมพันธ์</h5>
                </div>
            </div>
            <div class="ibox-body">
                <form class="form-horizontal" enctype="multipart/form-data" id="form-sample-1" method="post" novalidate="novalidate" style="height:500px; width:100%">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">ชื่อบอร์ด</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="boardName" value="<?php echo $boardName; ?>" />
                        </div>
                        <label class="col-sm-1 col-form-label">สถานะ</label>
                        <div class="col-sm-5">
                            <select class="form-control" style="width: 100%;" name="boardStatus">
                                <option value="<?php echo $boardStatus ?>"> <?php echo $boardStatus ?></option>
                                <option value="แสดง">แสดง</option>
                                <option value="ซ่อน">ซ่อน</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">คำอธิบาย</label>
                        <div class="col-sm-11">
                            <textarea class="form-control" rows="2" type="text" name="boardDiscribe" value="<?php echo $boardDiscribe; ?>"><?php echo $boardDiscribe; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">อัพโหลดรูปภาพ</label>
                        <div class="col-sm-5">
                            <p><img src="../assets/img/<?php echo $board; ?>" height="150" width="150" /></p>
                            <input class="input-group" type="file" name="Image" accept="image/*" />
                        </div>
                        <label class="col-sm-1 col-form-label">ลิ้งค์บอร์ด</label>
                        <div class="col-sm-5">
                            <p><a href="<?php echo $boardLink ?>"><?php echo $boardLink ?></a></p>
                            <input class="form-control" type="text" name="boardLink" value="<?php echo $boardLink; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <input class="form-control" type="hidden" name="boardAddby" value="<?php echo $boardAddby; ?>" readonly />
                        </div>
                        <div class="col-sm-5">
                            <input class="form-control" type="hidden" name="boardNo" value="<?php echo $boardNo; ?>" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-warning" type="submit" name="btupdateboard">แก้ไข</button>
                            <a href="organizer_board.php"><button class="btn btn-danger" type="button">ยกเลิก</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CORE PLUGINS-->
    <?php include 'footer.php'; ?>
</body>

</html>