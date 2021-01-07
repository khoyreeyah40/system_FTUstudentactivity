<?php
$stmt_1 = $session->runQuery("SELECT student.*, organization.* FROM student 
                            JOIN organization ON student.stdOrgtion = organization.orgtionNo
                            WHERE student.stdID = '$stdUser'");
$stmt_1->execute();
while ($row = $stmt_1->fetch(PDO::FETCH_ASSOC)) {
    $mainorgno = $row["stdMainorg"];
    $orgtionno = $row["stdOrgtion"];
    $year = $row["stdYear"] + 3;
    $group = $row["stdGroup"];
    $orgtionname = $row["organization"];
?>
    <!--act1ฮาลาเกาะห์-->
    <tr>
        <td><a href="javascript:;">กลุ่มศึกษาอัลกุรอ่าน</a></td>
        <td>ภาคเรียนที่ 1</td>
        <td>ทุกวันจันทร์ของสัปดาห์</td>
        <td>
            <?php
            include '../control/parti_halaqah_sem1_run.php';
            include '../control/parti_std_countactivity_sem_run.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_halaqah_sem1_reg.php';
            include '../control/parti_std_countactivity_sem_reg.php';
            ?>
        </td>
        <td>
            <?php
            if (($row1 || $row) > 0) {
                $persent = (($row1 / $row) * 100);
                if ($persent >= 80) {
                    $halaqah4_1 = "ผ่าน";
            ?>
                    <i class="text-success"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                <?php
                } elseif ($persent < 80) {
                    $halaqah4_1 = "ไม่ผ่าน";
                ?>
                    <i class="text-danger"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
            <?php
                } else {
                }
            } else {
            }
            ?>
        </td>
    </tr>
    <!--act1_2ฮาลาเกาะห์-->
    <tr>
        <td style="font-size:14px;width: 30%;border-top: 0px;">ที่ปรึกษา:
            <a href="javascript:;">
                <b><?php include '../control/show_halaqah_teacher.php'; ?></b>
            </a>
        </td>
        <td>ภาคเรียนที่ 2</td>
        <td>ทุกวันจันทร์ของสัปดาห์</td>
        <td>
            <?php
            include '../control/parti_halaqah_sem2_run.php';
            include '../control/parti_std_countactivity_sem_run.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_halaqah_sem2_reg.php';
            include '../control/parti_std_countactivity_sem_reg.php';
            ?>
        </td>
        <td>
            <?php
            if (($row1 || $row) > 0) {
                $persent = (($row1 / $row) * 100);
                if ($persent >= 80) {
                    $halaqah4_2 = "ผ่าน";
            ?>
                    <i class="text-success"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                <?php
                } elseif ($persent < 80) {
                    $halaqah4_2 = "ไม่ผ่าน";
                ?>
                    <i class="text-danger"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
            <?php
                } else {
                }
            } else {
            }
            ?>
        </td>
    </tr>

    <!--act2กิยามุลลัยล์-->
    <tr>
        <td><a href="javascript:;">กิยามุลลัยล์</a></td>
        <td>ภาคเรียนที่ 1</td>
        <td>
            <?php
            include '../control/parti_qiyaam_sem1_all.php';
            include '../control/parti_std_countactivity_sem_all.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_qiyaam_sem1_run.php';
            include '../control/parti_std_countactivity_sem_run.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_qiyaam_sem1_reg.php';
            include '../control/parti_std_countactivity_sem_reg.php';
            ?>
        </td>
        <td>
            <?php
            if (($row1 || $rowall) > 0) {
                $persent = (($row1 / $rowall) * 100);
                if ($persent >= 80) {
                    $qiyaam4_1 = "ผ่าน";
            ?>
                    <i class="text-success"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                <?php
                } elseif ($persent < 80) {
                    $qiyaam4_1 = "ไม่ผ่าน";
                ?>
                    <i class="text-danger"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
            <?php
                } else {
                }
            } else {
            }
            ?>
        </td>
    </tr>
    <!--act2_2กิยามุลลัยล์-->
    <tr>
        <td style="font-size:16px;width: 30%;border-top: 0px;"></td>
        <td>ภาคเรียนที่ 2</td>
        <td>
            <?php
            include '../control/parti_qiyaam_sem2_all.php';
            include '../control/parti_std_countactivity_sem_all.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_qiyaam_sem2_run.php';
            include '../control/parti_std_countactivity_sem_run.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_qiyaam_sem2_reg.php';
            include '../control/parti_std_countactivity_sem_reg.php';
            ?>
        </td>
        <td>
            <?php
            if (($row1 || $rowall) > 0) {
                $persent = (($row1 / $rowall) * 100);
                if ($persent >= 80) {
                    $qiyaam4_2 = "ผ่าน";
            ?>
                    <i class="text-success"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                <?php
                } elseif ($persent < 80) {
                    $qiyaam4_2 = "ไม่ผ่าน";
                ?>
                    <i class="text-danger"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
            <?php
                } else {
                }
            } else {
            }
            ?>
        </td>
    </tr>
    <!--act3อบรมคุณธรรมจริยธรรม-->
    <tr>
        <td><a href="javascript:;">อบรมคุณธรรมจริยธรรม</a></td>
        <td>ตลอดทั้งปีการศึกษา</td>
        <td>
            <?php
            include '../control/parti_week_all.php';
            // output data of each row
            include '../control/parti_std_countactivity_year_all.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_week_run.php';
            // output data of each row
            include '../control/parti_std_countactivity_year_run.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_week_reg.php';
            include '../control/parti_std_countactivity_year_reg.php';
            ?>
        </td>
        <td>
            <?php
            if (($row1 || $rowall) > 0) {
                $persent = (($row1 / $rowall) * 100);
                if ($persent >= 80) {
                    $week4 = "ผ่าน";
            ?>
                    <i class="text-success"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                <?php
                } elseif ($persent < 80) {
                    $week4 = "ไม่ผ่าน";
                ?>
                    <i class="text-danger"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
            <?php
                } else {
                }
            } else {
            }
            ?>
        </td>
    </tr>
    <!--act5อิอฺติก๊าฟ-->
    <tr>
        <td><a href="javascript:;">อิอฺติก๊าฟ 10 วันสุดท้ายเดือนรอมฎอน</a></td>
        <td>
            <?php
            $stmt = $session->runQuery("SELECT * FROM eiatiqaf
                                        WHERE 
                                        eiatiqafstdID = '$stdUser' && eiatiqafYear = '$year' 
                                        ");
            $stmt->execute();
            $rowfile = $stmt->rowCount();
            $rowfileeia = $stmt->fetch(PDO::FETCH_ASSOC);
            // output data of each row
            if ($rowfile > 0) {
            ?>
                <a href="?delete_id=<?php echo $rowfileeia['eiatiqafNo']; ?>" onclick="return confirm('ต้องการลบไฟล์ ?')"><button class="btn btn-danger btn-sm m-r-5" data-toggle="tooltip"><i class="fa fa-trash font-30"></i></button></a>
                <?php
            } else if ($rowfile == 0) {
                $stmt = $session->runQuery("SELECT * FROM acttype
                                                    WHERE acttypeName = 'อิอฺติก๊าฟ 10 วันสุดท้ายเดือนรอมฎอน'");
                $stmt->execute();
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $acttypeNo = $row["acttypeNo"];
                ?>
                    <form enctype="multipart/form-data" method="post">
                        <input class="input-group" type="hidden" name="acttype" value="<?php echo $acttypeNo ?>" />
                    <?php } ?>
                    <input class="input-group" type="hidden" name="year" value="<?php echo $year ?>" />
                    <input class="input-group" type="hidden" name="stdid" value="<?php echo $stdUser ?>" />
                    <input class="input-group" type="file" name="file" accept="file/*" />
                    <button class="btn btn-info btn-xs" type="submit" name="btaddfile">เพิ่ม</button>
                    </form>
                <?php  }
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_eiatiqaf_all.php';
            // output data of each row
            include '../control/parti_std_countactivity_year_all.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_eiatiqaf_run.php';
            // output data of each row
            include '../control/parti_std_countactivity_year_run.php';
            ?>
        </td>
        <td>
            <?php
            if ($rowfile > 0) {
            ?>
                <a href="../file/<?php echo $rowfileeia['eiatiqafFile']; ?>"><?php echo $rowfileeia['eiatiqafFile'] ?></a>
            <?php
            } else {
                include '../control/parti_eiatiqaf_reg.php';
                // output data of each row
                include '../control/parti_std_countactivity_year_reg.php';
            }
            ?>
        </td>
        <td>
            <?php
            if (($row1 || $rowall || $rowfile) > 0) {
                $persent = ((($row1 || $rowfile) / $rowall) * 100);
                if ($persent >= 80) {
                    $eiatiqaf4 = "ผ่าน";
            ?>
                    <i class="text-success"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                <?php
                } elseif ($persent < 80) {
                    $eiatiqaf4 = "ไม่ผ่าน";
                ?>
                    <i class="text-danger"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
            <?php
                } else {
                }
            } else {
            }
            ?>
        </td>
    </tr>
    <!--act6ปัจฉิมนิเทศ-->
    <tr>
        <td><a href="javascript:;">ปัจฉิมนิเทศ</a></td>
        <td>ชั้นปีที่ 4</td>
        <td>
            <?php
            include '../control/parti_phajjim_all.php';
            include '../control/parti_std_countactivity_year_all.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_phajjim_run.php';
            include '../control/parti_std_countactivity_year_run.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_phajjim_reg.php';
            include '../control/parti_std_countactivity_year_reg.php';
            ?>
        </td>
        <td>
            <?php
            if (($row1 || $rowall) > 0) {
                $persent = (($row1 / $rowall) * 100);
                if ($persent >= 80) {
                    $phajjim = "ผ่าน";
            ?>
                    <i class="text-success"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                <?php
                } elseif ($persent < 80) {
                    $phajjim = "ไม่ผ่าน";
                ?>
                    <i class="text-danger"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
            <?php
                } else {
                }
            } else {
            }
            ?>
        </td>
    </tr>
    <!--act7ชมรม-->
    <?php
    $stmt_club = $session->runQuery("SELECT club.*, organization.* FROM club 
                    JOIN organization ON organization.orgtionNo = club.clubOrgtion
                    WHERE clubstdID='$stdUser' && clubYear='$year'");
    $stmt_club->execute();
    $rowclub = $stmt_club->rowCount();
    $rowclubname = $stmt_club->fetch(PDO::FETCH_ASSOC);
    $club = $rowclubname["clubOrgtion"];
    $clubname = $rowclubname["organization"];
    if ($rowclub > 0) {
    ?>
        <tr>
            <td><a href="javascript:;">กิจกรรมชมรม</a></td>
            <td><?php echo $clubname ?></td>
            <td>
                <?php
                include '../control/parti_chomrom_all.php';
                // output data of each row
                include '../control/parti_std_countactivity_year_all.php'
                ?>
            </td>
            <td>
                <?php
                include '../control/parti_chomrom_run.php';
                // output data of each row
                include '../control/parti_std_countactivity_year_run.php';
                ?>
            </td>
            <td>
                <?php
                include '../control/parti_chomrom_reg.php';
                include '../control/parti_std_countactivity_year_reg.php';
                ?>
            </td>
            <td>
                <?php
                if (($row1 || $rowall) > 0) {
                    $persent = (($row1 / $rowall) * 100);
                    if ($persent >= 80) {
                        $chomrom4 = "ผ่าน";
                ?>
                        <i class="text-success"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                    <?php
                    } elseif ($persent < 80) {
                        $chomrom4 = "ไม่ผ่าน";
                    ?>
                        <i class="text-danger"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                <?php
                    } else {
                    }
                } else {
                }
                ?>
            </td>
        </tr>
    <?php
    } else if ($rowclub == null) {
        $chomrom4 = "ไม่ผ่าน"; ?>
        <tr>
            <td><a href="javascript:;">กิจกรรมชมรม</a></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><i class="fa fa-times text-danger"><b>ไม่มีชมรม</b></i></td>
        </tr>
    <?php
    }
    ?>
    <!--act8ชุมนุม-->
    <tr>
        <td><a href="javascript:;">กิจกรรมชุมนุม</a></td>
        <td><?php echo $orgtionname ?></td>
        <td>
            <?php
            include '../control/parti_chumnum_all.php';
            // output data of each row
            include '../control/parti_std_countactivity_year_all.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_chumnum_run.php';
            // output data of each row
            include '../control/parti_std_countactivity_year_run.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_chumnum_reg.php';
            include '../control/parti_std_countactivity_year_reg.php';
            ?>
        </td>
        <td>
            <?php
            if (($row1 || $rowall) > 0) {
                $persent = (($row1 / $rowall) * 100);
                if ($persent >= 80) {
                    $chumnum4 = "ผ่าน";
            ?>
                    <i class="text-success"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                <?php
                } elseif ($persent < 80) {
                    $chumnum4 = "ไม่ผ่าน";
                ?>
                    <i class="text-danger"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
            <?php
                } else {
                }
            } else {
            }
            ?>
        </td>
    </tr>
    <!--act9กิจกรรมอบศ-->
    <tr>
        <td><a href="javascript:;">เข้าร่วม 5 กิจกรรมที่จัดโดยองค์การบริหารนักศึกษา</a></td>
        <td>ตลอดทั้งปีการศึกษา</td>
        <td>
            <?php
            include '../control/parti_abc_all.php';
            // output data of each row
            include '../control/parti_std_countactivity_year_all.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_abc_run.php';
            // output data of each row
            include '../control/parti_std_countactivity_year_run.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_abc_reg.php';
            include '../control/parti_std_countactivity_year_reg.php';
            ?>
        </td>
        <td>
            <?php
            if (($row1 || $rowall) > 0) {
                if ($row1 >= 5) {
                    $persent = ((5 / $rowall) * 100);
                    if ($persent >= 80) {
                        $abc4 = "ผ่าน";
            ?>
                        <i class="text-success"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                    <?php
                    } elseif ($persent < 80) {
                        $abc4 = "ไม่ผ่าน";
                    ?>
                        <i class="text-danger"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                    <?php
                    } else {
                    }
                } else {
                    $persent = (($row1 / $rowall) * 100);
                    if ($persent >= 80) {
                        $abc4 = "ผ่าน";
                    ?>
                        <i class="text-success"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                    <?php
                    } elseif ($persent < 80) {
                        $abc4 = "ไม่ผ่าน";
                    ?>
                        <i class="text-danger"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
            <?php
                    } else {
                    }
                }
            } else {
            }
            ?>
        </td>
    </tr>
    <!--act10กิจกรรมสโมสร-->
    <tr>
        <td><a href="javascript:;">เข้าร่วม 5 กิจกรรมที่จัดโดยสโมสรคณะ</a></td>
        <td>ตลอดทั้งปีการศึกษา</td>
        <td>
            <?php
            include '../control/parti_smo_all.php';
            // output data of each row
            include '../control/parti_std_countactivity_year_all.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_smo_run.php';
            // output data of each row
            include '../control/parti_std_countactivity_year_run.php';
            ?>
        </td>
        <td>
            <?php
            include '../control/parti_smo_reg.php';
            include '../control/parti_std_countactivity_year_reg.php';
            ?>
        </td>
        <td>
            <?php
            if (($row1 || $rowall) > 0) {
                if ($row1 >= 5) {
                    $persent = ((5 / $rowall) * 100);
                    if ($persent >= 80) {
                        $smo4 = "ผ่าน";
            ?>
                        <i class="text-success"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                    <?php
                    } elseif ($persent < 80) {
                        $smo4 = "ไม่ผ่าน";
                    ?>
                        <i class="text-danger"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                    <?php
                    } else {
                    }
                } else {
                    $persent = (($row1 / $rowall) * 100);
                    if ($persent >= 80) {
                        $smo4 = "ผ่าน";
                    ?>
                        <i class="text-success"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
                    <?php
                    } elseif ($persent < 80) {
                        $smo4 = "ไม่ผ่าน";
                    ?>
                        <i class="text-danger"><b><?php echo number_format($persent, 0, '.', ','); ?> %</b></i>
            <?php
                    } else {
                    }
                }
            } else {
            }
            ?>
        </td>
    </tr>
    <!--สรุป-->
    <tr>
        <td style="color:#528124;">
            <h4>สรุปการเข้าร่วมกิจกรรมปี 4</h4>
        </td>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="2" style="text-align:center;">
            <?php
            if (
                $halaqah4_1 == 'ผ่าน' && $halaqah4_2 == 'ผ่าน' && $qiyaam4_1 == 'ผ่าน' && $qiyaam4_2 == 'ผ่าน' && $eiatiqaf4 == 'ผ่าน'
                && $week4 == 'ผ่าน' && $phajjim == 'ผ่าน'  && $chomrom4 == 'ผ่าน' && $chumnum4 == 'ผ่าน'
                && $abc4 == 'ผ่าน' && $smo4 == 'ผ่าน'
            ) {
                $actyear4 = "ผ่าน";
            ?>
                <h4><i class="fa fa-check text-success"><b>ผ่านกิจกรรม</b></i></h4>
            <?php
            } else {
                $actyear4 = "ไม่ผ่าน";
            ?>
                <h4><i class="fa fa-times text-danger"><b>ไม่ผ่านกิจกรรม</b></i></h4>
            <?php
            }
            ?>
        </td>
    </tr>
<?php
}
?>