<?php
include '../control/session_organizer.php';
include '../control/organizer_usertype.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ระบบกิจกรรมนักศึกษา| จัดการประเภทผู้ใช้</title>
    <?php include 'header.php'; ?>
    <style>
        .breadcrumb-item {
            font-size: 16px;
        }

        .td {
            text-align: center;
        }

        .modal-dialog {
            max-width: 800px;
            margin: 30px auto;
        }
    </style>
</head>

<body class="fixed-navbar">
    <div class="page-content fade-in-up" style="padding:20px;padding-top:0px">
        <div class="page-heading">
            <h1 class="page-title">จัดการประเภทผู้ใช้</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                </li>
                <li class="breadcrumb-item"><a href="organizer_organizer.php">จัดการเจ้าหน้าที่</a></li>
                <li class="breadcrumb-item">จัดการประเภทผู้ใช้</li>
            </ol>
        </div>
        <br>

        <a href="organizer_organizer.php"><button class="btn btn-info" type="button"> <span class="fa fa-pencil"></span> &nbsp; จัดการเจ้าหน้าที่</button></a>&nbsp;&nbsp;
        <a href="organizer_organization.php"><button class="btn btn-info" type="button"> <span class="fa fa-pencil"></span> &nbsp; จัดการรายชื่อองค์กร</button></a>&nbsp;&nbsp;
        <a href="organizer_halaqah_teacher.php"><button class="btn btn-info" type="button"> <span class="fa fa-pencil"></span> &nbsp; จัดการที่ปรึกษากลุ่มศึกษาอัลกุรอ่าน</button></a>&nbsp;&nbsp;
        <a href="organizer_mainorganization.php"><button class="btn btn-info" type="button"> <span class="fa fa-pencil"></span> &nbsp; จัดการรายชื่อสังกัด</button></a>

        <br>
        <br>
        <?php
        if (isset($errMSG)) {
        ?>
            <div class="alert alert-danger">
                <span class="fa fa-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
        <?php
        } else if (isset($successMSG)) {
        ?>
            <div class="alert alert-success">
                <strong><span class="fa fa-info-sign"></span> <?php echo $successMSG; ?></strong>
            </div>
        <?php
        }
        ?>
        <div class="ibox" style="box-shadow: 0 5px 4px rgba(0,0,0,.1);">
            <div class="ibox-head" style="background-color:#d1cbaf;">
                <div class="ibox-title" style="color:#484848;">
                    <h5>เพิ่มประเภทผู้ใช้</h5>
                </div>
                <div class="ibox-tools">
                    <a class="ibox-collapse" style="color:#484848;"><i class="fa fa-minus"></i></a>
                </div>
            </div>
            <div class="ibox-body">
                <form class="form-horizontal" id="form-sample-1" method="post" novalidate="novalidate">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ประเภทผู้ใช้</label>
                        <div class="col-sm-3">
                            <input class="form-control" type="text" name="userType" value="" required />
                        </div>
                        <label class="col-sm-1 col-form-label">ระดับ</label>
                        <div class="col-sm-3">
                            <select class="form-control select2_demo_1" style="width: 100%;" name="usertypeSec" required>
                                <option selected="selected" disabled="disabled">--ระดับ--</option>
                                <option value="คณะ"> คณะ</option>
                                <option value="มหาวิทยาลัย"> มหาวิทยาลัย</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">จัดการผู้ดูแล</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="cb1" value="true">
                        </div>
                        <label class="col-sm-3 col-form-label">จัดการเจ้าหน้าที่</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="cb2" value="true">
                        </div>
                        <label class="col-sm-3 col-form-label">จัดการนักศึกษา</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="cb3" value="true">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">จัดการตำแหน่งนักศึกษา</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="cb4" value="true">
                        </div>
                        <label class="col-sm-3 col-form-label">จัดการชมรม</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="cb5" value="true">
                        </div>
                        <label class="col-sm-3 col-form-label">จัดการกิจกรรมทั้งหมด</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="cb6" value="true">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">จัดการกิจกรรม</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="cb7" value="true">
                        </div>
                        <label class="col-sm-3 col-form-label">จัดการกิจกรรมที่กำลังดำเนิน</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="cb8" value="true">
                        </div>
                        <label class="col-sm-3 col-form-label">จำนงแก้กิจกรรม</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="cb9" value="true">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">ตรวจสอบการเข้าร่วม</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="cb10" value="true">
                        </div>
                        <label class="col-sm-3 col-form-label">จัดการบอร์ดประชาสัมพันธ์</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="cb11" value="true">
                        </div>
                        <label class="col-sm-3 col-form-label">จัดการกลุ่มศึกษาอัลกุรอ่าน</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="cb12" value="true">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">ติดต่อ</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="cb13" value="true">
                        </div>
                        <label class="col-sm-3 col-form-label">ประวัติการเข้าใช้</label>
                        <div class="col-sm-1">
                            <input type="checkbox" name="cb14" value="true">
                        </div>
                        <div class="col-sm-3">
                            <input class="form-control" type="hidden" name="usertypeAddby" value="<?php echo $loginby; ?>" readonly />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-info" type="submit" name="btaddusertype" value="submit">เพิ่ม</button>
                            <a href="organizer_usertype.php"><button class="btn btn-danger" type="button" data-dismiss="ibox">ยกเลิก</button></a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="row ">
            <div class="col-12">
                <div class="card" style="border-width:0px;border-bottom-width:4px;border-right-width:4px;">
                    <div class="card-header" style="background-color:#d1cbaf">
                        <h5 style="color:#2c2c2c">ตารางประเภทผู้ใช้</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body  text-nowrap">
                        <form method="post">
                            <table id="tb1" class="table table-bordered  table-striped table-md text-center">
                                <thead>
                                    <tr style="color:#528124;">
                                        <th> ประเภทผู้ใช้</th>
                                        <th>ระดับ</th>
                                        <!--td align="center" bgcolor="#FF6600">Image</td-->
                                        <!--this here will add column for change image-->
                                        <th>จัดการผู้ดูแล</th>
                                        <th>จัดการเจ้าหน้าที่</th>
                                        <th>จัดการนักศึกษา</th>
                                        <th>จัดการตำแหน่งนักศึกษา</th>
                                        <th>จัดการชมรม</th>
                                        <th>จัดการกิจกรรมทั้งหมด</th>
                                        <th>จัดการกิจกรรม</th>
                                        <th>จัดการกิจกรรมที่กำลังดำเนิน</th>
                                        <th>จำนงแก้กิจกรรม</th>
                                        <th>ตรวจสอบการเข้าร่วม</th>
                                        <th>จัดการบอร์ดประชาสัมพันธ์</th>
                                        <th>จัดการกลุ่มศึกษาอัลกุรอ่าน</th>
                                        <th>ติดต่อ</th>
                                        <th>ประวัติการเข้าใช้</th>
                                        <th>เพิ่มโดย</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $stmt = $session->runQuery("SELECT * FROM usertype ORDER BY usertypeID DESC");
                                    $stmt->execute();
                                    if ($stmt->rowCount()) {
                                        // output data of each row
                                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                            <tr>
                                                <td><?php echo $row['userType']; ?></td>
                                                <td><?php echo $row['usertypeSec']; ?></td>
                                                <td><?php echo "<input type=\"checkbox\" name=\"cb1" . $row["usertypeID"] . "\" value=\"" . $row["M_1"] . "\" "; ?>
                                                    <?php if ($row["M_1"] == "true") {
                                                        echo "checked";
                                                    } else {
                                                    }
                                                    echo ">";
                                                    ?>
                                                </td>
                                                <td><?php echo "<input type=\"checkbox\" name=\"cb2" . $row["usertypeID"] . "\" value=\"" . $row["M_2"] . "\" "; ?>
                                                    <?php if ($row["M_2"] == "true") {
                                                        echo "checked";
                                                    } else {
                                                    }
                                                    echo ">";
                                                    ?>
                                                </td>
                                                <td><?php echo "<input type=\"checkbox\" name=\"cb3" . $row["usertypeID"] . "\" value=\"" . $row["M_3"] . "\" "; ?>
                                                    <?php if ($row["M_3"] == "true") {
                                                        echo "checked";
                                                    } else {
                                                    }
                                                    echo ">";
                                                    ?>
                                                </td>
                                                <td><?php echo "<input type=\"checkbox\" name=\"cb4" . $row["usertypeID"] . "\" value=\"" . $row["M_4"] . "\" "; ?>
                                                    <?php if ($row["M_4"] == "true") {
                                                        echo "checked";
                                                    } else {
                                                    }
                                                    echo ">";
                                                    ?>
                                                </td>
                                                <td><?php echo "<input type=\"checkbox\" name=\"cb5" . $row["usertypeID"] . "\" value=\"" . $row["M_5"] . "\" "; ?>
                                                    <?php if ($row["M_5"] == "true") {
                                                        echo "checked";
                                                    } else {
                                                    }
                                                    echo ">";
                                                    ?>
                                                </td>
                                                <td><?php echo "<input type=\"checkbox\" name=\"cb6" . $row["usertypeID"] . "\" value=\"" . $row["M_6"] . "\" "; ?>
                                                    <?php if ($row["M_6"] == "true") {
                                                        echo "checked";
                                                    } else {
                                                    }
                                                    echo ">";
                                                    ?>
                                                </td>
                                                <td><?php echo "<input type=\"checkbox\" name=\"cb7" . $row["usertypeID"] . "\" value=\"" . $row["M_7"] . "\" "; ?>
                                                    <?php if ($row["M_7"] == "true") {
                                                        echo "checked";
                                                    } else {
                                                    }
                                                    echo ">";
                                                    ?>
                                                </td>
                                                <td><?php echo "<input type=\"checkbox\" name=\"cb8" . $row["usertypeID"] . "\" value=\"" . $row["M_8"] . "\" "; ?>
                                                    <?php if ($row["M_8"] == "true") {
                                                        echo "checked";
                                                    } else {
                                                    }
                                                    echo ">";
                                                    ?>
                                                </td>
                                                <td><?php echo "<input type=\"checkbox\" name=\"cb9" . $row["usertypeID"] . "\" value=\"" . $row["M_9"] . "\" "; ?>
                                                    <?php if ($row["M_9"] == "true") {
                                                        echo "checked";
                                                    } else {
                                                    }
                                                    echo ">";
                                                    ?>
                                                </td>
                                                <td><?php echo "<input type=\"checkbox\" name=\"cb10" . $row["usertypeID"] . "\" value=\"" . $row["M_10"] . "\" "; ?>
                                                    <?php if ($row["M_10"] == "true") {
                                                        echo "checked";
                                                    } else {
                                                    }
                                                    echo ">";
                                                    ?>
                                                </td>
                                                <td><?php echo "<input type=\"checkbox\" name=\"cb11" . $row["usertypeID"] . "\" value=\"" . $row["M_11"] . "\" "; ?>
                                                    <?php if ($row["M_11"] == "true") {
                                                        echo "checked";
                                                    } else {
                                                    }
                                                    echo ">";
                                                    ?>
                                                </td>
                                                <td><?php echo "<input type=\"checkbox\" name=\"cb12" . $row["usertypeID"] . "\" value=\"" . $row["M_12"] . "\" "; ?>
                                                    <?php if ($row["M_12"] == "true") {
                                                        echo "checked";
                                                    } else {
                                                    }
                                                    echo ">";
                                                    ?>
                                                </td>
                                                <td><?php echo "<input type=\"checkbox\" name=\"cb13" . $row["usertypeID"] . "\" value=\"" . $row["M_13"] . "\" "; ?>
                                                    <?php if ($row["M_13"] == "true") {
                                                        echo "checked";
                                                    } else {
                                                    }
                                                    echo ">";
                                                    ?>
                                                </td>
                                                <td><?php echo "<input type=\"checkbox\" name=\"cb14" . $row["usertypeID"] . "\" value=\"" . $row["M_14"] . "\" "; ?>
                                                    <?php if ($row["M_14"] == "true") {
                                                        echo "checked";
                                                    } else {
                                                    }
                                                    echo ">";
                                                    ?>
                                                </td>
                                                <td><?php echo $row['usertypeAddby']; ?></td>

                                            </tr>
                                    <?php }
                                    } else {
                                        echo "0 results";
                                    }
                                    ?>

                                </tbody>
                            </table>
                            <input align="center" type="submit" name="btupdateusertype" value="SAVE">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CORE PLUGINS-->
    <?php include 'footer.php'; ?>

</body>

</html>