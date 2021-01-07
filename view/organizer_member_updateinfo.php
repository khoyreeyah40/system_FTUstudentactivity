<?php
include '../control/session_organizer.php';
error_reporting(~E_NOTICE);
include '../control/organizer_member_updateinfo.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| จัดการผู้ดูแลระบบ</title>
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
            <h1 class="page-title">จัดการผู้ดูแลระบบ</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item"><a href="organizer_member.php">จัดการผู้ดูแลระบบ</a></li>
                <li class="breadcrumb-item">แก้ไขข้อมูลผู้ดูแลระบบ</li>
            </ol>
        </div>
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
                <div class="ibox-title" style="color:#484848">
                    <h5>แก้ไขข้อมูลผู้ดูแลระบบ</h5>
                </div>
            </div>
            <div class="ibox-body">
                <form class="form-horizontal" enctype="multipart/form-data" id="form-sample-1" method="post" novalidate="novalidate" style="height:620px; width:100%">

                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">รหัสผู้ใช้</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="orgzerID" value="<?php echo $orgzerID; ?>" readonly />
                        </div>
                        <label class="col-sm-1 col-form-label">ชื่อ-สกุล</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="orgzerName" value="<?php echo $orgzerName; ?>" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">สถานะ</label>
                        <div class="col-sm-5">
                            <select class="form-control" style="width: 100%;" name="orgzeruserType" readonly />
                            <option value="<?php echo $usertypeID ?>"> <?php echo $userType ?></option>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">กลุ่ม</label>
                        <div class="col-sm-5">
                            <select class="form-control" style="width: 100%;" name="orgzerGroup" readonly />
                            <option value="<?php echo $orgzerGroup ?>"> <?php echo $orgzerGroup ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">ระดับ</label>
                        <div class="col-sm-5">
                            <select class="form-control" style="width: 100%;" name="orgzerSec" readonly />
                            <option value="<?php echo $orgzerSec ?>"> <?php echo $orgzerSec ?></option>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">สังกัด</label>
                        <div class="col-sm-5">
                            <select class="form-control" style="width: 100%;" name="orgzerMainorg" readonly />
                            <option value="<?php echo $mainorgNo ?>"> <?php echo $mainorg ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">องค์กร</label>
                        <div class="col-sm-5">
                            <select class="form-control" style="width: 100%;" name="orgzerOrgtion" readonly />
                            <option value="<?php echo $orgtionNo ?>"> <?php echo $organization ?></option>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">เบอร์โทร</label>
                        <div class="col-sm-5">
                            <input class="form-control" id="ex-phone" type="text" name="orgzerPhone" value="<?php echo $orgzerPhone; ?>" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">E-mail</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="email" name="orgzerEmail" value="<?php echo $orgzerEmail; ?>" required />
                        </div>
                        <label class="col-sm-1 col-form-label">Facebook</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="orgzerFb" value="<?php echo $orgzerFb; ?>" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">รหัสผ่าน</label>
                        <div class="col-sm-5">
                            <input class="form-control" id="password" minlength=8 maxlength=10 type="password" name="orgzerPassword" placeholder="password" value="<?php echo $orgzerPassword; ?>" required />
                        </div>
                        <div class="col-sm-5">
                            <input class="form-control" type="hidden" name="orgzerAddby" value="<?php echo $orgzerAddby; ?>" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">รูปประจำตัว</label>
                        <div class="col-sm-5">
                            <p><img src="../assets/img/<?php echo $orgzerImage; ?>" height="150" width="150" /></p>
                            <input class="input-group" type="file" name="Image" accept="image/*" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-warning" type="submit" name="btupdatemember">แก้ไข</button>
                            <a href="organizer_member.php"><button class="btn btn-danger" type="button">ยกเลิก</button></a>
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