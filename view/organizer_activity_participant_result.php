<br>
<div class="row justify-content-center">
    <h4 class="m-t-10 m-b-10 font-strong">สรุปการเข้าร่วมกิจกรรม</h4>
</div>
<div class="row justify-content-center">
    <div class="col-md-8">
        <table id="tbact1" class="table table-condensed">
            <thead>
                <tr style="color:#528124;">
                    <th>หมวดหมู่</th>
                    <th>ปี1</th>
                    <th>ปี2</th>
                    <th>ปี3</th>
                    <th>ปี4</th>
                    <th style="text-align:right;">ผลการประเมิน</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt_1 = $session->runQuery("SELECT student.*, organization.* FROM student 
                                                            JOIN organization ON student.stdOrgtion = organization.orgtionNo
                                                            WHERE student.stdID = '$stdUser'  ");
                $stmt_1->execute();
                while ($row = $stmt_1->fetch(PDO::FETCH_ASSOC)) {
                    $mainorgno = $row["stdMainorg"];
                    $orgtionno = $row["stdOrgtion"];
                    $year = $row["stdYear"];
                    $group = $row["stdGroup"];
                    $orgtionname = $row["organization"];
                ?>
                    <!--act1กลุ่มศึกษาอัลกุรอ่าน-->
                    <tr>
                        <td><a href="javascript:;">กลุ่มศึกษาอัลกุรอ่าน</a></td>
                        <td><?php include '../control/parti_halaqah_result_y1.php'; ?></td>
                        <td><?php include '../control/parti_halaqah_result_y2.php'; ?></td>
                        <td><?php include '../control/parti_halaqah_result_y3.php'; ?></td>
                        <td><?php include '../control/parti_halaqah_result_y4.php'; ?></td>
                        <td style="text-align:center;">
                            <?php
                            if ($halaqah1 == 'ผ่าน' && $halaqah2 == 'ผ่าน' && $halaqah3 == 'ผ่าน' && $halaqah4 == 'ผ่าน') {
                                $halaqah = "ผ่าน";
                            ?>
                                <i class="text-success"><b>ผ่าน</b></i>
                            <?php
                            } else {
                                $halaqah = "ไม่ผ่าน";
                            ?>
                                <i class="text-danger"><b>ไม่ผ่าน</b></i>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <!--act2กิยามุลลัยน์-->
                    <tr>
                        <td><a href="javascript:;">กิยามุลลัยล์</a></td>
                        <td><?php include '../control/parti_qiyaam_result_y1.php'; ?></td>
                        <td><?php include '../control/parti_qiyaam_result_y2.php'; ?></td>
                        <td><?php include '../control/parti_qiyaam_result_y3.php'; ?></td>
                        <td><?php include '../control/parti_qiyaam_result_y4.php'; ?></td>
                        <td style="text-align:center;">
                            <?php
                            if ($qiyaam1_1 == 'ผ่าน' && $qiyaam1_2 == 'ผ่าน' && $qiyaam2_1 == 'ผ่าน' && $qiyaam2_2 == 'ผ่าน' && $qiyaam3_1 == 'ผ่าน' && $qiyaam3_2 == 'ผ่าน' && $qiyaam4_1 == 'ผ่าน' && $qiyaam4_2 == 'ผ่าน') {
                                $qiyaam = "ผ่าน";
                            ?>
                                <i class="text-success"><b>ผ่าน</b></i>
                            <?php
                            } else {
                                $qiyaam = "ไม่ผ่าน";
                            ?>
                                <i class="text-danger"><b>ไม่ผ่าน</b></i>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <!--act3อบรมคุณธรรมจริยะธรรม-->
                    <tr>
                        <td><a href="javascript:;">อบรมคุณธรรมจริยธรรม</a></td>
                        <td><?php include '../control/parti_week_result_y1.php'; ?></td>
                        <td><?php include '../control/parti_week_result_y2.php'; ?></td>
                        <td><?php include '../control/parti_week_result_y3.php'; ?></td>
                        <td><?php include '../control/parti_week_result_y4.php'; ?></td>
                        <td style="text-align:center;">
                            <?php
                            if ($week1 == 'ผ่าน' && $week2 == 'ผ่าน' && $week3 == 'ผ่าน' && $week4 == 'ผ่าน') {
                                $week == 'ผ่าน';
                            ?>
                                <i class="text-success"><b>ผ่าน</b></i>
                            <?php
                            } else {
                                $week == 'ไม่ผ่าน';
                            ?>
                                <i class="text-danger"><b>ไม่ผ่าน</b></i>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <!--act4ค่ายพัฒนานักศึกษา-->
                    <tr>
                        <td><a href="javascript:;">ค่ายพัฒนานักศึกษา</a></td>
                        <td><?php include '../control/parti_camp_result_y1.php'; ?></td>
                        <td> - </td>
                        <td><?php include '../control/parti_camp_result_y3.php'; ?></td>
                        <td> - </td>
                        <td style="text-align:center;">
                            <?php
                            if ($camp1 == 'ผ่าน' && $camp3 == 'ผ่าน') {
                                $camp == 'ผ่าน';
                            ?>
                                <i class="text-success"><b>ผ่าน</b></i>
                            <?php
                            } else {
                                $camp == 'ไม่ผ่าน';
                            ?>
                                <i class="text-danger"><b>ไม่ผ่าน</b></i>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <!--act5อิอฺติก๊าฟ-->
                    <tr>
                        <td><a href="javascript:;">อิอฺติก๊าฟ 10 วันสุดท้ายเดือนรอมฎอน</a></td>
                        <td><?php include '../control/parti_eiatiqaf_result_y1.php'; ?></td>
                        <td><?php include '../control/parti_eiatiqaf_result_y2.php'; ?></td>
                        <td><?php include '../control/parti_eiatiqaf_result_y3.php'; ?></td>
                        <td><?php include '../control/parti_eiatiqaf_result_y4.php'; ?></td>
                        <td style="text-align:center;">
                            <?php
                            if ($eiatiqaf1 == 'ผ่าน' && $eiatiqaf2 == 'ผ่าน' && $eiatiqaf3 == 'ผ่าน' && $eiatiqaf4 == 'ผ่าน') {
                                $eiatiqaf = "ผ่าน";
                            ?>
                                <i class="text-success"><b>ผ่าน</b></i>
                            <?php
                            } else {
                                $eiatiqaf = "ไม่ผ่าน";
                            ?>
                                <i class="text-danger"><b>ไม่ผ่าน</b></i>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <!--act6ปฐมนิเทศ-->
                    <tr>
                        <td><a href="javascript:;">ปฐมนิเทศ</a></td>
                        <td><?php include '../control/parti_phathom_result.php'; ?></td>
                        <td> - </td>
                        <td> - </td>
                        <td> - </td>
                        <td style="text-align:center;">
                            <?php
                            if ($phathom == 'ผ่าน') {
                            ?>
                                <i class="text-success"><b>ผ่าน</b></i>
                            <?php
                            } else {
                            ?>
                                <i class="text-danger"><b>ไม่ผ่าน</b></i>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <!--act7ปัจฉิมนิเทศ-->
                    <tr>
                        <td><a href="javascript:;">ปัจฉิมนิเทศ</a></td>
                        <td> - </td>
                        <td> - </td>
                        <td> - </td>
                        <td><?php include '../control/parti_phajjim_result.php'; ?></td>
                        <td style="text-align:center;">
                            <?php
                            if ($phajjim == 'ผ่าน') {
                            ?>
                                <i class="text-success"><b>ผ่าน</b></i>
                            <?php
                            } else {
                            ?>
                                <i class="text-danger"><b>ไม่ผ่าน</b></i>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <!--act8ชมรม-->
                    <tr>
                        <td><a href="javascript:;">กิจกรรมชมรม</a></td>
                        <td><?php include '../control/parti_chomrom_result_y1.php'; ?></td>
                        <td><?php include '../control/parti_chomrom_result_y2.php'; ?></td>
                        <td><?php include '../control/parti_chomrom_result_y3.php'; ?></td>
                        <td><?php include '../control/parti_chomrom_result_y4.php'; ?></td>
                        <td style="text-align:center;">
                            <?php
                            if ($chomrom1 == 'ผ่าน' && $chomrom2 == 'ผ่าน' && $chomrom3 == 'ผ่าน' && $chomrom4 == 'ผ่าน') {
                                $chomrom == 'ผ่าน';
                            ?>
                                <i class="text-success"><b>ผ่าน</b></i>
                            <?php
                            } else {
                                $chomrom == 'ไม่ผ่าน';
                            ?>
                                <i class="text-danger"><b>ไม่ผ่าน</b></i>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <!--act9ชุมนุม-->
                    <tr>
                        <td><a href="javascript:;">กิจกรรมชุมนุม</a></td>
                        <td><?php include '../control/parti_chumnum_result_y1.php'; ?></td>
                        <td><?php include '../control/parti_chumnum_result_y2.php'; ?></td>
                        <td><?php include '../control/parti_chumnum_result_y3.php'; ?></td>
                        <td><?php include '../control/parti_chumnum_result_y4.php'; ?></td>
                        <td style="text-align:center;">
                            <?php
                            if ($chumnum1 == 'ผ่าน' && $chumnum2 == 'ผ่าน' && $chumnum3 == 'ผ่าน' && $chumnum4 == 'ผ่าน') {
                                $chumnum == 'ผ่าน';
                            ?>
                                <i class="text-success"><b>ผ่าน</b></i>
                            <?php
                            } else {
                                $chumnum == 'ไม่ผ่าน';
                            ?>
                                <i class="text-danger"><b>ไม่ผ่าน</b></i>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <!--act10กิจกรรมอบศ-->
                    <tr>
                        <td><a href="javascript:;">กิจกรรมที่จัดโดยองค์การบริหารนักศึกษา</a></td>
                        <td><?php include '../control/parti_abc_result_y1.php'; ?></td>
                        <td><?php include '../control/parti_abc_result_y2.php'; ?></td>
                        <td><?php include '../control/parti_abc_result_y3.php'; ?></td>
                        <td><?php include '../control/parti_abc_result_y4.php'; ?></td>
                        <td style="text-align:center;">
                            <?php
                            if ($abc1 == 'ผ่าน' && $abc2 == 'ผ่าน' && $abc3 == 'ผ่าน' && $abc4 == 'ผ่าน') {
                                $abc == 'ผ่าน';
                            ?>
                                <i class="text-success"><b>ผ่าน</b></i>
                            <?php
                            } else {
                                $abc == 'ไม่ผ่าน';
                            ?>
                                <i class="text-danger"><b>ไม่ผ่าน</b></i>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <!--act11กิจกรรมสโมสร-->
                    <tr>
                        <td><a href="javascript:;">กิจกรรมที่จัดโดยสโมสรคณะ</a></td>
                        <td><?php include '../control/parti_smo_result_y1.php'; ?></td>
                        <td><?php include '../control/parti_smo_result_y2.php'; ?></td>
                        <td><?php include '../control/parti_smo_result_y3.php'; ?></td>
                        <td><?php include '../control/parti_smo_result_y4.php'; ?></td>
                        <td style="text-align:center;">
                            <?php
                            if ($smo1 == 'ผ่าน' && $smo2 == 'ผ่าน' && $smo3 == 'ผ่าน' && $smo4 == 'ผ่าน') {
                                $smo == 'ผ่าน';
                            ?>
                                <i class="text-success"><b>ผ่าน</b></i>
                            <?php
                            } else {
                                $smo == 'ไม่ผ่าน';
                            ?>
                                <i class="text-danger"><b>ไม่ผ่าน</b></i>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <!--สรุป-->
                    <tr>
                        <td style="color:#528124;">
                            <h4>สรุปการเข้าร่วมกิจกรรม</h4>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="text-align:center;">
                            <?php
                            if (
                                $halaqah == 'ผ่าน' && $qiyaam == 'ผ่าน' && $eiatiqaf == 'ผ่าน' && $week == 'ผ่าน' && $phathom == 'ผ่าน'
                                && $phajjim == 'ผ่าน' && $camp == 'ผ่าน' && $chomrom == 'ผ่าน' && $chumnum == 'ผ่าน'
                                && $abc == 'ผ่าน' && $smo == 'ผ่าน'
                            ) {
                            ?>
                                <h4><i class="fa fa-check text-success"><b>ผ่านกิจกรรม</b></i></h4>
                            <?php
                            } else {
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
            </tbody>
        </table>
    </div>
</div>