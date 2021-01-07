<?php
include '../control/session_organizer.php';
include '../control/organizer_activity_updateinfo.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| แก้ไขข้อมูลกิจกรรม</title>
    <?php include 'header.php'; ?>
    <link rel="stylesheet" href="../assets/vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../assets/vendors/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

    <style>
        .breadcrumb-item {
            font-size: 16px;
        }
    </style>
</head>

<body class="fixed-navbar">
    <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
        <div class="page-heading">
            <h1 class="page-title">แก้ไขข้อมูลกิจกรรม</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item"><a href="organizer_activity.php">เพิ่มกิจกรรม</a></li>
                <li class="breadcrumb-item">แก้ไขข้อมูลกิจกรรม</li>
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
                    <h5>แก้ไขข้อมูลกิจกรรม</h5>
                </div>
            </div>
            <div class="ibox-body">
                <form class="form-horizontal" enctype="multipart/form-data" id="form-sample-1" method="post" novalidate="novalidate">
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">ปีการศึกษา</label>
                        <div class="col-sm-5">
                            <select class="form-control" style="width: 100%;" name="actYear" readonly />
                            <option value="<?php echo $actYear; ?>"><?php echo $actYear; ?></option>
                            <?php include '../control/select_activity_year.php'; ?>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">ภาคเรียน</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="actSem" required />
                            <option value="<?php echo $actSem; ?>"> ภาคเรียนที่ <?php echo $actSem; ?></option>
                            <option disabled="disabled">--ภาคเรียน--</option>
                            <option value="1">ภาคเรียนที่ 1</option>
                            <option value="2">ภาคเรียนที่ 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">ชื่อกิจกรรม</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="actName" value="<?php echo $actName; ?>" required />
                        </div>
                        <label class="col-sm-1 col-form-label">กลุ่ม</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="actGroup" required />
                            <option value="<?php echo $actGroup; ?>"><?php echo $actGroup; ?></option>
                            <option disabled="disabled">--กลุ่ม--</option>
                            <option value="รวม">รวม</option>
                            <option value="ชาย">ชาย</option>
                            <option value="หญิง">หญิง</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">ระดับ</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="actSec">
                                <option value="<?php echo $actSec; ?>"><?php echo $actSec; ?></option>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">สังกัด</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="actMainorg">
                                <option value="<?php echo $actMainorg; ?>"><?php echo $mainorg; ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">องค์กร</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="actOrgtion">
                                <option value="<?php echo $actOrgtion; ?>"><?php echo $organization; ?></option>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label">หมวดหมู่</label>
                        <div class="col-sm-5">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="actType" required />
                            <option value="<?php echo $actType; ?>"><?php echo $acttypeName; ?></option>
                            <option disabled="disabled">--หมวดหมู่--</option>
                            <?php include '../control/select_activity_type.php'; ?>
                            </select>
                        </div>
                        <label class="col-sm-12 col-form-label">หลักการและเหตุผล</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="2" type="text" name="actReason" value="<?php echo $actReason; ?>"><?php echo $actReason; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">วัตถุประสงค์โครงการ</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="2" type="text" name="actPurpose" value="<?php echo $actPurpose; ?>"><?php echo $actPurpose; ?></textarea>
                        </div>
                        <label class="col-sm-12 col-form-label">รูปแบบหรือลักษณะการดำเนินการ</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="2" type="text" name="actStyle" value="<?php echo $actStyle; ?>"><?php echo $actStyle; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row" id="date_5">
                        <label class="col-sm-1 col-form-label">เวลา</label>
                        <div class="col-sm-5 input-group ">
                            <input class="input-sm form-control" type="text" data-target="#actTimeb" data-toggle="datetimepicker" id="actTimeb" name="actTimeb" value="<?php echo $actTimeb; ?>" autocomplete="off" required />
                            <span class="input-group-addon p-l-10 p-r-10">ถึง</span>
                            <input class="input-sm form-control" type="text" data-target="#actTimee" data-toggle="datetimepicker" id="actTimee" name="actTimee" value="<?php echo $actTimee; ?>" autocomplete="off" required />
                        </div>
                        <label class="col-sm-1 col-form-label">วันที่</label>
                        <div class="col-sm-5 input-group">
                            <input class="input-sm form-control" type="text" id="actDateb" data-toggle="datepicker" name="actDateb" autocomplete="off" value="<?php echo $actDateb; ?>" required />
                            <span class="input-group-addon p-l-10 p-r-10">ถึง</span>
                            <input class="input-sm form-control" type="text" id="actDatee" data-toggle="datepicker" name="actDatee" autocomplete="off" value="<?php echo $actDatee; ?>" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">สถานที่</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="actLocate" value="<?php echo $actLocate; ?>" required />
                        </div>
                        <label class="col-sm-1 col-form-label">ค่าลงทะเบียน</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="actPay" value="<?php echo $actPay; ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label">ไฟล์ใบโครงการ</label>
                        <div class="col-sm-5">
                            <a href="../file/<?php echo $actFile; ?>" target="_blank"><?php echo $actFile; ?></a>
                            <input class="input-group" type="file" name="actFile" accept="file/*" />
                        </div>
                        <label class="col-sm-1 col-form-label">ลิ้งค์ใบประเมิน</label>
                        <div class="col-sm-5">
                            <input class="form-control" type="text" name="actAssesslink" value="<?php echo $actAssesslink; ?>" />
                        </div>
                        <div class="col-sm-5">
                            <input class="form-control" type="hidden" name="actAddby" value="<?php echo $actAddby; ?>" readonly />
                        </div>
                        <div class="col-sm-5">
                            <input class="form-control" type="hidden" name="actID" value="<?php echo $actID; ?>" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12 col-form-label">หมายเหตุ</label>
                        <div class="col-sm-12">
                            <textarea class="form-control" rows="2" type="text" name="actNote" value="<?php echo $actNote; ?>"><?php echo $actNote; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-warning" type="submit" name="btupdateact">แก้ไข</button>
                            <a href="organizer_activity.php"><button class="btn btn-danger" type="button">ยกเลิก</button></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- CORE PLUGINS-->
    <?php include 'footer.php'; ?>
    <script src="../assets/vendors/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script type="text/javascript" src="../assets/vendors/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="../assets/vendors/js/bootstrap-datepicker-thai.js"></script>
    <script type="text/javascript" src="../assets/vendors/js/locales/bootstrap-datepicker.th.js"></script>
    <script>
        $(function() {
            $('#actDateb').datepicker({
                language: 'th-th',
                format: 'yyyy-mm-dd'
            });
            $('#actDatee').datepicker({
                language: 'th-th',
                format: 'yyyy-mm-dd'
            });
            //Timepicker
            $('#actTimeb').datetimepicker({
                format: 'HH:mm',
                pickDate: false,
                pickSeconds: false,
                pick12HourFormat: false
            });
            $('#actTimee').datetimepicker({
                format: 'HH:mm',
                pickDate: false,
                pickSeconds: false,
                pick12HourFormat: false
            });
        });
    </script>
</body>

</html>