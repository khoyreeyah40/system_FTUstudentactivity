<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE);
include '../control/organizer_news_updateinfo.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| แก้ไขข้อมูลข่าวประชาสัมพันธ์</title>
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
            <h1 class="page-title">จัดการข่าวประชาสัมพันธ์</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item"><a href="organizer_news.php">จัดการข่าวประชาสัมพันธ์</a></li>
                <li class="breadcrumb-item">แก้ไขข้อมูลข่าวประชาสัมพันธ์</li>
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
                    <h5>แก้ไขข้อมูลข่าวประชาสัมพันธ์</h5>
                </div>
            </div>
            <div class="ibox-body">
                <form class="form-horizontal" enctype="multipart/form-data" id="form-sample-1" method="post" novalidate="novalidate" style="height:500px; width:100%">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">หัวข้อ</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="newsTitle" value="<?php echo $newsTitle; ?>" required />
                        </div>
                        <label class="col-sm-1 col-form-label">สถานะ</label>
                        <div class="col-sm-5">
                            <select class="form-control" style="width: 100%;" name="newsStatus">
                                <option value="<?php echo $newsStatus ?>"> <?php echo $newsStatus ?></option>
                                <option value="แสดง">แสดง</option>
                                <option value="ซ่อน">ซ่อน</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">คำอธิบาย</label>
                        <div class="col-sm-11">
                            <textarea class="form-control" rows="2" type="text" name="newsDescribe" value="<?php echo $newsDescribe; ?>" required><?php echo $newsDescribe; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">อัพโหลดรูปภาพ</label>
                        <div class="col-sm-5">
                            <p><img src="../assets/img/<?php echo $newsImage; ?>" height="150" width="150" /></p>
                            <input class="input-group" type="file" name="Image" accept="image/*" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-5">
                            <input class="form-control" type="hidden" name="newsAddby" value="<?php echo $newsAddby; ?>" readonly />
                        </div>
                        <div class="col-sm-5">
                            <input class="form-control" type="hidden" name="newsNo" value="<?php echo $newsNo; ?>" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-warning" type="submit" name="btupdatenews">แก้ไข</button>
                            <a href="organizer_news.php"><button class="btn btn-danger" type="button">ยกเลิก</button></a>
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